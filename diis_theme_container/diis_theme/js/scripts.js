// JavaScript and jQuery goodness. Don't binge on it.
(function($, Drupal) {
    // No code above this line VVVVV
    /* -------------------------------------------- */
    // Drupal Behaviours
    Drupal.behaviors.diis_theme_behavior = {
        attach: function(context, settings) {} // End Attach
    }; // End diis_theme_behaviour



    // Create the back to top button
    Drupal.behaviors.createBackToTopLink = {
        attach: function(context, settings) {

            // Create the link
            $('body').append('<a href="#" class="back-to-top">Back to Top</a>');

            // Bind the scroll event to it
            var amountScrolled = 300;

            $(window).on('scroll', function() {
                if ($(window).scrollTop() > amountScrolled) {
                    $('a.back-to-top').fadeIn('slow');
                } else {
                    $('a.back-to-top').fadeOut('slow');
                }
            });

            // Animate the 'Back to top' action
            $('a.back-to-top, a.simple-back-to-top').on('click touch', function() {
                $('html, body').animate({
                    scrollTop: 0
                }, 700);
                return false;
            });
        }
    }; // End createBackToTopLink


    // Responsive tables

    Drupal.behaviors.responsiveTable = {
        attach: function(context, settings) {
            $('table', context).once('responsiveTable', function() {

                // *** Notes ***
                // To avoid tables jumping and the script firing due to table borders, specify table width to be 99.75% instead of 100%
                // Do not use 'max-width', as this causes rendering issues for regular tables that don't use the script

                // Test if the given table is wider than the screen. Used to add warning above large tables.
                // Using .width() instead of innerWidth(), in order to grab width only with no padding. The '-1' is due to width:auto randomly triggering the script.
                function tableWiderThanScreen($el) {
                    return ($el.outerWidth(true) - 1) > $('#region-content').width();
                }

                function fixTables() {
                    // Start fresh, remove any existing mobile elements
                    $('.mobile-table-text').remove();
                    $('.mobile-table-wrapper table').unwrap();

                    // Target any tables in the main content region only
                    $('#region-content table:not(.sticky-header):not(#table-header-copy)').each(function() {

                        var $table = $(this),
                            $wrapElements = $table.find('.text-wrap') || false;

                        if (tableWiderThanScreen($table) && $wrapElements != false) {
                            $wrapElements.removeClass('text-wrap');

                            // Add text above wide tables
                            var $textAbove = $([
                                    "<div class='mobile-table-text'>",
                                    "<p><strong>Large table warning</strong></p>",
                                    "<ul>",
                                    "<li>This table is large, and may need to be scrolled sideways to view all its content.</li>",
                                    "<li>You can also <a href='javascript:void(0);'>open this table in a new window</a>.</li>",
                                    "</ul>",
                                    "</div>"
                                ].join('')),
                                $stickyHeader = $table.prev('.sticky-header');

                            // Wire the 'New Window' link to open a new window populated with a styled copy of the table
                            $textAbove.find('a').on('click touch', function() {

                                // Grab the assets from the HTML source
                                // NOTE: The $closeLink allows the user to resume tabbing from the 'open in new window' link once the new window is closed
                                // NOTE: Hardcoded styles are optional, but omitted by default as all styles should be properly added to the CSS
                                var $closeLink = '<p><a href="javascript:window.open(' + "''" + ",'_self'" + ').close();">Close this window</a></p>',
                                    $newStylesheets = $('link[rel=stylesheet]').clone(),
                                    $newStyles = $('style').clone(),
                                    //$pageScripts = $('script:not(script[src*="contextual"]):not(script[src*="analytics"]):not(script[src*="admin"]):not(script[src*="toolbar"])').clone(),
                                    $pageScripts = $('script:not(script[src*="contextual"]):not(script[src*="analytics"]):not(script[src*="admin"]):not(script[src*="toolbar"])').clone(),
                                    $favicons = $('link[href*=favicon][rel*=icon]'),

                                    // Select everything inside the .export-view wrapper except the mobile wrapper and warning text
                                    $tableAssets = $table.parents('.export-view').children().not('.mobile-table-text, .mobile-table-wrapper').clone(),
                                    $stickyHeader = $table.prev('.sticky-header');

                                // Grab a copy of the table HTML
                                var $newTable = $table.clone();

                                // Make href urls absolute since the popup doesn't have the same url as the current page
                                // (requires jQuery 1.6+)
                                $newStyles.each(function() {
                                    $(this).attr('href', $(this).prop('href'));
                                });

                                $newTable.find('a').each(function() {
                                    $(this).attr('href', $(this).prop('href'));
                                });

                                // The following seems to be the best cross-browser method of injecting content into a new window (updated for Drupal structure)
                                // NOTE: The view-table.htm file is directly FTPd to the server, not uploaded via Drupal.
                                // 		 There is also a copy for each database on apps.tga.gov.au for when loaded via iFrames.

                                popupContent = "";

                                function addContent(e) {
                                    e.each(function() {
                                        popupContent += this.outerHTML;
                                    });
                                }

                                addContent($favicons)
                                addContent($newStylesheets);
                                addContent($newStyles);

                                popupContent += $closeLink;

                                // Add all JS scripts on the page to retain functionality on complex tables, i.e. sorting, filtering etc.
                                addContent($tableAssets);
                                addContent($stickyHeader);

                                popupContent += $newTable[0].outerHTML;

                                // Place all scripts after content, if not loaded within an iFrame, to avoid issues with HTML loading after the scripts

                                if (!inIframe()) {
                                    addContent($pageScripts);
                                }

                                // This iFrame detection snippet fires when clicking the 'open this table' link

                                function inIframe() {
                                    try {
                                        return window.self !== window.top;
                                    } catch (e) {
                                        return true;
                                    }
                                }

                                // Detect site's theme path by nicking it from something that loads with entity reference
                                // and appears on all pages, like the Crest
                                var $themePath = $('#main-page-top .coa-titles > a > img').attr('src').split('/');

                                // Drop the theme assets from the end of the src to get the actual theme path
                                $themePath.splice(-2);
                                var $newThemePath = $themePath.join('/');

                                var w = window.open($newThemePath + "/view-table.htm");
                            });

                            // Add the warning text above the original table once it's assessed everything else
                            $table.before($textAbove);

                            // Wrap table with div to contain page width
                            $table.wrap('<div class="mobile-table-wrapper mobile-table-scroll-right"></div>');


                            // Add the sticky header if one exists
                            $table.before($stickyHeader);

                            var $tableWrap = $table.parent();


                            // Add/remove CSS classes, depending on scrolling position
                            $tableWrap.on('scroll', function() {

                                var $this = $(this),
                                    $wrapOffset = $this.offset().left,
                                    $left = $this.scrollLeft(),
                                    $tableWidth = $table.width(),
                                    $tableStickyHeader = $this.children('.sticky-header'),
                                    $stickyOffset = $wrapOffset - $left;


                                // NOTE: the stickyHeader will not be hidden by the overflow-x of the parent. This is a CSS limitation :(
                                $tableStickyHeader.css('left', $stickyOffset + 'px');

                                // This only fires when scrolling back, as once scrolled, $left will not == 0
                                if ($left == 0) {
                                    $tableWrap.addClass('mobile-table-scroll-right').removeClass('mobile-table-scroll-left mobile-table-scroll');
                                } else if (($tableWidth - $left - 1) >= $this.width()) {
                                    $tableWrap.addClass('mobile-table-scroll').removeClass('mobile-table-scroll-left mobile-table-scroll-right');
                                } else {
                                    $tableWrap.addClass('mobile-table-scroll-left').removeClass('mobile-table-scroll-right mobile-table-scroll');
                                }
                            }); // End tableWrap.scroll

                        } else {
                            if ($wrapElements != false) {
                                $wrapElements.each(function() {
                                    var $this = $('this');

                                    if (!$this.hasClass('text-wrap')) {
                                        $this.addClass('text-wrap');
                                    }
                                });
                            }
                        } // End if tableWiderThanScreen
                    }); // End table.each function
                } // End fixTables()

                // Trigger the table width assessment
                fixTables();

                // Fire table width assessment when browser is resized, but on a 250ms timer to reduce number of times code runs
                $(window).resize(function() {
                    clearTimeout($.data(this, 'scrollTimer'));
                    $.data(this, 'scrollTimer', setTimeout(function() {
                        fixTables();
                    }, 250));
                })
            }); // End table context function
        } // End attach
    } // End responsiveTables 



    // Font resize
    // Brought to you by a dude called Eric: https://davidwalsh.name/change-text-size-onclick-with-javascript
    Drupal.behaviors.fontResize = {
        attach: function(context, settings) {
            function resizeText(e, multiplier) {
                e.preventDefault();
                if (document.body.style.fontSize === "") {
                    document.body.style.fontSize = "1.0em";
                }
                // Target just the main Content area
                document.getElementById('block-system-main').style.fontSize = parseFloat(document.body.style.fontSize) + (multiplier * 0.2) + "em";
            }
            $('#text-resize-large').on('click touch', function(e) {
                resizeText(e, 1);
            });
            $('#text-resize-reset').on('click touch', function(e) {
                resizeText(e, 0);
                //$('#main-content').css('font-size', document.body.style.fontSize); // Simply strip the inline styles to reset the font size
            });
            $('#text-resize-small').on('click touch', function(e) {
                resizeText(e, -1);
            });
        }
    }; // End fontResize



    //Case study slide
    Drupal.behaviors.feedbackForm = {
        attach: function(context, settings) {
            $("#flip").click(function() {
                $("#cs-content").slideToggle("fast");
            });
        }
    }; // End caseStudySlide


    //privacy slide
    Drupal.behaviors.privacyStatement = {
        attach: function(context, settings) {
            $("#privacy").click(function() {
                $("#privacy-content").slideToggle("fast");
            });
        }
    }; // End privacyStatement


    Drupal.behaviors.heroTilesSubmenuAnimation = {
        attach: function(context, settings) {
            $('.hero-list h2 a').each(function() {

                var $link = $(this);

                $link.parents('.view-taxonomy-sector')
                    .find('> .view-content, > .view-footer')
                    .wrapAll('<div class="hero-list-target"></div>');

                var $target = $link.parents('.view-taxonomy-sector').find('.hero-list-target');

                // Hide targets with JS, lest JS is disabled
                $target.hide();

                $link.on('click touch', function(e) {
                    e.preventDefault();
                    $link.toggleClass('hero-list-open');
                    $target.slideToggle(250).toggleClass('hero-list-target-open');
                    $link.hasClass('hero-list-open') ? $link.attr('aria-label', 'Close menu').attr('aria-expanded', 'true') : $link.attr('aria-label', 'Open menu').attr('aria-expanded', 'false');
                }); 
            });
        }
    }; // End homepageSliders



    // Expand-Contract widget
    Drupal.behaviors.expandContractWidget = {
        attach: function(context, settings) {
            $('.expand-link').each(function() {
                var $this = $(this),
                    hasAnchor = false,
                    hasVoid = false;
                // If the item already contains links, don't run
                if ($this.html().indexOf('<a') >= 0) {
                    hasAnchor = true;
                    // Check for oldschool 'expand-collapse' javascript links that used 'href="javascript: void(0)"'
                    if ($this.html().indexOf('void(0)') >= 0) {
                        hasAnchor = false;
                        hasVoid = true;
                    }
                } else {
                    hasAnchor = false;
                }
                var $contents = $this.html(),
                    $contentsId = $this.attr('id'),
                    $contentsNewId = $this.text().toLowerCase()
                    // Replace common words (space either side to prevent targeting bits of words)
                    .replace(/ the /g, '  ')
                    .replace(/ is /g, '  ')
                    .replace(/ a /g, '  ')
                    .replace(/ at /g, '  ')
                    .replace(/ an /g, '  ')
                    .replace(/ are /g, '  ')
                    .replace(/ and /g, '  ')
                    .replace(/ of /g, '  ')
                    .replace(/ if /g, '  ')
                    // Lastly, replace all strings of space characters with a single dash, regardless of length
                    .replace(/\W+/g, '-'),
                    $idCount = $('#' + $contentsNewId).length,
                    linkStart = '<a role="button" class="expand-link-js-a" tabindex="0">',
                    showMore = '<span class="element-invisible">Show more information about</span> ',
                    linkEnd = '</a>',
                    $children = $(this).next().hasClass('expand-item'),
                    $alreadyLinked = $this.find('.expand-link-js-a').length,
                    $message = 'This "expand-link" item cannot be linked. ',
                    itemFail = false;

                function stripItem(item) {
                    // If the link already contains a link, remove the targetting class so nothing fires
                    item.removeClass('expand-link');
                    // Also remove the class from the child element
                    item.next('.expand-item').removeClass('expand-item');
                }
                // Check each fail condition, but not with 'else if's - this way, every problem is noted at the start
                if ($alreadyLinked > 0) {
                    $message += 'It already contains the auto-link code \'.expand-link-ja-a\'. ';
                    itemFail = true;
                }
                if (hasAnchor === true) {
                    $message += 'It contains anchor links. ';
                    itemFail = true;
                }
                if ($children === false) {
                    $message += 'It has no element with the class \'.expand-item\' after it. ';
                    itemFail = true;
                }
                if (hasVoid === true) {
                    $message += 'It already contains a \'href="javascript:void(0)"\' anchor link. ';
                    itemFail = true;
                }
                if (itemFail === true) {
                    console.log($this.text() + ': ' + $message);
                    stripItem($this);
                }
                // If the link has not already been added, add one
                if (hasAnchor === false && !$alreadyLinked && $children === true && hasVoid === false) {
                    // If the inner text doesn't already start with 'show xyz'
                    if ($contents.toLowerCase().indexOf('show ') === -1) {
                        $this.html(linkStart + showMore + $contents + linkEnd);
                    } else {
                        $this.html(linkStart + $contents + linkEnd);
                    }
                    // Bind the Click and Keyup events to the dynamically-generated links
                    $this.children('a.expand-link-js-a').on('click touch keyup', function(e) {
                        // If the spacebar is used, prevent it from scrolling the page down
                        /*if (e.keyCode == 32) {
                        // TODO: Spacebar still scrolls down #http://stackoverflow.com/questions/22559830/html-prevent-space-bar-from-scrolling-page
                        e.preventDefault();
                        console.log('spacebar detected');
                        showHide($this);
                        }*/
                        // Only fire if the key pressed is 'Enter', or the event type is a 'click'
                        if (e.keyCode == 13 || e.type == 'click') {
                            showHide($this);
                        }
                    });
                }
                // Expand Item ID generator
                // If the element has no ID assigned
                if ($contentsId === null) {
                    // Check the value to be used isn't already present on the page as an ID
                    if ($idCount !== 0) {
                        // Select all IDs that start with the proposed ID
                        var $similarIds = $('*[id^="' + $contentsNewId + '"]');
                        // If part of the proposed ID already exists on the page, append a counter to keep it unique
                        if ($similarIds !== null) {
                            $this.attr('id', $contentsNewId + '-' + $idCount);
                        }
                    } else {
                        // If the ID hasn't already been used, add it to the link
                        $this.attr('id', $contentsNewId);
                    }
                }
            }); // End .each()
            // Show/Hide widget
            function showHide(e) {
                // Toggle all expand items between this expand-link and the next
                e.nextUntil('.expand-link', '.expand-item').first().slideToggle('fast');
                e.toggleClass('expanded');
            }
        }
    }; // End Expand-contract widget



    // Substitute file icon
    Drupal.behaviors.substituteFileIcon = {
        attach: function(context, settings) {
            $('img.file-icon').css("display", "none");

            var fileTypes = ["txt", "doc", "docx", "xls", "xlsx", "pdf",
                    "ppt", "pptx", "pps", "ppsx", "odt", "ods", "odp",
                    "mp3", "mov", "mp4", "m4a", "m4v", "mpeg", "avi", "ogg", "oga", "ogv",
                    "zip", "csv"
                ],
                downloadIcon = '<svg class="svg-inline--fa fa-arrow-alt-circle-down fa-w-16 icon-min-sz" aria-hidden="true" focusable="false" data-fa-processed="" data-prefix="far" data-icon="arrow-alt-circle-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm-32-316v116h-67c-10.7 0-16 12.9-8.5 20.5l99 99c4.7 4.7 12.3 4.7 17 0l99-99c7.6-7.6 2.2-20.5-8.5-20.5h-67V140c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12z"></path></svg>&nbsp;';

            $.each(fileTypes, function(i) {
                $('#main-content a[href$=".' + fileTypes[i] + '"]')
                    .wrap('<span class="linkwrap"></span>')
                    .before(downloadIcon);
            });
        } // End Attach
    }; // End substituteFileIcon



    // Feedback form
    Drupal.behaviors.setupFeedbackForm = {
        attach: function(context, settings) {
            // First, check if the form exists
            if ($('#webform-client-form-13321').length) {

                var $form = $('#webform-client-form-13321'),
                    $tellUsMore = $form.find('.form-actions .form-items-cubmitted-comments'),
                    $submitButton = $form.find('.form-actions button.form-submit'),
                    $options = $form.find('input[id^=edit-submitted-rating-]');

                // Hide the submit button no matter what
                $submitButton.attr('disabled', 'disabled');

                // When an option is selected, do stuff
                $options.on('change', function() {
                    // Only use this VVVV if the webform configuration is not used to manage field visibility 
                    //	$tellUsMore.slideDown();
                    $submitButton.removeAttr('disabled');
                });

                // Enforce character limit on free text field responses
                var $textField = $('#edit-submitted-comments'),
                    $wrapper = $textField.parent('div'),
                    $charLimit = 250;

                $wrapper.append('<div id="charLimitWrap"><span><strong>' + $charLimit + '</strong> characters remaining' + '</span></div>');

                var $charLimitWrap = $('#charLimitWrap > span');

                // detect when the form is being used
                $textField.on('focus, keyup', function() {

                    var $this = $(this);

                    // count the characters present
                    var $charCount = $this.val().length;

                    // If the count exceeds the charLimit, block further typing
                    if ($charCount > $charLimit) {

                        // Warn the user how far over the limit they've gone
                        $charLimitWrap.html('<strong style="color: #f00;">' + parseInt(($charLimit - $charCount) * -1) + '</strong> characters over the limit');

                        // Disable the submit button so they can't possibly send the response
                        $submitButton.attr('disabled', 'disabled');
                    } else {

                        $charLimitWrap.html('<strong>' + parseInt($charLimit - $charCount) + '</strong> characters remaining');

                        // Enable the submit button
                        $submitButton.removeAttr('disabled');
                    }
                });
            }
        }
    }; // End setupFeedbackForm



    // Toggle the Footer open/closed on mobiles to save space

    Drupal.behaviors.toggleFooterOnMobiles = {
        attach: function(context, settings) {
            // Keep the functionality simple and isolated from styles. 
            // Use CSS to control visibility wherever possible to avoid complication. 
            var $footerLink = $('.js #footer-nav-link'),
                $footerLinkText = $footerLink.children('span'),
                $footerLinkTextShow = $footerLinkText.text(); // Detect the initial value dynamically, so it's only controlled via the template
                $footerLinkTextHide = 'Hide',
                $footerWrap = $('#footer-nav-wrapper');

            $footerLink.on('click touch', function(e) {

                e.stopPropagation();

                // Show or hide the footer, noting that .slideToggle() triggers a 
                // bug on devices; scrolling up when over the exposed footer 
                // menu snaps it shut randomly. 
                $footerWrap.toggle();

                // Toggle the text value of the link to reflect the action
                $footerLinkText.text() == $footerLinkTextHide ? $footerLinkText.text($footerLinkTextShow) : $footerLinkText.text($footerLinkTextHide);

                if (!$('HTML').hasClass('lt-ie9')) {
                    e.preventDefault();
                };
            }); // End footerLink touch
        }
    }; // End toggleFooterOnMobiles



    // Remove hidden file links from Hero tiles. This is added by the 'raw image' dispaly format

    Drupal.behaviors.cleanHeroTiles = {
        attach: function(context, settings) {
            $('.front .hero-list .view-header > .file-image > h2.element-invisible').remove();
        }
    }



    // Link the Share This Page functionality up

    Drupal.behaviors.bindSocialLinks = {
        attach: function(context, settings) {

            $('#share-facebook').on('click touch', function(e) {
                window.open('https://www.facebook.com/sharer/sharer.php?u=' + window.location.href);
                e.preventDefault();
            });
            
            $('#share-google').on('click touch', function(e) {
                window.open('https://plus.google.com/share?url=' + window.location.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
                e.preventDefault();
            });
            
            $('#share-twitter').on('click touch', function(e) {
                window.open('https://www.twitter.com/intent/tweet?url=' + window.location.href.split('#')[0] + '&text=' + document.title.replace("|", "-"));
                e.preventDefault();
            });

            $('#share-linkedin').on('click touch', function(e) {
                linkedIn();
                e.preventDefault();
            });

            $('#share-print').on('click touch', function(e) {
                window.print();
                e.preventDefault();
            });

            $('#share-email').on('click touch', function(e) {
                emailPage();
                e.preventDefault();
            });
        }
    }


    // Search results page - collapse the Filter options for small screens

    Drupal.behaviors.searchResultsFilters = {
        attach: function(context, settings) {
            //if ($('body').hasClass('page-search') && $('.block-facetapi').length !== 0) {
            if ($('body').hasClass('page-search page-search-advanced')) {

                // It's a Faceted Search page, carry on. Like nothing really matters

                var filters = $('#region-sidebar-first > .region-sidebar-first section[id^=block-facetapi]');

                // Add a wrapper around all the Faceted search blocks
                filters.wrapAll('<div id="facet-filter-wrapper" aria-expanded="true"></div>');

                var wrapper = $('#facet-filter-wrapper');

                // Add a link for showing/hiding FS 
                wrapper.before('<p><a href="javascript:void(0);" id="filter-toggle" aria-label="Search filters menu" role="button">Filter these results <span>+</span></a></p>');

                var filterLink = $('#filter-toggle'),
                    filterState = filterLink.find('span');

                // Check if the filters are already being used. Don't hide them if Yes
                if (filters.find('.facetapi-active').length == 0) {
                    wrapper.attr('aria-expanded', 'false').hide();
                } else {
                    filterState.text('-');
                }

                // Assess if the filters are visible
                function checkFilters() {
                    if (wrapper.is(':visible')) {
                        wrapper.attr('aria-expanded', 'false').hide();
                        filterState.text('+');
                    } else {
                        wrapper.attr('aria-expanded', 'true').show();
                        filterState.text('-');
                    }
                }

                // Show or hide the Filters
                filterLink.on('click touch', function() {
                    checkFilters();
                });
            }
        }
    }

    // SVG FontAwesome icons load without focusable="false" applied, leading to false tabs in IE
    // This adds the attribute when the user focuses on the parent anchor
    
    Drupal.behaviors.nonFocusableSVGs = {
        attach: function(context, settings) {
            $('#share-this-page a, #footer-follow-links a').on('focus',function() {
                $(this).children('svg').attr('focusable', 'false');
            });
        }
    }


    // Main menu

    Drupal.behaviors.mainMenu = {
        attach: function(context, settings) {

            // Get the main menu link
            var $menuLink = $('#menu'),
                $menuLinkLabel = $menuLink.next('label');

            // If open, hide the menu when the page loads.
            // When the User goes 'Back' using the browser navigation buttons,
            // most browsers will retain the values of form fields as a convenience.
            // This leaves the menu open, as it uses a form field as the toggle control.
            if ($menuLink.prop('checked', true)) {
                $menuLink.prop('checked', false);
            }

            // Add some aria accessibility attributes
            $menuLink.attr('role', 'button')
                    .attr('aria-expanded', 'false')
                    .attr('aria-label', 'Main menu');
            
            // Allow the Enter key to trigger the checkbox and toggle the 'aria-expanded' value
            $menuLink.on('keyup', function(e) {
                if (e.which == 13) {
                    // As the checkbox can only have one of 2 values, tell it to be the reverse
                    // of whatever it currently is.
                    this.checked = !this.checked;
                    $('#menu:checked').length != 0 ? $menuLink.attr('aria-expanded', 'true') : $menuLink.attr('aria-expanded', 'false');
                    // If it's the spacebar, stop if before it triggers the checkbox. This is to 
                    // provide consistent navigation controls to users. 
                } else if (e.which == 32) {
                    return false;
                }
            });

            // Allow toggling the menu checkbox's 'aria-expanded' values when the label is clicked
            // NOTE: the order of the if statement is reversed from the keyup function above, as the
            // click action is evaluated BEFORE the checkbox changes state
            $menuLinkLabel.on('click touch', function() {
                $('#menu:checked').length != 0 ? $menuLink.attr('aria-expanded', 'false') : $menuLink.attr('aria-expanded', 'true');
            });

            // Add ID to the menu
            $('#region-header .menu-name-menu-about-us > ul').attr('id', 'menus');
            
            // Get ALL the expand links
            // NOTE: the .active menu class does not reliably appear between pages, 
            // so we can't use it as a selector here. 
            var $expandLinks = $('#menus > li.leaf > a');

            // For each expand-collapse link, do stuff
            $expandLinks.each(function() {

                var $this = $(this),
                    $targetMenu = $this.parent().next('li.expanded').children('ul.menu'),
                    $parentMenuLinkText = $this.parent().next('li.expanded').children('a').text();

                // If not submenu exists, stop right there.
                if (!$targetMenu.length) {
                    return
                }

                // Turn expand/contract links href into javascript:void(0) and add aria attributes
                $this.attr('href', 'javascript:void(0);')
                    .attr('role', 'button')
                    .attr('aria-expanded', 'false')
                    .attr('aria-label', $parentMenuLinkText + ' menu');
                
                // Hide the submenus
                $targetMenu.hide();

                // When clicked/touched, show/hide the target menu, toggle the +/- icon and 
                // the aria-expanded attributes
                $this.on('click touch', function() {
                    $targetMenu.toggle();
                    $this.text() == '+' ? $this.text('-') : $this.text('+');
                    $this.attr('aria-expanded') == 'false' ? $this.attr('aria-expanded', 'true') : $this.attr('aria-expanded', 'false');
                });
            });
        }
    }; // End Main Menu


    // Detect when the page is being printed and make some adjustments to suit paper

    Drupal.behaviors.printDetection = {
        attach: function(context, settings) {

            // Test if the given table is wider than the screen. Used to add warning above large tables.
            // Using .width() instead of innerWidth(), in order to grab width only with no padding. The '-1' is due to width:auto randomly triggering the script.
            function tableWiderThanScreen($el) {
                return ($el.outerWidth(true) - 1) > $('.region-content').width();
            }

            // Do stuff when the User tells the browser to print the page
            var beforePrint = function() {

                // Insert the print-only elements prior to calculating overflows
                $('body').before('<style class="print-assists">' +
                                    '#region-content a[href]:after {content: " (" attr(href) ")";' +
                                 '</style>');
                
                // Remove any existing wrappers, as some browsers fire this event twice:
                // https://www.tjvantoll.com/2012/06/15/detecting-print-requests-with-javascript/#update-july-16th-2012-1
                $('.print-table').unwrap();

                // Remove responsive table wrappers, if any
                $('.mobile-table-wrapper').unwrap()
                $('.mobile-table-text').remove();

                $('#region-content table').each(function() {
                    // this returns 100% for all tables due to CSS
                    if (tableWiderThanScreen($(this)) && !$(this).parent().hasClass('print-table')) {
                        $(this).wrap('<div class="print-table"></div>');
                    }
                });
            };

            // Do stuff after the browser is finished printing the page
            var afterPrint = function() {
                // remove print assists
                $('.print-assists').remove();
                $('.print-table > table').unwrap();
            };

            window.onbeforeprint = beforePrint;
            window.onafterprint = afterPrint;
        }
    } // End printDetection


    // Add an empty 'Alt' text attribute to images rendered with no Alt text

    Drupal.behaviors.imageAltText = {
        attach: function(context, settings) {

            // Target any image tag on the page without an Alt attribute
            $.each($('img:not(img[alt])'), function() {
                $(this).attr('alt', '');
            });
        }
    } // End imageAltText


    // Add a wrapper to iframes, include a data-iframe-src for accessibility
    
    Drupal.behaviors.wrapIframe = {
        attach: function(context, settings) {
            var $source = $("main iframe").attr("src");
            $("main iframe").wrap("<div class='iframe-wrapper' data-iframe-src=''></div>");
            $("div.iframe-wrapper").attr("data-iframe-src", $source);
        } // End Attach
    }; // End wrapIframe


    // Stop Users runing empty searches, since Drupal seems to ignore all settings
    // that would do that through the UI.

    Drupal.behaviors.preventEmptySearches = {
        attach: function(context, settings) {

            // Target only Views-generated search forms. Using attribue selectors to avoid ACSF/Sandbox ID clashes
            var $searchForm = $('form[id^=views-exposed-form][id*=search-page]'),
                popupAlertText = 'Please enter at least one word (3 characters or more), letters and numbers only.';
            
            // Evaluate the fields each time a submission is attempted,
            // as the User can freely change the value post-pageload.
            $searchForm.on('submit', function(event) {

                // Block the form from submitting, for now
                event.preventDefault();

                var $this = $(this),
                    permitSearch = false;
                    // As the form PHP template uses a counter to prevent duplicate IDs,
                    // use attribute selectors to find matches.
                    var $searchField = $this.find('input[id^=edit-search-api-views-fulltext], input[id^=edit-search-api-views-publications]');
                    

                // Add a  class to the form field wrapper if none exists 
                if (!$searchField.parent().hasClass('.popupAlertWrapper')) {
                    $searchField.parent().addClass('popupAlertWrapper');
                }
                
                // Remove any existing alerts when the submission is attempted
                $('.popupAlert').remove();

                // Replace all non-alphanumeric characters with a space, then split into an array on the spaces:
                // https://stackoverflow.com/questions/20864893/replace-all-non-alpha-numeric-characters-new-lines-and-multiple-white-space-wi 
                var $searchStringParts = $searchField.val().replace(/[\W_]+/g, " ").split(' ');

                // Count the length of terms entered. If nothing has 3+ characters, submit stays disabled
                for (var i = 0; i < $searchStringParts.length; i++) {
                    
                    var $part = $searchStringParts[i];

                    // If a single match is found, cancel the operation as the rest aren't needed
                    if ($part.length >= 3) {
                        permitSearch = true;
                        break;
                    }
                }

                // Add the alert when called, if it's not already there
                function popupAlert() {
                    if (!$searchField.next('popupAlert').length) {
                        $searchField.after('<p class="popupAlert">' + popupAlertText + '</p>');
                        // Reset the tab position to the search field, so keyboard users don't get led astray
                        $searchField.focus();
                    }
                }

                // 'undo' event.preventDefault(), or fire the alert 
                // https://stackoverflow.com/questions/5651933/what-is-the-opposite-of-evt-preventdefault
                permitSearch === true ? $(this).unbind('submit').submit() : popupAlert();
            });
        }
    } // End preventEmptySearches

    // Anything that doesn't need a Drupal Behaviour and needs to runs on doc load goes in here VVVV
    /* $(function() {
	
	
    }); // End $(function())
    */
    // No code below this line VVVVV
    /* -------------------------------------------- */
})(jQuery, Drupal);
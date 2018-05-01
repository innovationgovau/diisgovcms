// JavaScript and jQuery goodness. Don't binge on it.
(function($, Drupal) {
	// No code above this line VVVVV
	/* -------------------------------------------- */
	// Drupal Behaviours
	Drupal.behaviors.diis_theme_behavior = {
		attach: function(context, settings) {
			} // End Attach
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
					return ($el.outerWidth(true) -1) > $('#region-content').width();
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
							// NOTE: Hardcoded styles are optional, but omitted by default as all styles should be properly added to the CSS. This also avoids the mountains of CSS the AddThis plugin includes...
								var	$closeLink = '<p><a href="javascript:window.open(' + "''" + ",'_self'" + ').close();">Close this window</a></p>',
									$newStylesheets = $('link[rel=stylesheet]').clone(),
									$newStyles = $('style').clone(),
									$pageScripts = $('script:not(script[src*="contextual"]):not(script[src*="analytics"]):not(script[src*="admin"]):not(script[src*="toolbar"])').clone(),
							
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

								$newStylesheets.each(function() {
									popupContent += this.outerHTML;
								});

								$newStyles.each(function() {
									popupContent += this.outerHTML;
								});

								popupContent += $closeLink;

							// Add all JS scripts on the page to retain functionality on complex tables, i.e. sorting, filtering etc.
		 						$tableAssets.each(function() {
									popupContent += this.outerHTML;
								});

								$stickyHeader.each(function() {
									popupContent += this.outerHTML;
								});

								popupContent += $newTable[0].outerHTML;

							// Place all scripts after content, if not loaded within an iFrame, to avoid issues with HTML loading after the scripts
								
								if (!inIframe()) {
									$pageScripts.each(function() {
										popupContent += this.outerHTML;
									});
								}

							// This iFrame detection snippet fires when clicking the 'open this table' link
		 
								function inIframe() {
								    try {
								        return window.self !== window.top;
								    } catch (e) {
								        return true;
								    }
								}

								//TODO: $path may need to change based on environment...
								var $path = '/sites/default/files/',
									w = window.open($path + "view-table.htm");
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
								}
								else if(($tableWidth - $left - 1) >= $this.width()) {
									$tableWrap.addClass('mobile-table-scroll').removeClass('mobile-table-scroll-left mobile-table-scroll-right');
								}
								else {
									$tableWrap.addClass('mobile-table-scroll-left').removeClass('mobile-table-scroll-right mobile-table-scroll');
								}
							}); // End tableWrap.scroll

						}
						else {
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



	// Meanmenu
	// @TODO: Add body class when menu is open or closed for better CSS targeting
	Drupal.behaviors.meanMenu = {
		attach: function(context, settings) {
			$('.region-header #block-menu-menu-about-us').meanmenu({
				meanMenuContainer: '#meanmenu-dest',
				meanScreenWidth: '9999',
				meanMenuOpen: '<span></span><span></span><span></span><span>MENU</span>', // hamburger menu + the word 'Menu'
				meanMenuClose: '<span></span><span></span><span>CLOSE</span>',
				meanMenuCloseSize: 'inherit'
			});
		}
	};// End meanMenu



	Drupal.behaviors.homepageSliders = {
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
					// @TODO: This lags and jumps badly only when opening...
					$target.slideToggle(250).toggleClass('hero-list-target-open');
				});
			});
		}
	}; // End homepageSliders



	// Expand-Contract widget
	// TODO: Get spacebar working to toggle the buttons: http://fyvr.net/a11y/spacebar-action.html
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
			];
			
			$.each(fileTypes, function(i) {
				$('#main-content a[href$=".' + fileTypes[i] + '"]').before('<i class="far fa-arrow-alt-circle-down"></i>&nbsp;');
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
				$footerWrap.slideToggle(250);

				// Toggle the text value of the link to reflect the action
				$footerLinkText.text() == $footerLinkTextHide ? $footerLinkText.text($footerLinkTextShow) : $footerLinkText.text($footerLinkTextHide);
				
				if (!$('HTML').hasClass('lt-ie9')) {
					e.preventDefault();
				};
			});
			// Auto-reveal the footer if resized from mobile and the menu happens to be hidden
			$(window).bind('resize', function() {
				$footerWrap.removeAttr('style');
			});
		}
	}; // End toggleFooterOnMobiles



	// Remove hidden file links from Hero tiles. This is added by the 'raw image' dispaly format

	Drupal.behaviors.cleanHeroTiles = {
		attach: function(context, settings) {
			$('.front .hero-list .view-header > .file-image > h2.element-invisible').remove();
		}
	}

	// Anything that doesn't need a Drupal Behaviour and needs to runs on doc load goes in here VVVV
	/* $(function() {
	
	
	}); // End $(function())
	*/
	// No code below this line VVVVV
	/* -------------------------------------------- */
})(jQuery, Drupal);
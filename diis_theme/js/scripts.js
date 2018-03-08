// JavaScript and jQuery goodness. Don't binge on it.

(function($, Drupal) {
	// No code above this line VVVVV
	/* -------------------------------------------- */


	// Drupal Behaviours
	Drupal.behaviors.diis_theme_behavior = {
			attach: function(context, settings) {

				} // End Attach
		} // End diis_theme_behaviour


	// Create the back to top button

	Drupal.behaviors.createBackToTopLink = {
		attach: function(context, settings) {
			$('body').append('<a href="#" class="back-to-top">Back to Top</a>');

			var amountScrolled = 300;

			$(window).scroll(function() {
				if ($(window).scrollTop() > amountScrolled) {
					$('a.back-to-top').fadeIn('slow');
				} else {
					$('a.back-to-top').fadeOut('slow');
				}
			});
		}
	};



	// Animate the 'Back to top' action

	Drupal.behaviors.animateBackToTopLink = {
		attach: function(context, settings) {
			$('a.back-to-top, a.simple-back-to-top').on('click touch', function() {
				$('html, body').animate({
					scrollTop: 0
				}, 700);
				return false;
			});
		}
	};



	//Hover - Tooltip hover message

	Drupal.behaviors.tooltipMsg = {
		attach: function(context, settings) {
			function tooltipMsg() {

				// Add external link title attributes

				$('a[href^="http"]').filter(function() {
						return this.hostname && this.hostname !== location.hostname;
					})
					.addClass("external")

				var sitesClasses = [{
					hostname: 'business.gov.au',
					class: 'business',
					message: 'You are now leaving this website for the business.gov.au website'
				}, {
					hostname: 'minister.industry.gov.au',
					class: 'minister',
					message: 'This will take you to the Department of Industry, Innovation and Science Ministers site'
				}, {
					hostname: 'www.facebook.com/sharer.php',
					class: 'fbshare',
					message: 'Share via Facebook'
				}, {
					hostname: 'twitter.com/share',
					class: 'twittershare',
					message: 'Share via Twitter'
				}, {
					hostname: 'www.linkedin.com/shareArticle',
					class: 'linkedinshare',
					message: 'Share via LinkedIn'
				}, {
					hostname: 'plus.google.com/share',
					class: 'googleshare',
					message: 'Share via Google+'
				}, ]

				$.each(sitesClasses, function(index) {
					$('[href*="' + sitesClasses[index]['hostname'] + '"]').removeClass('external').addClass(sitesClasses[index]['class']);
					$('a.' + sitesClasses[index]['class'] + '').attr('title', sitesClasses[index]['message']);
				});

				$("a.external").attr('title', 'This will take you to an external website.');
				$("a.doc.external").attr('title', 'This document is located on an external website.');
			};
		}
	};


	// Font resize
	// Brought to you by a dude called Eric: https://davidwalsh.name/change-text-size-onclick-with-javascript
	Drupal.behaviors.fontResize = {
		attach: function(context, settings) {

			function resizeText(e, multiplier) {

				e.preventDefault();

				if (document.body.style.fontSize == "") {
					document.body.style.fontSize = "1.0em";
				}
				// Target just the main Content area
				document.getElementById('block-system-main').style.fontSize = parseFloat(document.body.style.fontSize) + (multiplier * 0.2) + "em";
			}

			$('#text-resize-large').on('click touch', function(e) {
				resizeText(e, 1)
			});
			$('#text-resize-reset').on('click touch', function(e) {
				resizeText(e, 0);
				//$('#main-content').css('font-size', document.body.style.fontSize); // Simply strip the inline styles to reset the font size
			});
			$('#text-resize-small').on('click touch', function(e) {
				resizeText(e, -1)
			});
		}
	};


	//Case study slide

	Drupal.behaviors.caseStudySlide = {
		attach: function(context, settings) {
			$("#flip").click(function() {
				$("#cs-content").slideToggle("fast");
			});
		}
	};


	// Meanmenu
	// @TODO: Add body class when menu is open or closed for better CSS targeting
	Drupal.behaviors.meanMenu = {
		attach: function(context, settings) {
			$('.region-header #block-menu-menu-about-us').meanmenu({
				meanMenuContainer: '#meanmenu-dest',
				meanScreenWidth: '9999',
				meanMenuOpen: '<span></span><span></span><span></span><span>Menu</span>', // hamburger menu + the word 'Menu'
				meanMenuClose: '<span></span><span></span><span>Close</span>',
				meanMenuCloseSize: 'inherit'
			});
		}
	};


	Drupal.behaviors.homepageSliders = {
		attach: function(context, settings) {

			$('.hero-list h2 a').each(function() {

				var $link = $(this);

				$link.parents('.view-taxonomy-sector')
					.find('.view-content, .view-content + .view-footer')
					.wrapAll('<div class="hero-list-target"></div>');

				var $target = $link.parents('.view-taxonomy-sector').find('.hero-list-target');

				// Hide targets with JS, lest JS is disabled
				$target.hide();

				$link.on('click touch', function(e) {
					e.preventDefault();
					$link.toggleClass('hero-list-open');
					$target.slideToggle(250).toggleClass('hero-list-target-open');
				});
			});
		}
	}



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
					$newIdHits = $('#' + $contentsNewId),
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
					// If the inner text doesn't already start with 'show xyz'i
					if (!$contents.toLowerCase().indexOf('show ') > -1) {
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
				if ($contentsId == null) {
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
			};
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
	} // End substituteFileIcon


	// Anything that doesn't need a Drupal Behaviour and needs to runs on doc load goes in here VVVV
	/* $(function() {
	
	
	}); // End $(function())
	*/
	// No code below this line VVVVV
	/* -------------------------------------------- */
})(jQuery, Drupal);
<?php
/**
* @file
* Default theme implementation to display the basic html structure of a single
* Drupal page.
*
* Variables:
* - $css: An array of CSS files for the current page.
* - $language: (object) The language the site is being displayed in.
*   $language->language contains its textual representation.
*   $language->dir contains the language direction. It will either be 'ltr' or 'rtl'.
* - $rdf_namespaces: All the RDF namespace prefixes used in the HTML document.
* - $grddl_profile: A GRDDL profile allowing agents to extract the RDF data.
* - $head_title: A modified version of the page title, for use in the TITLE
*   tag.
* - $head_title_array: (array) An associative array containing the string parts
*   that were used to generate the $head_title variable, already prepared to be
*   output as TITLE tag. The key/value pairs may contain one or more of the
*   following, depending on conditions:
*   - title: The title of the current page, if any.
*   - name: The name of the site.
*   - slogan: The slogan of the site, if any, and if there is no title.
* - $head: Markup for the HEAD section (including meta tags, keyword tags, and
*   so on).
* - $styles: Style tags necessary to import all CSS files for the page.
* - $scripts: Script tags necessary to load the JavaScript files and settings
*   for the page.
* - $page_top: Initial markup from any modules that have altered the
*   page. This variable should always be output first, before all other dynamic
*   content.
* - $page: The rendered page content.
* - $page_bottom: Final closing markup from any modules that have altered the
*   page. This variable should always be output last, after all other dynamic
*   content.
* - $classes String of classes that can be used to style contextually through
*   CSS.
*
* @see template_preprocess()
* @see template_preprocess_html()
* @see template_process()
*
* @ingroup themeable
*/
?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>"> <![endif]-->
<!--[if IE 9]>         <html class="no-js lt-ie10" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>"> <!--<![endif]-->
<head>
	<link rel="preconnect" href="https://fonts.googleapis.com/" crossorigin>
	<link rel="preconnect" href="https://cdnjs.cloudflare.com/" crossorigin>
	<title><?php print $head_title; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta property="og:title" content="<?php print $head_title; ?>">
	<meta property="og:locale" content="en_AU">
	<meta property="og:type" content="website">
	<meta property="og:description" content="Content management and website hosting for government.">
	<meta property="og:url" content="https://www.govcms.gov.au/">
	<meta property="og:site_name" content="govCMS">
	<meta property="og:image" content="<?php print '/' . path_to_theme(); ?>/img/og-image.png">
	<meta property="og:image:secure_url" content="<?php print '/' . path_to_theme(); ?>/img/og-image.png">
	<link rel="apple-touch-icon" href="<?php print '/' . path_to_theme(); ?>/favicons/apple-touch-icon.png">
	<link rel="shortcut icon" href="<?php print '/' . path_to_theme(); ?>/favicons/favicon.ico">
	<meta name="apple-mobile-web-app-title" content="govCMS">
	<meta name="application-name" content="govCMS">
	<meta name="msapplication-TileColor" content="#FFFFFF">
	<meta name="msapplication-TileImage" content="<?php print '/' . path_to_theme(); ?>/favicons/mstile-270.png">
	<meta name="theme-color" content="#4F82A2">
	<link rel="mask-icon" href="<?php print '/' . path_to_theme(); ?>/favicons/outline.svg" color="#4F82A2">
	<?php print $head; ?>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,600,600i,700,700i" >
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-TKM5HKB');</script>
	<!-- End Google Tag Manager -->
	<script defer src="https://use.fontawesome.com/releases/v5.0.4/js/all.js"></script>
	<!-- Social media Share icons -->
	<script>window.twttr=function(t,e,n){var i,o=t.getElementsByTagName(e)[0],r=window.twttr||{};return t.getElementById(n)?r:((i=t.createElement(e)).id=n,i.src="https://platform.twitter.com/widgets.js",o.parentNode.insertBefore(i,o),r._e=[],r.ready=function(t){r._e.push(t)},r)}(document,"script","twitter-wjs");var l=window.location,t=document.title;function linkedIn(){window.location="https://www.linkedin.com/shareArticle?mini=true&url="+l}function emailPage(){window.location="mailto:?subject="+t+"&body="+l}</script>
	<?php print $styles; ?>
	<?php print $scripts; ?>
</head>
<body class="<?php print $classes; ?>" <?php print $attributes;?>>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TKM5HKB" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<div id="skip-links">
		<a class="element-invisible element-focusable" href="#main-content-anchor">Skip to Content</a>
		<a class="element-invisible element-focusable" href="#meanmenu-dest">Skip to Main Navigation</a>
		<a class="element-invisible element-focusable" href="#block-search-form">Skip to Search</a>
	</div>
	<div id="print-crest" class="logos">
		<div class="coa-inline">
			<div class="coa-titles-inline">
				<div class="coa-titles">
					<a href="/">
						<img src=<?php print("/" . path_to_theme() . "/img/crest-black-256.png"); ?> alt="Home" class="coa-img" />
						<div>
							<span class="coa-line-one coa-lines-2">Australian Government</span>
							<span class="coa-line-one coa-lines-1">Department of Industry,<br>Innovation and Science</span>
						</div>
						<p>Beta</p>
						<span class="clearboth"></span>
					</a>
				</div>
			</div>
		</div>
	</div>
	<div id="main-body">
		<?php print $page_top; ?>
		<?php print $page; ?>
		<div id="is_tablet"></div>
		<div id="is_mobile"></div>
	</div>
</body>
</html>
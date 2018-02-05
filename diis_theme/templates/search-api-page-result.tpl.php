<?php

/**
* @file
* Default theme implementation for displaying a single search result.
*
* This template renders a single search result and is collected into
* search-results.tpl.php. This and the parent template are
* dependent to one another sharing the markup for definition lists.
*
* Available variables:
* - $url: URL of the result.
* - $title: Title of the result.
* - $snippet: A small preview of the result. Does not apply to user searches.
* - $info: String of all the meta information ready for print. Does not apply
*   to user searches.
* - $info_split: Contains same data as $info, split into a keyed array.
* - $module: The machine-readable name of the module (tab) being searched, such
*   as "node" or "user".
* - $title_prefix (array): An array containing additional output populated by
*   modules, intended to be displayed in front of the main title tag that
*   appears in the template.
* - $title_suffix (array): An array containing additional output populated by
*   modules, intended to be displayed after the main title tag that appears in
*   the template.
*
* Default keys within $info_split:
* - $info_split['module']: The module that implemented the search query.
* - $info_split['user']: Author of the node linked to users profile. Depends
*   on permission.
* - $info_split['date']: Last update of the node. Short formatted.
* - $info_split['comment']: Number of comments output as "% comments", %
*   being the count. Depends on comment.module.
*
* Other variables:
* - $classes_array: Array of HTML class attribute values. It is flattened
*   into a string within the variable $classes.
* - $title_attributes_array: Array of HTML attributes for the title. It is
*   flattened into a string within the variable $title_attributes.
* - $content_attributes_array: Array of HTML attributes for the content. It is
*   flattened into a string within the variable $content_attributes.
*
* Since $info_split is keyed, a direct print of the item is possible.
* This array does not apply to user searches so it is recommended to check
* for its existence before printing. The default keys of 'type', 'user' and
* 'date' always exist for node searches. Modules may provide other data.
* @code
*   <?php if (isset($info_split['comment'])): ?>
*     <span class="info-comment">
	*       <?php print $info_split['comment']; ?>
*     </span>
*   <?php endif; ?>
* @endcode
*
* To check for all available data within $info_split, use the code below.
* @code
*   <?php print '<pre>'. check_plain(print_r($info_split, 1)) .'</pre>'; ?>
* @endcode
*
* @see template_preprocess()
* @see template_preprocess_search_result()
* @see template_process()
*
* @ingroup themeable
*/
?>

<div id="top-and-first-wrapper">
<?php include "includes/header.tpl.php"; ?>
</div>
<main>
<!-- #page -->
<div id="page" class="clearfix">
	<!-- #main-content -->
	<a id="main-content-anchor" tabindex="-1"></a>
	<div id="main-content" data-js="responsive-video">
		<div class="container">
			<div id="region-highlighted">
				<?php print render($page['highlighted']); ?>
			</div>
		</div>
		<?php if ($messages): ?>
		<!-- #EOF region-higlighted parent container -->
		<div class="container">
			<div class="col-md-12">
				<!-- #messages-console -->
				<?php if ($messages): ?>
				<div id="messages-console" class="clearfix">
					<div class="row">
						<div class="col-md-12">
							<?php print $messages; ?>
						</div>
					</div>
				</div>
				<?php endif; ?>
				<!-- EOF: #messages-console -->
			</div>
		</div>
		<?php endif; ?>
		<!-- Main page content if not homepage -->
		<div class="container">
			<div class="row">
				<div class="col-md-9" id="region-content">
					<div class="post-preview">
						<a href="/<?php print $url['path']; ?>">
							<h2 class="post-title"><?php print $title; ?></h2>
						</a>
						<p class="post-subtitle"><?php print $snippet; ?></p>
					</div>
				</div>
				<div class="col-md-3" id="region-sidebar-second">
					<?php print render($page['sidebar_second']); ?>
				</div>
			</div>
			<!-- EOF:#main-content -->
		</div>
		<!-- EOF:#page -->
	</div>
</div>
</main>
<?php include "includes/footer.tpl.php"; ?>
<!-- EOF:#footer -->
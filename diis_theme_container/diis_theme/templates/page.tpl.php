<?php include "includes/header.tpl.php"; ?>


<section class="above-main" id="above-main">
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<div class="block-crumbs-wrapper">
					<?php
						// Conditionally display different Blocks for the breadcrumbs,
						// depending what page we're on. Search page detection method taken from:
						// https://drupal.stackexchange.com/questions/25/how-to-determine-if-the-current-drupal-page-is-a-search-results-page#answer-125
						
						if (arg(0) == 'search') {
							// This is a Search page, load Search Block content
							$block = module_invoke('block', 'block_view', '46');
					
						} else {
							// Otherwise, load Crumbs block content for all other page types
							$block = module_invoke('crumbs', 'block_view', 'breadcrumb');
						}
						print $block['content'];
					?>
				</div>
				<?php if (!empty($title)): ?>
				<div class="title">
					<h1 class="page-header"><?php print $title; ?></h1>
				</div>
				<?php endif; ?>
			</div>
			<div class="col-sm-3 text-resize-social-widget-wrapper">
				<?php $block = module_invoke('bean', 'block_view', 'text-resize-widget'); print render($block['content']); ?>
				<?php $block = module_invoke('bean', 'block_view', 'share-this-page-widget'); print render($block['content']); ?>
			</div>
		</div>
	</div>
</section>


<main>
	<!-- #page -->
	<div id="page" class="clearfix">
		<!-- #main-content -->
		<a id="main-content-anchor" class="element-invisible" tabindex="-1"></a>
		<div id="main-content" data-js="responsive-video">
			<div class="container">
				<div class="row">
					<div id="region-highlighted">
						<?php print render($page['highlighted']); ?>
					</div>
				</div>
			</div>
			
			
			<!-- Tabs, messages and links area -->
			<?php if ($tabs || $action_links): ?>
			<div class="container">
				<div>
					<!-- #tabs -->
					<?php if ($tabs = render($tabs)): ?>
					<div class="tabs">
						<?php print render($tabs); ?>
					</div>
					<?php endif; ?>
					<!-- EOF: #tabs -->
					<!-- #action links -->
					<?php if ($action_links): ?>
					<ul class="action-links">
						<?php print render($action_links); ?>
					</ul>
					<?php endif; ?>
					<!-- EOF: #action links -->
				</div>
			</div>
			<?php endif; ?>
			<!-- EOF: Tabs, messages and links area -->
			
			
			<!-- Main page content if not homepage -->
			<div class="container">
				<div class="row">
					<div class="col-md-12" id="region-content">
						<?php print render($page['content']); ?>
						<?php # conditionally add the node ID and Last updated date depending on the Content Type
						if ($show_page_details): ?>
							<hr>
							<div id="page-details">
								<p><span>Last updated:</span> <?php print format_date($node->changed, $type='custom', $format='j F Y'); ?></p>
								<p><span>Content ID:</span> <?php print($node->nid); ?></p>
							</div>
						<?php endif; ?>
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
<?php include "includes/header.tpl.php"; ?>


<section class="about" id="about">
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<div class="block-crumbs-wrapper">
					<p><?php
									// Conditionally dispaly different Blocks for the breadcrumbs,
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
					?></p>
				</div>
				<?php if (!empty($title)): ?>
				<div class="title">
					<h1 class="page-header"><?php print $title; ?></h1>
				</div>
				<?php endif; ?>
			</div>
			<div class="col-sm-3 text-resize-social-widget-wrapper">
				<?php $node = node_load(13271); print $node->body['und'][0]['value']; ?>
				<?php $node = node_load(13276); print $node->body['und'][0]['value']; ?>
			</div>
		</div>
	</div>
</section>


<main>
	<!-- #page -->
	<div id="page" class="clearfix">
		<!-- #main-content -->
		<a id="main-content-anchor" tabindex="-1"></a>
		<div id="main-content" data-js="responsive-video">
			<div class="container">
				<div class="row">
					<div id="region-highlighted">
						<?php print render($page['highlighted']); ?>
					</div>
				</div>
			</div>
			
			
			<!-- Tabs, messages and links area -->
			<?php if ($messages || $tabs || $action_links): ?>
			<div class="container">
				<div>
					<!-- #messages-console -->
					<?php if ($messages): ?>
					<div id="messages-console" class="clearfix">
						<?php print $messages; ?>
					</div>
					<?php endif; ?>
					<!-- EOF: #messages-console -->
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
					<div class="col-md-9" id="region-content">
						<?php print render($page['content']); ?>
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
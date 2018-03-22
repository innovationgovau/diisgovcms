<header id="top">
	<div id="region-top">
		<?php print render($page['top']); ?>
		<div id="cs-content"><?php $block = module_invoke('webform', 'block_view', 'client-block-13336');  print render($block['content']); ?></div>
	</div>
	<div id="main-page-top" class="full-width">
		<div class="container">
			<div class="row">
				<div class="col-md-6 logos">
					<div class="coa-inline">
						<div class="coa-titles-inline">
							<div class="coa-titles">
								<a href="/">
									<img src=<?php print("/" . drupal_get_path('theme',$GLOBALS['theme']) . "/img/crest-64.png"); ?> alt="Home" class="coa-img" />
									<div>
										<span class="coa-line-one coa-lines-2">Australian Government</span>
										<span class="coa-line-one coa-lines-1"><?php $node = node_load(13256); print $node->body['und'][0]['value']; ?></span>
									</div>
									<span class="clearboth"></span>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6" id="region-header">
					<?php print render($page['header']); ?>
				</div>
			</div>
			<div class="row">
				<div id="meanmenu-dest"></div>
			</div>
		</div>
		<?php if (drupal_is_front_page()): ?>
		<div id="mission-statement" class="container">
			<?php $node = node_load(13281); print $node->body['und'][0]['value']; ?>
		</div>
		<?php endif; ?>
	</div>
</header>

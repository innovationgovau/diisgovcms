<footer>
	<div class="container">
		<div class="row">
			<div id="region-footer-main" class="col-md-9">
				<?php print render($page['footer_main']); ?>
			</div>
			<div id="region-footer-minor" class="col-md-3">
				<?php print render($page['footer_minor']); ?>
			</div>
		</div>
		<div class="row">
			<div id="region-footer-lower">
				<a id="footer-navigation" class="element-invisible" tabindex="-1">Main navigation, at the bottom of the page</a>
				<h2><a href="#" id="footer-nav-link" title="Show or hide the website's main menu"><span>Show</span> main menu</a></h2>
				<div <?php // DO NOT CHANGE THE ID 'footer-nav-wrapper', IT IS USED BY GOOGLE TAG MANAGER. ALTERING IT WILL BREAK THE TAGS ?> id="footer-nav-wrapper">
					<div id="footer_first" role="navigation">
						<nav class="col-md-3" <?php // DO NOT CHANGE THE ID 'footer-follow-links', IT IS USED BY GOOGLE TAG MANAGER. ALTERING IT WILL BREAK THE TAGS ?> id="footer-follow-links"><?php $block = module_invoke('bean', 'block_view', 'follow-us---footer'); print render($block['content']); ?>
						</nav>
						<nav class="col-sm-6 col-md-3">
							<?php $block = module_invoke('menu_block', 'block_view', '9'); ?> <?php print render($block['content']); ?>
						</nav>
						<nav class="col-sm-6 col-md-3">
							<?php $block = module_invoke('menu_block', 'block_view', '10'); ?> <?php print render($block['content']); ?>
						</nav>
						<nav class="col-sm-6 col-md-3">
							<?php $block = module_invoke('menu_block', 'block_view', '11'); ?> <?php print render($block['content']); ?>
						</nav>
					</div>
					<hr>
					<div id="footer-nav-wrap"  aria-described-by="footer-desc">
						<span id="footer-desc" class="sr-only">This menu is a copy of the website's main menu, which can be found at the top of every page</span>
						<div id="footer_second">
							<nav class="col-sm-6 col-md-3">
								<?php $block = module_invoke('menu_block', 'block_view', '3'); ?><h2><?php print render($block['subject']);?></h2><?php print render($block['content']);?>
							</nav>
							<nav class="col-sm-6 col-md-3">
								<?php $block = module_invoke('menu_block', 'block_view', '4'); ?><h2><?php print render($block['subject']);?></h2><?php print render($block['content']);?>
							</nav>
							<nav class="col-sm-6 col-md-3">
								<?php $block = module_invoke('menu_block', 'block_view', '5'); ?><h2><?php print render($block['subject']);?></h2><?php print render($block['content']);?>
							</nav>
							<nav class="col-sm-6 col-md-3">
								<?php $block = module_invoke('menu_block', 'block_view', '6'); ?><h2><?php print render($block['subject']);?></h2><?php print render($block['content']);?>
							</nav>
						</div>
						<hr>
						<div id="footer_third">
							<nav class="col-sm-6 col-md-3">
								<?php $block = module_invoke('menu_block', 'block_view', '7'); ?><h2><?php print render($block['subject']);?></h2><?php print render($block['content']);?>
							</nav>
							<nav class="col-sm-6 col-md-3">
								<?php $block = module_invoke('menu_block', 'block_view', '8'); ?><h2><?php print render($block['subject']);?></h2><?php print render($block['content']);?>
							</nav>
							<nav class="col-sm-6 col-md-3">
								<?php $block = module_invoke('menu_block', 'block_view', '12'); ?><h2><?php print render($block['subject']);?></h2>
								<?php print render($block['content']); ?>
							</nav>
							<nav class="col-sm-6 col-md-3 last">
								<?php $block = module_invoke('menu_block', 'block_view', '13'); ?>
								<?php print render($block['content']); ?>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<?php print render($page['footer_lower']); ?>
		</div>
	</div>
</footer>
<div id="region-bottom">
	<?php print render($page['bottom']); ?>
</div>
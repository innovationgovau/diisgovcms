<footer>
	<div class="container">
		<div class="row">
			<div id="region-footer-main" class="col-md-12">
				<?php print render($page['footer_main']); ?>
				<div id="region-footer-minor">
					<?php print render($page['footer_minor']); ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div id="region-footer-lower">
				<div id="footer_first">
					<nav class="col-sm-6 col-md-3">
						<?php $block = module_invoke('menu_block', 'block_view', '9'); ?> <strong> <?php print render($block['content']); ?></strong>
					</nav>
					<nav class="col-sm-6 col-md-3">
						<?php $block = module_invoke('menu_block', 'block_view', '10'); ?> <strong> <?php print render($block['content']); ?></strong>
					</nav>
					<nav class="col-sm-6 col-md-3">
						<?php $block = module_invoke('menu_block', 'block_view', '11'); ?> <strong> <?php print render($block['content']); ?></strong>
					</nav>
					<nav class="col-md-3" id="footer-follow-links"><?php $block = module_invoke('bean', 'block_view', 'follow-us---footer'); print render($block['content']); ?>
				</div>
			</div>
			<hr>
			<div id="footer_second">
				<nav class="col-sm-6 col-md-3">
					<?php $block = module_invoke('menu_block', 'block_view', '3'); ?> <h2><?php  print render($block['subject']);?></h2><?php print render($block['content']);?>
				</nav>
				<nav class="col-sm-6 col-md-3">
					<?php $block = module_invoke('menu_block', 'block_view', '4'); ?> <h2><?php  print render($block['subject']);?></h2><?php print render($block['content']);?>
				</nav>
				<nav class="col-sm-6 col-md-3">
					<?php $block = module_invoke('menu_block', 'block_view', '5'); ?> <h2><?php  print render($block['subject']);?></h2><?php print render($block['content']);?>
				</nav>
				<nav class="col-sm-6 col-md-3">
					<?php $block = module_invoke('menu_block', 'block_view', '6'); ?> <h2><?php  print render($block['subject']);?></h2><?php print render($block['content']);?>
				</nav>
			</div>
			
			<hr>
			<div id="footer_third">
				<nav class="col-sm-6 col-md-3">
					<?php $block = module_invoke('menu_block', 'block_view', '7'); ?> <h2><?php  print render($block['subject']);?></h2><?php print render($block['content']);?>
				</nav>
				<nav class="col-sm-6 col-md-3">
					<?php $block = module_invoke('menu_block', 'block_view', '8'); ?> <h2><?php  print render($block['subject']);?></h2><?php print render($block['content']);?>
				</nav>

					<nav class="col-sm-6 col-md-3">
						<?php $block = module_invoke('menu_block', 'block_view', '12'); ?> <h2><?php  print render($block['subject']);?></h2> <div class="wepweb"><?php print render($block['content']); ?></div>
					</nav>
					<nav class="col-sm-6 col-md-3">
						<div class="last"><?php $block = module_invoke('menu_block', 'block_view', '13'); ?><div class="wepweblast"><?php print render($block['content']); ?></div></div>
					</nav>
			</div>
			</div>
			<?php print render($page['footer_lower']); ?>
		</div>
	</div>
</footer>
<div id="region-bottom">
	<?php print render($page['bottom']); ?>
</div>
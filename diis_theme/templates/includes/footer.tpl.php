<footer>
	<div class="container">
		<div class="row">
			<div id="region-footer-main" class="col-md-8">
				<?php print render($page['footer_main']); ?>
			</div>
			<div class="col-md-4">
				<div id="region-footer-minor">
					<?php print render($page['footer_minor']); ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div id="region-footer-lower">
				<?php print render($page['footer_lower']); ?>
			</div>
		</div>
	</div>
</footer>
<div id="region-bottom">
	<?php print render($page['bottom']); ?>
</div>
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
						<?php $block = module_invoke('menu_block', 'block_view', '9'); print render($block['content']); ?>
					</nav>
					<nav class="col-sm-6 col-md-3">
						<?php $block = module_invoke('menu_block', 'block_view', '10'); print render($block['content']); ?>
					</nav>
					<nav class="col-sm-6 col-md-3">
						<?php $block = module_invoke('menu_block', 'block_view', '11'); print render($block['content']); ?>
					</nav>
					<nav class="col-md-3">
						<p>Follow us</p>
						<a href="https://plus.google.com/+IndustryGovAu"><i class="fab fa-google-plus-g"></i></a>
						<a href="http://www.youtube.com/InnovationGovAu"><i class="fab fa-youtube"></i></a>
						<a href="http://twitter.com/IndustryGovAu"><i class="fab fa-twitter"></i></a>
						<a href="http://www.linkedin.com/company/department-of-innovation-industry-science-and-research"><i class="fab fa-linkedin-in"></i></a>
					</nav>
				</div>
			</div>
			<hr>
			<div id="footer_second">
				<nav class="col-sm-6 col-sm-6 col-sm-6 col-md-3">
					<h2><a href="/topic/data-and-publications">Data and Publications</a></h2>
					<?php $block = module_invoke('menu_block', 'block_view', '3'); print render($block['content']);?>
				</nav>
				<nav class="col-sm-6 col-sm-6 col-md-3">
					<h2><a href="/topic/funding-and-incentives">Funding and incentives</a></h2>
					<?php $block = module_invoke('menu_block', 'block_view', '4'); print render($block['content']);?>
				</nav>
				<nav class="col-sm-6 col-md-3">
					<h2><a href="/topic/planning-for-the-future">Planning for the future</a></h2>
					<?php $block = module_invoke('menu_block', 'block_view', '5'); print render($block['content']);?>
				</nav>
				<nav class="col-sm-6 col-md-3">
					<h2><a href="/topic/regulation-and-standards">Regulation and standards</a></h2>
					<?php $block = module_invoke('menu_block', 'block_view', '6'); print render($block['content']);?>
				</nav>
			</div>
			<hr>
			<div id="footer_third">
				<nav class="col-sm-6 col-md-3">
					<h2><a href="/topic/for-the-community">For the community</a></h2>
					<?php $block = module_invoke('menu_block', 'block_view', '7'); print render($block['content']); ?>
				</nav>
				<nav class="col-sm-6 col-md-3">
					<h2><a href="/topic/for-government">For government</a></h2>
					<?php $block = module_invoke('menu_block', 'block_view', '8'); print render($block['content']);?>
				</nav>
			</div>
			<?php print render($page['footer_lower']); ?>
		</div>
	</div>
</footer>
<div id="region-bottom">
	<?php print render($page['bottom']); ?>
</div>
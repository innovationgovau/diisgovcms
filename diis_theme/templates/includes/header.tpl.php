<header id="top">
	<div id="region-top">
		<?php print render($page['top']); ?>
	</div>
	<div id="main-page-top" class="full-width">
		<div class="container">
			<div class="row">
				<div class="col-md-6 logos">
					<div class="coa-inline">
						<div class="coa-titles-inline">
							<div class="coa-titles">
								<a href="/">
									<img src="/sites/all/themes/diis_theme/img/crest-64.png" alt="Home" class="coa-img" />
									<div>
										<span class="coa-line-one coa-lines-2">Australian Government</span>
										<span class="coa-line-one coa-lines-1">Department of Industry,<br>Innovation and Science</span>
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
			<p>Our vision is to enable growth and productivity for globally competitive industries.</p>
		</div>
		<?php endif; ?>
	</div>
</header>
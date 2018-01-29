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
						<section class="news-list">
							<div class="container">
								<div class="row">
									<?php /* TESTING
										<div class="col-md-3" id="region-sidebar-first">
										<?php print render($page['sidebar_first']); ?>
									</div>
									*/ ?>
									
									<div class="col-md-9" id="region-content">
										<?php print render($page['content']); ?>
									</div>
									<div class="col-md-3" id="region-sidebar-second">
										<?php print render($page['sidebar_second']); ?>
									</div>
								</div>
							</div>
						</section>
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
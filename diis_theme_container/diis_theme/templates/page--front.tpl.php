<?php include "includes/header.tpl.php"; ?>

<!-- Homepage handled via Panels, so no additional markup here -->

<div class="container" id="region-highlighted">
	<div class="col-md-12">
		<?php print render($page['highlighted']); ?>
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

<div class="container">
	<div class="row">
		<?php if ($page['content']): ?>
		<a id="main-content-anchor" class="element-invisible" tabindex="-1"></a>
		<?php print render($page['content']); ?>
		<?php endif; ?>
	</div>
</div>

<?php include "includes/footer.tpl.php"; ?>
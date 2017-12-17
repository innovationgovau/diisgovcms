<div id="top-and-first-wrapper">
  <?php include "includes/header.tpl.php"; ?>
  <?php if ($title): ?>
    <section class="about" id="about">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <h1 class="title" id="page-title"><?php print $title; ?></h1>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>
</div>

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

        <?php if ($page['content']): ?>
            <?php print render($page['content']); ?>
        <?php endif; ?>

<?php include "includes/footer.tpl.php"; ?>

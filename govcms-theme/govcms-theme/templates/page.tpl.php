<div id="top-and-first-wrapper">
  <?php include "includes/header.tpl.php"; ?>
  
  <?php if ($title): ?>
    <section class="about" id="about">
      <div class="container">
        <div class="row">
          <?php if ($breadcrumb && theme_get_setting('breadcrumb_display')): ?>
            <div class="col-md-10 col-md-offset-1">
              <ul class="pager back">
                <li class="previous">
                  <?php print $breadcrumb; ?>
                </li>
              </ul>
            </div>
          <?php endif; ?>
          <div class="col-md-12 text-center">
            <h1 class="title" id="page-title"><?php print $title; ?></h1>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>
</div>

<main>
  <!-- #page -->
  <div id="page" class="clearfix">
    <!-- #main-content -->
    <div id="main-content" data-js="responsive-video">
      <?php if ($messages || $tabs || $action_links): ?>
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
      <!-- Main page content if not homepage -->
      <?php print render($page['content']); ?>

    </div>
    <!-- EOF:#main-content -->

  </div>
  <!-- EOF:#page -->
</main>

<?php include "includes/footer.tpl.php"; ?>
<!-- EOF:#footer -->

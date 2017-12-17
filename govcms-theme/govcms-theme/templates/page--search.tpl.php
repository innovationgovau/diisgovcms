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

<main>
  <!-- #page -->
  <div id="page" class="clearfix">
    <!-- #main-content -->
    <div id="main-content">
      <?php if ($messages): ?>
        <div class="container">
          <div class="col-md-8 col-md-offset-2">
            <div id="messages-console" class="clearfix">
              <div class="row">
                <div class="col-md-12">
                  <?php print $messages; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>
      <?php print render($page['content']); ?>
    </div>
    <!-- EOF:#main-content -->

  </div>
  <!-- EOF:#page -->
</main>

<?php include "includes/footer.tpl.php"; ?>
<!-- EOF:#footer -->

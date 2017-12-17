<?php
/**
 * @file
 * Template for a 3 column panel layout.
 *
 * This template provides a very simple "one column" panel display layout.
 *
 * Variables:
 * - $id: An optional CSS id to use for the layout.
 * - $content: An array of content, each item in the array is keyed to one
 *   panel of the layout. This layout supports the following sections:
 *   $content['middle']: The only panel in the layout.
 */
?>

<?php if ($content['mission']): ?>
  <section class="about move-to-top" id="about">
    <div class="container">
      <?php print $content['mission']; ?>
    </div>
  </section>
<?php endif; ?>


<?php if ($content['data']): ?>
  <section class="icons-grid light" id="services">
    <div class="container">
      <div class="home">
        <?php print $content['data']; ?>
      </div>
    </div>
  </section>
<?php endif; ?>


<?php if ($content['biag']): ?>
  <section class="clients icons-grid bg-primary" id="clients">
    <div class="container">
      <?php print $content['biag']; ?>
    </div>
  </section>
<?php endif; ?>

<?php if ($content['resources']): ?>
  <section class="icons-grid light" id="services">
    <div class="container">
      <div class="row">
        <?php print $content['resources']; ?>
      </div>
    </div>
  </section>
<?php endif; ?>

<?php if ($content['science']): ?>
  <section class="clients icons-grid bg-primary" id="clients">
    <div class="container">
      <div class="row text-center">
        <?php print $content['science']; ?>
      </div>
    </div>
  </section>
<?php endif; ?>


<?php if ($content['community']): ?>
    <section class="icons-grid light" id="services">
    <div class="container">
      <?php print $content['community']; ?>
    </div>
  </section>
<?php endif; ?>

<?php if ($content['government']): ?>
  <section class="clients icons-grid bg-primary" id="clients">
    <div class="container">
      <div class="row">
        <?php print $content['government']; ?>
      </div>
    </div>
  </section>
<?php endif; ?>
.<?php if ($content['about_us']): ?>
    <section class="icons-grid light" id="services">
    <div class="container">
      <?php print $content['about_us']; ?>
    </div>
  </section>
<?php endif; ?>

<?php if ($content['news']): ?>
  <section class="clients icons-grid bg-primary" id="clients">
    <div class="container">
      <div class="row">
        <?php print $content['news']; ?>
      </div>
    </div>
  </section>
<?php endif; ?>




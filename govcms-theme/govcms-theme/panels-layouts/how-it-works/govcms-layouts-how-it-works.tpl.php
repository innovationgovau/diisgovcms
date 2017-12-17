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

<?php if ($content['intro']): ?>
    <div class="col-md-10 col-md-offset-1 move-into-top text-center">
      <?php print $content['intro']; ?>
    </div>
<?php endif; ?>

<?php if ($content['text_content_alternate']): ?>
  <section class="text-content alternating">
    <div class="container">
      <?php print $content['text_content_alternate']; ?>
    </div>
  </section>
<?php endif; ?>

<?php if ($content['text_content_alternate_primary']): ?>
  <section class="text-content bg-primary alternating">
    <div class="container">
      <?php print $content['text_content_alternate_primary']; ?>
    </div>
  </section>
<?php endif; ?>


<?php if ($content['text_content_alternate_2']): ?>
  <section class="text-content alternating">
    <div class="container">
      <?php print $content['text_content_alternate_2']; ?>
    </div>
  </section>
<?php endif; ?>


<?php if ($content['whos_using']): ?>
  <section class="icons-grid bg-primary">
    <div class="container">
      <div class="row text-center">
        <div class="col-md-10 col-md-offset-1">
          <h2>Usage statistics</h2>
          <div class="row">
            <?php print $content['whos_using']; ?>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>

<?php if ($content['clients']): ?>
  <section class="clients light-bg" id="clients">
    <div class="container">
      <?php print $content['clients']; ?>
    </div>
  </section>
<?php endif; ?>


<?php if ($content['testimonial_split']): ?>
  <section class="split testimonial">
    <div class="container">
        <?php print $content['testimonial_split']; ?>
    </div>
  </section>
<?php endif; ?>

<?php if ($content['distro_split']): ?>
  <section class="split distro">
    <div class="container">
      <div class="row">
        <?php print $content['distro_split']; ?>
      </div>
    </div>
  </section>
<?php endif; ?>

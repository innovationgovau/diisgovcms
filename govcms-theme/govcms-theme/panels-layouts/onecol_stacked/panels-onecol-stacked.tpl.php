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
    <section class="about move-to-top text-center" id="about">
      <div class="container">
          <?php print $content['intro']; ?>
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


  <?php if ($content['fourth']): ?>
    <section class="icons-grid bg-primary" id="services">
      <div class="container">
        <?php print $content['fourth']; ?>
      </div>
    </section>
  <?php endif; ?>


  <?php if ($content['fifth']): ?>
    <section class="split">
      <div class="container">
        <?php print $content['fifth']; ?>
      </div>
    </section>
  <?php endif; ?>


  <?php if ($content['sixth']): ?>
    <section class="">
      <div class="container">
        <?php print $content['sixth']; ?>
      </div>
    </section>
  <?php endif; ?>


  <?php if ($content['seventh']): ?>
    <section class="">
      <div class="container">
        <?php print $content['seventh']; ?>
      </div>
    </section>
  <?php endif; ?>


  <?php if ($content['eighth']): ?>
    <section class="">
      <div class="container">
        <?php print $content['eighth']; ?>
      </div>
    </section>
  <?php endif; ?>


  <?php if ($content['ninth']): ?>
    <section class="">
      <div class="container">
        <?php print $content['ninth']; ?>
      </div>
    </section>
  <?php endif; ?>

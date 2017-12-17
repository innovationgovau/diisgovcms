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

<?php if ($content['pricing_table']): ?>
  <section class="pricingTable">
    <div class="container">
      <div class="row text-center">
        <?php print $content['pricing_table']; ?>
      </div>
      <div class="text-center">
        <a class="pricing-more-btn btn btn-light btn-lg btn-default" href="/how-it-works/compare-saas-and-paas">
          Compare SaaS and PaaS features
        </a>
      </div>
    </div>
  </section>
<?php endif; ?>

<?php if ($content['whats_included']): ?>
  <section class="icons-grid bg-primary">
    <div class="container">
      <div class="row text-center">
        <?php print $content['whats_included']; ?>
      </div>
    </div>
  </section>
<?php endif; ?>


<?php if ($content['additional_services_1']): ?>
  <section id="support-cats" class="icons-grid">
    <div class="container">
      <div class="row">
        <?php print $content['additional_services_1']; ?>
      </div>
    </div>
  </section>
<?php endif; ?>


<?php if ($content['additional_services']): ?>
  <section id="additional-services-1" class="text-content bg-primary alternating">
    <div class="container">
      <div class="row">
        <?php print $content['additional_services']; ?>
      </div>
    </div>
  </section>
<?php endif; ?>

<?php if ($content['text_content_alternate']): ?>
  <section class="text-content alternating">
    <div class="container">
      <?php print $content['text_content_alternate']; ?>
    </div>
  </section>
<?php endif; ?>


<?php if ($content['split']): ?>
  <section class="split">
    <div class="container">
      <div class="row">
        <?php print $content['split']; ?>
      </div>
    </div>
  </section>
<?php endif; ?>

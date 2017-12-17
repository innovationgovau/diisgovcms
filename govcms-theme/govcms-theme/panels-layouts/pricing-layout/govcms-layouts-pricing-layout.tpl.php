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

<?php if(trim($content['page_views_per_month']) == '0'): ?>
  <div class="panel panel-dashed">
    <div class="panel-heading">
      <h3 class="text-center">
        <strong>Custom</strong>
      </h3>
    </div>
    <div class="panel-body text-center vertical-center">
      <div>
        <p class="lead">
          After something larger <br>
          or <a href="/how-it-works/compare-saas-and-paas"><abbr title="Platform as as Service">PaaS</abbr></a> pricing?
        </p>
        <p>
          Contact us to get a customised quote.
        </p>
      </div>
    </div>
    <div class="panel-footer">
      <a class="btn btn-lg btn-block btn-default" href="/contact-us">Contact us</a>
    </div>
  </div>
<?php else: ?>
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="text-center">
        <strong><?php print $content['plan_title']; ?></strong>
      </h3>
    </div>
    <div class="panel-body text-center panel-footer lead">
      <strong><?php print $content['page_views_per_month']; ?></strong>
      <br>page views / month
    </div>
    <div class="panel-body text-center">
      <p class="lead">
        $<strong><?php print trim($content['total_cost']); ?></strong> <br>/ year
      </p>
    </div>
    <div class="plus-separator"></div>
    <ul class="list-group list-group-flush text-center">
      <li class="list-group-item">
        <span class="optional">(Optional)</span><br>
        <span class="heading-style">Additional sites</span><br>
        $<strong><?php print trim($content['additional_sites']); ?></strong> / year, per site<br>
        <small>capped at $<?php print trim($content['additional_sites_capped']); ?></small>
      </li>
      <div class="plus-separator"></div>
      <li class="list-group-item">
        <span class="heading-style">Setup fee</span><br>
        $<strong><?php print trim($content['setup_fee']); ?></strong> per site
      </li>
    </ul>
    <div class="panel-footer">
      <a class="btn btn-lg btn-block btn-primary" href="/apply-site">Apply now</a>
    </div>
  </div>
<?php endif; ?>

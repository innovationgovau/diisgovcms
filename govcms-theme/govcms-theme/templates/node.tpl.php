<div class="container">

  <div class="row">
    <!-- #main -->
    <div id="main" class="clearfix">

      <!-- EOF:#content-wrapper -->
      <div id="content-wrapper">
        <section class="col-md-8 col-md-offset-2" id="top">
          <article id="node-<?php print $node->nid; ?>"
                   class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

            <div class="content"<?php print $content_attributes; ?>>
              <?php
              // We hide the comments and links now so that we can render them later.
              hide($content['comments']);
              hide($content['links']);
              hide($content['field_tags']);
              print render($content);
              ?>
            </div>

            <?php if (($tags = render($content['field_tags'])) || ($links = render($content['links']))): ?>
              <hr class="small">
              <div class="tags text-center">
                <?php print render($content['field_tags']); ?>
              </div>
            <?php endif; ?>

          </article>
        </section>
      </div>
    </div>
  </div>
</div>

<section class="comments">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <?php print render($content['comments']); ?>
      </div>
    </div>
  </div>
</section>
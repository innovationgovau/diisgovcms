<div class="move-into-top col-md-10 col-md-offset-1 text-center">
  <?php
  $default_view_modes = array(
    'label'=>'hidden',
    'type' => 'default',
  );
  $the_view = field_view_field('node', $node, 'field_summary', $default_view_modes);
  print render($the_view);

  ?>
</div>

<section class="text-content">
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1 node-<?php print $node->nid; ?>">
        <div class="content"<?php print $content_attributes; ?>>
          <?php
          // We hide the comments and links now so that we can render them later.
          hide($content['comments']);
          hide($content['links']);
          hide($content['field_tags']);
          $the_view = field_view_field('node', $node, 'body', $default_view_modes);
          print render($the_view);
          ?>
        </div>
      </div>
    </div>
  </div>
</section>

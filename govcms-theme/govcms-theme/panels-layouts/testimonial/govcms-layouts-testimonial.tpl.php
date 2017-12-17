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

<div class="col-md-6 col-sm-12 text-left section-one arrow">
  <blockquote>
    <?php print $content['quote']; ?>
  </blockquote>
  <cite>
    <span class="cite-name"><?php print $content['name']; ?></span>
    <span class="cite-pos"><?php print $content['position']; ?></span>
  </cite>
</div>
<?php $style = ''; ?>
<?php if ($content['background']): ?>
  <?php $style = "style='background: transparent url(".$content['background'].") repeat scroll 0% 0% / cover;'"; ?>
<?php endif; ?>
<div class="col-md-6 col-sm-12 section-two text-center" <?php echo $style ?>>
  <img src="<?php print $content['logo']; ?>" alt="<?php print trim($content['title']); ?>" height="200">
</div>

<?php

/**
 * @file
 * This template is used to print a single field in a view.
 *
 * It is not actually used in default Views, as this is registered as a theme
 * function which has better performance. For single overrides, the template is
 * perfectly okay.
 *
 * Variables available:
 * - $view: The view object
 * - $field: The field handler object that can process the input
 * - $row: The raw SQL result that can be used
 * - $output: The processed output that will normally be used.
 *
 * When fetching output from the $row, this construct should be used:
 * $data = $row->{$field->field_alias}
 *
 * The above will guarantee that you'll always get the correct data,
 * regardless of any changes in the aliasing that might happen if
 * the view is modified.
 */
?>
<div class="media-left media-top">
  <?php
    $icon = 'icon-document-link';
    $file_ext = trim(pathinfo($output, PATHINFO_EXTENSION));
    
    if ($file_ext == 'pdf') {
      $icon = 'icon-document-pdf';
    } elseif($file_ext == 'ppt') {
      $icon = 'icon-document-ppt';
    } elseif(($file_ext == 'docx') || $file_ext == 'doc') {
      $icon = 'icon-document-doc';
    }
  ?>
  <i class="<?php print $icon; ?> text-primary"></i>
</div>
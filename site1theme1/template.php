<?php

/**
 * @file
 * Template overrides as well as (pre-)process and alter hooks for the
 * site1theme1 theme.
 */



/**
 * Overrides theme_file_entity_download_load().
 *
 * This is defined in the file entity module, and itself is overriding the
 * core theme_file_link() function.
 *
 * Override it here so we can add Google Analytics tracking to PDFs.

 https://getlevelten.com/blog/kristin-brinner/drupal-and-google-analytics-how-track-downloads-when-using-file-entity-module
 */
function site1theme1_file_entity_download_link($variables) {
  $file = $variables['file'];
  $icon_directory = $variables['icon_directory'];

  $uri = file_entity_download_uri($file);
  $icon = theme('file_icon', array('file' => $file, 'icon_directory' => $icon_directory));

  // Set options as per anchor format described at
  // http://microformats.org/wiki/file-format-examples
  $uri['options']['attributes']['type'] = $file->filemime . '; length=' . $file->filesize;

  // Add GA tracking for downloads.
  $uri['options']['attributes']['onclick'] = "ga('send', 'event', 'Downloads', 'Click', 'PDF', '0');";

  // Provide the default link text.
  if (!isset($variables['text'])) {
    $variables['text'] = t('Download [file:name]');
  }

  // Perform unsanitized token replacement if $uri['options']['html'] is empty
  // since then l() will escape the link text.
  $variables['text'] = token_replace($variables['text'], array('file' => $file), array('clear' => TRUE, 'sanitize' => !empty($uri['options']['html'])));

  $output = '<span class="file">' . $icon . ' ' . l($variables['text'], $uri['path'], $uri['options']);
  $output .= ' ' . '<span class="file-size">(' . format_size($file->filesize) . ')</span>';
  $output .= '</span>';

  return $output;
}


?>


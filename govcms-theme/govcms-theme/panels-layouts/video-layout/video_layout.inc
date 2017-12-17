<?php

/**
 * @file
 * One column stacked panel layout.
 */

/**
 * Implements hook_panels_layouts().
 */
// Plugin definition.
$plugin = array(
  'title' => t('govCMS Video Layout'),
  'category' => t('Columns: 1'),
  'icon' => 'video.png',
  'theme' => 'govcms-layouts-video-layout',
  'regions' => array(
    'image' => t('Image'),
    'title' => t('Title'),
    'description' => t('Description'),
    'url' => t('URL'),
  ),
);
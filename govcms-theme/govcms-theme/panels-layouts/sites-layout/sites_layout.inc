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
  'title' => t('govCMS Sites Layout'),
  'category' => t('Columns: 1'),
  'icon' => 'sites.png',
  'theme' => 'govcms-layouts-sites-layout',
  'regions' => array(
    'image' => t('Image'),
    'title' => t('Title'),
    'description' => t('Description'),
    'url' => t('URL'),
  ),
);
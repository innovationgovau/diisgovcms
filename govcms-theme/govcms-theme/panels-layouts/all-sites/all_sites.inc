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
  'title' => t('govCMS All Sites Page'),
  'category' => t('Columns: 1'),
  'icon' => 'all_sites.png',
  'theme' => 'govcms-layouts-all-sites',
  'regions' => array(
    'intro' => t('Introduction'),
    'whos_using' => t('Usage statistics'),
    'sites' => t('List of Sites'),
  ),
);

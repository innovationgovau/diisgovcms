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
  'title' => t('govCMS Front Page'),
  'category' => t('Columns: 1'),
  'icon' => 'front.png',
  'theme' => 'govcms-layouts-front',
  'admin css' => 'front.admin.css',
  'regions' => array(
    'mission' => t('Mission'),
    'data' => t('Data and Publications'),
    'biag' => t('Usage Business and Industry Growth'),
    'resources' => t('Resources'),
    'science' => t('Science'),
    'community' => t('Community'),
    'government' => t('Government'),
    'about_us' => t('About Us'),
    'news' => t('News'),
  ),
);

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
  'title' => t('govCMS Pricing Page'),
  'category' => t('Columns: 1'),
  'icon' => 'pricing.png',
  'theme' => 'govcms-layouts-pricing',
  'regions' => array(
    'intro' => t('Introduction'),
    'pricing_table' => t('Pricing Table'),
    'whats_included' => t('What\'s Included'),
    'additional_services_1' => t('Additional Services support'),
    'additional_services' => t('Additional Services'),
    'text_content_alternate' => t('Image and Text Split White'),
    'split' => t('Split'),
  ),
);

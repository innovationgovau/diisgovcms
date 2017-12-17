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
  'title' => t('govCMS Pricing Layout'),
  'category' => t('Columns: 1'),
  'icon' => 'pricing.png',
  'theme' => 'govcms-layouts-pricing-layout',
  'regions' => array(
    'plan_title' => t('Plan Title'),
    'page_views_per_month' => t('Page Views Per Month'),
    'total_cost' => t('Total Cost'),
    'additional_sites' => t('Additional Sites'),
    'additional_sites_capped' => t('Additional Sites Capped'),
    'setup_fee' => t('Setup Fee'),
  ),
);

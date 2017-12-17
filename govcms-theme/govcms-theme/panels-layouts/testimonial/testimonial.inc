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
  'title' => t('govCMS Testimonial Layout'),
  'category' => t('Columns: 1'),
  'icon' => 'testimonial.png',
  'theme' => 'govcms-layouts-testimonial',
  'regions' => array(
    'title' => t('Title'),
    'quote' => t('Quote'),
    'name' => t('Name'),
    'position' => t('Position'),
    'logo' => t('Logo'),
    'background' => t('Background'),
  ),
);
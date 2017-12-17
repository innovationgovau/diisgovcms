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
  'title' => t('govCMS How it works Variable Page'),
  'category' => t('Columns: 1'),
  'icon' => 'how_it_works_variable.png',
  'theme' => 'govcms-layouts-how-it-works-variable',
  'regions' => array(
    'intro' => t('Introduction'),
    'text_content_alternate' => t('Image and Text Split White'),
    'text_content_alternate_primary' => t('Image and Text Split Primary'),
    'text_content_alternate_2' => t('Image and Text Split White 2'),
    'clients' => t('Clients / Trusted by'),
    'testimonial_split' => t('Testimonial Split'),
    'distro_split' => t('Split Distribution'),
  ),
);

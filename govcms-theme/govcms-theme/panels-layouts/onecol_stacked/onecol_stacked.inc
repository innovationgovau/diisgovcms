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
  'title' => t('Single column stacked'),
  'category' => t('Columns: 1'),
  'icon' => 'onecol_stacked.png',
  'theme' => 'panels_onecol_stacked',
  'admin css' => 'onecol_stacked.admin.css',
  'regions' => array(
    'intro' => t('Introduction'),
    'clients' => t('Clients / Trusted by'),
    'testimonial_split' => t('Testimonial Split'),
    'fourth' => t('Fourth'),
    'fifth' => t('Fifth'),
    'sixth' => t('Sixth'),
    'seventh' => t('Seventh'),
    'eighth' => t('Eighth'),
    'ninth' => t('Ninth'),
  ),
);

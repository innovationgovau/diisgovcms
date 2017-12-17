
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
  'title' => t('Apply Now'),
  'category' => t('Columns: 1'),
  'icon' => 'apply_now.png',
  'theme' => 'govcms-layouts-apply-now',
  'regions' => array(
    'intro' => t('Introduction'),
    'split' => t('Split'),
    'general_content' => t('General Content'),
  ),
);

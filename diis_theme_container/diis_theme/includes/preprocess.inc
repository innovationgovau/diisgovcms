<?php

/* TEST ONLY, govCMS filepath fix */

/**
 * @file
 * preprocess.inc
 */

/**
 * Preprocess the field.
 *
 * @param $vars
 */
function diis_theme_preprocess_field(&$vars) {
  $function = 'diis_theme_preprocess_field__' . $vars['element']['#field_name'];
  if (function_exists($function)) {
    $function($vars);
  }
}

/**
 * Preprocess the body field.
 *
 * @param $vars
 */
function diis_theme_preprocess_field__body(&$vars) {
  // Process ACSF site path.
  if (!empty($vars['items'][0]['#markup'])) {
    $content = $vars['items'][0]['#markup'];

    // Fix the ACSF site path.
    require_once './' . drupal_get_path('theme', 'diis_theme') . '/helpers/acsffix.inc';
    $content = _diis_theme_acsffix_path($content);

    // Apply tokens to body field.
    $vars['items'][0]['#markup'] = token_replace($content);
  }
}

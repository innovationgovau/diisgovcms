<?php

/* TEST ONLY, govCMS filepath fix */

/**
 * Fix ACSF site paths issue.
 */

/**
 * Fix the ACSF paths.
 *
 * @param $text
 *
 * @return mixed
 */
function _diis_theme_acsffix_path($text) {

    // Return the text as quick as possible.
    if (false === strpos($text, 'sites/g/files/net')) {
        return $text;
    }

    // Find all ACSF links in $content.
    preg_match_all('@/sites/g/files/(net[a-zA-Z0-9]+)/f/@', $text, $matches);

    // Return the text if no matches.
    if (empty($matches) || !isset($matches[0])) {
        return $text;
    }

    // Get ACSF net paths.
    $ascf_paths = $matches[0];

    // Replace the paths to current site path.
    $text = str_replace($ascf_paths, _diis_theme_file_path(), $text);

    return $text;
}

/**
 * Return the current Drupal site file paths.
 */
function _diis_theme_file_path() {
    return '/' . variable_get('file_public_path', conf_path() . '/files') . '/';
}

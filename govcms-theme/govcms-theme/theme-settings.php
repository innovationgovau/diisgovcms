<?php
/**
 * Implements hook_form_FORM_ID_alter().
 *
 * @param $form
 *   The form.
 * @param $form_state
 *   The form state.
 */
function govcmstheme_bootstrap_form_system_theme_settings_alter(&$form, &$form_state)
{

  $form['mtt_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Australia.gov.au Bootstrap Theme Settings'),
    '#collapsible' => FALSE,
    '#collapsed' => FALSE,
  );

  $form['mtt_settings']['tabs'] = array(
    '#type' => 'vertical_tabs',
  );

  $form['mtt_settings']['tabs']['basic_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Basic Settings'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );

  $form['mtt_settings']['tabs']['basic_settings']['breadcrumb_display'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show breadcrumb'),
    '#description' => t('Use the checkbox to enable or disable the breadcrumb.'),
    '#default_value' => theme_get_setting('breadcrumb_display', 'govcmstheme_bootstrap'),
  );

  $form['mtt_settings']['tabs']['basic_settings']['scrolltop_display'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show scroll-to-top button'),
    '#description' => t('Use the checkbox to enable or disable scroll-to-top button.'),
    '#default_value' => theme_get_setting('scrolltop_display', 'govcmstheme_bootstrap'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );

  $form['mtt_settings']['tabs']['bootstrap_cdn'] = array(
    '#type' => 'fieldset',
    '#title' => t('BootstrapCDN'),
    '#group' => 'bootstrap',
  );

  $form['mtt_settings']['tabs']['bootstrap_cdn']['bootstrap_css_cdn'] = array(
    '#type' => 'select',
    '#title' => t('BootstrapCDN Complete CSS version'),
    '#options' => drupal_map_assoc(array(
      '3.3.5',
    )),
    '#default_value' => theme_get_setting('bootstrap_css_cdn'),
    '#empty_value' => NULL,
  );

  $form['mtt_settings']['tabs']['bootstrap_cdn']['bootstrap_js_cdn'] = array(
    '#type' => 'select',
    '#title' => t('BootstrapCDN Complete JavaScript version'),
    '#options' => drupal_map_assoc(array(
      '3.3.5',
    )),
    '#default_value' => theme_get_setting('bootstrap_js_cdn'),
    '#empty_option' => t('Disabled'),
    '#empty_value' => NULL,
  );

  $form['mtt_settings']['tabs']['ie8_support'] = array(
    '#type' => 'fieldset',
    '#title' => t('IE8 support'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );

  $form['mtt_settings']['tabs']['ie8_support']['responsive_respond'] = array(
    '#type' => 'checkbox',
    '#title' => t('Add Modernizr and Respond [<em>modernizr-n-respond.min.js</em>] JavaScript to provider basic CSS3 media query support to IE versions lower than 9.'),
    '#default_value' => theme_get_setting('responsive_respond', 'govcmstheme_bootstrap'),
    '#description' => t('IE versions lower than 9 require a JavaScript polyfill solution to add basic support of CSS3 media queries. Note that you should enable <strong>Aggregate and compress CSS files</strong> through <em>/admin/config/development/performance</em>.'),
  );

  $form['mtt_settings']['tabs']['carousel'] = array(
    '#type' => 'fieldset',
    '#title' => t('Carousel'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );

  $form['mtt_settings']['tabs']['carousel']['num_carousel_items'] = array(
    '#type' => 'select',
    '#title' => t('Number of items on the homepage quicklink carousel'),
    '#options' => drupal_map_assoc(array(
      4,5,6,7,8,9,10,11,12,13,14,15,16,17,18
    )),
    '#default_value' => (int) theme_get_setting('num_carousel_items', 'govcmstheme_bootstrap'),
  );

}

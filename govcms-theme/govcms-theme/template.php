<?php

define('GOVCMS_MIN_DOWNLOADS', 11000);
define('GOVCMS_MIN_PAGE_VIEWS', 200000);
define('GOVCMS_MIN_RELEASES', 18);
define('GOVCMS_MIN_AVAILABILITY', 98);
define('GOVCMS_MIN_PAGE_VISITS', 200000);
define('GOVCMS_MAX_PAGE_LOAD', 5.0);
define('GOVCMS_THEME', 'govCMS Theme');

/**
 * Page alter.
 */
function govcmstheme_bootstrap_page_alter($page) {
  $mobileoptimized = array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => array(
      'name' => 'MobileOptimized',
      'content' => 'width'
    )
  );
  $handheldfriendly = array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => array(
      'name' => 'HandheldFriendly',
      'content' => 'true'
    )
  );
  $viewport = array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => array(
      'name' => 'viewport',
      'content' => 'width=device-width, initial-scale=1, viewport-fit=cover'
    )
  );
  drupal_add_html_head($mobileoptimized, 'MobileOptimized');
  drupal_add_html_head($handheldfriendly, 'HandheldFriendly');
  drupal_add_html_head($viewport, 'viewport');
}

/**
 * Override or insert variables into the html template.
 */
function govcmstheme_bootstrap_process_html(&$vars) {
  // Hook into color.module
  if (module_exists('color')) {
    _color_html_alter($vars);
  }
}

function govcmstheme_bootstrap_preprocess_html(&$vars) {
  $path = drupal_get_path_alias();
  $aliases = explode('/', $path);

  foreach ($aliases as $alias) {
    if ($alias == 'search') {
      $vars['classes_array'][] = 'search-results';
    }
  }
}


/**
 * For stripe.com style sub menu
 */
function govcmstheme_bootstrap_preprocess_page(&$variables) {
  // Load node entity.
  // @todo: Update this node id.
  $main_menu_node = node_load(1386); // Main Menu content type item
  if ($main_menu_node) {
    $variables['main_menu'] = $main_menu_node->body['und'][0]['value'];
  } else {
    $variables['main_menu'] = NULL;
  }
}


/**
 * Preprocess variables for block.tpl.php
 */
function govcmstheme_bootstrap_preprocess_block(&$variables) {
  $variables['classes_array'][] = 'clearfix';
}

/**
 * Preprocess Views exposed form
 */
function govcmstheme_bootstrap_preprocess_views_exposed_form(&$vars, $hook) {

  if (strrpos($vars['form']['#id'], 'views-exposed-form', -strlen($vars['form']['#id'])) !== FALSE) {
    $vars['form']['submit']['#attributes']['class'] = array('btn btn-info');
    $vars['form']['submit']['#value'] = "Filter";
    $vars['form']['reset']['#attributes']['class'] = array('btn btn-info');
    unset($vars['form']['submit']['#printed']);
    unset($vars['form']['reset']['#printed']);
    $vars['button'] = drupal_render($vars['form']['submit']);
    $vars['reset_button'] = drupal_render($vars['form']['reset']);
  }
}


function govcmstheme_bootstrap_js_alter(&$javascript) {
  $node_admin_paths = array(
    'node/*/edit',
    'node/add',
    'node/add/*',
  );
  $replace_jquery = TRUE;
  if (path_is_admin(current_path())) {
    $replace_jquery = FALSE;
  }
  else {
    foreach ($node_admin_paths as $node_admin_path) {
      if (drupal_match_path(current_path(), $node_admin_path)) {
        $replace_jquery = FALSE;
      }
    }
  }
  // Swap out jQuery to use an updated version of the library.
  if ($replace_jquery) {
    $javascript['misc/jquery.js']['data'] = '//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js';
    drupal_add_js('//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js', 'external');
  }
}

function govcmstheme_bootstrap_html_tag($vars) {
  if ($vars['element']['#tag'] == 'script') {
    unset($vars['element']['#value_prefix']);
    unset($vars['element']['#value_suffix']);
  }

  return theme_html_tag($vars);
}

function govcmstheme_bootstrap_menu_tree__main_menu($variables) {
  return '<ul class="nav nav-pills pull-right">' . $variables['tree'] . '</ul>';
}

function govcmstheme_bootstrap_menu_link__main_menu($variables) {
  //unset all the classes
  if (!empty($element['#attributes']['class'])) {
    foreach ($element['#attributes']['class'] as $key => $class) {
      if ($class != 'active') {
        unset($element['#attributes']['class'][$key]);
      }
    }
  }

  $element = $variables['element'];
// die(); TIM TODO
  // $element['#attributes']['data-content'][] = machine_name($element['#title']); // add data-content to <li> for dropdown menu
  // $element['#attributes']['data-content'][] = pathauto_cleanstring($element['#title']); // add data-content to <li> for dropdown menu - requires module to be enabled - add check or it will error out
  // $element['#attributes']['class'][] = "tim-class"; // add class to <li> for dropdown menu
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);

  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . "</li>\n";
}

function govcmstheme_bootstrap_menu_tree__menu_footer_sub_menu($variables) {
  return '<ul class="list-inline small-links">' . $variables['tree'] . '</ul>';
}


function govcmstheme_bootstrap_form_alter(&$form, &$form_state, $form_id) {
  if (!empty($form['actions']) && $form['actions']['submit']) {
    $form['actions']['submit']['#attributes'] = array(
      'class' => array(
        'btn',
        'btn-primary'
      )
    );
    if (isset($form_id) && ($form_id == 'webform_client_form_126' || $form_id == 'webform_client_form_131')) {
      $form['actions']['submit']['#suffix'] = '<br ><small>Please do not include any unnecessary personal, financial, or sensitive information.  Information will only be used for purposes for which you provide it. Please see our <a href="/privacy">Privacy Policy</a> for further information.</small>';
    }

    if (isset($form_id) && $form_id == 'webform_client_form_466') {
      $form['actions']['submit']['#value'] = 'Start my site';
    }

  }

  //URLS:
  // Email Confirmed (): /easybake-email-confirmed
  // Baker Url (ezbake_baker_url): https://baker.govcms.gov.au
  // Verification Required (ezbake_confirm_url): /easybake-verification-required
  // Verification Error (ezbake_error_url): /easybake-verification-error
  // Check if we are dealing with Easy Bake webform
  $is_node = array_key_exists('#node', $form);
  $is_webform = $is_node && $form['#node']->type == "webform";
  $is_easybake_form = $is_webform && $form['#node']->machine_name == "EasyBake";
  if ($is_easybake_form) {
    // In case of AJAX call we need to add values Drupal.settings
    _push_ezbake_settings_to_js($form);
    // displays a drupal error if there is a GET param for error
    // and fill in form with values
    // @see https://govcms.atlassian.net/wiki/display/EZB/Baker+API for response types
    $query_params = drupal_get_query_parameters();
    if (!empty($query_params['error'])) {
      $error_msg = "Error: " . $query_params['error'];
      // read details (input as dot notation, e.g, details.message
      // but . is replaced by _ in PHP)
      if (!empty($query_params['details_message'])) {
        $error_msg .= "<br>Details: " . $query_params['details_message'];
      }
      // fill in the form fields
      $fields = array(
        'contact_name',
        'contact_email',
        'phone_number',
        'site_name',
        'agency_name',
        'website_purpose'
      );
      foreach ($fields as $field) {
        $query_field_name = "details_form_values_" . $field;
        if (!empty($query_params[$query_field_name])) {
          $form['submitted'][$field]['#default_value'] = $query_params[$query_field_name];
        }
      }
      if (!empty($query_params['details_field'])) {
        form_set_error($query_params['details_field'], $error_msg);
      }
      else {
        drupal_set_message($error_msg, 'error');
      }
    }
    $form['#attributes']['name'] = 'easybake-order-form';
    $form['submitted']['#tree'] = FALSE;
    $form['#action'] = variable_get('ezbake_baker_url') . '/order/submit?redirect=true';
  }
}

function govcmstheme_bootstrap_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];
  if (!empty($breadcrumb)) {
    $crumbs = '';
    foreach ($breadcrumb as $value) {
      $temp = substr($value, 0, strpos($value, '>') + 1);
      $temp .= "← Back to ";
      $temp .= get_between('>', '</', $value);
      $temp .= " page</a>";
      $crumbs .= $temp;
    }
  }

  return $crumbs;
}

function get_between($var1 = "", $var2 = "", $pool) {
  $temp1 = strpos($pool, $var1) + strlen($var1);
  $result = substr($pool, $temp1, strlen($pool));
  $dd = strpos($result, $var2);
  if ($dd == 0) {
    $dd = strlen($result);
  }

  return substr($result, 0, $dd);
}

/**
 * Returns HTML for a date element formatted as an interval.
 */
function govcmstheme_bootstrap_display_interval($variables) {
  $entity = $variables['entity'];
  $options = $variables['display']['settings'];
  $dates = $variables['dates'];
  $attributes = $variables['attributes'];

  // Get the formatter settings, either the default settings for this node type
  // or the View settings stored in $entity->date_info.
  if (!empty($entity->date_info) && !empty($entity->date_info->formatter_settings)) {
    $options = $entity->date_info->formatter_settings;
  }

  $time_ago_vars = array(
    'start_date' => $dates['value']['local']['object'],
    'end_date' => $dates['value2']['local']['object'],
    'interval' => $options['interval'],
    'interval_display' => $options['interval_display'],
  );

  if ($return = theme('date_time_ago', $time_ago_vars)) {
    $return = get_between(">", "</", $return);

    return '<p class="post-meta"' . drupal_attributes($attributes) . ">$return</p>";
  }
  else {
    return '';
  }
}

/**
 * Implements hook_form_alter().
 */
function govcmstheme_bootstrap_form_search_api_page_search_form_alter(&$form, &$form_state, $form_id) {
  //Add CSS to form tag
  if (!isset($form['#attributes']['class'])) {
    $form['#attributes'] = array(
      'class' => array(
        'form-inline',
        'navbar-form',
        'search-form',
        'move-into-top'
      )
    );
  }
  else {
    $form['#attributes']['class'][] = 'form-inline';
    $form['#attributes']['class'][] = 'navbar-form';
    $form['#attributes']['class'][] = 'search-form';
    $form['#attributes']['class'][] = 'move-into-top';
  }

  //Hide label.. can't add classes directly to label so add span inside label... hackery
  $form['form']['keys_1']['#title'] = '<span class="sr-only">Search</span>';
  $form['form']['keys_1']['#theme_wrappers'] = array();
  unset($form['form']['keys_1']['#size']);

  //Add classes to input field
  $form['form']['keys_1']['#attributes']['class'][] = 'form-control';
  $form['form']['keys_1']['#attributes']['class'][] = 'input-lg';

  $form['form']['submit_1']['#attributes']['class'][] = 'sr-only';

  $form['form']['submit_2'] = array(
    '#type' => 'item',
    '#markup' => '<button type="submit" id="edit-submit-2" name="op" value="Search" class="form-submit input-group-addon btn-lg"><i class="icon-search"></i><span class="sr-only">Search</span></button>',
    '#weight' => 1000,
    '#theme_wrappers' => array(),
  );
  $form['form']['submit_1']['#theme_wrappers'] = array();

  $form['form']['#prefix'] = '<div class="input-group">';
  $form['form']['#suffix'] = '</div>';
}

// Remove Height and Width Inline Styles from Drupal Images
function govcmstheme_bootstrap_preprocess_image(&$variables) {
  foreach (array('width', 'height') as $key) {
    unset($variables[$key]);
  }
}


// Stop Drupal's meddling CSS loading
function govcmstheme_bootstrap_css_alter(&$css) {
  unset($css[drupal_get_path('module', 'system') . '/system.theme.css']);
}

/*
 * Helper function to construct settings array to be passed to Drupal.settings
 * in order to execute and AJAX call
 *
 * @form
 * EasyBake webform
 */
function _push_ezbake_settings_to_js(&$form) {
  // Initialise JS settings array
  $ezbake_settings = array();
  // Initialise flag to disable submit button if needed
  $disable_submit = FALSE;
  // Get the Baker URL
  $baker_url = variable_get('ezbake_baker_url');
  if (!$baker_url) {
    if (user_access('administer site configuration')) {
      $msg = "The Baker URL variable (ezbake_baker_url) is not set for this form. Form submission will not work.";
    }
    else {
      $msg = "This form cannot be submitted at the moment. Please contact site administrator for more information.";
    }
    drupal_set_message($msg, 'error');
    $disable_submit = TRUE;
  }
  else {
    $ezbake_settings['bakerURL'] = $baker_url;
  }
  // Get the confirmation page URL
  $confirmation_page_url = variable_get('ezbake_confirm_url');
  if (!$confirmation_page_url) {
    if (user_access('administer site configuration')) {
      $msg = "The confirmation page URL (ezbake_confirm_url) has not been set. Responses from the baker might not work properly.";
      drupal_set_message($msg, 'warning');
    }
  }
  else {
    $ezbake_settings['confirmPageURL'] = $confirmation_page_url;
  }
  // Get the error page URL
  $error_page_url = variable_get('ezbake_error_url');
  if (!$error_page_url) {
    if (user_access('administer site configuration')) {
      $msg = "The error page URL (ezbake_error_url) has not been set. Responses from the baker might not work properly.";
      drupal_set_message($msg, 'warning');
    }
  }
  else {
    $ezbake_settings['errorPageURL'] = $error_page_url;
  }
  if ($disable_submit) {
    $form['actions']['submit']['#disabled'] = TRUE;
  }
  if (!empty($ezbake_settings)) {
    // Push settings to JS
    drupal_add_js(array('ezBake' => $ezbake_settings), 'setting');
  }
}

/**
 * Additions for Dashboard
 */

/**
 * Hook theme_preprocess_page
 */
function govcmstheme_bootstrap_preprocess_node(&$variables) {

    // API Functionlity
    $current_path = drupal_get_path_alias();
    if (0 === strpos($current_path, 'dashboard')) {
        // We are on the dashboard page
        // Get variable to check when it was last updated. if more than 24 hours, update the nodes.
        $now = time();
        $yesterday = strtotime('-1 day');
        $dashboard_updated = variable_get('govcms_dashboard_last_updated');
        if(!isset($dashboard_updated) || empty($dashboard_updated) || $dashboard_updated < $yesterday) {
            // Update the variables API GETs
            _govcmstheme_bootstrap_drupal_api();
            _govcmstheme_bootstrap_github_api();
            _govcmstheme_bootstrap_site247_api();
            _govcmstheme_bootstrap_ga_api();

            variable_set('govcms_dashboard_last_updated', $now);
            $dashboard_updated = $now;
        }

        // Put variables in node for template
        $variables['govcms_dashboard_ga_page_loads'] = variable_get('govcms_dashboard_ga_page_loads');
        $variables['govcms_dashboard_ga_page_visits'] = variable_get('govcms_dashboard_ga_page_visits');
        $variables['govcms_dashboard_drupal_downloads'] = variable_get('govcms_dashboard_drupal_downloads');
        $variables['govcms_dashboard_site247_availability'] = variable_get('govcms_dashboard_site247_availability');
        $variables['govcms_dashboard_github_releases'] = variable_get('govcms_dashboard_github_releases');

        $variables['govcms_dashboard_smes'] = $variables['field_sme_savings'][0]['value'];
        $variables['govcms_dashboard_smes_unit'] = $variables['field_sme_suffix_unit'][0]['value'];
        $variables['govcms_dashboard_finance'] = $variables['field_finance_savings'][0]['value'];
        $variables['govcms_dashboard_finance_unit'] = $variables['field_finance_suffix_unit'][0]['value'];
        $variables['govcms_dashboard_acquia'] = $variables['field_acquia_spending'][0]['value'];
        $variables['govcms_dashboard_acquia_unit'] = $variables['field_acquia_suffix_unit'][0]['value'];
        $variables['govcms_dashboard_savings'] = $variables['field_agency_savings'][0]['value'];
        $variables['govcms_dashboard_savings_unit'] = $variables['field_agency_suffix_unit'][0]['value'];
        $variables['govcms_dashboard_support'] = $variables['field_support_requests_response'][0]['value'];
        $variables['govcms_dashboard_support_unit'] = $variables['field_support_suffix_unit'][0]['value'];

        $query = new EntityFieldQuery();
        $query->entityCondition('entity_type', 'node')
            ->entityCondition('bundle', 'govcms_site')
            ->propertyCondition('status', 1)
            ->fieldCondition('field_saas_paas', 'value', 'saas', '=');

        $saas_count = $query->count()->execute();


        $variables['govcms_dashboard_saas_count'] = $saas_count;

        $query2 = new EntityFieldQuery();
        $query2->entityCondition('entity_type', 'node')
            ->entityCondition('bundle', 'govcms_site')
            ->propertyCondition('status', 1)
            ->fieldCondition('field_saas_paas', 'value', 'paas', '=');

        $paas_count = $query2->count()->execute();

        $variables['govcms_dashboard_paas_count'] = $paas_count;

        $variables['govcms_dashboard_last_updated'] = time_elapsed_string($dashboard_updated);
        $variables['govcms_dashboard_last_updated_debug'] = $dashboard_updated;
    }
}

function _govcmstheme_bootstrap_github_api() {
    $options = array(
        'headers' =>  array('User-Agent' => 'Awesome-Octocat-App', 'Content-Type' => 'text/json; charset=UTF-8'),
    );
    $result = drupal_http_request('https://api.github.com/repos/govCMS/govCMS/tags', $options);
    $result_array = json_decode($result->data);
    $github_releases = sizeof($result_array);
    if($github_releases >= GOVCMS_MIN_RELEASES) {
        variable_set('govcms_dashboard_github_releases', $github_releases);
    } else {
        watchdog(GOVCMS_THEME, 'GitHub failed: '. $github_releases, NULL, WATCHDOG_INFO, NULL);
    }
}

function _govcmstheme_bootstrap_site247_api() {
    $auth_token = variable_get('govcms_dashboard_site247_auth_token', '');
    $options = array(
        'headers' => array('Authorization' => 'Zoho-authtoken '.$auth_token, 'Accept' => 'application/json;version=2.0'),
    );
    $monitor_id = variable_get('govcms_dashboard_site247_monitor_id');
    $result = drupal_http_request('https://www.site24x7.com/api/reports/availability_summary/'.$monitor_id.'?period=5&unit_of_time=3', $options);
    $result_array = json_decode($result->data);
    $availability = $result_array->data->summary_details->availability_percentage;
    if($availability > GOVCMS_MIN_AVAILABILITY) {
        variable_set('govcms_dashboard_site247_availability', $availability);
    } else {
        watchdog(GOVCMS_THEME, 'Site 24x7 failed: '. $availability, NULL, WATCHDOG_INFO, NULL);
    }
}

function _govcmstheme_bootstrap_drupal_api() {
    $options = array(
        'headers' => array('User-Agent' => 'Awesome-Octocat-App', 'Content-Type' => 'text/json; charset=UTF-8'),
    );
    $result = drupal_http_request('https://www.drupal.org/api-d7/node.json?field_project_machine_name=govcms', $options);
    $result_array = json_decode($result->data);
    $downloads = $result_array->list[0]->field_download_count;
    if($downloads >= GOVCMS_MIN_DOWNLOADS) {
        $downloads = thousandsCurrencyFormat($downloads);
        variable_set('govcms_dashboard_drupal_downloads', (int)$downloads);
    } else {
        watchdog(GOVCMS_THEME, 'Drupal Downloads failed: '. $downloads, NULL, WATCHDOG_INFO, NULL);
    }
}

function _govcmstheme_bootstrap_ga_api() {
    require_once('classes/GoogleAnalyticsAPI.class.php');

    $ga = new GoogleAnalyticsAPI('service');
    $ga->auth->setClientId(variable_get('govcms_dashboard_ga_client_id'));
    $ga->auth->setEmail(variable_get('govcms_dashboard_ga_client_email'));
    $ga->auth->setPrivateKey(base64_decode(variable_get('govcms_dashboard_ga_private_info')));

    $auth = $ga->auth->getAccessToken();
    if ($auth['http_code'] == 200) {
        $accessToken = $auth['access_token'];

        $ga->setAccessToken($accessToken);
        $ga->setAccountId('ga:91394131');

        $defaults = array(
            'start-date' => '30daysAgo',
            'end-date' => 'yesterday',
        );
        $ga->setDefaultQueryParams($defaults);

        $params = array(
            'metrics' => 'ga:pageviews',
        );
        $page_visit = $ga->query($params);
        $page_visits = $page_visit['rows'][0][0];
        if($page_visits && $page_visits > GOVCMS_MIN_PAGE_VISITS) {
            $page_visits = thousandsCurrencyFormat($page_visits);
            variable_set('govcms_dashboard_ga_page_visits', (float) $page_visits);
        }
        $params = array(
            'metrics' => 'ga:avgServerResponseTime',
        );

        $page_load = $ga->query($params);
        $page_loads = $page_load['rows'][0][0];
        if($page_loads && $page_loads < GOVCMS_MAX_PAGE_LOAD) {
            variable_set('govcms_dashboard_ga_page_loads', round((float) $page_loads, 2));
        }
    } else {
        watchdog(GOVCMS_THEME, 'Google Analytics request failed', NULL, WATCHDOG_INFO, NULL);
    }
}

function thousandsCurrencyFormat($num) {
    $x = round($num);
    $x_number_format = number_format($x);
    $x_array = explode(',', $x_number_format);
    $x_parts = array('k', 'm', 'b', 't');
    $x_count_parts = count($x_array) - 1;
    $x_display = $x;
    $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
    $x_display .= $x_parts[$x_count_parts - 1];
    return $x_display;
}

// Pretty relative timestamps
// https://gist.github.com/zachstronaut/1184831
// http://www.zachstronaut.com/posts/2009/01/20/php-relative-date-time-string.html
function time_elapsed_string($ptime) {
    $etime = time() - $ptime;

    if ($etime < 1) {
        return '0 seconds';
    }

    $a = array( 365 * 24 * 60 * 60  =>  'year',
        30 * 24 * 60 * 60  =>  'month',
        24 * 60 * 60  =>  'day',
        60 * 60  =>  'hour',
        60  =>  'minute',
        1  =>  'second'
    );
    $a_plural = array( 'year'   => 'years',
        'month'  => 'months',
        'day'    => 'days',
        'hour'   => 'hours',
        'minute' => 'minutes',
        'second' => 'seconds'
    );

    foreach ($a as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
        }
    }
}

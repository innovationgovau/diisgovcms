<?php
# Template preprocess functions

// @TODO: Add the subtheme path as a variable

/**
 * Clear any previously set element_info() static cache.
 *
 * If element_info() was invoked before the theme was fully initialized, this
 * can cause the theme's alter hook to not be invoked.
 *
 * @see https://www.drupal.org/node/2351731
 */
drupal_static_reset('element_info');
/**
 * Include hook_preprocess_*() hooks.
 */
include_once './' . drupal_get_path('theme', 'diis_theme') . '/includes/preprocess.inc';


/******************************
 * Taken from GovCMS template.php
 ******************************/

/**
 * Page alter.
 */
function diis_theme_page_alter($page) {
  $mobileoptimized = [
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => [
      'name' => 'MobileOptimized',
      'content' => 'width'
    ]
  ];
  $handheldfriendly = [
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => [
      'name' => 'HandheldFriendly',
      'content' => 'true'
    ]
  ];
  $viewport = [
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => [
      'name' => 'viewport',
      'content' => 'width=device-width, initial-scale=1, viewport-fit=cover'
    ]
  ];
  drupal_add_html_head($mobileoptimized, 'MobileOptimized');
  drupal_add_html_head($handheldfriendly, 'HandheldFriendly');
  drupal_add_html_head($viewport, 'viewport');
}

/**
 * Override or insert variables into the html template.
 */
function diis_theme_process_html(&$vars) {
  // Hook into color.module
  if (module_exists('color')) {
    _color_html_alter($vars);
  }
}

function diis_theme_preprocess_html(&$vars) {
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
function diis_theme_preprocess_page(&$variables) {
  // Load node entity.
  // @todo: Update this node id.
  $main_menu_node = node_load(1386); // Main Menu content type item
  if ($main_menu_node) {
    $variables['main_menu'] = $main_menu_node->body['und'][0]['value'];
  } else {
    $variables['main_menu'] = NULL;
  }

  if (isset($variables['node']->type)) {
    // If the content type's machine name is "my_machine_name" the file
    // name will be "page--my-machine-name.tpl.php".
    $variables['theme_hook_suggestions'][] = 'page__' . $variables['node']->type;
  }


  /**
   * DIIS theme addition:
   * Check node Content Type
   * see https://drupal.stackexchange.com/questions/37274/how-to-check-the-node-type-using-php
   */

  // Only show if $match is true
  $match = false;

  // Which node types (as an array)
  /*$types = array('page', 'corporate-publications');

  // Match current node type with array of types
  if (arg(0) == 'node' && is_numeric(arg(1))) {
    $nid = arg(1);
    $node = node_load($nid);
    $type = $node->type; 
    $match |= in_array($type, $types);
  }
  return $match;
*/
  $variables['show_page_details'] = false;
  if (isset($variables['node']) && $variables['node']->type == 'page') {
    $variables['show_page_details'] = true;
  }
}
/* @end DIIS theme addition*/


/**
 * Preprocess variables for block.tpl.php
 */
function diis_theme_preprocess_block(&$variables) {
	$variables['classes_array'][] = 'clearfix';

	//Replace the Search page's in-page form ID, as it duplicates the header search form.
	if ($variables['block_html_id'] == 'block-views-exp-advanced-search-page') {
		
		$target = $variables['content'];
		$variables['content'] = str_replace('views-exposed-form-advanced-search-page', 'views-exposed-form-advanced-search-page-inner', $target);
	}
}

/**
 * Preprocess Views exposed form
 */
function diis_theme_preprocess_views_exposed_form(&$vars, $hook) {

  if (strrpos($vars['form']['#id'], 'views-exposed-form', -strlen($vars['form']['#id'])) !== FALSE) {
    $vars['form']['submit']['#attributes']['class'] = array('btn btn-info');
    $vars['form']['submit']['#value'] = "Search";
    $vars['form']['submit']['#attributes']['class'] = array('btn btn-info');
    $vars['form']['reset']['#attributes']['class'] = array('btn btn-info');
    unset($vars['form']['submit']['#printed']);
    unset($vars['form']['reset']['#printed']);
    $vars['button'] = drupal_render($vars['form']['submit']);
    $vars['reset_button'] = drupal_render($vars['form']['reset']);
  }
}

function diis_theme_html_tag($vars) {
  if ($vars['element']['#tag'] == 'script') {
    unset($vars['element']['#value_prefix']);
    unset($vars['element']['#value_suffix']);
  }

  return theme_html_tag($vars);
}

function diis_theme_menu_tree__main_menu($variables) {
  return '<ul class="nav nav-pills pull-right">' . $variables['tree'] . '</ul>';
}

function diis_theme_menu_link(array $variables) {
  $element = $variables['element'];
  $sub_menu = '';


  if ($element['#below']) {
    $element['#below'][key($element['#below'])]['#attributes']['class'][] = 'menu';
    $sub_menu = drupal_render($element['#below']);
  }
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}


function diis_theme_menu_link__main_menu($variables) {
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




function diis_theme_form_alter(&$form, &$form_state, $form_id) {

  if (!empty($form['actions']) && $form['actions']['submit']) {
    $form['actions']['submit']['#attributes'] = array(
      'class' => array(
        'btn',
        'btn-primary'
      )
    );

    // Add a privacy warning to the 'Beta feedback' form and the 'Was this page helpul' form
    if (isset($form_id) && ($form_id == 'webform-client-form-13336' || $form_id == 'webform-client-form-13321')) {
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


/**
 * Alter the exposed form in Views to rebuild the header Search form
 */
function diis_theme_form_views_exposed_form_alter(&$form, &$form_state, $form_id) {

	// Target the Header search form specifically
	// @TODO: This targeting isn't working, can't dpm($form) either to inspect returned arrays
	//if ($form['#attributes']['id'] == 'views-exposed-form-advanced-search-page') {
	
		// Main <form> element
		// Add a negative tabindex to the form itself so IE can tab to the form using skip links
		$form['#attributes'] = array(
			'tabindex' => array('-1')
		);

		// Text input field
		$form['search_api_views_fulltext'] = array(
			'#type' => 'textfield',
			'#size' => 40,
			'#maxlength' => 128,
			'#attributes' => array(	
				'placeholder' => t('Search industry.gov.au'),
				'size' => 40,
				'title' => t('Enter the terms you wish to search for'),
				'name' => 'search_api_views_fulltext'
			)
		);

		// Submit button
		// Don't define a new type or name (see above), as it breaks the search functionality
		$form['submit']['#attributes'] = array(
			'aria-label' => 'Search'
		);
	//}
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
function diis_theme_display_interval($variables) {
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
function diis_theme_form_search_api_page_search_form_alter(&$form, &$form_state, $form_id) {
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
function diis_theme_preprocess_image(&$variables) {
  foreach (array('width', 'height') as $key) {
    unset($variables[$key]);
  }
}


// Stop Drupal's meddling CSS loading
function diis_theme_css_alter(&$css) {
  unset($css[drupal_get_path('module', 'system') . '/system.theme.css']);

  // Override the Bootstrap CSS version with a minified one.

  $node_admin_paths = array(
    'node/*/edit',
    'node/add',
    'node/add/*',
  );
  
  $replace_bootstrap_css = TRUE;

  if (path_is_admin(current_path())) {
    $replace_bootstrap_css = FALSE;
  }
  else {
    foreach ($node_admin_paths as $node_admin_path) {
      if (drupal_match_path(current_path(), $node_admin_path)) {
        $replace_bootstrap_css = FALSE;
      }
    }
  }

  // Swap out Bootstrap CSS to use a minified version.
  if ($replace_bootstrap_css) {
    $css['//cdn.jsdelivr.net/bootstrap/3.3.7/css/bootstrap.css']['data'] = '//cdn.jsdelivr.net/bootstrap/3.3.7/css/bootstrap.min.css';
  }
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
function diis_theme_preprocess_node(&$variables) {

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
            _diis_theme_drupal_api();
            _diis_theme_github_api();
            _diis_theme_site247_api();
            _diis_theme_ga_api();

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

function _diis_theme_github_api() {
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

function _diis_theme_site247_api() {
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

function _diis_theme_drupal_api() {
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

function _diis_theme_ga_api() {
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


/***************************
 * END GovCMS template.php * 
 **************************/



// Override the default jQuery version with an up-to-date one.

function diis_theme_js_alter(&$javascript) {
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
  if ($replace_jquery) {
    
    // Swap out jQuery to use an updated version of the library.
    $javascript['misc/jquery.js']['data'] = '//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js';
  
    /* Switch Bootstrap to use a minified version of their JS file:
     * https://drupal-bootstrap.org/api/bootstrap/docs%21subtheme%21settings.md/group/subtheme_settings/7#advanced
     * Normally this is done by specifying the override in <subtheme>.info, but it didn't work...
     */
    $javascript['//cdn.jsdelivr.net/bootstrap/3.3.7/js/bootstrap.js']['data'] = '//cdn.jsdelivr.net/bootstrap/3.3.7/js/bootstrap.min.js';
    
    // Exclude jQuery from being minified when JS aggregation is enabled
    $javascript['misc/jquery.js']['preprocess'] = false;
  }
}

// Add aria-label attribute to search form button
function diis_theme_bootstrap_search_form_wrapper(array $variables) {
  $output = '<div class="input-group">';
  $output .= $variables['element']['#children'];
  $output .= '<span class="input-group-btn">';
  $output .= '<button aria-label="Search" type="submit" class="btn btn-primary">' . '<span class="sr-only">' . t('Search') . '</span>' . '</button>';
  $output .= '</span>';
  $output .= '</div>';
  return $output;
}

// Make Bootstrap messages accessible
function diis_theme_status_messages(array $variables) {
  $display = $variables['display'];
  $output = '';

  $status_heading = array(
    'status' => t('Status message'),
    'error' => t('Error message'),
    'warning' => t('Warning message'),
    'info' => t('Informative message'),
  );

  // Map Drupal message types to their corresponding Bootstrap classes.
  // @see http://twitter.github.com/bootstrap/components.html#alerts
  $status_class = array(
    'status' => 'success',
    'error' => 'danger',
    'warning' => 'warning',
    // Not supported, but in theory a module could send any type of message.
    // @see drupal_set_message()
    // @see theme_status_messages()
    'info' => 'info',
  );

  // Retrieve messages.
  $message_list = drupal_get_messages($display);

  // Allow the disabled_messages module to filter the messages, if enabled.
  if (module_exists('disable_messages') && variable_get('disable_messages_enable', '1')) {
    $message_list = disable_messages_apply_filters($message_list);
  }

  foreach ($message_list as $type => $messages) {
    $class = (isset($status_class[$type])) ? ' alert-' . $status_class[$type] : '';
    $output .= "<div class=\"alert alert-block alert-dismissible$class messages $type\">\n";
    $output .= "  <a aria-label=\"Close " . strtolower(filter_xss_admin($status_heading[$type])) . "\" role=\"button\" class=\"close\" data-dismiss=\"alert\" href=\"#\">&times;</a>\n";

    if (!empty($status_heading[$type])) {
      $output .= '<h4 class="element-invisible">' . filter_xss_admin($status_heading[$type]) . "</h4>\n";
    }

    if (count($messages) > 1) {
      $output .= " <ul>\n";
      foreach ($messages as $message) {
        $output .= '  <li>' . filter_xss_admin($message) . "</li>\n";
      }
      $output .= " </ul>\n";
    }
    else {
      $output .= filter_xss_admin(reset($messages));
    }

    $output .= "</div>\n";
  }
  return $output;
}


// Remove 'type' attributes from <scripts> tags
// https://benmarshall.me/remove-type-attribute-drupal-7/
function diis_theme_process_html_tag(&$vars) {
  $el = &$vars['element'];
 
  // Remove type="..." and CDATA prefix/suffix.
  unset($el['#attributes']['type'], $el['#value_prefix'], $el['#value_suffix']);
 
  // Remove media="all" but leave others unaffected.
  if (isset($el['#attributes']['media']) && $el['#attributes']['media'] === 'all') {
    unset($el['#attributes']['media']);
  }
}


// Bootstrap overrides for menu/nav

// bootstrap/templates/menu


function diis_theme_menu_tree(array &$variables) {
  return '<ul class="menu">' . $variables['tree'] . '</ul>';
}


function diis_theme_menu_tree__primary(array &$variables) {
  return '<ul class="menu navbar-nav">' . $variables['tree'] . '</ul>';
}

function diis_theme_menu_tree__secondary(array &$variables) {
  return '<ul class="menu nav navbar-nav secondary">' . $variables['tree'] . '</ul>';
}



function diis_theme_menu_tree__book_toc__sub_menu(array &$variables) {
  return '<ul class="menu" role="menu">' . $variables['tree'] . '</ul>';
}


// templates/bootstrap/bootstrap-dropdown.vars.php

function diis_theme_preprocess_bootstrap_dropdown(array &$variables) {
  $element = &$variables['element'];

  // Provide defaults.
  $element += array(
    '#wrapper_attributes' => NULL,
    '#attributes' => NULL,
    '#alignment' => NULL,
    '#toggle' => NULL,
    '#items' => NULL,
  );

  // Dropdown vertical alignment.
  $element['#wrapper_attributes']['class'][] = '';
  if ($element['#alignment'] === 'up' || (is_array($element['#alignment']) && in_array('up', $element['#alignment']))) {
    $element['#wrapper_attributes']['class'][] = 'dropup';
  }

  if (isset($element['#toggle'])) {
    if (is_string($element['#toggle'])) {
      $element['#toggle'] = array(
        '#theme' => 'link__bootstrap_dropdown__toggle',
        '#text' => filter_xss_admin($element['#toggle']),
        '#path' => '#',
        '#options' => array(
          'attributes' => array(),
          'html' => TRUE,
          'external' => TRUE,
        ),
      );
    }
    if (isset($element['#toggle']['#options']['attributes'])) {
      $element['#toggle']['#options']['attributes']['class'][] = 'dropdown-toggle';
 
    }
    else {
      $element['#toggle']['#attributes']['class'][] = 'dropdown-toggle';
      
    }
  }

  // Menu items.
  $element['#attributes']['role'] = 'menu';
  $element['#attributes']['class'][] = 'menu';
  if ($element['#alignment'] === 'right' || (is_array($element['#alignment']) && in_array('right', $element['#alignment']))) {
    $element['#attributes']['class'][] = 'dropdown-menu-right';
  }
}

/* http://loopduplicate.com/content/drupal-remove-the-panels-separator
 *
 * Implements theme_panels_default_style_render_region().
 * 
 * Removes the panels separator.
 */
function diis_theme_panels_default_style_render_region($vars) {
  $output = '';
  $output .= implode('', $vars['panes']);
  return $output;
}

/**
 * Implements hook_query_TAG_alter() .
 *
 * Exclude some content-types from the search index
 */
function diis_theme_query_node_access_alter(QueryAlterableInterface $query) {
  global $user;
 
//  if ($user->uid == 1) {
//    return;
//  }
 
  $search = FALSE;
  $node = FALSE;
 
  foreach ($query->getTables() as $alias => $table) {
    if ($table['table'] == 'search_index') {
      $search = $alias;
    }
    elseif ($table['table'] == 'node') {
      $node = $alias;
    }
  }
 
  if ($node && $search) {
    $excluded_content_types = array(
      'consultations',
      'minisite',
      'grants_listing',
      'image_upload',
      'webform',
      'admin',
      'blog_article',
      'event',
      'footer_teaser',
      'publication',
      'slide',
      'aip',
    );
 
    if (!empty($excluded_content_types)) {
      $query->condition($node . '.type', array($excluded_content_types), 'NOT IN');
    }
 
//dpq($query);
  }
}

/**
 * Implements hook_file_view_alter().
 */
function diis_theme_file_view_alter($build, $type) {
  // When viewing a file page.
  if (arg(0) == 'file' && is_numeric(arg(1)) && !arg(2)) {
    $file = $build['#file'];
    // For the main file that is being loaded.
    if ($file->fid == arg(1) && $build['#view_mode'] == 'full') {
      // Redirect to the actual file.
      drupal_goto(file_create_url($file->uri));
    }
  }
}


/**
 * Implements theme_form_required_marker(). This changes * to (this field is required)
 */
function diis_theme_form_required_marker($variables) {
  // This is also used in the installer, pre-database setup.
  $t_function = get_t();
  $attributes = array(
    'class' => 'form-required',
    'title' => $t_function('This field is required.'),
  );
 return '<span' . drupal_attributes($attributes) . '>(' . $t_function('this field is required') . ')</span><span class="sr-only">Required field</span>';
}
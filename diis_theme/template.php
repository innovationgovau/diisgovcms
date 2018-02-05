<?php
# Template preprocess functions

// Override the parent theme function 'govcms_bootstrap_js_alter' - not sure 
// why it isn't working in the parent theme...

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
  // Swap out jQuery to use an updated version of the library.
  if ($replace_jquery) {
    $javascript['misc/jquery.js']['data'] = '//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js';
    $javascript['misc/jquery.js']['preprocess'] = false;
    drupal_add_js('//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js', 'external');
  }
}


function diis_theme_form_search_block_form_alter(&$form, &$form_state, $form_id) {
    //$form['search_block_form']['#title'] = t('Search'); // Change the text on the label element
    //$form['search_block_form']['#title_display'] = 'invisible'; // Toggle label visibilty
    $form['search_block_form']['#size'] = 40;  // define size of the textfield
    // $form['search_block_form']['#default_value'] = t('Search industry.gov.au'); // Set a default value for the textfield
    //$form['actions']['submit']['#value'] = t('GO'); // Change the text on the submit button
    $form['actions']['submit']['#attributes'] = array('class' => array('button'));
    $form['actions']['submit']['#value'] = html_entity_decode('&#xf002;');
    //$form['actions']['submit'] = array('#type' => 'image_button', '#src' => base_path() . path_to_theme() . '/images/search-button.png');
    // Add extra attributes to the text box
    //$form['search_block_form']['#attributes']['onblur'] = "if (this.value == '') {this.value = 'Search';}";
    //$form['search_block_form']['#attributes']['onfocus'] = "if (this.value == 'Search') {this.value = '';}";
    // Prevent user from searching the default text
    //$form['#attributes']['onsubmit'] = "if(this.search_block_form.value=='Search'){ alert('Please enter a search'); return false; }";
    // Alternative (HTML5) placeholder attribute instead of using the javascript
    $form['search_block_form']['#attributes']['placeholder'] = t('Search industry.gov.au');
  
} 


// Remove 'type' attributes from <sripts> tags
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
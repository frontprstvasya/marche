<?php

/**
 * Implements hook_preprocess_html().
 *
 */
function marche_en_ligne_preprocess_html(&$variables) {

  /* Adding admin/not-admin class to body */
  if($variables['is_admin']) {
    $variables['classes_array'][] = 'is-admin';
  }else{
    $variables['classes_array'][] = 'is-not-admin';
  }
}

/**
 * Implements hook_preprocess_region().
 *
 * Get user images.
 */
function marche_en_ligne_preprocess_region(&$variables) {

  /* Get prefix */
  global $language;
  $language->prefix ? $variables['language_prefix'] = $language->prefix : $variables['language_prefix'] = false;

  /**
   * Checking "user" from url && set value variable.
   */
  if($variables['region'] == 'header') {
    $path = current_path();
    $path_explode = explode("/", $path);
    $check_user_url = $path_explode[0];

    $check_user_url === 'user' ? $variables['check_user_url'] = 1 : $variables['check_user_url'] = 0;

    /**
     * Rewrite render view region header.
     */
    $variables['header_locale_language'] = $variables['elements']['locale_language'];
    $variables['header_menu_menu_new_navigation'] = $variables['elements']['menu_menu-new-navigation'];
    $variables['header_system_user_menu'] = $variables['elements']['system_user-menu'];
  }

  /**
   * Rewrite render view region footer.
   */
  if($variables['region'] == 'footer'){
    $variables['footer_text_block'] = $variables['elements']['block_7'];
    $variables['footer_block_social'] = $variables['elements']['block_1'];
    $variables['footer_contacts'] = $variables['elements']['menu_menu-cameroun-douala'];
    $variables['footer_categories_menu'] = $variables['elements']['menu_block_3'];
  }

  $variables['admin_logged'] = $variables['is_admin'];

  if($variables['region'] == 'header') {
    $logged_in = $variables['logged_in'];
    $uid = $variables['user']->uid;

    if($logged_in == 'true') {
      $account = user_load($uid);
      if (!empty($account->picture->uri)) {
        $uri = $account->picture->uri;
        $style = image_style_path('thumbnail', $uri);
        $variables['file_uri'] = file_create_url($style);
      }else{
        /* Path to default user picture */
        $variables['file_uri'] = '/sites/default/files/avatar.jpg';
      }
    }
  }

  if($variables['region'] == 'sidebar_user') {
    $logged_in = $variables['logged_in'];
    $uid = $variables['user']->uid;

    if($logged_in == 'true') {
      $account = user_load($uid);
      if (!empty($account->picture->uri)) {
        $uri = $account->picture->uri;
        $style = image_style_path('thumbnail', $uri);
        $variables['file_uri_sidebar_user'] = file_create_url($style);
      }else{
        /* Path to default user picture */
        $variables['file_uri_sidebar_user'] = '/sites/default/files/avatar.jpg';
      }
    }

    if (arg(0) == 'user'  && $variables['logged_in'] == TRUE) {
      $variables['sidebar_username'] = $variables['user']->name;
    }
  }
}

/**
 * Implements hook_preprocess_page().
 */
function marche_en_ligne_preprocess_page(&$variables) {


  if(isset($variables['page']['content']['system_main']['#bundle'])){
    /************************************************************************ temp redirect on view */
    //    $bundle = $variables['page']['content']['system_main']['#bundle'];
    //    global $user;
    //
    //    if($bundle === 'user'){
    //      $path = current_path();
    //      $explode_path = explode("/", $path);
    //      if($explode_path['0'] === 'user' && $explode_path['1'] != $user->uid) {
    //        drupal_goto('/user/'. $explode_path['1'] .'/view');
    //      }
    //    }
    /************************************************************************ temp redirect on view */
  }
  /* Get current ID */
  $variables['user']->uid ? $variables['cuid'] = $variables['user']->uid : $variables['cuid'] = false;

  /* Get prefix */
  global $language;
  $language->prefix ? $variables['language_prefix'] = $language->prefix : $variables['language_prefix'] = false;

  // Add template suggestions based on content type
  if (isset($variables['node'])) {
    $variables['theme_hook_suggestions'][] = "page__type__" . $variables['node']->type;
  }

  $suggestions = $variables['theme_hook_suggestions'];
  $count_suggestion = count($suggestions);

  if($count_suggestion >= 3 && $suggestions['2'] === 'page__taxonomy__term__%'){
    /**
     * Create variable count result.
     *
     * Count items on page.
     */
    $variables['cont_result'] = count($variables['page']['#views_contextual_links_info']['views_ui']['view']->result);

    /**
     * Get depth term.
     *
     *  Dependencies module drupal/taxonomy_term_depth.
     */
    $tid =  $variables['page']['#views_contextual_links_info']['views_ui']['view']->args[0];
    $term = taxonomy_term_load($tid);

    /* Get taxonomy hierarchy (1 or 2) */
    $variables['depth_term'] = $term->depth;
  }
}

/**
 * Implements hook_reprocess_block().
 */
function marche_en_ligne_preprocess_block(&$variables) {
  // Get phone
  $variables['my_phone']  = check_plain(theme_get_setting('settings_phone'));
  $variables['my_email']  = check_plain(theme_get_setting('settings_email'));
  // Replace phone number
  $variables['phone_replace'] = preg_replace('![^0-9]+!', '', check_plain(theme_get_setting('settings_phone')));
}

/**
 * Preprocess variables for field.tpl.php.
 */
function marche_en_ligne_preprocess_field(&$variables) {

  /**
   * Get phone number from user profile & insert to field.
   */
  $entityType = $variables['element']['#entity_type'];
  if($entityType == 'node'){
    $elemObject = $variables['element']['#object'];

    $typeNode = $elemObject->type;

    if($typeNode ==='submit_an_ad') {
      $fn = $variables['element']['#field_name'];

      if($fn === 'field_btn_call' || $fn === 'field_btn_chat' || $fn === 'field_btn_whatsapp'){
        $userId = $elemObject->uid;
        $account = user_load($userId);
        $phone_empty = $account->field_uphone;
        if($phone_empty) {
          $phone = $phone_empty['und']['0']['value'];
          $variables['phone_replace'] = preg_replace('![^0-9]+!', '', $phone);
        }else{
          $variables['phone_replace'] = '237000000000';
        }
      }

      if($fn === 'field_location_2') {
        $variables['location_clone'] = $variables['element']['#object']->field_location['und'][0]['taxonomy_term']->name;
      }
    };
  }
}

/**
 * Theme_menu_link().
 *
 * Adding uniq class to li and link.
 */
function marche_en_ligne_menu_link(array $variables): string
{
  /**
   * Add img for taxonomy menu.
   *
   * Front page.
   */
  if($variables['element']['#original_link']['menu_name'] == 'menu-menu-categories') {
    $element = &$variables['element'];

    $image = file_load($element['#localized_options']['menu_image']['fid']);
    $image_info = image_get_info($image->uri);
    $image_markup = theme_image(array(
        'path' => $image->uri,
        'width' => $image_info['width'],
        'height' => $image_info['height'],
        'attributes' => array(),
      )
    );

    $element['#localized_options']['html'] = true;
    $element['#title'] = '<span>' . $element['#title'] . '</span>' .$image_markup ;

  }

  if($variables['element']['#original_link']['menu_name'] == 'menu-advertise-menu') {
    $element = &$variables['element'];

    $image = file_load($element['#localized_options']['menu_image']['fid']);
    $image_info = image_get_info($image->uri);

    $image_markup = theme_image(array(
        'path' => $image->uri,
        'width' => $image_info['width'],
        'height' => $image_info['height'],
        'attributes' => array(),
      )
    );

    $element['#localized_options']['html'] = true;
    $element['#title'] = $image_markup ;
  }

  /**
   *  Adding uniq class for li & link.
   */
  // Add class for li
  $variables['element']['#attributes']['class'][] = 'menu-li-' . $variables['element']['#original_link']['mlid'];
  //add class for a
  $variables['element']['#localized_options']['attributes']['class'][] = 'menu-link-' . $variables['element']['#original_link']['mlid'];
  /* Hide attribute title from link menu */
  $variables['element']['#localized_options']['attributes']['title'] = '';
  return theme_menu_link($variables);
}

/**
 * Implements theme_facetapi_title().
 *
 * Delete prefix from label facets.
 */
function marche_en_ligne_facetapi_title(&$variables) {
  return  $variables['title'];
}

/**
 *  Implements hook_select().
 *
 *  Adding class "form-select" && data-value to select.
 */
function marche_en_ligne_select($variables): string {

  $name = $variables['element']['#name'];
  $element = $variables['element'];

  element_set_attributes($element, array('id', 'name', 'size'));               // Отображает 'id', 'name', 'size'
  _form_set_class($element, array('form-select'));                              // Выводит класс, классы.

  if($name == 'field_sub_categories_tid' || $name == 'field_categories_tid' ||
    $name == 'field_location_tid' || $name == 'field_location_tid_1' ||
    $name == 'field_categories[und]' || $name == 'field_sub_categories[und]' ||
    $name == 'field_location[und]' || $name == 'field_ville[und]'
  )   {
    return '<select' . drupal_attributes($element['#attributes']) . '>' . marche_en_ligne_form_select_options($element)  . '</select>';
  }else{
    return '<select' . drupal_attributes($element['#attributes']) . '>' . form_select_options($element)  . '</select>';
  }
}

/**
 *  Implements hook_form_select_options().
 *
 *  Custom form_select_options from adding class  data-value to select.
 *
 *  USE dm_marche.inc  -- dm_marche::_getTable.
 */
function marche_en_ligne_form_select_options ($element, $choices = NULL): string
{
  if (!isset($choices)) {
    $choices = $element['#options'];
  }

  $value_valid = isset($element['#value']) || array_key_exists('#value', $element);
  $value_is_array = $value_valid && is_array($element['#value']);
  $options = '';

  /**
   * Get array from table.
   */
  $q=db_select('taxonomy_term_hierarchy','s');
  $q->fields('s',array('tid', 'parent'));
  $res=$q->execute();

  $array_key = [];
  $array_value = [];
  $associative= [];

  while($rec=$res->fetchAssoc()) {
    $tid = $rec['tid'];
    $parent = $rec['parent'];

    $associative[$tid] = $parent;

    array_push($array_key, $tid);
    array_push($array_value, $parent);
  }

  /**
   * Render option in cycle.
   */
  foreach ($choices as $key => $choice) {
    if (is_array($choice)) {
      $options .= '<optgroup label="' . $key . '">';
      $options .= marche_en_ligne_select($element, $choice);
      $options .= '</optgroup>';
    }
    elseif (is_object($choice)) {
      $options .= marche_en_ligne_select($element, $choice->option);
    }
    else {
      $key = (string) $key;
      if ($value_valid && (!$value_is_array && (string) $element['#value'] === $key || ($value_is_array && in_array($key, $element['#value'])))) {
        $selected = ' selected="selected"';
      }
      else {
        $selected = '';
      }

      if(isset($associative[$key])){
        $options .= '<option data-value="' . check_plain($associative[$key]) . '" value="' . check_plain($key) . '"' . $selected . '>' . check_plain($choice) . '</option>';
      }else{
        $options .= '<option data-value="' . check_plain($key) . '" value="' . check_plain($key) . '"' . $selected . '>' . check_plain($choice) . '</option>';
      }
    }
  }
  return $options;
}

/**
 * Implements hook_preprocess_views_exposed_form().
 *
 * Delete filter when empty select.
 *
 */
function marche_en_ligne_preprocess_views_exposed_form(&$variables): void{
  $my_form = $variables['form'];
  foreach ($my_form as $my_select) {
    if(isset($my_select['#type'])){
      if($my_select['#type'] == 'select' && count($my_select['#options']) < 2){
        $select_name = $my_select['#name'];
        unset($variables['widgets']['filter-' . $select_name]);
      }
    }
  }
}


/**
 * Implements hook_preprocess_views_view().
 *
 * @param $variables
 */
function marche_en_ligne_preprocess_views_view(&$variables) {
  $views_name = $variables['view']->name;

  /* Get prefix */
  global $language;
  $language->prefix ? $variables['language_prefix'] = $language->prefix : $variables['language_prefix'] = false;

  if($views_name === 'views_reviews_autgor_user' || $views_name === 'user_page_view') {
    $variables['view']->args[0] ? $variables['views_arg'] = $variables['view']->args[0] : $variables['views_arg'] = 0;
    $current_url = url(current_path());
    $explode_url = explode("/", $current_url);
    $variables['last_url'] = end($explode_url);
  }

  /**
   * Get prefix lang. && user id.
   */
  if($views_name === 'views_chat_rooms'){
    /* Get current ID */
    $variables['user']->uid ? $variables['cuid'] = $variables['user']->uid : $variables['cuid'] = false;
  }

  /**
   * Views reviews author.
   * Get count rows && count reviews.
   */
  if($views_name === 'views_reviews_autgor_user'){

    /* Count render rows */
    if(isset($variables['view']->result)){
      $result_row = $variables['view']->result;
      $row_count = count($result_row);
      $variables['row_count'] = $row_count;

      /* Count all reviews from DB */
      if(isset($variables['view']->result[0]->node_dm_reviews_uid)){
        $nid_seller = $variables['view']->result[0]->dm_reviews_nid;
        $variables['count_reviews'] = dm_reviews::dmReviewsCountReviews($nid_seller);
      }
    }
  }
}
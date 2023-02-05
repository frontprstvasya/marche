<?php
/**
 * @file
 * Contains the theme's settings form.
 */

/**
 * Implements hook_form_system_theme_settings_alter().
 */
function marche_en_ligne_form_system_theme_settings_alter(&$form, &$form_state, $form_id = NULL) {

  /**
   * Settings contact form.
   */
  $form['settings_contact'] = [
    '#type' => 'fieldset',
    '#title' => t('Settings Contact'),
  ];
  $form['settings_contact'] ['settings_phone']= [
    '#type' => 'textfield',
    '#title' => t('Phone'),
    '#default_value' => theme_get_setting('settings_phone'),
    '#description' => t('Add phone'),
  ];
  $form['settings_contact'] ['settings_email']= [
    '#type' => 'textfield',
    '#title' => t('email'),
    '#default_value' => theme_get_setting('settings_email'),
    '#description' => t('Add email'),
  ];

  /**
   * Arbitrage user for chat.
   */

  $form['settings_chat'] = [
    '#type' => 'fieldset',
    '#title' => t('Settings Chat'),
  ];

  $form['settings_chat']['url_ws'] = [
    '#type' => 'textfield',
    '#title' => t('IP:PORT'),
    '#default_value' => theme_get_setting('url_ws'),
    '#description' => t("Enter URl (format: ip-address:port) where is the application. At the beginning / do not set"),
  ];

  $form['settings_chat']['user_arbitrage'] = [
    '#type' => 'textfield',
    '#title' => t('Arbitrage ID'),
    '#default_value' => theme_get_setting('user_arbitrage'),
    '#description' => t("Specify the user ID of the user who will arbitrate."),
  ];

  $form['settings_chat']['arbitrage_text'] = [
    '#type' => 'textarea',
    '#title' => t('Enter text'),
    '#default_value' => theme_get_setting('arbitrage_text'),
    '#description' => t("Message into chat after adding arbitrage."),
  ];

  /**
   * Settings reviews.
   */
  $form['settings_reviews'] = [
    '#type' => 'fieldset',
    '#title' => t('Settings reviews'),
  ];

  $form['settings_reviews']['url_page_review'] = [
    '#type' => 'textfield',
    '#title' => t('URL'),
    '#default_value' => theme_get_setting('url_page_review'),
    '#description' => t("Enter the url (relative path) where you want to display the review form."),
  ];
}

В theme-settings.php добавляем код для настроек чата
========================================================================================================================
function THEME_NAME_form_system_theme_settings_alter(&$form, &$form_state, $form_id = NULL) {
  /**
   * Arbitrage user for chat.
   */
  $form['settings_chat'] = [
    '#type' => 'fieldset',
    '#title' => t('Settings Chat'),
  ];

  $form['settings_chat']['user_arbitrage'] = [
    '#type' => 'textfield',
    '#title' => t('Arbitrage ID'),
    '#default_value' => theme_get_setting('user_arbitrage'),
    '#description' => t("Specify the user ID of the user who will arbitrate."),
  ];
}

------------------------------------------------------------------------------------------------------------------------
В Setting.php задаем значение по умолчанию (не обязательно)
========================================================================================================================
; Custom settings
settings[user_arbitrage] = 1

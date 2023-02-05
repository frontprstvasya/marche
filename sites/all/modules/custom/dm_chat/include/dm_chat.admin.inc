<?php
///**
// *  Administration settings DM chat module.
// */
//
//function dm_chat_settings_form(): array {
//  $form['user_arbitrage'] = [
//    '#type' => 'textfield',
//    '#title' => t('Arbitrage ID'),
//    '#default_value' => theme_get_setting('user_arbitrage'),
//    '#description' => t("Specify the user ID of the user who will arbitrate."),
//  ];
//
//    $form['submit'] = array(
//      '#type' => 'submit',
//      '#value' => t('Отправить'),
//    );
//
//  return $form;
//}



//
///**
// * Form builder.
// */
//function dm_chat_upload_img(): array
//{
//  $form['file'] = array(
//    '#type' => 'file',
//  );
//
//  $form['name_img'] = array(
//    '#type' => 'textfield',
//  );
//
//  $form['submit'] = array(
//    '#type' => 'submit',
//    '#value' => 'Отправить',
//  );
//
//  return $form;
//}
//
///**
// * Form validate callback.
// */
//function dm_chat_upload_img_validate($form, &$form_state) {
//  $validators = array(
//    'file_validate_is_image' => array(), // Проверка, действительно ли файл является изображением
//    'file_validate_extensions' => array('png gif jpg jpeg'), // Проверка на расширения
//    'file_validate_size' => array(1 * 1024 * 1024), // Проверка на размер файла (максимум 1mb)
//  );
//  // Загружаем файл в sites/default/files (по умолчанию)
//  if ($file = file_save_upload('file', $validators, 'public://chat-img')) {
//    $form_state['values']['file'] = $file; // передаём информацию о файле в ф-ю mymodule_form_submit()
//  }
//  else {
//    form_set_error('file', 'Файл не был загружен');
//  }
//}
//
///**
// * Form submit callback.
// */
//function dm_chat_upload_img_submit($form, &$form_state) {
//  $file = $form_state['values']['file'];
//  $file->status = FILE_STATUS_PERMANENT; // Изменяем статус файла на "Постоянный"
//  file_save($file); // Сохраняем новый статус
//  drupal_set_message('Картинка загружена');
//}

<?php
/**
 * @file
 *  Administration functions for messente module.
 */

function messente_main_settings() {
    $form['#attached']['js'] = array(
        drupal_get_path('module', 'messente'). '/js/cleanconfig.js' => array(
      'type' => 'file',
    ),
    );
    $form['messente_test_mode'] = array(
        '#prefix' => '<div style="border: solid 2px #ccc;border-radius:5px;padding: 10px;margin: 5px 0;"><h4>TEST MODE</h4>',
        '#type' => 'checkbox',
        '#title' => t('Test mode module'),
        '#description' => t('Enable test mode module, disabled valid form if this mode enabled'),
        '#default_value' =>  variable_get('messente_test_mode'),
        '#suffix' => '</div><hr>',
    );
    $form['messente_username'] = array(
        '#prefix' => '<div style="border: solid 2px #ccc;border-radius:5px;padding: 10px;margin: 5px 0;"><h4>Connection</h4>',
        '#type' => 'textfield',
        '#title' => t('Username HTTP API Keys*'),
        '#default_value' => variable_get('messente_username'),
        '#description' => t('You can view it in your account using the following link: https://dashboard.messente.com/api-settings'),
    );
    $form['messente_password'] = array(
        '#type' => 'textfield',
        '#title' => t('Password HTTP API Keys*'),
        '#default_value' => variable_get('messente_password'),
        '#description' => t('You can view it in your account using the following link: https://dashboard.messente.com/api-settings'),
    );
    $form['messente_password']['#suffix']=
        '<div style="display: flex;padding: 5px;"><a class="btn-danger" href="messente/import_provider" 
            style="border: solid 1px;border-radius: 5px;padding: 3px;font-size: 12px;position: relative;
            ">+ ADD PROVIDER</a></div></div><hr>';
    $form['messente_to_name'] = array(
        '#prefix' => '<div style="border: solid 2px #ccc;border-radius:5px;padding: 10px;margin: 5px 0;"><h4>Настройки отправки сообщений</h4>',
        '#type' => 'textfield',
        '#title' => t('Отправитель'),
        '#default_value' => variable_get('messente_to_name'),
        '#description' => t('От кого будет приходить смс'),
    );
    $form['messente_sms_text'] = array(
        '#type' => 'textfield',
        '#title' => t('Шаблон сообщения'),
        '#default_value' => variable_get('messente_sms_text'),
        '#description' => t('Текст сообщения в смс, где в тег < PIN > будет вставлен PIN'),
    );
    $form['messente_request_timer'] = array(
        '#type' => 'textfield',
        '#title' => t('Пауза между отправкой СМС'),
        '#default_value' =>variable_get('messente_request_timer'),
        '#description' => t("Minimum 10, maximum 180"),
    );
    $form['messente_pin_length'] = array(
        '#prefix' => '<hr>',
        '#type' => 'textfield',
        '#title' => t('Количесвто симолов в Пинкоде'),
        '#default_value' => variable_get('messente_pin_length'),
        '#description' => t('Length of the PIN code. Minimum 4 digits, maximum 16. Defaults to 6'),
        '#suffix' => '</div>',
    );
    $form['messente_url_form_register'] = array(
        '#prefix' => '<div style="border: solid 2px #ccc;border-radius:5px;padding: 10px;margin: 5px 0;"><h4>Настройка форм</h4>',
        '#type' => 'textfield',
        '#title' => t('Путь к форме регистрации'),
        '#default_value' => variable_get('messente_url_form_register'),
        '#description' => t('Register new users form Url'),
        '#suffix' => '<hr>',
    );
    $form['messente_url_form_request'] = array(
        '#type' => 'textfield',
        '#title' => t('Путь к форме восстановления доступа'),
        '#default_value' => variable_get('messente_url_form_request'),
        '#description' => t('Password recovery form url'),
        '#suffix' => '</div>',
    );
    $form['messente_pincode_inputs_add_enabled'] = array(
        '#prefix' => '<div style="border: solid 2px #ccc;border-radius:5px;padding: 10px;margin: 5px 0;"><h4>Дополнительные настройки</h4>',
        '#type' => 'checkbox',
        '#title' => t('Разделить поля ввода PIN'),
        '#description' => t('Добавляет для каждой цифры отдельный инпут и подключает pincode.js'),
        '#default_value' =>  variable_get('messente_pincode_inputs_add_enabled'),
        '#suffix' => '<hr>',
    );
    $form['messente_phone_change'] = array(
          '#type' => 'checkbox',
          '#title' => t('Подверждение номера в профиле'),
          '#description' => t('При попытке изменить номер телефона в профиле, пользователь получит СМС с кодом подтверждения. Подключает скрипт changephone.js'),
          '#default_value' =>  variable_get('messente_phone_change'),
          '#suffix' => '<hr>',
    );
    if(variable_get('messente_phone_change')){
          $form['messente_phone_change']['#suffix'] ='<hr>';
          $form['messente_url_phone_change_form'] = array(
                 '#type' => 'textfield',
                 '#title' => t('Путь к форме "изменить номер телефона"'),
                 '#default_value' => variable_get('messente_url_phone_change_form'),
                 '#description' => t('Enable Change Phone number form Url'),
             );
    }
    $form['messente_phone_mask_enabled'] = array(
            '#type' => 'checkbox',
            '#title' => t('Маска для телефонных номеров'),
            '#description' => t('Возможность добавить собственную маску номера телефона. Подключает скрипт Mask.js'),
            '#default_value' =>  variable_get('messente_phone_mask_enabled'),
            '#suffix' => '</div>',
     );
    if(variable_get('messente_phone_mask_enabled')){
        $form['messente_phone_mask_enabled']['#suffix']='
            <div style="display: flex;padding: 5px;"><a class="btn-danger" href="messente/import_mask" 
            style="border: solid 1px;border-radius: 5px;padding: 3px;font-size: 12px;position: relative;
            ">+ ADD MASK</a></div>';
        $form['messente_input_type_selection_enabled'] = array(
            '#type' => 'checkbox',
            '#title' => t('Кнопки выбора входа'),
            '#description' => t('добавить выбор входа на сайт, по телефону или по email '),
            '#default_value' =>  variable_get('messente_input_type_selection_enabled'),
            '#suffix' => '</hr>',
        );
        if(!variable_get('messente_input_type_selection_enabled')) {
           $form['messente_input_type_selection_enabled']['#suffix']='<hr>';
        }
    }
    $form['messente_field_phone'] = array(
    '#prefix' => '<div style="border: solid 2px #ccc;border-radius:5px;padding: 10px;margin: 5px 0;"><h4>Сохранение номера телефона</h4>',
    '#type' => 'textfield',
    '#title' => t('User field phone*'),
    '#default_value' => variable_get('messente_field_phone'),
    '#description' => t('Machine name of the field to store the phone number'),
  );
    $form['field_phone_number_type'] = array(
    '#type' => 'textfield',
    '#title' => t('Field data type*'),
    '#default_value' =>variable_get('field_phone_number_type'),
    '#description' => t("The name of the column in the table 'field_data_***', where to write the phone, example: 'phonenumber' , 'value'"),
    '#suffix' => '</div>',
  );
    $form['messente_field_username_enabled'] = array(
    '#prefix' => '<div style="border: solid 2px #ccc;border-radius:5px;padding: 10px;margin: 5px 0;"><h4>Дополнительные поля</h4>',
    '#type' => 'checkbox',
    '#title' => t('Include username'),
    '#description' => t('Enable username field when registering'),
    '#default_value' =>  variable_get('messente_field_username_enabled'),
      '#suffix' => '<hr>',
  );
    if(variable_get('messente_field_username_enabled')) {
        $form['messente_field_username'] = [
            '#type' => 'textfield',
            '#title' => t('machine name field username*'),
            '#default_value' => variable_get('messente_field_username'),
            '#description' => t("Machine name of the field username"),
            '#suffix' => '<hr>',
        ];
    }
    $form['messente_field_surname_enabled'] = array(
    '#type' => 'checkbox',
    '#title' => t('Include surname'),
    '#description' => t('Enable surname field when registering'),
    '#default_value' =>  variable_get('messente_field_surname_enabled'),
    '#suffix' => '<hr>',
  );
    if(variable_get('messente_field_surname_enabled')) {
    $form['messente_field_surname'] = [
      '#type' => 'textfield',
      '#title' => t('machine name field surname*'),
      '#default_value' => variable_get('messente_field_surname'),
      '#description' => t("Machine name of the field surname"),
      '#suffix' => '<hr>',
    ];
  }
    $form['messente_field_email_enabled'] = array(
        '#type' => 'checkbox',
        '#title' => t('Include user email'),
        '#description' => t('Добавить поле Email при регистрации по номеру телефона'),
        '#default_value' =>  variable_get('messente_field_email_enabled'),
        '#suffix' => '</div>',
    );
    $form['messente_register_picture_upload_enabled'] = array(
        '#prefix' => '<div style="border: solid 2px #ccc;border-radius:5px;padding: 10px;margin: 5px 0;"><h4>Изображение</h4>',
        '#type' => 'checkbox',
        '#title' => t('Добавить возможность загрузки изображения профиля'),
        '#description' => t('Картинки будут загружаться в папку "avatar-img", папка создастся автоматом после включения данной настройки по пути: /sites/default/files/avatar-img/ '),
        '#default_value' =>  variable_get('messente_register_picture_upload_enabled'),
        '#suffix' => '</div><hr>',
    );
        if(variable_get('messente_register_picture_upload_enabled')){
          $form['messente_register_picture_upload_enabled']['#suffix'] ='<hr>';
          $form['messente_register_picture_upload_url'] = [
                '#type' => 'textfield',
                '#title' => t('Путь к изображению аватарки по умолчанию'),
                '#default_value' => variable_get('messente_register_picture_upload_url'),
                '#description' => t("Изображения аватарки профиля перед загрузкой собственного"),
                '#suffix' => '<div><p>путь в настройках профиля :'.variable_get('user_picture_default').'</p>
                            <img src="'.variable_get('user_picture_default').'"  style="height: 50px;"></div>'];
          $form['messente_field_user_avatar'] = [
              '#type' => 'textfield',
              '#title' => t('Машинное имя изображения пользователя*'),
              '#default_value' => variable_get('messente_field_user_avatar'),
              '#description' => t("Если аватарка загружается не по умолчанию, нужно добавить название поля из профиля"),
              '#suffix' => '</div>',
          ];
     }
    $form['messente_request_mail'] = array(
    '#prefix' => '<div style="border: solid 2px #ccc;border-radius:5px;padding: 10px;margin: 5px 0;"><h4>Email</h4>',
    '#type' => 'checkbox',
    '#title' => t('Registration and recovery of users by email'),
    '#description' => t('If enabled, new users, when entering email in the input, will be redirected to the registration form by email'),
    '#default_value' =>  variable_get('messente_request_mail'),
    '#suffix' => '</div><hr>',
  );
    if(variable_get('messente_request_mail')){
          $form['messente_request_mail']  ['#suffix'] =  '<hr>';
          $form['messente_form_email_register_enabled'] = array(
              '#type' => 'checkbox',
              '#title' => t('Separate forms for email'),
              '#description' => t('Adds separate forms for registering and restoring users by email'),
              '#default_value' =>  variable_get('messente_form_email_register_enabled'),
              '#suffix' => '</div><hr>',
          );
          if(variable_get('messente_form_email_register_enabled')){
             $form['messente_form_email_register_enabled']  ['#suffix'] =  '<hr>';
             $form['messente_url_form_email_register'] = array(
                  '#type' => 'textfield',
                  '#title' => t('Url Register email form'),
                  '#default_value' => variable_get('messente_url_form_email_register'),
                  '#description' => t(''),
              );
             $form['messente_url_form_email_request'] = array(
                  '#type' => 'textfield',
                  '#title' => t('Url Password recovery email form'),
                  '#default_value' => variable_get('messente_url_form_email_request'),
                  '#description' => t(''),
                  '#suffix' => '</div><hr>',
              );
          }
    }
    $form['messente_register_google'] = array(
          '#prefix' => '<div style="border: solid 2px #ccc;border-radius:5px;padding: 10px;margin: 5px 0;"><h4>Социальные сети</h4>',
           '#type' => 'checkbox',
           '#title' => t('Google account'),
          '#markup' => '',
           '#description' => t('Registration and login to the site of users using a Google account'),
           '#default_value' =>  variable_get('messente_register_google'),
           '#suffix' => '<hr>',
       );
    if(variable_get('messente_register_google')) {
            $form['messente_google_client_id'] = [
                '#type' => 'textfield',
                '#title' => t('Google client Id'),
                '#default_value' => variable_get('messente_google_client_id'),
                '#description' => t(""),
            ];
            $form['messente_google_client_secret'] = [
                '#type' => 'textfield',
                '#title' => t('Google client secret'),
                '#default_value' => variable_get('messente_google_client_secret'),
                '#description' => t(""),
            ];
            $form['messente_google_redirect_uri'] = [
                '#type' => 'textfield',
                '#title' => t('Google redirect Url'),
                '#default_value' => variable_get('messente_google_redirect_uri'),
                '#description' => t(""),
            ];
            $form['messente_google_enter_redirect_uri'] = [
                '#type' => 'textfield',
                '#title' => t('Google redirect Url for login'),
                '#default_value' => variable_get('messente_google_enter_redirect_uri'),
                '#description' => t("Redirect URL after login for registered users"),
            ];
            $form['messente_url_google_register_form'] = [
                '#type' => 'textfield',
                '#title' => t('Url Register google form'),
                '#default_value' => variable_get('messente_url_google_register_form'),
                '#description' => t(""),
                '#suffix' => '<hr>',
            ];
    }
    $form['messente_register_facebook'] = array(
        '#type' => 'checkbox',
        '#title' => t('Facebook account'),
        '#description' => t('Registration and login to the site of users using a Facebook account'),
        '#default_value' =>  variable_get('messente_register_facebook'),
        '#suffix' => '<hr>',
    );
    if(variable_get('messente_register_facebook')) {
         $form['messente_register_facebook']['#suffix']='<hr>';
         $form['messente_facebook_client_id'] = [
                '#type' => 'textfield',
                '#title' => t('facebook client Id'),
                '#default_value' => variable_get('messente_facebook_client_id'),
                '#description' => t(""),
          ];
         $form['messente_facebook_client_secret'] = [
                '#type' => 'textfield',
                '#title' => t('facebook client secret'),
                '#default_value' => variable_get('messente_facebook_client_secret'),
                '#description' => t(""),
         ];
         $form['messente_facebook_redirect_uri'] = [
               '#type' => 'textfield',
               '#title' => t('facebook redirect Url'),
               '#default_value' => variable_get('messente_facebook_redirect_uri'),
               '#description' => t(""),
         ];
         $form['messente_facebook_enter_redirect_uri'] = [
                '#type' => 'textfield',
                '#title' => t('Facebook redirect Url for login'),
                '#default_value' => variable_get('messente_facebook_enter_redirect_uri'),
                '#description' => t("Redirect URL after login for registered users"),
         ];
         $form['messente_url_facebook_register_form'] = [
                '#type' => 'textfield',
                '#title' => t('Url Register Facebook form'),
                '#default_value' => variable_get('messente_url_facebook_register_form'),
                '#description' => t(""),
                '#suffix' => '<hr>',
         ];
    }
    $form['messente_redirect_url_google_and_facebook'] = array(
       '#type' => 'textfield',
       '#title' => t('Редирект при неудачном входе'),
       '#default_value' => variable_get('messente_redirect_url_google_and_facebook'),
       '#description' => t('Указать путь к странице регистрации или выбора типа регистрации'),
       '#suffix' => '</div>',
     );
    $form['clean_config'] = array(
           '#attributes'  => array('id' => 'edit-setting-config-clean'),
           '#markup' => '<a href="#" id="edit-clean-config-btn">Clear Configurations</a>',
          '#prefix' => '<div id="setting_config_clean" style="background: #fffdc0;padding: 10px;">
                            <h6  style="font-size: 100%;">Before purge obsolete configurations, please enable  Maintenance Mode </h6>',
          '#suffix' => '</div><hr>',
     );
    return system_settings_form($form);
}

function  messente_form_messente_main_settings_alter(&$form, &$form_state) {
  $form['#submit'] = is_array($form['#submit']) ? $form['#submit'] : array();
  array_unshift($form['#submit'], 'messente_main_settings_submit');
}

function messente_main_settings_submit($form, &$form_state) {
  foreach ($form_state['values'] as $name=>$value){
    if($name!='messente_request_mail'
      && $name!='messente_field_username_enabled'
      && $name!='messente_field_username'
      && $name!='messente_field_surname_enabled'
      && $name!='messente_field_surname'
      && $name!='messente_register_google'
      && $name!='messente_register_facebook'
      && $name!='messente_register_picture_upload_enabled'
      && $name!='messente_field_user_avatar'
      && $name!='messente_email_register_send_mail'
      && $name!='messente_phone_mask_enabled'
      && $name!='messente_form_email_register_enabled'
      && $name!='messente_test_mode'
      && $name!='messente_pincode_inputs_add_enabled'
      && $name!='messente_input_type_selection_enabled'
      && $name!='messente_phone_change'
      && $name!='messente_mask_for_login_user'
      && $name!='messente_field_email_enabled'
      && $name!='messente_field_email'
      && $name!='messente_register_picture_upload_url'
    ){
      if(empty($value)){
        form_set_error($name, ''.$name.' the field cannot be empty');
      }
      else{
        variable_set($name, $value);
      }
    }
  }
  if(variable_get('messente_register_picture_upload_enabled')){
    $patch =$_SERVER['DOCUMENT_ROOT'] . base_path().'sites/default/files/avatar-img/';
    if (!file_exists($patch)) {
      mkdir($patch , 0777, true);
    }
  }
  if(variable_get('messente_input_type_selection_enabled')){
        $form_state['values']['messente_mask_for_login_user']=false;
        variable_set('messente_mask_for_login_user',false);
    }
  if(variable_get('messente_phone_mask_enabled')==FALSE){
        variable_set('messente_mask_for_login_user',false);
        variable_set('messente_input_type_selection_enabled',false);
        $form_state['values']['messente_mask_for_login_user']=false;
        $form_state['values']['messente_input_type_selection_enabled']=false;

  }
  variable_set('messente_request_mail',$form_state['values']['messente_request_mail']);
  variable_set('messente_field_username_enabled',$form_state['values']['messente_field_username_enabled']);
  if(variable_get('messente_register_facebook')){
        if(empty($form_state['values']['messente_url_facebook_register_form'])){
                form_set_error('messente_register_facebook', 'messente_url_facebook_register_form the field cannot be empty');
        }
        else{
                variable_set('messente_url_facebook_register_form',$form_state['values']['messente_url_facebook_register_form']);
        }
  }
  if(variable_get('messente_register_google')){
        if(empty($form_state['values']['messente_url_google_register_form'])){
                form_set_error('messente_register_google', 'messente_url_google_register_form  the field cannot be empty');
        }
        else{
                variable_set('messente_url_google_register_form',$form_state['values']['messente_url_google_register_form']);
        }
    }
  if(variable_get('messente_field_username_enabled')){
        if(empty($form_state['values']['messente_field_username'])){
                form_set_error('messente_field_username', 'messente_field_username  the field cannot be empty');
        }
        else{
                variable_set('messente_field_username',$form_state['values']['messente_field_username']);
        }
  }
//    drupal_flush_all_caches();
}
 
function AdminSetLog($array){
  $log = date('Y-m-d H:i:s') . ' ' . print_r($array, true);
  file_put_contents(__DIR__ . '/Adminlog.txt', $log . PHP_EOL, FILE_APPEND);
}


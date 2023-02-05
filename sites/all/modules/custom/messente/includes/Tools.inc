<?php

class Tools {

    public static function array_is_object($object){
        if (is_object($object)) {
            $result = [];
            foreach ($object as $key => $value) {
                $result[$key] = $value;
            }
            return $result;
        } else {
            return false;
        }
    }

    public static function replace_str($str,$params='phone'){
        if(empty($str) && !is_string($str)){
            return false;
        }else{
            if($params=='mail'){
                $str= str_replace('@', '', $str);
                $str= str_replace('&', '', $str);
                $str= str_replace('_', '', $str);
                $str= str_replace('-', '', $str);
                $str= str_replace('.', '', $str);
                return $str;
            }
            if($params=='phone'){
                $str= str_replace(' ', '', $str);
                $str= str_replace('+', '', $str);
                $str= str_replace('(', '', $str);
                $str= str_replace(')', '', $str);
                $str= str_replace('_', '', $str);
                $str= str_replace(' ', '', $str);
                return $str;
            }

        }
    }

    public static function delete_config($name_config='messente_google_register_user_array_'){
        $google_config = db_query("
        SELECT *
        FROM {variable}
        WHERE name LIKE :title
        ", array(':title' => '%' . db_like($name_config) . '%'))->fetchAll();
        if (count($google_config)) {
            foreach ($google_config as $config) {
                db_delete('variable')
                    ->condition('name', $config->name)
                    ->execute();
            }
        }
    }

    public static function login_generate()
    {
        do {
            $UIN = rand(100000000, 999999999);
            $res = Tools::register_users_nom_row($UIN);
        } while ($res);

        return $UIN;
    }

    public static function register_users_nom_row($UIN)
    {
        $count = db_select('users', 'n')
            ->condition('n.name', $UIN)
            ->countQuery() // <--
            ->execute()
            ->fetchField();
        return $count;
    }

    public static function get_count_field_is_phone($phone){
        $result = FALSE;
        $countfield_data = db_select('field_data_' . variable_get('messente_field_phone'), 'n')
            ->countQuery() // <--
            ->execute()
            ->fetchField();
        if ($countfield_data) {
            $querys = db_select('field_data_' . variable_get('messente_field_phone'), 'n');
            $querys->innerJoin('users', 'u', 'n.entity_id = u.uid'); // <--
            $querys->fields('n', ['entity_id']);
            $querys->fields('u', ['name'])
                ->condition('n.' . variable_get('messente_field_phone') . '_' . variable_get('field_phone_number_type'), $phone)
                ->condition('n.entity_type', 'user');
            $login_r = $querys->countQuery()->execute()->fetchField();
            if ((int)$login_r > 0) {
                $result = TRUE;
            } else {
                $result = FALSE;
            }

        }
        return $result;
    }

    public static function validation_phone($phone){

        if(variable_get('valid_mask_phone_number_count_'.session_id())){
          $max_count = (int)variable_get('valid_mask_phone_number_count_'.session_id());
          $phone= Tools::replace_str($phone,'phone');

          if (is_numeric($phone)) {
            if (strlen($phone) == $max_count) {
              return TRUE;
            } else {
              return FALSE;
            }
          } else {
            return FALSE;
          }
        }else{
          $max_count = 13;
          $phone= Tools::replace_str($phone,'phone');

          if (is_numeric($phone)) {
            if (strlen($phone) <= $max_count || strlen($phone)>=11) {
              return TRUE;
            } else {
              return FALSE;
            }
          } else {
            return FALSE;
          }
        }

    }

    public static function get_params($type='request',$prov ='google',$value=null,$login=false){
        $params=array();
        if($type=='request' && $prov=='google' && $value!==null){
            $params = array(
                'client_id' => variable_get('messente_google_client_id'),
                'client_secret' => variable_get('messente_google_client_secret'),
                'redirect_uri' => variable_get('messente_google_redirect_uri'),
                'grant_type' => 'authorization_code',
                'code' =>$value,
            );
            if($login){
                $params['redirect_uri']=variable_get('messente_google_enter_redirect_uri');
            }
        }
        if($type=='register' && $prov=='google' && $value!==null){
            if(is_array($value)){
                $params = array(
                    'idUser' =>$value['uid'],
                    'code' =>$value['id'],
                    'email' =>$value['email'],
                    'first_name' => $value['given_name'],
                    'last_name' => $value['family_name'],
                );
            }else{
                return false;
            }
        }
        if($type=='register' && $prov=='facebook' && $value!==null){
            if(is_array($value)){
                $params = array(
                    'idUser' =>$value['uid'],
                    'code' =>$value['id'],
                    'email' =>$value['email'],
                    'first_name' => $value['first_name'],
                    'last_name' => $value['last_name'],
                );
            }else{
                return false;
            }
        }
        if($type=='request' && $prov=='facebook' && $value!==null ){
            $params = array(
                'client_id'     => variable_get('messente_facebook_client_id'),
                'client_secret' => variable_get('messente_facebook_client_secret'),
                'redirect_uri'  => variable_get('messente_facebook_redirect_uri'),
                'code'=>$value
            );
            if($login){
                $params['redirect_uri']=variable_get('messente_facebook_enter_redirect_uri');
            }
        }

        if($type=='update' && $prov=='table' && $value==null ){
            $params=[
                'table'=>'',
                'fields'=>'',
                'condition'=>'',
            ];
        }

        if(count($params)){
            return $params;
        }else{
            return false;
        }

    }

    public static function get_url_params($prov ='google'){
        if($prov ='google'){
            return 'https://accounts.google.com/o/oauth2/token';
        }
        if($prov ='facebook'){
            return 'https://graph.facebook.com/oauth/access_token';
        }
    }

    public static function get_count_user_is_mail($mail){
        if(empty($mail) && !$mail && $mail==null){
            return false;
        }else{
            return db_select('users', 'n')
                ->condition('n.mail', $mail)
                ->countQuery() // <--
                ->execute()
                ->fetchField();

        }
    }

    public static function get_rand_pincode(){
        $result = [];
        for ($i = 1; $i <= (int)variable_get('messente_pin_length'); $i++) {
            $result[$i]=1;
            if($i==(int)variable_get('messente_pin_length')){
                $result[$i]=0;
            }

        }
        $imd ='';
        $imd_max ='';
        $max_n = 9;
        foreach ( $result as $res){
            $imd=$imd.''.$res;
            $imd_max=$imd_max.''.$max_n;
        }
        $result_pin =rand($imd, $imd_max);
        return  $result_pin;

    }

    public static function validation_pincode($pin){
        if(empty($pin) && !$pin && $pin==null){
            return false;
        } else {
            if (strlen($pin) != (int)variable_get('messente_pin_length')) {
                return false;
            } else {
                $pin_array = str_split($pin);
                $result = false;
                foreach ($pin_array as $pn) {
                    if (!is_numeric($pn)) {
                        $result = false;
                        break;
                    } else {
                        $result = true;
                    }
                }
                return $result;
            }
        }
    }

    public static function update_field_table($params){
        db_update($params['table'])
            ->fields($params['fields'])
            ->condition($params['condition']['name'], $params['condition']['value'])
            ->execute();
    }

    public static function insert_field_table($params){
        db_insert($params['table'])
            ->fields($params['fields'])
            ->execute();
    }

    public static function get_field_table($params,$condition=false){
        if(empty($params) && !count($params) && !is_array($params)){
            return false;
        }else {
            if($condition==true){
                if(count($params['condition'])==2){
                    return db_select($params['table'], 'n')
                        ->fields('n', $params['fields'])
                        ->condition('n.'.$params['condition'][0]['name'], $params['condition'][0]['value']) // <--
                        ->condition('n.'.$params['condition'][1]['name'], $params['condition'][1]['value']) // <--
                        ->execute()
                        ->fetchField();
                }else{
                    if(count($params['condition'])==1) {
                        return Tools::get_field_table($params, false);
                    }else{
                        return false;
                    }
                }

            }else{
                return db_select($params['table'], 'n')
                    ->fields('n', $params['fields'])
                    ->condition('n.'.$params['condition']['name'], $params['condition']['value']) // <--
                    ->execute()
                    ->fetchField();
            }

        }

    }

    public static function get_fields_table($params,$whire=true){
        if(empty($params) && !count($params) && !is_array($params)){
            return false;
        }else {
            if($whire==true){
              $result= db_select($params['table'], 'n')
                    ->fields('n')
                    ->condition('n.'.$params['condition']['name'], $params['condition']['value']) // <--
                    ->execute()
                    ->fetchAll();
              if(count( $result)==1){
                  return $result[0];
              }else{
                  return  $result;
              }
            }else{
                return db_select($params['table'], 'n')
                    ->fields('n')
                    ->execute()
                    ->fetchAll();
            }

        }

    }

    public static function user_field_set($uid, $fild,$type,$value){
        $user = user_load($uid);
        $aaray_save = [$fild => ['und' => [0 => [$type =>$value]]]];
        if(variable_get('messente_field_phone')===$fild){
         $aaray_save=[$fild => ['und' => [0 => [$type =>$value, 'format'=>$value]]]];
        }
        user_save($user,$aaray_save);
        return $user;


    }



}
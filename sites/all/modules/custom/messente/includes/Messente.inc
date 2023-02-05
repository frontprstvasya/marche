<?php

class Messente {

  private $username;

  private $userpassword;


  public function __construct(){
    $this->username=variable_get('messente_username');
    $this->userpassword =variable_get('messente_password');
  }

  private static function getUser(){
    $messente = new Messente();
    return $messente->username;
  }

  private static function getPassword(){
    $messente = new Messente();
    return $messente->userpassword;
  }

  public static function SendSMSVerifyStart($phone){
    if(Messente::validParams($phone)) {
      $text ="Votre code PIN de vérification est <PIN>";
      $data = array(
        'username' => Messente::getUser(),
        'password' => Messente::getPassword(),
        'to' => $phone,
        'template'=> $text,

      );
      if(FALSE!=($pin_length =   variable_get('messente_pin_length'))){
        $data['pin_length']=$pin_length;
      }
      if(FALSE!=($to_name =  variable_get('messente_to_name'))){
        $data['from']=$to_name;
      }
      if(FALSE!=($messente_sms_text =  variable_get('messente_sms_text'))){
        $data['template']=$messente_sms_text;
      }
      if(FALSE!=($retry_delay = variable_get('messente_request_timer'))){
        $data['retry_delay']=$retry_delay;
      }

      $url = 'https://api2.messente.com/verify/start/?' . http_build_query($data);
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
      curl_setopt($ch, CURLOPT_POST, 1);
      //  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
      curl_setopt($ch, CURLOPT_HEADER, FALSE);
      $res = curl_exec($ch);
      curl_close($ch);
      $res = json_encode($res, JSON_UNESCAPED_UNICODE);
      $res = json_decode($res);
      if (count($result = explode(" ", $res))) {
        if ($result[0] == 'OK') {
         // Messente::setMessenteLog($result);
          return $result[1];
        }
        else {
          $log_array = [
            'result' => $result,
            'data' => $data,
            'func' => 'SendSMSVerifyStart',
          ];
          Messente::setMessenteLog($log_array);
          return FALSE;
        }

      }
      else {
        $log_array = [
          'res' => $res,
          'data' => $data,
          'func' => 'SendSMSVerifyStart',
        ];
        Messente::setMessenteLog($log_array);
        return FALSE;
      }
    }else{
      $log_array = [
        'func' => 'SendSMSVerifyStart',
        'error'=>'not valid params'
      ];
      Messente::setMessenteLog($log_array);
      return FALSE;
    }
  }

  public static function SendSMSVerifyPin($verification_id,$pin){
  if(Messente::validParams($verification_id) && Messente::validParams($pin)){
    $data =array(
      'username'=>Messente::getUser(),
      'password'=>Messente::getPassword(),
      'verification_id'=>$verification_id,
      'pin'=>$pin,
    );
    $url = 'https://api2.messente.com/verify/pin/?'.http_build_query($data);
    $ch = curl_init( $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_POST, 1);
    //  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, false);
    $res = curl_exec($ch);
    curl_close($ch);
    $res = json_encode($res, JSON_UNESCAPED_UNICODE);
    $res = json_decode($res);
    if( $res=='VERIFIED'){
      return true;
    }else{
      $log_array = array(
        'res'=>$res,
        'data'=>$data,
        'func'=>'SendSMSVerifyPin',
      );
      Messente::setMessenteLog(array('result'=>$log_array));
      return false;
    }
  }else{
    $log_array = array(
      'error'=>'not valid params',
      'func'=>'SendSMSVerifyPin',
    );
    Messente::setMessenteLog(array('result'=>$log_array));
    return false;
  }


  }

  public static function validParams($params) {
    if (is_string($params)) {
      $params = str_replace(' ', '', $params);
    }
    if (empty($params) && $params == FALSE && $params == NULL && $params == '') {
      return FALSE;
    }
    else {
      return TRUE;
    }
  }

  public static function setMessenteLog($array) {
    $log = date('Y-m-d H:i:s') . ' ' . print_r($array, TRUE);
    file_put_contents(__DIR__ . '/Messentelog.txt', $log . PHP_EOL, FILE_APPEND);
  }
}
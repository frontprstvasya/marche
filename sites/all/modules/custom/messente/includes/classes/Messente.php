<?php


class Messente {

  private $username;

  private $userpassword;

  private $url;

  public function __construct(){
    $this->username=variable_get('messente_username');
    $this->userpassword =variable_get('messente_password');
    $this->url ='https://api.verigator.com/v1/service/service/';
  }

  private static function getUrl(){
    $messente = new Messente();
    return $messente->url;
  }

  private static function getUser(){
    $messente = new Messente();
    return $messente->username;
  }

  private static function getPassword(){
    $messente = new Messente();
    return $messente->userpassword;
  }

  private static function getHeader(){
    $messente = new Messente();
    $headr = array();
    $headr[] = 'Accept: application/json';
    $headr[] = 'Content-type: application/json';
    $headr[] = 'X-Service-Auth:'.$messente->username.':'.$messente->userpassword;
    return $headr;
  }

  private static function getServiceId(){
    return variable_get('messente_service_id');
  }

  private static function getServiceName(){
    return variable_get('messente_service_name');
  }

  public static function SetServiseName($name){
    variable_set('messente_service_name', $name);
  }

  public static function CreatServiseMes($name){
    $url = 'https://api.verigator.com/v1/service/service';
    $data=array('fqdn'=>$GLOBALS['base_root'],'name'=>$name);
    $result = Messente::getRequest($url,"POST",$data);
    if(!empty($result)){
      variable_set('messente_service_name',$name);
      variable_set('messente_service_id', $result->id);
      return $result;
    }else{
      return FALSE;
    }
  }

  public static function addMessenteUser($id,$phone){
    $url =Messente::getUrl().Messente::getServiceId().'/users';
    $data=array('id_in_service'=>$id, 'phone_number'=>$phone);
    $result = Messente::getRequest($url,"POST",$data);
    return $result;
  }

  /// Передаем id user из мессанты
  public static function sendSMSUserAuth($user_id){
    $url ='https://api.verigator.com/v1/service/service/'.Messente::getServiceId().'/users/'.$user_id.'/auth';
    $data=array('method'=>'sms');
    $result = Messente::getRequest($url,"POST",$data);
    return $result;
  }

  /// Передаем id user и pincode из мессанты
  public static function getPinCodeAuth($user_id,$pin){
    $url = Messente::getUrl().Messente::getServiceId().'/users/'.$user_id.'/auth';
    $data=array('method'=>'sms', 'token'=>$pin);
    $result = Messente::getRequest($url,"PUT",$data);
    return $result;
  }

  public static function deleteMesUser($phone){
    $url = Messente::getUrl().Messente::getServiceId().'/users/'.$phone;
    $result = Messente::getRequest($url,"DELETE");
    return  $result ;
  }

  public static function getRequest($url,$method,$data=null){
    $requestParams = '';
    if($data!=null){
      $requestParams = json_encode($data);
    }
    $context = stream_context_create(array(
      'http' => array(
        'method' =>$method,
        'header' =>Messente::getHeader(),
        'content' =>$requestParams,
      ),
    ));

    if (false !== ($result =file_get_contents($url, false, $context))){
      return json_decode($result);
    }else{
      return false;
    }



  }

  public static function setUserIdMes($uid,$id){
    db_update('users')
      ->fields(array('messente' => $id))
      ->condition('uid', $uid)
      ->execute();
  }

  public static function getUserName($uid){
    return db_select('users', 'n')
      ->fields('n', array('name'))
      ->condition('n.uid', $uid) // <--
      ->execute()
      ->fetchField();
  }

  public static function getUserIdMes($uid){
    $messente_id = db_select('users', 'n')
      ->fields('n', array('messente'))
      ->condition('n.uid', $uid) // <--
      ->execute()
      ->fetchField();
    if( $messente_id){
      return $messente_id;
    }else{
      return false;
    }

  }

  public static function getUserMessenteIDisUID($uid){
    $messente_id =  db_select('users', 'n')
      ->fields('n', array('messente'))
      ->condition('n.uid', $uid) // <--
      ->execute()
      ->fetchField();
    if($messente_id){
      return $messente_id;
    }else{
      return false;
    }

  }

}
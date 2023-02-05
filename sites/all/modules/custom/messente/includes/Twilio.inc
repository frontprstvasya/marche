<?php
require_once(drupal_get_path('module', 'messente').'/includes/libraries/Twilio/autoload.php');
use Twilio\Rest\Client;
class Twilio {

    private $twilio_sid;
    private $twilio_token;
    private $from_number_phone;
    private $body_sms;

    public function __construct(){
        variable_set('twilio_sid','AC8c8f755834264f93b493fbe771ebf9a9');
        variable_set('twilio_token','b3788c30e09b1f75dcb1d586dacb6e03');
        variable_set('twilio_from_number_phone','+13347593039');
        variable_set('twilio_body_sms','PIN CODE: ');

        $this->twilio_sid= variable_get('twilio_sid');
        $this->twilio_token =variable_get('twilio_token');
        $this->from_number_phone= variable_get('twilio_from_number_phone');
        $this->body_sms = variable_get('twilio_body_sms');

    }

    private static function getSID(){
        $twilio = new Twilio();
        return $twilio->twilio_sid;
    }

    private static function getTOKEN(){
        $twilio = new Twilio();
        return $twilio->twilio_token;
    }

    private static function getTwilio_number(){
        $twilio = new Twilio();
        return $twilio->from_number_phone;
    }
    private static function getTwilio_body(){
        $twilio = new Twilio();
        return $twilio->body_sms;
    }



    public static function sendTwilio($phone,$code){
        $account_sid = Twilio::getSID();
        $auth_token = Twilio::getTOKEN();
        if(Tools::validation_pincode($code)){
            $client = new Client($account_sid, $auth_token);
            $phone = Tools::replace_str($phone,'phone');
            $phone = '+'. $phone;
            $client->messages->create(
                $phone,
                array(
                    'from' =>  Twilio::getTwilio_number(),
                    'body' =>Twilio::getTwilio_body().': '.$code
                )
            );
            return true;
        }else{
            return false;
        }

    }

    public static function getTwilioPinCode(){
        if(variable_get('twilio_pincode_'.session_id())){
            return variable_get('twilio_pincode_'.session_id());
        }else{
            return false;
        }
    }

    public static function validTwilioPinCode($pin){
        if(variable_get('twilio_pincode_'.session_id())){
           if( variable_get('twilio_pincode_'.session_id())==$pin){
               return true;
           }else{
               return false;
           }
        }else{
            return false;
        }
    }

}
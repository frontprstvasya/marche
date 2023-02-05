<?php

require_once(drupal_get_path('module', 'messente').'/includes/libraries/Twilio/autoload.php');
use Twilio\Rest\Client;

class TwilioSend {

    private $sid;
    private $token;
    private $sender;

    public function __construct($sid,$token){
        $this->sid= $sid;
        $this->token =$token;
        $this->sender='+13347593039';
    }



    public function sendTwilio($phone,$code){
        $account_sid =$this->sid;
        $auth_token = $this->token;
        if(Tools::validation_pincode($code)){
            $client = new Client($account_sid, $auth_token);
            $phone = Tools::replace_str($phone,'phone');
            $phone = '+'. $phone;
            $client->messages->create(
                $phone,
                array(
                    'from' =>'+13347593039',
                    'body' => 'PIN CODE: '.$code
                )
            );
            return true;
        }else{
            return false;
        }

    }

}
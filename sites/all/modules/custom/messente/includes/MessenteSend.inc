<?php

class MessenteSend {

    private $sid;
    private $token;


    public function __construct($sid,$token){
        if (
            !empty($sid) || is_string($sid)
            && !empty($token) || is_string($token)){
            $this->sid = $sid;
            $this->token = $token;
        } else {
            return false;
        }
    }

    public function SendPinCode($phone){
         $url = 'https://api2.messente.com/verify/start';
         $pin = '<PIN>';
         $text ="Pin Code:".$pin;
         $data = array(
             'username' =>$this->sid,
             'password' => $this->token,
             'to' => $phone,
             'template'=> $text,
             'pin_length'=>variable_get('messente_pin_length'),
             'from'=> variable_get('messente_to_name'),
             'retry_delay'=>variable_get('messente_request_timer'),
         );
        $res = $this->RequestSMS( $url,$data);
        if (count($result = explode(" ", $res))) {
            if ($result[0] == 'OK') {
                return $result[1];
            }
            else {
                return FALSE;
            }

        }
        else {
            return FALSE;
        }
    }

    public function VerifyPin($verification_id,$pin){
            $data =array(
                'username' =>$this->sid,
                'password' => $this->token,
                'verification_id'=>$verification_id,
                'pin'=>$pin,
            );
            $url = 'https://api2.messente.com/verify/pin';

            $res =$this->RequestSMS( $url,$data);
            if($res=='VERIFIED'){
                return true;
            }else{
                return false;
            }


    }

    private function RequestSMS($url,$data){
        $url =  $url.'/?' . http_build_query($data);
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
        return $res;

    }

    public static function setMessenteSendLog($array) {
        $log = date('Y-m-d H:i:s') . ' ' . print_r($array, TRUE);
        file_put_contents(__DIR__ . '/MessenteSendError.log.txt', $log . PHP_EOL, FILE_APPEND);
    }
}
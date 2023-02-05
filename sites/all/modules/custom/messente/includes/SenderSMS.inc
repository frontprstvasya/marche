<?php

class SenderSMS
{

    private $name;


    public function __construct($name){
        if(FALSE!=($provider =ProviderSMS::getProviderFieldsIsName($name))){
            $this->name = $provider->name;

        }else{
            return false;
        }

    }


    public function getProvider(){
        return ProviderSMS::getProviderFieldsIsName( $this->name);
    }




}
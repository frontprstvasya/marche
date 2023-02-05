<?php

class ProviderSMS
{


    private $provider_name;

    public static function getProviderDefault(){
        $params=array(
            'table'=>'messente_providers',
            'condition'=>array(
                'name'=>'default',
                'value'=>1
            ),
        );
        return Tools::get_fields_table($params,true);
    }

    public static function getProviderAll(){
        $params=array(
            'table'=>'messente_providers',
            'condition'=>array(
                'name'=>'status',
                'value'=>1
            ),
        );
        return Tools::get_fields_table($params,true);
    }


    public static function getProviderFieldsIsName($name){
        if(empty($name)){
            return false;
        }else{
            $params=array(
                'table'=>'messente_providers',
                'condition'=>array(
                    'name'=>'name',
                    'value'=>$name
                ),
            );
            return Tools::get_fields_table($params,true);
        }

    }

    public static function getSidIsDefault(){
        $params=array(
            'table'=>'messente_providers',
            'fields'=>array('sid'),
            'condition'=>array(
                array(
                    'name'=>'default',
                    'value'=>1
                ),
                array(
                    'name'=>'status',
                    'value'=>1
                ),
            ),
        );
            return Tools::get_field_table($params,true);
    }

    public static function getTokenIsDefault(){
        $params=array(
            'table'=>'messente_providers',
            'fields'=>array('token'),
            'condition'=>array(
                array(
                    'name'=>'default',
                    'value'=>1
                ),
                array(
                    'name'=>'status',
                    'value'=>1
                ),
            ),
        );
            return Tools::get_field_table($params,true);


    }


}
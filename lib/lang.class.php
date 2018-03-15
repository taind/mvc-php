<?php

class Lang{

    protected static $data;

    public static function load($lang_code){
        //lấy file path roi check xem thu co thi include khong thi throw exception
        $lang_file_path = ROOT.DS.'lang'.DS.strtolower($lang_code).'.php'; //root/...../htdocs/lang/en.php
        if(file_exists($lang_file_path)){
            self::$data = include($lang_file_path); //include vao
        }else{
            throw new Exception('Lang file not found: '.$lang_file_path);
        }
    }

    public static function get($key, $default_value = ''){ //get $data en/vi
        return isset(self::$data[strtolower($key)]) ? self::$data[strtolower($key)] : $default_value;
    }
}
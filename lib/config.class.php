<?php

class Config{
    //set and get something in an array, i dont know what to do with this
    protected static $settings = array();

    public static function get($key){
        return isset(self::$settings[$key]) ? self::$settings[$key] : null;
    }
    public static function set($key,$value){
        self::$settings[$key] = $value;
    }
}

?>

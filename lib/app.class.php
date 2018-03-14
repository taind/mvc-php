<?php
class App{

    protected static $router;

    /**
     * @return mixed
     */
    public static function getRouter()
    {
        return self::$router;
    }
    public static function run($uri){
        self::$router = new Router($uri);
    }
}
<?php
class App{

    protected static $router;
    public static $db;

    public static function getRouter()
    {
        return self::$router;
    }
    public static function run($uri){
        self::$router = new Router($uri); // tao 1 thang router moi

        //connect db
        self::$db = new DB(Config::get('db.host'), Config::get('db.username'), Config::get('db.password'), Config::get('db.db_name'));


        //language support
        Lang::load(self::$router->getLanguage());

        $controller_class = ucfirst(self::$router->getController()).'Controller'; //get NameController
        $controller_method = strtolower(self::$router->getMethodPrefix().self::$router->getAction());//get method

        $layout = self::$router->getRoute();
        if($layout == 'admin' && Session::get('role') != 'admin'){
            if($controller_method != 'admin_login'){
                Router::redirect('/admin/users/login');
            }
        }


        $controller_object = new $controller_class();        // new PagesController

        if(method_exists($controller_object, $controller_method)){ // coi thu method co trong class khong
            $view_path =  $controller_object->$controller_method();
            $view_object = new View($controller_object->getData(), $view_path);
            $content = $view_object->render();

        }else{
            throw new Exception($controller_class.'--------'.$controller_method);
        }

        //layout chung cho admin hoac pages
        $layout = self::$router->getRoute();
        $layout_path = VIEWS_PATH.DS.$layout.'.php';
        $layout_view_object = new View(compact('content'), $layout_path);

        echo $layout_view_object->render();
    }
}
<?php
class Router{

    protected $uri;

    protected $controller;

    protected $action;

    protected $params;

    protected $route;

    protected $method_prefix;

    protected $language;


    public function __construct($uri)
    {
        //get tat ca default
        $this->uri = urldecode(trim($uri,'/'));

        $routes = Config::get('routes'); // lay mang route trong config
        $this->route = Config::get('default_route');
        $this->method_prefix = isset($routes[$this->route]) ? $routes[$this->route] : ''; // admin_
        $this->language = Config::get('default_language');
        $this->controller = Config::get('default_controller');
        $this->action = Config::get('default_action');

        $uri_parts = explode('?', $this->uri); // lay tung phan trong uri
        $path = $uri_parts[0]; // lay phan truoc dau ? vi sau no la get
        $path_parts = explode('/', $path); //sau do tach ra

        // get route xong cat phan route di con lai controller o sau
        if(count($path_parts)){
            // neu phan uri nam trong route key admin/default
            if(in_array(strtolower(current($path_parts)), array_keys($routes))){
                $this->route = strtolower(current($path_parts));
                $this->method_prefix = $routes[$this->route];
                array_shift($path_parts); //remove part uri do khoi array
            }elseif (in_array(strtolower(current($path_parts)), Config::get('languages'))){ //check thu uri part nam trong list languages hay khong
                $this->language = strtolower(current($path_parts));
                array_shift($path_parts); //remove part uri ra khoi array
            }
        }
        //get controller xong cat phan controller di con lai param o sau
        if(current($path_parts)){
            $this->controller = strtolower(current($path_parts));
            array_shift($path_parts);
        }
        if(current($path_parts)){ //get actions
            $this->action = strtolower(current($path_parts));
            array_shift($path_parts);
        }
        $this->params = $path_parts; //lay mang uri da tach ra gan vao params

    }


    public function getUri()
    {
        return $this->uri;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function getRoute()
    {
        return $this->route;
    }

    public function getMethodPrefix()
    {
        return $this->method_prefix;
    }

    public function getLanguage()
    {
        return $this->language;
    }


}
?>

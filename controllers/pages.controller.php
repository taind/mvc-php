<?php
class PagesController extends Controller{

    public function index()
    {
        $this->data['test_content'] = 'hello this is test content from index';
    }
    public function view(){
        $params = App::getRouter()->getParams();
        if(isset($params[0])){
            $alias = strtolower($params[0]);
            $this->data['content'] = 'here we '.$alias.' go from view';
        }

    }
}
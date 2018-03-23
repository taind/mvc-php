<?php
class PagesController extends Controller{


    public function __construct($data = array())
    {
        parent::__construct($data);
        $this->model = new Page();
    }

    public function index()
    {
        $this->data['page'] = $this->model->getList();
    }
    public function view(){
        $params = App::getRouter()->getParams();
        if(isset($params[0])){
            $alias = strtolower($params[0]); //lay param
            $this->data['page'] = $this->model->getByAlias($alias);
        }

    }

    public function admin_index(){
        $this->data['page'] = $this->model->getList();
    }

    public function admin_edit(){
        if( array_key_exists('id', $_POST) ){ //neu bien id duoc truyen len trong post
            $id = isset($_POST['id'])? $_POST['id'] : null;
            $result = $this->model->save($_POST,$id);
            if($result){
                Session::setFlash('saved!!!!');
            }else{
                Session::setFlash("something wrong");
            }
        }

        if(isset($this->params[0])){
            $this->data['page'] = $this->model->getById($this->params[0]);
            if(!$this->data['page']['id']){
                Router::redirect('/admin/pages');
            }
        }else{
            Router::redirect('/admin/pages');
        }
    }

    public function admin_add(){
        if($_POST){
            $result = $this->model->save($_POST);
            if($result){
                Session::setFlash('saved!!!');
            }else{
                Session::setFlash('something wrong!!!');
            }
        }
    }

    public function admin_delete(){
        if(isset($this->params[0])){
            $id = $this->params[0];
            $result = $this->model->delete($id);
            if($result){
                Session::setFlash('delete success');
            }else{
                Session::setFlash('delete failed');
            }
        }
        Router::redirect('/admin/pages');
    }
}
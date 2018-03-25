<?php
class PagesController extends Controller{


    public function __construct($data = array())
    {
        parent::__construct($data);
        $this->model = new Page();
    }

    public function index()
    {
        $this->data['page'] = $this->model->getAll();
    }
    public function view(){
        $params = App::getRouter()->getParams();
        if(isset($params[0])){
            $id = intval($params[0]); //lay param
            $this->data['page'] = $this->model->getById($id);
        }

    }

    public function admin_index(){
        $this->data['listBooks'] = $this->model->getAll();
    }

    public function admin_edit(){
        if($_POST){
            $result = $this->model->edit($_POST, $_FILES);//form data va file image
            if(isset($result['error'])){
                Session::set('error', $result);
            }else{
                Session::set('success', 'book updated');
            }
        }
        if(isset($this->params[0])){
            $id = $this->params[0];
            $this->data['bookinfo'] = $this->model->getById($id); //show info luc bam edit
            if($this->data['bookinfo'] == null){ //neu khong co gi thi redirect ve menu
                Router::redirect('/admin/pages');
            }
            $this->data['bookinfo']['img_mime'] = mime_content_type($this->data['bookinfo']['image']); // xu ly anh
            $this->data['bookinfo']['img_b64'] = base64_encode(file_get_contents($this->data['bookinfo']['image']));
        }
    }

    public function admin_add(){
        if($_POST){
            $result = $this->model->save($_POST);
            if(isset($result['error'])){
                Session::set('error', $result);
            }else{
                Session::set('success', 'book added');
            }
        }
    }

    public function admin_delete(){
        if(isset($this->params[0])){
            $id = $this->params[0];
            $result = $this->model->delete($id);
            if($result){
                Session::set('admin_delete', 'book deleted');
            }else{
                Session::set('admin_delete', 'can not delete this book');
            }
        }
        Router::redirect('/admin/pages');
    }
}
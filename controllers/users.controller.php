<?php

class UsersController extends Controller{

    public function __construct($data = array())
    {
        parent::__construct($data);
        $this->model = new User();
    }


    public function index(){ //user login
        if((Session::get('role') == 'user')){ //neu da dang nhap thi route ve info
            Router::redirect('/users/info');
        }
        if((Session::get('role') == 'admin')){ // neu da dang nhap va la admin thi route ve admin page
            Router::redirect('/admin/');
        }
        if(isset($_POST['username']) && isset($_POST['password'])){
            $user = $this->model->getUserByUsername($_POST['username']);
            $hash = md5(Config::get('salt').$_POST['password']);
            if($user && $user['is_active'] && $hash == $user['password']){
                Session::set('username', $user['username']);
                Session::set('role', $user['role']);
                Router::redirect('/users/info'); //lay user info va route ve info page
            }
        }

    }

    public function info(){ //get user info
        if((!Session::get('role'))){ // neu chua dang nhap se bi redirect
            Router::redirect('/');
        }
        $user = $this->model->getUserByUsername($_SESSION['username']);
        $this->data['userinfo'] = $user;
    }

    public function admin_index(){
        $this->data['listUser'] = $this->model->getAllUser();
    }

    public function edit(){
        if($_POST){
            $result = $this->model->user_edit($_POST);
            if(isset($result['error'])){
                Session::set('error', $result);
            }else{
                Session::set('success', 'user updated');

            }
        }

        if(isset($this->params[0])){
            if(Session::get('username') !== $this->params[0]){ //neu username dang nhap khong phai username duoc sua thi return
                Router::redirect('/users/edit/'.Session::get('username'));
            }// vi vay nen khong can phan quyen them
            $username = $this->params[0];
            $this->data['userinfo'] = $this->model->getUserByUsername($username); //show info luc bam edit
        }

    }




    //////admin section

    public function admin_login(){  //admin login
        if((Session::get('username') == 'admin')){
            Router::redirect('/admin/');
        }
        if(isset($_POST['username']) && isset($_POST['password'])){
            $user = $this->model->getUserByUsername($_POST['username']);
            $hash = md5(Config::get('salt').$_POST['password']);
            if($user && $user['is_active'] && $hash == $user['password'] &&$user['role'] == 'admin'){
                Session::set('username', $user['username']);
                Session::set('role', $user['role']);
                Router::redirect('/admin/');
            }
        }
    }

    public function admin_add(){
        if($_POST){
            $result = $this->model->save($_POST);
            if(isset($result['error'])){
                Session::set('error', $result);
            }else{
                Session::set('success', 'User saved');
            }
        }
    }

    public function admin_edit(){
        if($_POST){
            $result = $this->model->edit($_POST);

            if(isset($result['error'])){
                Session::set('error', $result);
            }else{
                Session::set('success', 'user updated');

            }
        }
        if(isset($this->params[0])){
            $id = $this->params[0];
            $this->data['userinfo'] = $this->model->getUserByID($id); //show info luc bam edit
        }
    }

    public function admin_delete(){
        if(isset($this->params[0])){
            $id = $this->params[0];
            $result = $this->model->deleteUser($id);
            if($result){
                Session::set('admin_delete', 'User deleted');
            }else{
                Session::set('admin_delete', 'Can not delete user');
            }
            Router::redirect('/admin/users');
        }
    }

    public function admin_logout(){ //admin logout
        Session::destroy();
        Router::redirect('/admin/');
    }
    public function logout(){       //user logout
        Session::destroy();
        Router::redirect('/users/');
    }
}
?>
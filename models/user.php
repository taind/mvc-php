<?php
class User extends Model{
    public function getUserByUsername($login){
        $login = $this->db->escape($login);
        $sql = "select * from users where username = '{$login}'";
        $result = $this->db->query($sql);
        if(isset($result[0])){
            return $result[0];
        }
        return false;
    }

    public function getUserByID($login){
        $login = $this->db->escape($login);
        $sql = "select * from users where id = '{$login}'";
        $result = $this->db->query($sql);
        if(isset($result[0])){
            return $result[0];
        }
        return false;
    }

    public function getAllUser(){
        $sql = "select * from users";
        $result = $this->db->query($sql);
        if(isset($result)){
            return $result;
        }
    }

    public function save($data){ //admin_add controller use this shit
        $error = array();
        if( !($data['username']) || !($data['fullname']) || !($data['password']) || !($data['re-password']) || !($data['email']) || !($data['role'])){
            $error['form_err'] = 'Please input all the field!';
        }
        $username = $this->db->escape($data['username']);
        if($this->getUserByUsername($username)){ //check thu username co trong database chua
            $error['username_err'] = 'Username duplicated';
        }
        $password = $this->db->escape($data['password']);
        $re_password = $this->db->escape($data['re-password']); //doan nay check 2 password trung hay khong
        if($password !== $re_password){
            $error['password_err'] = 'Your passwords does not match!';
        }

        //doan nay check role co trong config hay khong
        $role = $this->db->escape($data['role']);
        $error['role_err'] = 'Role not found'; //neu qua vong for ma co user khop se bi se lai null
        foreach(Config::get('account.role') as $da){
            if($role == $da){
                $error['role_err'] = null;
            }
        }

        if(isset($error['form_err']) || isset($error['username_err']) || isset($error['password_err']) || isset($error['role_err'])){
            $error['error'] = '';
            return $error;
        }
        $fullname = $this->db->escape($data['fullname']);
        $password = Config::get('salt').$password;
        $email = $this->db->escape($data['email']);

        $sql = "INSERT INTO USERS VALUES (null, '{$fullname}', '{$username}',md5('{$password}'),'{$email}', '{$role}', 'img/default_avatar.png')";
        $result = $this->db->query($sql);
        return $result;
    }//end save function

    public function edit($data,$file){ //admin edit khong can password
        $error = array();
        if( !($data['username']) || !($data['email']) || !($data['role']) || !($data['re-password']) || !($data['new-password'])){
            $error['form_err'] = 'Please fill in all the input field!';
            $error['error'] = '';
            return $error; //khac voi add user, edit ma phat hien thieu 1 field la return ngay
        }
        $username = $this->db->escape($data['username']);
        if(!$this->getUserByUsername($username)){ //check thu username co trong database khonh
            $error['username_err'] = 'you cant change username'; //khong co thi bao not exist
            $error['error'] = '';
            return $error;
        }
        $email = $this->db->escape($data['email']);
        $role = $this->db->escape($data['role']);
        if( ($data['new-password']) && ($data['re-password'])){ //neu co new password gui len thi moi xu li new password
            $new_password = $this->db->escape($data['new-password']);
            $re_password = $this->db->escape($data['re-password']);
            if($new_password !== $re_password){
                $error['password_err'] = 'Your passwords does not match!';
                $error['error'] = '';
                return $error;
            }
            $new_password = Config::get('salt').$new_password;
            $sql = "UPDATE USERS SET password=md5('{$new_password}'), email='{$email}', role='{$role}' where username='{$username}' ";
            // neu co new password thi update new password
        }else{
            //khong thi chi update email va role
            $sql = "UPDATE USERS SET email='{$email}', role='{$role}' where username='{$username}' ";
        }
        $result = $this->db->query($sql);
        return $result;
    }//end edit function


    public function user_edit($data,$file){ //function cho viec user tu edit chinh no
        $error = array();
        if( !($data['username']) || !($data['email']) || !($data['cur-password']) || !($data['fullname'])){
            $error['form_err'] = 'Please fill in all required input field!';
            $error['error'] = '';
            return $error; //khac voi add user, edit ma phat hien thieu 1 field la return ngay
        }
        $sql = "UPDATE USERS SET ";
        $fullname = $this->db->escape($data['fullname']);
        $username = $this->db->escape($data['username']);
        $email = $this->db->escape($data['email']);
        $sql .= "email='{$email}', ";
        if(!$this->getUserByUsername($username)){ //check thu username co trong database khong
            $error['username_err'] = 'you cant change username'; //khong co thi bao not exist
            $error['error'] = '';
            return $error;
        }
        $sql .= "fullname='{$fullname}', ";


        $tmp = $this->getUserByUsername($username); //check thu neu sai current password
        if(md5(Config::get('salt').$data['cur-password']) !== $tmp['password']){
            $error['wrong_pass_err'] = 'Wrong password!';
            $error['error'] = '';
            return $error;
        }
        if(($data['new-password']) && ($data['re-password'])) { //neu co new password gui len thi moi xu li new password
            $new_password = $this->db->escape($data['new-password']);
            $re_password = $this->db->escape($data['re-password']);
            if ($new_password !== $re_password) {
                $error['password_err'] = 'Your passwords does not match!';
                $error['error'] = '';
                return $error;
            }
            $new_password = Config::get('salt').$new_password;
            $sql .= "password=md5('{$new_password}'), ";
        }
        if($file['image']['name'] !== ''){ //co name tuc la co gui ah len
            $img_result = $this->imageUploader($file); //thi moi up
            if(array_key_exists('error',$img_result)){
                $error['image_err'] = $img_result['error']; //neu co loi thi return
                $error['error'] = '';
                return $error;
            }
            $image = $img_result['success']; //lay image path
            $sql .= "image='{$image}', ";
        }
        $sql .= "username='{$username}'";
        $sql .= " where username='{$data['username']}'";
        $result = $this->db->query($sql);
        return $result;
    }//end edit function


    public function imageUploader($file){
        $target_filename = basename($file['image']['name']);//lay file name de get extension
        $result = array();
        if($file['image']['size'] > 2000000){ //chi lay hinh tu 2mb tro xuong
            $result['error'] = 'File size must be <2mb'.PHP_EOL;
            return $result;
        }
        $target_extension = strtolower(pathinfo($target_filename, PATHINFO_EXTENSION));
        if($target_extension != "jpg" && $target_extension != "jpeg" && $target_extension != "png" ){
            $result['error'] = 'Only .jpg|.jpeg|.png was allowed'.PHP_EOL;
            return $result;
        }
        $check = getimagesize($file['image']['tmp_name']);
        if(!$check){
            $result['error'] = 'File is not an image!'.PHP_EOL;
            return $result;
        }
        $target_filename = md5(Session::get('salt').$target_filename);
        $target_file = "uploads".DS.$target_filename.".".$target_extension;

        if(move_uploaded_file($file['image']['tmp_name'], $target_file)){
            $result['success'] = $target_file; //neu up duoc thi no return file path
        }else{
            $result['error'] = ''; //con khong thi gg
        }
        return $result;
    }

    public function deleteUser($id){
        $id = intval($id);
        if($id === 1){ // khong xoa admin
            $_SESSION['error'] = 'Cannot delete admin!';
            return false;
        }
        $sql = "DELETE FROM USERS WHERE id = {$id}";
        return $this->db->query($sql);
    }
}
?>
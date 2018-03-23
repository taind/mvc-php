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
        $re_password = $this->db->escape($data['re-password']);
        if($password !== $re_password){
            $error['password_err'] = 'Your passwords does not match!';
        }
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

        $sql = "INSERT INTO USERS VALUES (null, '{$fullname}', '{$username}',md5('{$password}'),'{$email}', '{$role}', 1)";
        $result = $this->db->query($sql);
        return $result;
    }//end save function

    public function edit($data){ //admin edit khong can password
        $error = array();
        if( !($data['username']) || !($data['email']) || !($data['role'])){
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
        if(($data['new-password']) && ($data['re-password'])){ //neu co new password gui len thi moi xu li new password
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
<?php

class Message extends Model{

    public function save($data, $id = null){
        if( !isset($data['name']) || !isset($data['email']) || !isset($data['message']) ){
            return false;
        }

        $id =  intval($id);
        $name = $this->db->escape($data['name']);
        $email = $this->db->escape($data['email']);
        $message = $this->db->escape($data['message']);

        if(!$id){  //neu id chua co add vao database
            $sql = "INSERT INTO MESSAGES VALUES (null, '{$name}','{$email}','{$message}')";
        }else{
            $sql = "UPDATE MESSAGES SET name='{$name}', email='$email', message='{$message}' where id={$id} ";
        }

        return $this->db->query($sql);
    }

    public function getList(){
        $sql = "select * from messages where 1";
        return $this->db->query($sql);
    }
}
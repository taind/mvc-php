<?php

class Page extends Model{

    public function getAll(){
        $sql = "select * from books";
        return $this->db->query($sql);
    }

    public function getByTitle($alias){
        $alias =  $this->db->escape($alias);
        $sql = "select * from books where title = '{$alias}' limit 1";
        $result = $this->db->query($sql);
        return isset($result[0]) ? $result[0] : null;
    }

    public function getById($id){
        $id = intval($id); //filter
        $sql = "select * from books where id = '{$id}' limit 1";
        $result = $this->db->query($sql);
        return isset($result[0]) ? $result[0] : null;
    }

    public function save($data){ //save book function
        if( !($data['title']) || !($data['author']) || !($data['price'])|| !($data['description']) ){
            $error['form_err'] = 'Please input all field!';
        }
        $title = $this->db->escape($data['title']);
        $author = $this->db->escape($data['author']);
        $description = $this->db->escape($data['description']);
        $price = $this->db->escape($data['price']);
        $price = intval($price);
        if($price < 1000 ){
            $error['price_err'] = 'Price must be > 1000';
        }
        if(isset($error['form_err']) || isset($error['price_err'])){
            $error['error'] = '';
            return $error;
        }
        $sql = "INSERT INTO BOOKS VALUES (null, '{$title}','{$author}', {$price}, '{$description}', 1)";
        return $this->db->query($sql);
    }//end save function

    public function edit($data){ //edit book function
        if( !($data['title']) || !($data['author']) || !($data['price'])|| !($data['description']) ){
            $error['form_err'] = 'Please input all field!';
            $error['error'] = '';
            return $error;
        }
        $title = $this->db->escape($data['title']);
        $author = $this->db->escape($data['author']);
        $description = $this->db->escape($data['description']);
        $price = $this->db->escape($data['price']);
        $price = intval($price);
        if($price < 1000 ){
            $error['price_err'] = 'Price must be > 1000';
            $error['error'] = '';
            return $error;
        }
        $sql = "select * from books";
        return $this->db->query($sql);
    }//end save function

    public function delete($id){
        $id = intval($id);
        $sql = "DELETE FROM BOOKS WHERE id = {$id}";
        return $this->db->query($sql);
    }
}
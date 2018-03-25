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
        $sql = "INSERT INTO BOOKS VALUES (null, '{$title}','{$author}', {$price}, '{$description}', 'img/default.jpg')";
        return $this->db->query($sql);
    }//end save function

    public function edit($data, $file){ //edit book function
        if( !($data['title']) || !($data['author']) || !($data['price'])|| !($data['description']) || !$data['id'] ){
            $error['form_err'] = 'Please input all field!';
            $error['error'] = '';
            return $error; //check form
        }
        $id = intval($data['id']);
        $title = $this->db->escape($data['title']);
        $author = $this->db->escape($data['author']);
        $description = $this->db->escape($data['description']);
        $price = $this->db->escape($data['price']);
        $price = intval($price);
        if($price < 1000 ) { //check gia tien
            $error['price_err'] = 'Price must be > 1000';
            $error['error'] = '';
            return $error;
        }

        if($file['image']['name'] !== ''){ //co name tuc la co gui ah len
            $img_result = $this->imageUploader($file); //thi moi up
            if(array_key_exists('error',$img_result)){
                $error['image_err'] = $img_result['error']; //neu co loi thi return
                $error['error'] = '';
                return $error;
            }
            //khong thi chay dong sau
            $image_path = $img_result['success']; // get file path tu result
            $sql = "UPDATE BOOKS SET title='{$title}', author='{$author}', description='{$description}', price={$price}, image='{$image_path}' where id={$id}";
        }else{
            $sql = "UPDATE BOOKS SET title='{$title}', author='{$author}', description='{$description}', price={$price} where id={$id}";
        }
        return $this->db->query($sql);
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




    public function delete($id){
        $id = intval($id);
        $sql = "DELETE FROM BOOKS WHERE id = {$id}";
        return $this->db->query($sql);
    }
}
<?php

class Page extends Model{

    public function getAll($only_published = false){
        $sql = "select * from books where 1";
        if ($only_published){
            $sql .= " and is_published = 1";
        }
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

    public function save($data, $id=null){
        if( !isset($data['alias']) || !isset($data['title']) || !isset($data['content']) ){
            return false;
        }
        $id = intval($id);
        $alias = $this->db->escape($data['alias']);
        $title = $this->db->escape($data['title']);
        $content = $this->db->escape($data['content']);
        $is_published = isset($data['is_published'])? 1:0;

        if(!$id){  //neu id chua co add vao database
            $sql = "INSERT INTO PAGES VALUES (null, '{$alias}','{$title}','{$content}', {$is_published})";
        }else{
            $sql = "UPDATE PAGES SET alias='{$alias}', title='$title', content='{$content}', is_published={$is_published} where id={$id} ";
        }
        return $this->db->query($sql);
    }//end save function

    public function delete($id){
        $id = intval($id);
        $sql = "DELETE FROM PAGES WHERE id = {$id}";
        return $this->db->query($sql);
    }
}
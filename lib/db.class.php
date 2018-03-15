<?php
class DB{

    protected $connection;

    public function __construct($host, $user, $password, $db_name)
    {
        $this->connection = new mysqli($host, $user, $password, $db_name);

        if(mysqli_connect_error()){
            throw new Exception('Can not connect to '.$host);
        }
    }

    public function query($sql)
    {
        if (!$this->connection) { //connection ok or not
            return false;
        }
        $result = $this->connection->query($sql); //ok thi query

        if(mysqli_error($this->connection)){ // query ok or not
            throw new Exception(mysqli_error($this->connection));
        }

        if(is_bool($result)){ //result is true ?
            return $result;
        }

        $data = array();
        while($row = mysqli_fetch_assoc($result)){ //fetch and return data
            $data[] = $row;
        }

        return $data;
    }//end function query

    public function escape($str){
        return mysqli_escape_string($this->connection, $str);
    }


}
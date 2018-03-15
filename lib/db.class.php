<?php
class DB{

    protected $connection;

    public function __construct($host, $user, $password, $db_name)
    {
        $this->connection = new mysqli($host, $user, $password, $db_name); //khoi tao connection

        if(mysqli_connect_error()){
            throw new Exception('Can not connect to '.$host);
        }
    }

    public function query($sql)
    {
        if (!$this->connection) { //connection khong duoc gi thi return ngay
            return false;
        }
        $result = $this->connection->query($sql); //query

        if(mysqli_error($this->connection)){ // neu co loi thi return thu loi gi
            throw new Exception(mysqli_error($this->connection));
        }

        if(is_bool($result)){ //dong query tren co tra ve gia tri khong ?
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
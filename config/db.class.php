<?php
class Db
{
    protected static $connection;

    public function connect(){
        if(!isset(self::$connection)){
            $config = parse_ini_file("config.ini");
            self::$connection = new mysqli("localhost",$config["username"],$config["password"],$config["databasename"]);
        }
        if(self::$connection==false){
            return false;
        }
        return self::$connection;
    }

    public function querry_execute($query){
        $connection= $this->connect();

        $connection->query("SET NAMES utf8");
        $result = $connection->query($query);
        // $connection->close();
        return $result;
    }
    public function select_to_array($query){
        $rows = array();
        $result=$this->querry_execute($query);

        if($result==false) return false;
        while($item = $result->fetch_assoc()){
            $rows[]=$item;
        }
        return $rows;
    }

}


?>
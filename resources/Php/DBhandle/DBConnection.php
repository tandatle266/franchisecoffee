<?php


class DBConnection
{
 private string $username='root';
 private string $password='';
 private string $host='localhost';
 private int $port = 3306;
 private array $options=[PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
 private ?PDO $db;

    /**
     * DBConnection constructor.
     * @param string $dbname database name
     * <br>database connection will automatically close when this object is collect by garbage collection.
     * <br>see : https://www.php.net/manual/en/pdo.connections.php
     */
 public function __construct(string $dbname)
 {
            $this->db= new PDO("mysql:host=$this->host;port=$this->port;dbname=$dbname",
                $this->username,$this->password,$this->options);
 }
public function isConnected():bool{
     return (bool)$this->db;
}
public function tableExists(string $tableName):bool{
     try {
         $result = $this->db->query("SELECT 1 FROM $tableName LIMIT 1");
     }catch (Exception $e){
         //got an exception == table not found;
         return false;
     }
     //result is either false (no table round) or true( table found)
     return $result!==false;
}
public function getdb():PDO {
     return $this->db;
}


}


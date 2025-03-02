<?php
namespace Controller;

use PDO;
use PDOException;

class Connection{
    protected $connection;
    protected $servername;
    protected $username;
    protected $password;

    public function __construct(){
    try{
        $this->username = "root";
        $this->password = "";
        $this->servername = "localhost";

        $this->connection = new PDO("mysql:host=$this->servername;dbname=test", $this->username, $this->password);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
    } catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }
    }

    public function get_connection(){
        return $this->connection;
    }

    public function close_connection(){
        $this->connection = null;
    }
}
?>
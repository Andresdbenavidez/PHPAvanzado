<?php

namespace Models;

class User extends Model{
    protected $name;
    protected $email;
    protected $password;
    protected $sector;
    protected $token;
    protected $email_verified;
    
    public function __construct($name, $email, $password, $sector){
        $this->name = $name;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->sector = $sector;
        $this->token = null;
        $this->email_verified = null;
    }

    public function save(\Controller\Connection $connection){
        $con = $connection->get_connection();

        $stmt = $con->prepare("INSERT INTO users (name, email, password, sector, token, creation, mail_verified) VALUES (:name, :email, :password, :sector, :token, :mail_verified)");

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":sector", $this->sector);
        $stmt->bindParam(":token", $this->token);
        $stmt->bindParam(":mail_verified", $this->email_verified);

        $stmt->execute();
    }

    public static function login (\Controller\Connection $connection, $email, $password){
        $con = $connection->get_connection();

        $stmt = $con->prepare("SELECT mail, password FROM users WHERE mail = ?");
        $stmt->execute(array($email));
        $user = $stmt->fetch();

        if($user && password_verify($password, $user['password'])){
            return true;
        }
        return false;
    }
}
    
    


?>
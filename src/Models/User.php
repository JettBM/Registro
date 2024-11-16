<?php

namespace Base\Models;
require __DIR__ . '/../../../Registro/vendor/autoload.php';
use Firebase\JWT\JWT;
use Base\Models\BaseModel;
use PDO;



class User extends BaseModel {
    
    
    public $name;
    public $email;
    
    

    public function __construct()
    {
        parent::__construct();
       
    }
    
    public static function getUser($email, $password){
        $db = new BaseModel;
        $stmt = $db->db->prepare("SELECT id, name, password FROM users WHERE email = :email");
        $stmt->bindParam('email', $email);

        $stmt->execute();
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if($user && password_verify($password, $user['password'])){
            return $user;
        }
        else{
            return false;
        }

    }
    public static function Token($payload, $id){
        $db = new BaseModel;
        $secretKey = 'llavesecreta';
        $token = JWT::encode($payload, $secretKey, 'HS256');
        $stmt = $db->db->prepare("UPDATE users SET token = :token WHERE id = :id");
        $stmt->bindParam('token', $token);
        $stmt->bindParam('id', $id);
        $stmt->execute();

    }
   
}





?>
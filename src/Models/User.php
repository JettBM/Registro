<?php

namespace Base\Models;
require __DIR__ . '/../../../Registro/vendor/autoload.php';
use Firebase\JWT\JWT;
use Base\Models\BaseModel;
use PDO;



class User extends BaseModel {
    
    protected $fields = ['name', 'email', 'password'];
    public $name;
    public $email;
    public $password;

    public function __construct()
    {
        parent::__construct();
       
    }
    
    public function getUser(){
        $stmt = $this->db->prepare("SELECT id, name, password FROM users WHERE email = :email");
        $stmt->bindParam('email', $this->email);

        $stmt->execute();
        
        $user = $stmt->fetchObject(User::class);
    
        if($user && password_verify($this->password, $user->password)){
            return $user;
        }
        else{
            return false;
        }

    }
    //esta funcion debe ser sin parametros, ya que los parametros se enviaran desde un objeto
   public function saveUser(){

    $stmt = $this->db->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
    $stmt->bindParam(':name', $this->name);
    $stmt->bindParam('email', $this->email);
    $stmt->bindParam('password', password_hash($this->password, PASSWORD_DEFAULT));
    //retornar el usuario insertado como un objeto
    $id = $this->db->lastInsertId();
    if($stmt->execute()){
        return $id;
    }
   }

   //aprendiendo sobre consultas dinamicas, para testear.
   public function updateInfo($email, $name = null, $password = null){

    foreach($this->fields as $key => $value){
        $this->$key ":{$name}"
    }

    $SQLfields = [];
    $params = [];

    if(!is_null($name)){
        $SQLfields[] = "name = :name";
        $params["name"] = $name; 
    }
    if(!is_null($password)){
        $SQLfields[] = "password = :password";
        $params["password"] = $password;
    }

    
    $params["email"] = $email;
    
    $stmt = $this->db->prepare("UPDATE users SET " . implode(', ', $SQLfields) . "WHERE email = :email");

    foreach($params as $key => $value){
        $stmt->bindParam($key, $value);
    }

    if($stmt->execute()){
        return 'true';
    }
    else{
        return 'false';
    }



   }
    
   
}





?>
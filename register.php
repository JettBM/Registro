<?php

require __DIR__ . '/vendor/autoload.php';

use Base\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$payload = [
    'iss' => 'register.php',
    'iat' => time(),
    'exp' => time() + 3600
];

class SignUp {
    
    public function Registrar($name, $email, $password, $token){
        $stmt = $this->db->prepare("INSERT INTO users (name, email, password, token) VALUES (:name, :email, :password, :token)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':token', $token);

        return $stmt->execute();
    }
    
}

$token = User::token($payload)

try{
    $usuario = new SignUp();
    $usuario->Registrar($_POST['name'], $_POST['email'], password_hash($_POST['password'], PASSWORD_DEFAULT), $token);
    return print('user registered');
}

catch(Exception $e){
    echo $e->getMessage();
}





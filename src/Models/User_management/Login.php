<?php
namespace Base\Models\User_management;

require __DIR__ . '/../../../../Registro/vendor/autoload.php';
use Base\Models\User;
use Base\Models\BaseModel;
use PDO;
use Firebase\JWT\JWT;

session_start();

class Login {
    
    public function authentication($email, $password){
        $user = User::getUser($email, $password);
        
        if($user){
            
            $_SESSION['id'] = $user['id'];
            return true;
            
        }
        
    }
}



?>
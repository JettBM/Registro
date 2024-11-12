<?php
namespace Base\Models\User_management;

require __DIR__ . '/../../../../Registro/vendor/autoload.php';
use Base\Models\User;
use Base\Models\BaseModel;
use PDO;

class Registrar {

    
    public static function RegistrarUsuario($name, $email, $password){
        
        $user = new BaseModel();
        $stmt = $user->db->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam('email', $email);
        $stmt->bindParam('password', password_hash($password, PASSWORD_DEFAULT));
      
        $stmt->execute();
        
       
     }


}


print_r(Registrar::RegistrarUsuario($_POST['name'], $_POST['email'], $_POST['password']));


?>
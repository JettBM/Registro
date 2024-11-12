<?php
namespace Base\Models\User_management;

require __DIR__ . '/../../../../Registro/vendor/autoload.php';
use Base\Models\User;
use Base\Models\BaseModel;
use PDO;

class Login{



    public function login(){
        $user = new User()
        
        $stmt = $this->db->prepare("SELECT id, name, password FROM users WHERE email = :email");
        $stmt->bindParam(':email', $this->email);

        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        
        if($data && password_verify($this->password, $data['password'])){
             echo 'logged in';
        }
        else{
            echo 'incorrect data';
        }
    }

}

$user = new Login(null, $_POST['email'], $_POST['password']);

return $user->login();




?>
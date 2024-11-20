<?php
namespace Base\Models\User_management;

require __DIR__ . '/../../../../Registro/vendor/autoload.php';
use Base\Models\User;
use Base\Models\BaseModel;
use Exception;
use PDO;



class Registrar {

    public function Registrar($name, $email, $password){
        $newUser = new User();
        $newUser->name = $name;
        $newUser->email = $email;
        $newUser->password = $password;

    try {
        $newUser->saveUser($name, $email, $password);
    }
    catch(Exception $e){
        return $e->getMessage();
    }
 }

}

$newUser = new Registrar();
$newUser->Registrar($_POST['name'], $_POST['email'], $_POST['password']);

var_dump($newUser);

?>


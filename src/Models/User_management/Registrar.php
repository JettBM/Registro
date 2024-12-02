<?php
namespace Base\Models\User_management;

require __DIR__ . '/../../../../Registro/vendor/autoload.php';
use Base\Models\User;
use Base\Models\BaseModel;
use Exception;
use PDO;
//volver los parametros del objeto dinamicos tambien
class Update {
    //asignar por defecto null a los parametros en caso de que no se reciba su valor
    public function actualizar($id, $name, $email){
        $updateUser = new User();
        $updateUser->name = $name;
        $updateUser->email = $email;
        
        try{
            $updatedUser = $updateUser->updateUser($id);
            return print(json_encode($updatedUser));
        }
        catch(Exception $e){
            return $e->getMessage();
        }
        
    }
   
}

$updatedUser = new Update();
$updatedUser->actualizar($_POST['id'], $_POST['name'], $_POST['email']);

// class Registrar {

//     public function Registrar($name, $email, $password){
//         $newUser = new User();
//         $newUser->name = $name;
//         $newUser->email = $email;
//         $newUser->password = $password;

//     try {
//         $newUser->saveUser($name, $email, $password);
//         return print(json_encode($newUser));
//     }
//     catch(Exception $e){
//         return $e->getMessage();
//     }
//  }

// }

// $newUser = new Registrar();
// $newUser->Registrar($_POST['name'], $_POST['email'], $_POST['password']);




?>


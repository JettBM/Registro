<?php
namespace Base\UserManagement;

require __DIR__ . '/../../../Registro/vendor/autoload.php';
use Base\Models\User;
use Base\Models\BaseModel;
use Exception;
use PDO;





class Update {

    public function actualizar($id, $name = null, $email = null, $password = null)
    {
        try
        {

        $updatedUser = new User();
        $updatedUser->name = $name;
        $updatedUser->email = $email;
        $updatedUser->password = $password;

        $updatedUser->updateUser($id);
        
        }

        catch(Exception $e)
        {
            echo $e->getMessage("Error");
        }
        
        
    $updatedUser = User::getUserById($id);
    
    if($updatedUser)
    {
        var_dump($updatedUser);
    }
    else
    {
        echo "error";
        die;
    }
    
    return $updatedUser;
        
    }
}

$updatedUser = new Update();
$updatedUser->actualizar($_POST['id'], $_POST['name']);

print_r($updatedUser);



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
//         http_response_code(500);
//         return print(json_encode(['error' => $e->getMessage()]));
//     }
//  }

// }

// $newUser = new Registrar();
// $newUser->Registrar($_POST['name'], $_POST['email'], $_POST['password']);




?>


<?php
namespace Base\User_management;

require __DIR__ . '/../../../Registro/vendor/autoload.php';
use Base\Models\User;
use Base\Models\BaseModel;
use Base\Models\User_management\Login;
use PDO;

$payload = [
    'iss' => 'LoginController.php',
    'iat' => time(),
    'exp' => time() + 3600,
    
];

$email = $_POST['email'];
$password = $_POST['password'];


$login = new Login();

if($login->authentication($email, $password) && isset($_SESSION['id'])){
    $payload['id'] = $_SESSION['id'];
    User::Token($payload, $_SESSION['id']);
    print('login successful');
    return session_destroy();
    
}
else{
    return print('invalid data');
}


?>
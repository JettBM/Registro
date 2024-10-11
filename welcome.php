<?php
require 'vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


if(isset($_COOKIE['jwt_token'])){
    
    $secretKey = 'mi?llave?secreta';

    try{
        $decode = JWT::decode($_COOKIE['jwt_token'], new Key($secretKey, 'HS256'));
        echo "Bienvenido " . $decode->data->userName;
        echo "<a href=" . '/Registro/logout.php' . ">" . 'Log out' .  "</a>";
        die;
    }
    catch(Exception $e){
        echo json_encode([
            'error' => 'token invalido o expirado'
        ]);
        die;
    }
    
}
else{
    echo "token invalido o expirado";
}





?>
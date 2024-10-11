<?php
require 'vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

include 'database.php';
//llave secreta del token
$secretKey = 'mi?llave?secreta';

$email = $_POST['email'];
$password = $_POST['password'];

//statement sql para requerir la informacion en base al correo introducido
$sqli = "SELECT id, name, password FROM users WHERE email=:email";

//preparar el statement para ser ejecutado
$stmt = $database->prepare($sqli);
//parametro que el usuario va a pasarpara validar
$stmt->bindParam(':email', $email);
//ejecutar statement
$stmt->execute();
//guardar la informacion extraida de la base de datos en la variable info (convertido en array asociativo)
$info = $stmt->fetch(PDO::FETCH_ASSOC);
//validar si el correo y la contraseña fueron introducidos correctamente
if($info && password_verify($password, $info['password'])){

    $payload = [
        'iss' => 'userlogin.php',
        'aud' => 'welcome.php',
        'iat' => time(),
        'exp' => time() + (60 * 60),
        'data' => [
            'userId' => $info['id'],
            'userName' => $info['name']
        ]
    ];

    if(headers_sent()){
        die("Error");
    }

    $jwt = JWT::encode($payload, $secretKey, 'HS256');

    //Especificar correctamente el dominio, para que la cookie sea usada en diferentes scripts de php
    setcookie('jwt_token', $jwt, time() + (60*60), "/", $_SERVER['HTTP_HOST'], false, true);
    
    header('Location: welcome.php');
    exit;


}
else{
    echo json_encode([
        'message' => 'datos incorrectos'
    ]);
}


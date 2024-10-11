<?php

//conexion a la base de datos

try{
    $database = new PDO("mysql:host=localhost;dbname=usuarios", 'root');
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $err){
    echo "error connecting " . $err->getMessage();
}


?>
<?php

include 'database.php';


$name = $_POST['name'];
$email = $_POST['email'];
$hashedpassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

try{
    $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";

$stmt = $database->prepare($sql);

$stmt->bindParam(':name', $name);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $hashedpassword);

$stmt->execute();

echo "user registered.";
}

catch(PDOException $e){
    if($e->errorInfo[1] == 1062){
        echo "Email already exists";
    }
    else{
        echo $e->getMessage();
    }
}

?>
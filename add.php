<?php
include 'database.php';


$sql = 'ALTER TABLE users ADD COLUMN token_exp DATETIME DEFAULT NULL';

$stmt = $database->prepare($sql);

$stmt->execute();

if($sql == true){
    echo 'done';
}

?>
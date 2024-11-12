<?php
namespace Base\Models;
require __DIR__ . '/../../../Registro/vendor/autoload.php';
use Firebase\JWT\JWT;
use PDO;
use PDOException;

class BaseModel {
   public $db;

   public function __construct()
   {
      try{
         $this->db = new PDO("mysql:host=localhost;dbname=usuarios", 'root');
         $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         
         
      }

      catch(PDOException $e){
         echo $e->getMessage();
   }  }
   
   
   
}



?>
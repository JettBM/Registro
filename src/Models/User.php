<?php

namespace Base\Models;
require __DIR__ . '/../../../Registro/vendor/autoload.php';
use Firebase\JWT\JWT;
use Base\Models\BaseModel;
use PDO;

class User extends BaseModel {
    
    
    public $name;
    public $email;
    
    

    public function __construct()
    {
        parent::__construct();
       
    }
    

   
}





?>
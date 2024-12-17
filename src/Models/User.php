<?php

namespace Base\Models;
require __DIR__ . '/../../../Registro/vendor/autoload.php';
use Firebase\JWT\JWT;
use Base\Models\BaseModel;
use Exception;
use PDO;



class User extends BaseModel {
    
    public $allowedData = ['name', 'email', 'password'];
    public $name;
    public $email;
    public $password;

    public function __construct()
    {
        parent::__construct();
       
    }
    
    public static function getUserByEmailPassword($email, $password):self
    {
        $stmt = new self();
        $stmt = $stmt->db->prepare("SELECT id, name, password FROM users WHERE email = :email");
        $stmt->bindParam('email', $email);

        $stmt->execute();
        
        $user = $stmt->fetchObject(User::class);
    
        if($user && password_verify($password, $user->password)){
            return $user;
        }
        else{
            return false;
        }

    }

    public static function getUserById($id)
    {
        $stmt = new self();
        $stmt = $stmt->db->prepare("SELECT name, email FROM users WHERE id = :id");
        $stmt->bindParam('id', $id);

        $stmt->execute();

        return $stmt;
    }

    //esta funcion debe ser sin parametros, ya que los parametros se enviaran desde un objeto
   public function saveUser():User
   {

        try
        {
            //beginTransaction es para poder hacer multiples consultas SQL y que se ejecuten como un solo comando
            $this->db->beginTransaction();

            $stmt = $this->db->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam('email', $this->email);
            $stmt->bindParam('password', password_hash($this->password, PASSWORD_DEFAULT));
            $stmt->execute();

            
            $user = $stmt->fetchObject(User::class);

            $this->db->commit();

            return $user;
        }
        catch(Exception $e)
        {
            $this->db->rollBack();
            return $e->getMessage();
        }

        //retornar el usuario insertado como un objeto
   }

  
   //aprendiendo sobre consultas dinamicas, para testear.
   public function updateUser($id)
   {
    //get_object_vars se utiliza para obtener las propiedades de un objeto
    $data = get_object_vars($this);
    //array_intersect_key devuelve todas las claves que esten presentes en los arrays dados, solo devuelve las que esten presentes en ambos, si hay una que esta
    //en un array pero no en el otro, no aparece
    //array_flip hace que en el array se intercambie la clave por el valor y el valor por la clave
    $fields = array_intersect_key($data, array_flip($this->allowedData));
    //array_filter es para verificar un array para ver si tiene claves sin valores, en caso de haber una clave que no tenga un valor asignado se obvia
    $fields = array_filter($fields, function($values)
    {
        return !empty($values);
    }
    );
    if(empty($fields)){
        throw new Exception("No data");
    }

    if(isset($fields['password'])){
        $fields['password'] = password_hash($fields['password'], PASSWORD_DEFAULT);
    }    
    //este bloque crea un array vacio para el statement dinamico. 
    $sqlclause = [];
    //el foreach pasara por el array fields que tenga llave => valor y guardara llave => :llave en el array vacio creado anteriormente
    foreach($fields as $column => $value){
        $sqlclause[] = "$column = :$column"; 
    }
    //esto convierte el array creadocon los valores en un string que pueda ser insertado en el statement sql
    $sqlclause = implode(", ", $sqlclause);
    //paso el id a parte para testeo, luego probar pasando todo desde sqlclause
    $fields['id'] = $id;

    $this->db->beginTransaction();
    try{
        $stmt = $this->db->prepare("UPDATE users SET {$sqlclause} WHERE id = :id");
        $stmt->execute($fields);
        
        $stmt2 = $this->db->prepare("SELECT id, name, email FROM users WHERE id = :id");
        $stmt2->execute(['id' => $id]);

        $updatedUser = $stmt2->fetchObject(User::class);
        $this->db->commit();
        
        //@todo Crear funcion para buscar usuario en base a un criterio específico
         //
        
    
    }
    catch(Exception $e){
        $this->db->rollBack();
        throw $e->getMessage();
    }
    return $updatedUser;
   }
    
   
}





?>
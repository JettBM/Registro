<?php

class register {
public function register(){
	
	//Esto es para instanciar un nuevo objeto user. 
    //Este objeto debe tener las propiedades que se va a utilizar dependiendo lo que queramos hacer, sin necesidad de instanciarlas en la clase directamente
	$user = new User();
	$user->password = null;
	$user->name = "jhon";
	$user->email = "email";
	$user->save();

	$token = Token::generate($user);
	$user->delete();
	
}


public function generate($user)
{
	$token = "sdaksjdaskldjaskldjasd";
	$user->token = $token;
	$user->name = "name";
	$user->update();
}

}

class User {

    //En user, como es del modelo, debemos tener todo lo que sea referente a un manejo de usuario, tal como registrar, logear, actualizar, deslogear, etc...
	public $name;
	public $email;


	public function save() {
		$table = "user";

		foreach($this as $propiedadName) {
			$variable .= $proiedadName;
		}
		$variable2 = ':name, :email, :password';
		
        $stmt = $this->db->prepare("INSERT INTO ".$table." (".$variable.") VALUES (.$variable2.)");
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam('email', $this->email);
        $stmt->bindParam('password', password_hash($this->password, PASSWORD_DEFAULT));
        
        $newUser = $stmt->execute();
        
        foreach ($newUser as $key => $value) {
            if (property_exists($this, $key)) {
                $this->name = $value;
            }
        }
        
        return $this;
	}
	
		public function update() {
		
        $stmt = $this->db->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam('email', $this->email);
        $stmt->bindParam('password', password_hash($this->password, PASSWORD_DEFAULT));
        
        $newUser = $stmt->execute();
        
        foreach ($newUser as $key => $value) {
            if (property_exists($this, $key)) {
                $this->name = $value;
            }
        }
        
        return $this;
	}
	
	
	
}


?>
<?php

//se declara clase

class Persona {
//propiedades
public $name;
public $age;


//constructor para inicializar propiedades

public function __construct($name, $age) {
    $this->name = $name;
    $this->age = $age;
}

public function saludar(){
    return "Hola, mi nombre es " . $this->name . " Y tengo " . $this->age . " años.";
}

}

$persona = new Persona("John", 25);

echo $persona->saludar();

?>
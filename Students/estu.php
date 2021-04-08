<?php

class estu{

    public $id;
    public $nombre;
    public $apellido;
    public $carreraId;
    public $check;
    public $asignacion;
    public $profilePhoto;

    private $utilities;

    public function __construct(){

        $this->utilities = New utilities();

    }

    public function InicializeData($id,$nombre,$apellido,$carreraId,$check,$asignacion){
        
        $this->id = $id; 
        $this->nombre = $nombre; 
        $this->apellido = $apellido; 
        $this->carreraId = $carreraId; 
        $this->check = $check; 
        $this->asignacion = $asignacion; 
    }

    public function set($data){

        foreach($data as $key => $value) $this->{$key} = $value;
    }

    public function getCarrera(){

        if($this->carreraId != 0 && $this->carreraId != null){

            return $this->utilities->carrera[$this->carreraId];

        }
    }

}

?>
<?php

class estuServiceCookies implements IServiceBase{

    private $utilities;
    private $cookieName; 

    public function __construct(){

        $this->utilities = New utilities();
        $this->cookieName = "estudiantes";

    }

    public function GetList(){

        $listadoEstudiantes = array();

        if(isset($_COOKIE[$this->cookieName])){

            $listadoEstudiantesDecode = json_decode($_COOKIE[$this->cookieName],false);

            foreach($listadoEstudiantesDecode as $elementDecode){

                $element = new estu();
                $element->set($elementDecode);

                array_push($listadoEstudiantes, $element);
            }

        }else{
            setcookie($this->cookieName, json_encode($listadoEstudiantes), $this->utilities->GetCookieTime(),"/");
        }

        return $listadoEstudiantes;
    }

    public function GetById($id){

        $listadoEstudiantes = $this->GetList();
        $estu = $this->utilities->buscarProperty($listadoEstudiantes,'id',$id)[0];

        return $estu; 
    }

    public function Add($entity){

        $listadoEstudiantes = $this->GetList();
        $estuId = 1;

        if(!empty($listadoEstudiantes)){

            $lastEstu = $this->utilities->getlastElement($listadoEstudiantes);
            $estuId = $lastEstu->id + 1;

        }

        $entity ->id = $estuId;
        $entity->profilePhoto = "";

        if(isset($_FILES['profilePhoto'])){

            $photoFile = $_FILES['profilePhoto'];

            if($photoFile['error'] == 4){ 

                $entity->profilePhoto = "";

            }else{

                $typereplace = str_replace("image/","",$_FILES['profilePhoto']['type']);
                $type = $photoFile['type'];
                $size = $photoFile['size'];
                $name = $estuId . '.' . $typereplace;
                $tmpname =  $photoFile['tmp_name'];
    
                $success = $this->utilities->uploadImage('../assets/img/estudiantes/', $name, $tmpname, $type, $size); 
    
                if($success){
    
                    $entity->profilePhoto = $name; 
                }

            }

        }


        array_push($listadoEstudiantes,$entity);

        setcookie($this->cookieName,json_encode($listadoEstudiantes),$this->utilities->GetCookieTime(),"/");

    }

    public function Update($id,$entity){

        $element = $this->GetById($id);
        $listadoEstudiantes = $this->GetList();

        $elementIndex = $this->utilities->getIndexElement($listadoEstudiantes,'id',$id);

        if(isset($_FILES['profilePhoto'])){

            $photoFile = $_FILES['profilePhoto'];

            if($photoFile['error'] == 4){

                $entity->profilePhoto = $element->profilePhoto;

            }else{

            $typereplace = str_replace("image/", "",$_FILES['profilePhoto']['type']);
            $type = $photoFile['type'];
            $size = $photoFile['size'];
            $name = $id . '.' . $typereplace;
            $tmpname =  $photoFile['tmp_name'];

            $success = $this->utilities->uploadImage('../assets/img/estudiantes/',$name,$tmpname,$type,$size); 

            if($success){

                $entity->profilePhoto = $name; 
            }

            }

        }

        $listadoEstudiantes[$elementIndex] = $entity;

        setcookie($this->cookieName,json_encode($listadoEstudiantes),$this->utilities->GetCookieTime(),"/");

    }

    public function Delete($id){

        $listadoEstudiantes = $this->GetList();

        $elementIndex = $this->utilities->getIndexElement($listadoEstudiantes,'id',$id);
        
        unset($listadoEstudiantes[$elementIndex]);

        $listadoEstudiantes = array_values($listadoEstudiantes);
        setcookie($this->cookieName,json_encode($listadoEstudiantes),$this->utilities->GetCookieTime(),"/");

    }

}

?>
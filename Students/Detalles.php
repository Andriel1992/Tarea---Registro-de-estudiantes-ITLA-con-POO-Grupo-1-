<?php

require_once '../Helpers/utilities.php';
require_once 'estu.php';
require_once '../service/IServiceBase.php';
require_once 'estuServiceCookies.php';

$service = new estuServiceCookies();
$utilities = new utilities();
$isContaintId = isset($_GET['id']);   

if(isset($_GET['id'])){

  $estuId = $_GET['id'];
  $element = $service->GetById($estuId);

  if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['carrera']) && isset($_POST['check']) 
  && isset($_FILES['profilePhoto'])){

    $updateEstu = new Estu();

    $updateEstu->InicializeData($estuId,$_POST['nombre'],$_POST['apellido'],$_POST['carrera'],$_POST['check'],$_POST['asignacion']);
    
    $service->Update($estuId,$updateEstu);

    header("Location: ../index.php");
    exit();
    
   
  
  } 

}else{
  
header("Location: ../index.php");
exit();
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles</title>
    <link href="..\assets\css\bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="..\assets\css\style.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
    <script href="..\assets\js\bootstrap.min.js"></script>
</head>

<body>

<nav class="navbar navbar-dark bg-dark">
  <form class="form-inline">
    
    <a href="..\index.php">
        <button class="btn btn-outline-success font-weight-bold" type="button"> Inicio </button>
    </a>
    
  </form>

</nav>

<h2 class="text-center">Detalles del estudiante </h2>

    <div class="forma card bg-white" style="width: 18rem;">

 <?php if($element->profilePhoto == "" || $element->profilePhoto == null): ?>

  <img class="card-img-top" src="<?php echo "../assets/img/default.png" ?>" width="100%" height="200">


 <?php else: ?>

  <img class="card-img-top" src="<?php echo "../assets/img/estudiantes/" . $element->profilePhoto; ?>" width="100%" height="200">

 <?php endif; ?>

     

       <label class="font-weight-bold" for="nombre" class="es">Nombre del estudiante:</label>
       <p class="text-muted"><?php echo $element->nombre; ?></p> 
       <p class="text-muted"><?php echo $element->apellido; ?></p>

       <label class="font-weight-bold" for="asignacion">Asignacion favorita:</label>
       <p class="text-muted"><?php echo $element->asignacion; ?><img src="..\assets\img\estrella.png"></p>
      
       <label class="font-weight-bold" for="carrera">Carrera:</label>
       <p class="text-muted"><?php echo $element->getCarrera(); ?></p>

       <label class="font-weight-bold"  for="check">Estatus del estudiante:</label>
       <p class="text-muted"><?php echo $element->check; ?></p>

       
       <a href="..\index.php">
        <button class="btn btn-success font-weight-bold" type="button"> Volver atras </button>
      </a>

       </div>

<style >
  
  footer{
  position:fixed;
  left:0px;
  bottom:0px;
  width:100%;
  }

</style>

<footer class="page-footer font-small blue bg-dark">
 <div class="footer-copyright text-center py-3">
  
   <h5>© 2020 Xiolin Ramirez</h5> 
  
 </div>
</footer>

</body>
</html>
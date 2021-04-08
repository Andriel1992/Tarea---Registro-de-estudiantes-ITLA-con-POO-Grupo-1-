<?php

require_once '../Helpers/utilities.php';
require_once 'estu.php';
require_once '../layout/layout.php';
require_once '../service/IServiceBase.php';
require_once 'estuServiceCookies.php';

$layout = new Layout();
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

<?php echo $layout->printHeader(); ?>

<h2 class="text-center">Detalles del estudiante </h2>

    <div class="diseno card bg-white" style="width: 22rem;">

 <?php if($element->profilePhoto == "" || $element->profilePhoto == null): ?>

  <img class="card-img-top" src="<?php echo "../assets/img/default.png" ?>" width="100%" height="200">


 <?php else: ?>

  <img class="card-img-top" src="<?php echo "../assets/img/estudiantes/" . $element->profilePhoto; ?>" width="100%" height="200">

 <?php endif; ?>

     

       <label class="font-weight-bold" for="nombre" class="es">Nombre del estudiante:</label>
       <p class="text-muted"><?php echo $element->nombre; ?></p> 
       <p class="text-muted"><?php echo $element->apellido; ?></p>

       <label class="font-weight-bold" for="asignacion">Materia favorita:</label>
       <p class="text-muted"><?php echo $element->asignacion; ?><img src="..\assets\img\estrella.png"></p>
      
       <label class="font-weight-bold" for="carrera">Carrera:</label>
       <p class="text-muted"><?php echo $element->getCarrera(); ?></p>

       <label class="font-weight-bold"  for="check">Estatus del estudiante:</label>
       <p class="text-muted"><?php echo $element->check; ?></p>

       
       <a href="..\index.php">
        <button class="btn btn-success font-weight-bold" type="button"> Volver atras </button>
      </a>

       </div>


<?php echo $layout->printFooter(); ?>
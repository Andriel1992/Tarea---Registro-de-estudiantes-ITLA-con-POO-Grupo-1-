
<?php

require_once '../Helpers/utilities.php';
require_once 'estu.php';
require_once '../service/IServiceBase.php';
require_once 'estuServiceCookies.php';
require_once '../layout/layout.php';

$layout = new Layout();
$service = new estuServiceCookies();
$utilities = new utilities();


if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['carrera']) && isset($_POST['check']) &&
isset($_POST['asignacion']) && isset($_FILES['profilePhoto'])){


  $newEstu = new estu();

  $newEstu->InicializeData(0,$_POST['nombre'],$_POST['apellido'],$_POST['carrera'],$_POST['check'],$_POST['asignacion']);

  $service->Add($newEstu);
   
  header("Location: ../index.php");
  exit();
} 

?>

<?php echo $layout->printHeader(); ?>




<form enctype="multipart/form-data" action="Registrar.php" method="POST">

<div class="diseno card">
    <div class="card-header ch bg-dark text-white font-weight-bold">
    Registrar de estudiantes
    </div>

        <label class="font-weight-bold" for="photo">Foto de perfil</label>
        <input type="file" name="profilePhoto"  id="profilePhoto">

        <label class="font-weight-bold" for="nombre">Nombre</label>
        <input type="text" name="nombre" placeholder="Nombre"  id="nombre">

        <label class="font-weight-bold" for="apellido">Apellido</label>
        <input type="text" name="apellido" placeholder="Apellido"  id="apellido">

        <label class="font-weight-bold"  for="apellido">Materia favorita</label>
        <input type="text" name="asignacion" placeholder="Asignacion favorita"  id="asignacion">

        <label class="font-weight-bold" for="carrera">Carrera</label>
        <select class="custom-select" id="carrera" name="carrera">

        <?php foreach($utilities->carrera as $id => $text): ?>

        <option value="<?php echo $id ?>"><?php echo $text; ?></option>

        <?php endforeach; ?>

        </select>

      <p class="font-weight-bold">Estatus del estudiante</p>

       <div class="form-check">
       <input type="checkbox" class="form-check-input" name="check" id="check" Value="Activo" checked >
       <label for="estatus">Activo</label>
       </div>
      
        <button type="submit" class="btn btn-primary " id="sendForm">Guardar</button> 

        
</div>

</form>

<?php echo $layout->printFooter(); ?>
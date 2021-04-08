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

if (isset($_GET['id'])) {

  $estuId = $_GET['id'];
  $element = $service->GetById($estuId);

  if (
    isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['carrera']) && isset($_POST['check'])
    && isset($_FILES['profilePhoto'])
  ) {

    $updateEstu = new Estu();

    $updateEstu->InicializeData($estuId, $_POST['nombre'], $_POST['apellido'], $_POST['carrera'], $_POST['check'], $_POST['asignacion']);

    $service->Update($estuId, $updateEstu);

    header("Location: ../index.php");
    exit();
  }
} else {

  header("Location: ../index.php");
  exit();
}



?>

<?php echo $layout->printHeader(); ?>




<form enctype="multipart/form-data" action="Editar.php?id=<?php echo $element->id; ?>" method="POST">

  <div class="diseno card bg-white">
    <div class="card-header text-white bg-dark font-weight-bold">
      Editar de estudiantes
    </div>
    <div class="card" style="width: 18rem;">


      <?php if ($element->profilePhoto == "" || $element->profilePhoto == null) : ?>

        <img class="card-img-top" src="<?php echo "../assets/img/default.png" ?>" width="100%" height="200">


      <?php else : ?>

        <img class="card-img-top" src="<?php echo "../assets/img/estudiantes/" . $element->profilePhoto; ?>" width="100%" height="200">

      <?php endif; ?>

      <div class="card-body">
        <label for="photo">Foto de perfil</label>
        <input type="file" name="profilePhoto" id="profilePhoto">
      </div>
    </div>

    <label class="font-weight-bold" for="nombre">Nombre</label>
    <input type="text" name="nombre" placeholder="Nombre" id="nombre" value="<?php echo $element->nombre; ?>">

    <label class="font-weight-bold" for="apellido">Apellido</label>
    <input type="text" name="apellido" placeholder="Apellido" id="apellido" value="<?php echo $element->apellido; ?>">

    <label class="font-weight-bold" for="apellido">Materia favorita</label>
    <input type="text" name="asignacion" placeholder="Asignacion favorita" id="asignacion" value="<?php echo $element->asignacion; ?>">

    <label class="font-weight-bold" for="carrera">Carrera</label>

    <select class="custom-select" id="carrera" name="carrera">

      <?php foreach ($utilities->carrera as $id => $text) : ?>

        <?php if ($id == $element->carreraId) : ?>

          <option selected value="<?php echo $id ?>"> <?php echo $text; ?> </option>

        <?php else : ?>

          <option value="<?php echo $id ?>"><?php echo $text; ?></option>

        <?php endif; ?>

      <?php endforeach; ?>

    </select>

    <p class="font-weight-bold">Estatus del estudiante</p>


    <div class="form-check">
      <input type="checkbox" class="form-check-input" name="check" id="check" Value="Activo" checked>
      <label for="estatus">Activo</label>
    </div>

    <div class="form-check">
      <input type="checkbox" class="form-check-input" name="check" id="check" Value="No activo">
      <label class="form-check-label" for="Check1">No activo</label>
    </div>


    <button type="submit" class="btn btn-primary " id="sendForm">Guardar</button>

  </div>
</form>



<?php echo $layout->printFooter(); ?>
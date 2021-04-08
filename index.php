<?php

require_once 'Helpers/utilities.php';
require_once 'Students/estu.php';
require_once 'service/IServiceBase.php';
require_once 'Students/estuServiceCookies.php';
require_once 'layout/layout.php';

$layout = new Layout(true);
$utilities = new utilities();
$service = new estuServiceCookies();

$listadoEstu = $service->GetList();

if (!empty($listadoEstu)) {
  if (isset($_GET['carreraId'])) {

    $listadoEstu = $utilities->buscarProperty($listadoEstu, 'carreraId', $_GET['carreraId']);
  }
}


?>

<?php echo $layout->printHeader(); ?>





<div class="row ">
  <div class="col-md-10"></div>
  <div class="col-md-2">
    <a href="Students\Registrar.php">
      <button class=" text-center btn btn-success" type="button"> Nuevo Estudiante</button>
    </a>
  </div>
</div>





<div class="card">
  <div class="text-center">
    <div class="btn-group">

      <a href="index.php?carreraId=5" class="btn bg-light font-weight-bold">Seguridad informatica</a>
      <a href="index.php?carreraId=3" class="btn bg-light font-weight-bold">Redes</a>
      <a href="index.php?carreraId=4" class="btn bg-light font-weight-bold">Mecatronica</a>
      <a href="index.php?carreraId=6" class="btn bg-light font-weight-bold">Multimedia</a>
      <a href="index.php?carreraId=2" class="btn bg-light font-weight-bold">Software</a>

      <a href="index.php" class="btn bg-light font-weight-bold">Todos</a>

    </div>
  </div>
</div>


<div class="album py-5">
  <div class="container">
    <div class="row">

      <?php if (empty($listadoEstu)) : ?>

        <div class="container">
          <div class="row justify-content-center">
            <h5>No hay estudiantes registrados.</h5>
          </div>
        </div>

      <?php else : ?>

        <?php foreach ($listadoEstu as $estu) : ?>

          <div class="col-md-3">
            <div class="card" style="width: 18rem;">

              <?php if ($estu->profilePhoto == "" || $estu->profilePhoto == null) : ?>

                <img class="card-img-top" src="<?php echo "assets/img/default.png" ?>" width="100%" height="200">


              <?php else : ?>

                <img class="card-img-top" src="<?php echo "assets/img/estudiantes/" . $estu->profilePhoto; ?>" width="100%" height="200">

              <?php endif; ?>

              <div class="card-body">
                <h5 class="card-title"><?php echo $estu->nombre; ?></h5>
                <h5 class="card-subtitle mb-2"><?php echo $estu->apellido; ?></h5>
                <p class="card-text"><?php echo $estu->getCarrera(); ?></p>
                <p class="card-text"><?php echo $estu->check; ?></p>
                <a href="Students/Editar.php?id=<?php echo $estu->id; ?>" class="btn btn-primary">Editar</a>
                <a href="#" onclick="preguntar(<?php echo $estu->id; ?>)" class="btn btn-danger">Eliminar</a>
                <a href="Students/Detalles.php?id=<?php echo $estu->id; ?>" class="btn btn-secondary">Detalle</a>
              </div>
            </div>
          </div>

        <?php endforeach; ?>


      <?php endif; ?>


    </div>
  </div>
</div>



<script class="text/javascript">
  function preguntar(id) {
    if (confirm('Eliminar Estudiante?')) {
      window.location.href = "Students/Eliminar.php?id=" + id;
    }
  }
</script>





<?php echo $layout->printFooter(); ?>
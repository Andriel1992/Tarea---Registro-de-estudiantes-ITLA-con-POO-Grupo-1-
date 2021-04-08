<?php 

require_once '../Helpers/utilities.php';
require_once 'estu.php';
require_once '../service/IServiceBase.php';
require_once 'estuServiceCookies.php';

$service = new estuServiceCookies();
$isContaintId = isset($_GET['id']);


if($isContaintId){

$estuId = $_GET['id'];
$service->Delete($estuId);

}

header("Location: ../index.php");
exit();

?>
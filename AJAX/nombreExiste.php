<?php
if (isset($_REQUEST["nombreUsuario"])) {
  
$nombreUsuario = $_REQUEST["nombreUsuario"];

include("../PHP/conexion.php");
$tabla="usuarios";

$sql1 = "select nombre from $tabla where nombre='$nombreUsuario';";
$repetido = mysqli_query($conexion, $sql1);
$repetido = mysqli_fetch_array($repetido);

if (!$repetido) {
  echo 'exito';
}else {
  echo 'error';
}
}
?>
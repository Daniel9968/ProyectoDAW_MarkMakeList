<?php
session_start();
if (isset($_SESSION['username']) && isset($_REQUEST["nombreLista"])) {

$nombre = $_SESSION['username'];
$nombreLista = $_REQUEST["nombreLista"];

include("../PHP/conexion.php");
$tabla="listas";

$sql1 = "select idUsuario from usuarios where nombre= '$nombre';";
$resultado = mysqli_query($conexion, $sql1);

$resultado = mysqli_fetch_array($resultado);
$idUsuario = $resultado['idUsuario'];

$sql2 = "select * from $tabla where idUsuario='$idUsuario' and nombreLista='$nombreLista';";
$existe = mysqli_query($conexion, $sql2);
$existe = mysqli_fetch_array($existe);

if ($existe) {
  $sql3 = "DELETE FROM $tabla where idUsuario='$idUsuario' and nombreLista='$nombreLista';";
  $resultado = mysqli_query($conexion, $sql3);
  echo 'exito';
}else {
  echo 'error';
}
}
?>
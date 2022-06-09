<?php
session_start();
if (isset($_SESSION['username']) && isset($_REQUEST["nombreAntiguoProducto"]) && isset($_REQUEST["nombreNuevoProducto"])) {

$nombre = $_SESSION['username'];
$nombreAntiguoProducto = $_REQUEST["nombreAntiguoProducto"];
$nombreNuevoProducto = $_REQUEST["nombreNuevoProducto"];

include("../PHP/conexion.php");
$tabla="productos";

$sql1 = "select idUsuario from usuarios where nombre= '$nombre';";
$resultado = mysqli_query($conexion, $sql1);

$resultado = mysqli_fetch_array($resultado);
$idUsuario = $resultado['idUsuario'];

$sql2 = "select * from $tabla where idUsuario='$idUsuario' and nombreProducto='$nombreAntiguoProducto';";
$existe = mysqli_query($conexion, $sql2);
$existe = mysqli_fetch_array($existe);

if ($existe) {
  $sql3 = "UPDATE $tabla SET nombreProducto = '$nombreNuevoProducto' WHERE idUsuario='$idUsuario' and nombreProducto = '$nombreAntiguoProducto';";
  $resultado = mysqli_query($conexion, $sql3);
  echo 'exito';
}else {
  echo 'error';
}
}
?>
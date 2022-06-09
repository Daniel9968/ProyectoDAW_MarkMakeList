<?php
session_start();
if (isset($_SESSION['username']) && isset($_REQUEST["nombreAntiguoCategoria"]) && isset($_REQUEST["nombreNuevoCategoria"])) {

$nombre = $_SESSION['username'];
$nombreAntiguoCategoria = $_REQUEST["nombreAntiguoCategoria"];
$nombreNuevoCategoria = $_REQUEST["nombreNuevoCategoria"];

include("../PHP/conexion.php");
$tabla="categorias";

$sql1 = "select idUsuario from usuarios where nombre= '$nombre';";
$resultado = mysqli_query($conexion, $sql1);

$resultado = mysqli_fetch_array($resultado);
$idUsuario = $resultado['idUsuario'];

$sql2 = "select * from $tabla where idUsuario='$idUsuario' and nombreCategoria='$nombreAntiguoCategoria';";
$existe = mysqli_query($conexion, $sql2);
$existe = mysqli_fetch_array($existe);

if ($existe) {
  $sql3 = "UPDATE $tabla SET nombreCategoria = '$nombreNuevoCategoria' WHERE idUsuario='$idUsuario' and nombreCategoria = '$nombreAntiguoCategoria';";
  $resultado = mysqli_query($conexion, $sql3);
  echo 'exito';
}else {
  echo 'error';
}
}
?>
<?php
session_start();
if (isset($_SESSION['username']) && isset($_REQUEST["nombreCategoria"])) {

$nombre = $_SESSION['username'];
$nombreCategoria = $_REQUEST["nombreCategoria"];

include("../PHP/conexion.php");
$tabla="categorias";

$sql1 = "select idUsuario from usuarios where nombre= '$nombre';";
$resultado = mysqli_query($conexion, $sql1);

$resultado = mysqli_fetch_array($resultado);
$idUsuario = $resultado['idUsuario'];

$sql2 = "select * from $tabla where idUsuario='$idUsuario' and nombreCategoria='$nombreCategoria';";
$duplicado1 = mysqli_query($conexion, $sql2);
$duplicado1 = mysqli_fetch_array($duplicado1);

$sql3 = "select * from $tabla where idUsuario IS NULL and nombreCategoria='$nombreCategoria';";
$duplicado2 = mysqli_query($conexion, $sql3);
$duplicado2 = mysqli_fetch_array($duplicado2);

if (!$duplicado1 && !$duplicado2) {
  $sql4 = "INSERT INTO $tabla VALUES (null,'$nombreCategoria','$idUsuario');";
  $resultado = mysqli_query($conexion, $sql4);
  echo 'exito';
}else {
  echo 'error';
}
}
?>
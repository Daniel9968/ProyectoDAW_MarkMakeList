<?php
session_start();
if (isset($_SESSION['username']) && isset($_REQUEST["nombreCategoria"]) && isset($_REQUEST["nombreProducto"])) {

$nombre = $_SESSION['username'];
$nombreCategoria = $_REQUEST["nombreCategoria"];
$nombreProducto = $_REQUEST["nombreProducto"];

include("../PHP/conexion.php");
$tabla="productos";
$tabla2="categorias";

$sql1 = "select idUsuario from usuarios where nombre= '$nombre';";
$resultado = mysqli_query($conexion, $sql1);

$resultado = mysqli_fetch_array($resultado);
$idUsuario = $resultado['idUsuario'];

$sql2 = "select * from $tabla where idUsuario='$idUsuario' and nombreProducto='$nombreProducto';";
$duplicado1 = mysqli_query($conexion, $sql2);
$duplicado1 = mysqli_fetch_array($duplicado1);

$sql3 = "select * from $tabla where idUsuario IS NULL and nombreProducto='$nombreProducto';";
$duplicado2 = mysqli_query($conexion, $sql3);
$duplicado2 = mysqli_fetch_array($duplicado2);

if (!$duplicado1 && !$duplicado2) {
  $sql4 = "select idCategoria from $tabla2 where (idUsuario='$idUsuario' or idUsuario IS NULL) and nombreCategoria='$nombreCategoria';";
  $idCategoria = mysqli_query($conexion, $sql4);
  $idCategoria = mysqli_fetch_array($idCategoria);

  $idCategoria = $idCategoria['idCategoria'];

  $sql5 = "INSERT INTO $tabla VALUES (null,'$nombreProducto','$idCategoria','$idUsuario');";
  $resultado = mysqli_query($conexion, $sql5);
  echo 'exito';
}else {
  echo 'error';
}
}
?>
<?php
session_start();
if (isset($_SESSION['username'])) {

$nombre = $_SESSION['username'];

include("../PHP/conexion.php");
$tabla="listapedidos";
$tabla2="listas";

$sql1 = "select idUsuario from usuarios where nombre= '$nombre';";
$resultado = mysqli_query($conexion, $sql1);

$resultado = mysqli_fetch_array($resultado);
$idUsuario = $resultado['idUsuario'];

$sql2 = "select idLista from $tabla2 where idUsuario='$idUsuario';";
$idLista = mysqli_query($conexion, $sql2);

if ($idLista) {
  while ($fila = mysqli_fetch_array($idLista)) {
    $idListaPedidos = $fila['idLista'];
    $sql4_x = "DELETE FROM $tabla where idListaPedidos = '$idListaPedidos';";
    $resultado = mysqli_query($conexion, $sql4_x);
  }
  echo 'exito';
}else {
  echo 'error';
}
}
?>
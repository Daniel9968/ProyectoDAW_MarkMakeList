<?php
session_start();
if (isset($_SESSION['username']) && isset($_REQUEST["idListaPedidos"])) {

$nombre = $_SESSION['username'];
$idListaPedidos = $_REQUEST["idListaPedidos"];

include("../PHP/conexion.php");
$tabla="listapedidos";
$tabla2="listas";

$sql1 = "select idUsuario from usuarios where nombre= '$nombre';";
$resultado = mysqli_query($conexion, $sql1);

$resultado = mysqli_fetch_array($resultado);
$idUsuario = $resultado['idUsuario'];

$sql2 = "select idLista from $tabla2 where idUsuario='$idUsuario' and idLista='$idListaPedidos';";
$existe = mysqli_query($conexion, $sql2);
$existe = mysqli_fetch_array($existe);

if ($existe) {
  $sql3 = "DELETE FROM $tabla where idListaPedidos = '$idListaPedidos';";
  $resultado = mysqli_query($conexion, $sql3);
  echo 'exito';
}else {
  echo 'error';
}
}
?>
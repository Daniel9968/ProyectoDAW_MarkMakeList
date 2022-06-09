<?php
session_start();
if (isset($_SESSION['username']) && isset($_REQUEST["idListaPedidos"]) && isset($_REQUEST["nombreProducto"]) && isset($_REQUEST["Cantidad"])) {

$nombre = $_SESSION['username'];
$idListaPedidos = $_REQUEST["idListaPedidos"];
$nombreProducto = $_REQUEST["nombreProducto"];
$Cantidad = $_REQUEST["Cantidad"];


include("../PHP/conexion.php");
$tabla="listapedidos";
$tabla2="productos";
$tabla3="listas";

$sql1 = "select idUsuario from usuarios where nombre= '$nombre';";
$resultado = mysqli_query($conexion, $sql1);

$resultado = mysqli_fetch_array($resultado);
$idUsuario = $resultado['idUsuario'];

$sql2 = "select idLista from $tabla3 where idUsuario='$idUsuario' and idLista='$idListaPedidos';";
$idLista = mysqli_query($conexion, $sql2);
$idLista = mysqli_fetch_array($idLista);

$sql3 = "select idProducto from $tabla2 where idUsuario='$idUsuario' and nombreProducto='$nombreProducto';";
$idProducto = mysqli_query($conexion, $sql3);
$idProducto = mysqli_fetch_array($idProducto);

if(!$idProducto){
  $sql4 = "select idProducto from $tabla2 where idUsuario IS NULL and nombreProducto='$nombreProducto';";
  $idProducto = mysqli_query($conexion, $sql4);
  $idProducto = mysqli_fetch_array($idProducto);
}

$idProducto = $idProducto['idProducto'];
$idListaPedidos = $idLista['idLista'];

if ($idProducto && $idListaPedidos) {

  $sql5 = "UPDATE $tabla SET Cantidad = '$Cantidad' WHERE idListaPedidos = '$idListaPedidos' and idProducto = '$idProducto';";
  $resultado = mysqli_query($conexion, $sql5);
  echo 'exito';
}else {
  echo 'error';
}
}
?>
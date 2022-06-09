<?php
session_start();
if (isset($_SESSION['username']) && isset($_REQUEST["nombreAntiguoLista"]) && isset($_REQUEST["nombreNuevoLista"])) {

$nombre = $_SESSION['username'];
$nombreAntiguoLista = $_REQUEST["nombreAntiguoLista"];
$nombreNuevoLista = $_REQUEST["nombreNuevoLista"];

include("../PHP/conexion.php");
$tabla="listas";

$sql1 = "select idUsuario from usuarios where nombre= '$nombre';";
$resultado = mysqli_query($conexion, $sql1);

$resultado = mysqli_fetch_array($resultado);
$idUsuario = $resultado['idUsuario'];

$sql2 = "select * from $tabla where idUsuario='$idUsuario' and nombreLista='$nombreAntiguoLista';";
$existe = mysqli_query($conexion, $sql2);
$existe = mysqli_fetch_array($existe);

if ($existe) {
  $sql3 = "UPDATE $tabla SET nombreLista = '$nombreNuevoLista' WHERE idUsuario='$idUsuario' and nombreLista = '$nombreAntiguoLista';";
  $resultado = mysqli_query($conexion, $sql3);
  echo 'exito';
}else {
  echo 'error';
}
}
?>
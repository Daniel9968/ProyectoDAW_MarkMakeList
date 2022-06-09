<?php
if (isset($_POST['nombre']) && isset($_POST['contrasenya'])) {

$nombre = $_POST['nombre'];
$contrasenya = md5($_POST['contrasenya']);

include("../PHP/conexion.php");
$tabla = "usuarios";
$tabla2 = "listas";

$sql1 = "SELECT idUsuario from $tabla where nombre = '$nombre';";
$resultado = mysqli_query($conexion, $sql1);
$idUsuario = mysqli_fetch_array($resultado);
if (!$idUsuario) {
	$sql2 = "INSERT INTO $tabla VALUES (null,'$nombre','$contrasenya');";
	$resultado = mysqli_query($conexion, $sql2);

	$sql3 = "SELECT idUsuario from $tabla where nombre = '$nombre';";
	$resultado = mysqli_query($conexion, $sql3);
	$idUsuario = mysqli_fetch_array($resultado);

	if ($idUsuario) {
		$sql4 = "INSERT INTO $tabla2 VALUES (null,$idUsuario[idUsuario],'Lista de la compra');";
		$resultado = mysqli_query($conexion, $sql4);

		mysqli_close($conexion);
		session_start();
        $_SESSION['username'] = $nombre;
		header("location: /sites/verLista.php");
	} else {
		mysqli_close($conexion);
		header("location: /sites/crearCuenta.php?YaExiste=".$nombre);
	}
} else {
	mysqli_close($conexion);
	header("location: /sites/crearCuenta.php");
}
}
?>
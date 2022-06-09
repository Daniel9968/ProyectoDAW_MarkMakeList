<?php
if (isset($_REQUEST['nombre']) && isset($_REQUEST['contrasenya'])) {

$nombre = $_REQUEST['nombre'];
$contrasenya = md5($_REQUEST['contrasenya']);

include("../PHP/conexion.php");
$tabla = "usuarios";

$sql1 = "SELECT COUNT(*) as contar from $tabla where nombre = '$nombre'";
$resultado = mysqli_query($conexion, $sql1);
$resultado = mysqli_fetch_array($resultado);

if ($resultado['contar'] == 1) {
    $sql2 = "SELECT COUNT(*) as contar from $tabla where nombre = '$nombre' and contrasenya = '$contrasenya'";
    $resultado = mysqli_query($conexion, $sql2);
    $resultado = mysqli_fetch_array($resultado);
    if ($resultado['contar'] == 1) {
        session_start();
        $_SESSION['username'] = $nombre;
        mysqli_close($conexion);
        header("location: /sites/verLista.php");
    } else {
        mysqli_close($conexion);
        header("location: /sites/iniciarSesion.php?contrasenyaIncorrecta");
    }
} else {
    mysqli_close($conexion);
    header("location: /sites/iniciarSesion.php?usuarioIncorrecto=" . $nombre);
}
}
?>
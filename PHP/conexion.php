<?php
$servidor = "127.0.0.1";
$usuario_bd = "root";
$clave_bd = "";
$basedatos = "proyectodaw";

$conexion = mysqli_connect($servidor, $usuario_bd, $clave_bd);
$resultado = mysqli_select_db($conexion, $basedatos);
?>
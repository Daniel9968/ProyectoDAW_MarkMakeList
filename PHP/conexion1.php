<?php
$servidor = "sql211.epizy.com";
$usuario_bd = "epiz_31611773";
$clave_bd = "jXyX5WX9d2UE0";
$basedatos = "epiz_31611773_proyectodaw";

$conexion = mysqli_connect($servidor, $usuario_bd, $clave_bd);
$resultado = mysqli_select_db($conexion, $basedatos);
?>
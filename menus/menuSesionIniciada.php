<?php
$nombre = $_SESSION['username'];

echo "<nav class='menu'>
<ul>
    <li><a href='../PHP/salir.php'>Cerrar sesión</a></li>
    <li class=barraMenu>|</li>
    <li><a href='../index.php'>Inicio</a></li>
    <li class=barraMenu>|</li>
    <li><a href='../sites/administrar.php'>Administrar</a></li>
    <li class=barraMenu>|</li>
    <li><a href='../sites/verLista.php'>Ver</a></li>
    <img src='../images/bxs-user.svg' alt='Imagen no disponible'>
    <p class=holaNombre><i>Hola,&nbsp;$nombre</i></p>
</ul>
</nav>";
?>
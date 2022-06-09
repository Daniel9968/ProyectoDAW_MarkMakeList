<?php
session_start();
if (isset($_SESSION['username'])) {
    $nombre = $_SESSION['username'];
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="initial-scale=1">
    <title>MarkMakeList - Inicio</title>
    <link rel="shortcut icon" href="../images/logo16.png">
    <link rel="stylesheet" type="text/css" href="./css/comun.css" />
    <link rel="stylesheet" type="text/css" href="./css/index.css" />
</head>

<body>
    <header class="header">
        <h1>Mark Make List</h1>
        <p>La memoria no está para cosas triviales</p>
    </header>
    <?php
    if (isset($nombre)) {
        include("./menus/menuSesionIniciada.php");
    } else {
        include("./menus/menuSesionCerrada.php");
    }
    ?>
    <section class="content">
        <figure class="imageLeft">
            <img src="./images/latrach-med-jamil-Eb6hMEhGlKY-unsplash.jpg" alt="Imagen no disponible" />
        </figure>
        <h2>¿No sabes cómo empezar?</h2>

        <P>Comienza registrándote en nuestro sitio web. Una vez registrado ya habrás iniciado sesión
            automáticamente y tendrás tu primera lista de la compra, pero como verás está vacía. Todas las
            listas están en blanco al principio, así que comienza agregando productos a tu lista. Si quieres aumentar o disminuir la
            cantidad a comprar de un producto, pulsa el botón “<b>+</b>” o ”<b>-</b>” cerca del número de unidades, si quieres borrarlo, pulsa en
            el botón de la papelera, para tacharlo pulsa sobre el texto, si quieres borrar la lista actual o todas,
            en la parte inferior encontrarás esos botones y por último, verás encima de estos, los botones “<b><<</b>” y ”<b>>></b>” para
            cambiar de una lista a otra.</P>

        <h2>¿No tienes suficiente con una lista, las categorías y los productos normales?</h2>

        <p>Pues corre a la opción de <b>Administrar</b> y crea tantas listas, categorías y productos como tú quieras. De esta
            manera podrás controlar mejor todo acerca de tus listas de la compra. No te preocupes por que el día de mañana le
            cambien el nombre a un producto o lo eliminen, aquí también podrás eliminar y renombrar todo lo que tú quieras. Como
            puedes apreciar podrás modificar todo lo relacionado a tus listas de la compra en un periquete.</p>

        <h2>¿Estás harto de olvidar comprar cosas en el super?</h2>

        <p>Gracias a este sitio web <b>podrás crear fácilmente listas de la compra</b> para que no pierdas ni un segundo a
            donde vayas. Piensa en no tener que buscar bolígrafo cada vez que quieras añadir un nuevo producto a tu
            lista de la compra. Olvídate de tener que llevar contigo un trozo de papel y un bolígrafo. Tan sencillo
            como encender tu ordenador o móvil y apuntar o consultar qué tienes que comprar.</p>

        <p>Descubre una manera fácil y cómoda de organizar tus compras y mucho más usando nuestra web <b>Mark Make List</b>.
            Tan fácil como registrarse y empezar a crear tu lista de la compra.</p>

        <h2>¿Aun quieres más ventajas?</h2>

        <p>Piensa en que también usando este sitio web ayudas al planeta. Piensa en todos los árboles que se talan por papel,
            en cuánto plástico y tinta para hacer bolígrafos. Sólo piensa en que si todo el planeta empezara a usar este sitio
            web como <b>mejoraría el calentamiento global</b>.</p>

        <p>No lo dudes más, empieza a usar <b>Mark Make List</b>.</p>

    </section>
    <footer class="footer">
        <p>© Daniel González Lloret 2022</p>
    </footer>
</body>
</html>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="wclassth=device-wclassth, initial-scale=1">
    <title>MarkMakeList - Iniciar sesión</title>
    <link rel="shortcut icon" href="../images/logo16.png">
    <link rel="stylesheet" type="text/css" href="../css/comun.css" />
    <link rel="stylesheet" type="text/css" href="../css/crearCuenta_inicarSesion.css" />
</head>

<body>
    <header class="header">
        <h1>Mark Make List</h1>
        <p>La memoria no está para cosas triviales</p>
    </header>

    <?php
    include("../menus/menuSesionCerrada.php");
    ?>

    <section class="content">
        <form method="POST" action="../PHP/comprobarSesion.php">
            <legend>Iniciar sesión</legend>
            <ul>
                <li>
                    <label for="nombre">Nombre:<br>
                        <input type="text" name="nombre" onkeyup="nombreUsuarioMSG()" required>
                        <?php
                        if (isset($_REQUEST['usuarioIncorrecto'])) {
                            $nombreUsuario = $_REQUEST['usuarioIncorrecto'];
                            echo "<p class='error' id='nombreUsuarioMSG'>El usuario $nombreUsuario no existe.</p>";
                        }
                        ?>
                    </label>
                </li>
                <li>
                    <label for="contrasenya">Contraseña:<br>
                        <input type="password" name="contrasenya" onkeyup="contrsenyaMSG()" required>
                        <?php
                        if (isset($_REQUEST['contrasenyaIncorrecta'])) {
                            echo "<p class='error' id='contrasenyaMSG'>La contraseña no es válida. Vuelva a intentarlo</p>";
                        }
                        ?>
                    </label>
                </li>
                <li>
                    <input type="submit" value="Iniciar sesión">
                </li>
                <li>
                    Sí aun no tiene cuenta puede <a href="crearCuenta.php">crear una cuenta nueva</a>
                </li>
            </ul>
        </form>
    </section>
    <footer class="footer">
        <p>© Daniel González Lloret 2022</p>
    </footer>
</body>
<script src="../JS/iniciarSesion.js"></script>

</html>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="wclassth=device-wclassth, initial-scale=1">
    <title>MarkMakeList - Crear cuenta</title>
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
        <form method="POST" action="../PHP/insertarUsuario.php" onsubmit="return validarFormulario()">
            <legend>Crear cuenta</legend>
            <ul>
                <li>
                    <label for="nombre">Nombre de usuario:<br>
                        <input type="text" name="nombre"  maxlength=20 onkeyup="nombreUsuarioMSG()" autocomplete="off" required>
                        <span><abbr title="Obligatorio"></abbr></span>
                        <?php
                        if (isset($_REQUEST['YaExiste'])) {
                            $nombreUsuario = $_REQUEST['YaExiste'];
                            echo "<p class='error' id='nombreUsuarioMSG'>El nombre de usuario $nombreUsuario ya está en uso. Prueba con otro.</p>";
                        } else {
                            echo "<p class='error displayNone' id='nombreUsuarioMSG'>Este nombre de usuario ya está en uso. Prueba con otro.</p>";
                        }
                        ?>
                    </label>
                </li>
                <li>
                    <label for="contrasenya">Contraseña:<br>
                        <input type="password" name="contrasenya" onkeyup="contrsenyaDebilMSG()" required>
                        <span><abbr title="Obligatorio"></abbr></span>
                        <p class="error displayNone" id="contrasenyaDebilMSG">Advertencia: La contraseña debería ser más segura. Prueba con una combinación de letras mayúsculas y minúsculas, números y símbolos con al menos 8 caracteres.</p>
                    </label>
                </li>
                <li>
                    <label for="contrasenyaComprovacion">Repite contraseña:<br>
                        <input type="password" name="contrasenyaComprovacion" onkeyup="contrsenyaNoCoincideMSG()" required>
                        <span><abbr title="Obligatorio"></abbr></span>
                        <p class="error displayNone" id="contrasenyaNoCoincideMSG">Las contraseñas no coinciden. Inténtalo de nuevo.</p>
                    </label>
                </li>
                <li>
                    <input type="submit" value="Crear cuenta">
                </li>
                <li>
                    Sí ya tiene una cuenta puede <a href="iniciarSesion.php">iniciar sesión</a>
                </li>
            </ul>
        </form>
    </section>
    <footer class="footer">
        <p>© Daniel González Lloret 2022</p>
    </footer>
</body>
<script src="../JS/crearCuenta.js"></script>

</html>
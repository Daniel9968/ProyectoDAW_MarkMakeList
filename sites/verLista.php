<?php
session_start();
if (isset($_SESSION['username'])) {
    $nombre = $_SESSION['username'];
} else {
    header("location: ../sites/index.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MarkMakeList - Inicio</title>
    <link rel="shortcut icon" href="../images/logo16.png">
    <link rel="stylesheet" type="text/css" href="../css/comun.css" />
    <link rel="stylesheet" type="text/css" href="../css/verLista.css" />
</head>

<body>
    <?php
       if (isset($nombre)) {
        include("../menus/menuSesionIniciada.php");
    } else {
        header("location: /index.php");
    }

    include("../PHP/conexion.php");
    if (!$resultado) {
        echo "ERROR: Imposible seleccionar la base de datos $basedatos.<br>\n";
    } else {
        /* ---------------------------------------------------- */
        $sql1 = "select idUsuario from usuarios where nombre= '$nombre';";
        $resultado = mysqli_query($conexion, $sql1);
        if (!$resultado) {
            echo "ERROR: Imposible idUsuario<br>\n";
        } else {
            $resultado = mysqli_fetch_array($resultado);
            $idUsuario = $resultado['idUsuario'];
        }
        /* ---------------------------------------------------- */
        $sql2 = "select idLista, nombreLista from listas where idUsuario=$idUsuario;";
        $resultado = mysqli_query($conexion, $sql2);
        if (!$resultado) {
            echo "ERROR: Imposible idLista (s) de listas<br>\n";
        } else {
            $idLista = [];
            $nombreLista = [];
            while ($fila = mysqli_fetch_array($resultado)) {
                array_push($idLista, $fila['idLista']);
                array_push($nombreLista, $fila['nombreLista']);
            }
        }
        /* ---------------------------------------------------- */
        $numeroLista = 0; //
        $contadorElementos = 1;
        while ($numeroLista <= count($idLista) - 1) {
            $sql3 = "select categorias.nombreCategoria, productos.idProducto, productos.nombreProducto, listapedidos.Cantidad
                from categorias, productos, listapedidos
                where categorias.idCategoria=productos.idCategoria and productos.idProducto=listapedidos.idProducto and listapedidos.idListaPedidos=$idLista[$numeroLista]
                order by categorias.nombreCategoria, productos.nombreProducto;";
            $resultado = mysqli_query($conexion, $sql3);
            if (!$resultado) {
                echo "ERROR: Imposible Dibujar " . ($numeroLista + 1) . "<br>\n";
            } else {
                $categoria = "";
                echo "<section class='lists' id='L" . $idLista[$numeroLista] . "'>";
                echo "<h1>" . $nombreLista[$numeroLista] . "</h1>";
                while ($fila = mysqli_fetch_array($resultado)) {
                    $nuevaCategoria = $fila['nombreCategoria'];
                    if ($categoria !== $nuevaCategoria) {
                        $categoria = $fila['nombreCategoria'];
                        echo "<h2>" . $fila['nombreCategoria'] . "</h2>";
                    }
                    $contadorElementosString = "elemento" . $contadorElementos;
                    echo "<div id=" . $contadorElementosString . ">";
                    echo "<button type='button' class='pIcon mas' onclick='aumentarProducto(\"" . $contadorElementosString . "\")'></button>";
                    echo "<p class='num'>" . $fila['Cantidad'] . "</p>";
                    echo "<span> Uds.</span>";
                    echo "<button type='button' class='pIcon menos' onclick='disminuirProducto(\"" . $contadorElementosString . "\")'></button>";
                    echo "<p class='nombreProducto normal' onclick='tachar(\"" . $contadorElementosString . "\")'>" . $fila['nombreProducto'] . "</p>";
                    echo "<button type='button' class='pIcon basura' onclick='borrarProducto(\"" . $contadorElementosString . "\")'></button><br>";
                    echo "</div>";
                    $contadorElementos++;
                }
                echo "<h2>Productos recién añadidos</h2>";
                echo "</section>";
            }
            $numeroLista++;
        }
    }

    ?>

    <section class="mensaje" id="productoRepetidoMSG">
        <h2>PRODUCTO REPETIDO</h2>
        <p>El producto ya está en esta la lista de la compra.</p>
        <button type="button" class="buttonMensaje" onclick="esconder('productoRepetidoMSG')">Cerrar</a>
    </section>
    <section class="mensaje" id="borrarListaMSG">
        <h2>¿Está seguro?</h2>
        <p>Se vaciará la lista actual.</p>
        <button type="button" class="buttonMensajeSi" onclick="borrarLista()">Deseo borrarla</a>
        <button type="button" class="buttonMensajeNo" onclick="esconder('borrarListaMSG')">Quiero mantenerla</a>

    </section>
    <section class="mensaje" id="borrarTodasListasMSG">
        <h2>¿Está seguro?</h2>
        <p>Se vaciarán todas las listas.</p>
        <button type="button" class="buttonMensajeSi" onclick="borrarTodasListas()">Deseo borrarlas</a>
        <button type="button" class="buttonMensajeNo" onclick="esconder('borrarTodasListasMSG')">Quiero mantenerlas</a>

    </section>

    <footer class="footer">
        <select id="producto">

            <?php
            /* ---------------------------------------------------- */
            $sql4 = "select categorias.nombreCategoria, productos.idProducto, productos.nombreProducto
            from categorias, productos
            where categorias.idCategoria=productos.idCategoria and (categorias.idUsuario=$idUsuario or categorias.idUsuario IS NULL) and (productos.idUsuario=$idUsuario or productos.idUsuario IS NULL)
            order by categorias.nombreCategoria, productos.nombreProducto;";
            $resultado = mysqli_query($conexion, $sql4);
            if (!$resultado) {
                echo "ERROR: No hay productos en tabla productos o no se conectó a la base de datos\n";
            } else {
                $cerrojo = true;
                while ($fila = mysqli_fetch_array($resultado)) {
                    $nuevaCategoria = $fila['nombreCategoria'];
                    if ($categoria !== $nuevaCategoria) {
                        $categoria = $fila['nombreCategoria'];
                        if ($cerrojo) {
                            $cerrojo = false;
                        } else {
                            echo "</optgroup>";
                        }
                        echo " <optgroup label='" . $fila['nombreCategoria'] . "'>";
                    }
                    echo "<option value=" . $fila['idProducto'] . ">" . $fila['nombreProducto'] . "</option>";
                }
                if (!$cerrojo) {
                    echo "</optgroup>";
                }
            }

            ?>
        </select><br>
        <div>
            <button type="button" id="left" onclick="listsIndexDisminuye()"></button>
            <button type="button" id="introducir" onclick="introducirProducto()">Introducir</button>
            <button type="button" id="right" onclick="listsIndexAumenta()"></button>
        </div>
        <div>
            <button type="button" id="borrarLista" onclick="mostrar('borrarListaMSG')">Borrar&nbsp;lista</button>
            <?php
            $numeroDeListas = (int) count($idLista);
            echo "<h3>1/" . $numeroDeListas . "</h3>";
            ?>
            <button type="button" id="borarTodasLasListas" onclick="mostrar('borrarTodasListasMSG')">Borrar&nbsp;las&nbsp;listas</button>
            <div>
                </table>
    </footer>
</body>
<script src="../JS/verLista.js"></script>

</html>
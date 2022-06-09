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
    <meta name="viewport" content="initial-scale=1">
    <title>MarkMakeList - Inicio</title>
    <link rel="shortcut icon" href="../images/logo16.png">
    <link rel="stylesheet" type="text/css" href="../css/comun.css" />
    <link rel="stylesheet" type="text/css" href="../css/administrar.css" />
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
            /*echo "<br><br><br>";
                    echo "$idUsuario";*/
        }
        /* ---------------------------------------------------- */
        /* ---------------------------------------------------- */
        echo "<section class='center'>";
        echo "<h1>Crear Listas, Categorias y Productos</h1>";
        echo "<section class='grid'>";
        /* ---------------------------------------------------- */
        echo "<article class='card'>";
        echo "<div>";
        echo "<h2><span>Crear</span> Listas</h2>";
        echo "<p>Nombre de la nueva lista:</p>";
        echo "<input type='text' id='crearLista'  maxlength=20>";
        echo "<p id='comprobacionCrearLista'></p>";
        echo "<button type='button' onclick='crearLista()'>Crear Lista</button>";
        echo "</div>";
        /* ---------------------------------------------------- */
        $sql2_1 = "select idLista, nombreLista from listas where idUsuario=$idUsuario;";
        $resultado = mysqli_query($conexion, $sql2_1);
        if (!$resultado) {
            echo "ERROR: listas<br>\n";
        } else {
            echo "<div>";
            echo "<h2><span>Borrar</span> Listas</h2>";
            echo "<p>Selecione la lista:</p>";
            echo "<select class='lista'>";
            while ($fila = mysqli_fetch_array($resultado)) {
                echo "<option value=" . $fila['idLista'] . ">" . $fila['nombreLista'] . "</option>";
            }
            echo "</select>";
            echo "<p id='comprobacionBorrarLista'></p>";
            echo "<button type='button' onclick='borrarLista()'>Borrar Lista</button>";
            echo "</div>";
        }
        /* ---------------------------------------------------- */
        $sql2_2 = "select idLista, nombreLista from listas where idUsuario=$idUsuario;";
        $resultado = mysqli_query($conexion, $sql2_2);
        if (!$resultado) {
            echo "ERROR: listas<br>\n";
        } else {
            echo "<div>";
            echo "<h2><span>Renombrar</span> Listas</h2>";
            echo "<p>Selecione la lista:</p>";
            echo "<select class='lista'>";
            while ($fila = mysqli_fetch_array($resultado)) {
                echo "<option value=" . $fila['idLista'] . ">" . $fila['nombreLista'] . "</option>";
            }
            echo "</select>";
            echo "<p>Escriba su nuevo nombre:</p>";
            echo "<input type='text'  id='nuevoNombreLista'  maxlength=20>";
            echo "<p id='comprobacionRenombrarLista'></p>";
            echo "<button type='button' onclick='renombrarLista()'>Renombrar Lista</button>";
            echo "</div>";
            echo "</article>";
        }
        /* ---------------------------------------------------- */
        /* ---------------------------------------------------- */
        echo "<article class='card'>";
        echo "<div>";
        echo "<h2><span>Crear</span> Categorias</h2>";
        echo "<p>Nombre de la nueva categoria:</p>";
        echo "<input type='text' id='crearCategoria'  maxlength=35>";
        echo "<p id='comprobacionCrearCategoria'></p>";
        echo "<button type='button' onclick='crearCategoria()'>Crear Categoria</button>";
        echo "</div>";
        /* ---------------------------------------------------- */
        $sql3_1 = "select categorias.idCategoria, categorias.nombreCategoria
            from categorias
            where categorias.idUsuario=$idUsuario
            order by categorias.nombreCategoria;";
        $resultado = mysqli_query($conexion, $sql3_1);
        if (!$resultado) {
            echo "ERROR: categorias<br>\n";
        } else {
            echo "<div>";
            echo "<h2><span>Borrar</span> Categorias</h2>";
            echo "<p>Selecione la categoria:</p>";
            echo "<select class='categoria'>";
            while ($fila = mysqli_fetch_array($resultado)) {
                echo "<option value=" . $fila['idCategoria'] . ">" . $fila['nombreCategoria'] . "</option>";
            }
            echo "</select>";
            echo "<p id='comprobacionBorrarCategoria'></p>";
            echo "<button type='button' onclick='borrarCategoria()'>Borrar Categoria</button>";
            echo "</div>";
        }
        /* ---------------------------------------------------- */
        $sql3_2 = "select categorias.idCategoria, categorias.nombreCategoria
            from categorias
            where categorias.idUsuario=$idUsuario
            order by categorias.nombreCategoria;";
        $resultado = mysqli_query($conexion, $sql3_2);
        if (!$resultado) {
            echo "ERROR: categorias<br>\n";
        } else {
            echo "<div>";
            echo "<h2><span>Renombrar</span> Categorias</h2>";
            echo "<p>Selecione la categoria:</p>";
            echo "<select class='categoria'>";
            while ($fila = mysqli_fetch_array($resultado)) {
                echo "<option value=" . $fila['idCategoria'] . ">" . $fila['nombreCategoria'] . "</option>";
            }
            echo "</select>";
            echo "<p>Escriba su nuevo nombre:</p>";
            echo "<input type='text' id='nuevoNombreCategoria' maxlength=35>";
            echo "<p id='comprobacionRenombrarCategoria'></p>";
            echo "<button type='button' onclick='renombrarCategoria()'>Renombrar Categoria</button>";
            echo "</div>";
            echo "</article>";
        }
        /* ---------------------------------------------------- */
        /* ---------------------------------------------------- */
        echo "<article class='card'>";
        echo "<div>";
        echo "<h2><span>Crear</span> Productos</h2>";
        $sql4_0 = "select categorias.idCategoria, categorias.nombreCategoria
            from categorias
            where categorias.idUsuario=$idUsuario or categorias.idUsuario IS NULL 
            order by categorias.nombreCategoria;";
        $resultado = mysqli_query($conexion, $sql4_0);
        if (!$resultado) {
            echo "ERROR: categorias<br>\n";
        } else {
            echo "<p>Selecione la categoria:</p>";
            echo "<select class='categoria' id='nombreCategoriaDelProducto'>";
            while ($fila = mysqli_fetch_array($resultado)) {
                echo "<option value=" . $fila['idCategoria'] . ">" . $fila['nombreCategoria'] . "</option>";
            }
            echo "</select>";
        }
        echo "<p>Nombre del nuevo producto:</p>";
        echo "<input type='text' id='crearProducto' maxlength=35>";
        echo "<p id='comprobacionCrearProducto'></p>";
        echo "<button type='button' onclick='crearProducto()'>Crear Producto</button>";
        echo "</div>";
        /* ---------------------------------------------------- */
        $sql4_1 = "select categorias.idCategoria, categorias.nombreCategoria 
            from categorias, productos
            where categorias.idUsuario=$idUsuario or categorias.idUsuario IS NULL 
            group by categorias.nombreCategoria 
            order by categorias.nombreCategoria;";
        $resultado = mysqli_query($conexion, $sql4_1);
        if (!$resultado) {
            echo "ERROR: productos<br>\n";
        } else {
            echo "<div>";
            echo "<h2><span>Borrar</span> Productos</h2>";
            echo "<p>Selecione el producto:</p>";
            echo "<select class='producto'>";


            while ($fila = mysqli_fetch_array($resultado)) {
                $idCategoria = $fila['idCategoria'];
                echo "<optgroup class='optgroup" . $fila['idCategoria'] . "' label='" . $fila['nombreCategoria'] . "'>";
                $sql4_x = "select productos.idProducto, productos.nombreProducto
                    from categorias, productos
                    where categorias.idCategoria=productos.idCategoria and (categorias.idUsuario=$idUsuario or categorias.idUsuario IS NULL) and productos.idUsuario=$idUsuario and productos.idCategoria=$idCategoria
                    order by productos.nombreProducto;";
                $resultado_x = mysqli_query($conexion, $sql4_x);
                while ($fila_x = mysqli_fetch_array($resultado_x)) {
                    echo "<option value=" . $fila_x['idProducto'] . ">" . $fila_x['nombreProducto'] . "</option>";
                }
                echo "</optgroup>";
            }


            echo "</select>";
            echo "<p  id='comprobacionBorrarProducto'></p>";
            echo "<button type='button'  onclick='borrarProducto()'>Borrar Producto</button>";
            echo "</div>";
        }
        /* ---------------------------------------------------- */
        $sql4_2 = "select categorias.idCategoria, categorias.nombreCategoria 
            from categorias, productos
            where categorias.idUsuario=$idUsuario or categorias.idUsuario IS NULL 
            group by categorias.nombreCategoria 
            order by categorias.nombreCategoria;";
        $resultado = mysqli_query($conexion, $sql4_2);
        if (!$resultado) {
            echo "ERROR: productos<br>\n";
        } else {
            echo "<div>";
            echo "<h2><span>Renombrar</span> Productos</h2>";
            echo "<p>Selecione el producto:</p>";
            echo "<select class='producto'>";


            while ($fila = mysqli_fetch_array($resultado)) {
                $idCategoria = $fila['idCategoria'];
                echo " <optgroup class='optgroup" . $fila['idCategoria'] . "' label='" . $fila['nombreCategoria'] . "'>";
                $sql4_x = "select productos.idProducto, productos.nombreProducto
                    from categorias, productos
                    where categorias.idCategoria=productos.idCategoria and (categorias.idUsuario=$idUsuario or categorias.idUsuario IS NULL) and productos.idUsuario=$idUsuario and productos.idCategoria=$idCategoria
                    order by productos.nombreProducto;";
                $resultado_x = mysqli_query($conexion, $sql4_x);
                while ($fila_x = mysqli_fetch_array($resultado_x)) {
                    echo "<option value=" . $fila_x['idProducto'] . ">" . $fila_x['nombreProducto'] . "</option>";
                }
                echo "</optgroup>";
            }


            echo "</select>";
            echo "<p>Escriba su nuevo nombre:</p>";
            echo "<input type='text' id='nuevoNombreProducto' maxlength=35>";
            echo "<p id='comprobacionRenombrarProducto'></p>";
            echo "<button type='button' onclick='renombrarProducto()'>Renombrar Producto</button>";
            echo "</div>";
            echo "</article>";
        }
    }
    ?>
    </section>
    </section>
    <footer class="footer">
        <p>© Daniel González Lloret 2022</p>
    </footer>
</body>
<script src="../JS/administrar.js"></script>

</html>
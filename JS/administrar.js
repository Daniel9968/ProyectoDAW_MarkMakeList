let selectListas = [];
let selectCategorias = [];
let selectProductos = [];
let optgroupFiltrado = [];
let optgroupProductos = [];

let valor = -1;

function cogerListaDeListas() {
    selectListas = document.getElementsByClassName("lista");
}

function cogerListaDeCategorias() {
    selectCategorias = document.getElementsByClassName("categoria");
}

function cogerListaDeProductos() {
    selectProductos = document.getElementsByClassName("producto");
}

function cogerListaDeOptgroupFiltrado(valueCategoria) {
    optgroupFiltrado = [];
    cogerListaDeOptgroup()
    valueCategoria = "optgroup" + valueCategoria;
    for (let index = 0; index < optgroupProductos.length; index++) {
        if (optgroupProductos[index].className === valueCategoria) {
            optgroupFiltrado.push(optgroupProductos[index]);
        }
    }
}

function cogerListaDeOptgroup() {
    optgroupProductos = document.querySelectorAll("optgroup");
}

function hayContenido(str) {
    if (str === null || str.match(/^ *$/) !== null || str === '') {
        return false;
    } else {
        return true;
    }
}

/*Optgroups -------------------*/

function mostrar_ocultarOPTS() {
    opts = document.querySelectorAll('optgroup');
    for (let index = 0; index < opts.length; index++) {
        if (opts[index].childElementCount==0) {
            opts[index].style.display = "none";
        }
    }
}
mostrar_ocultarOPTS();

/*Crear------------------------ */
function crearLista() {
    let nombreLista = document.getElementById("crearLista").value;
    if (hayContenido(nombreLista)) {
        /*AJAX*/
        const data = new URLSearchParams('nombreLista=' + nombreLista);
        fetch('../AJAX/crearLista.php', { method: 'POST', body: data })
            .then(response => response.text())
            .then(text => {
                let respuesta = text
                if (respuesta == "exito") {
                    //Añade la lista a las select
                    cogerListaDeListas()
                    for (let index = 0; index < selectListas.length; index++) {
                        let optionLista = document.createElement('option');
                        optionLista.value = 000;
                        optionLista.textContent = nombreLista;
                        selectListas[index].insertBefore(optionLista, selectListas[index].firstChild);
                        //cambia el elemento selecciondo
                        selectListas[index].value=optionLista.value;
                    }
                    //Muestra mensaje de exito
                    let p = document.getElementById("comprobacionCrearLista");
                    p.textContent = "Exito al crear la lista " + nombreLista;
                    p.className = "exito";
                    //Vacia el campo
                    nombreLista = document.getElementById("crearLista").value = '';
                }
                else {
                    //Muestra mensaje de error
                    let p = document.getElementById("comprobacionCrearLista");
                    p.textContent = "Error al crear la lista " + nombreLista;
                    p.className = "error";
                }
            });
    }
}

function crearCategoria() {
    let nombreCategoria = document.getElementById("crearCategoria").value;
    if (hayContenido(nombreCategoria)) {
        /*AJAX*/
        const data = new URLSearchParams('nombreCategoria=' + nombreCategoria);
        fetch('../AJAX/crearCategoria.php', { method: 'POST', body: data })
            .then(response => response.text())
            .then(text => {
                let respuesta = text
                if (respuesta == "exito") {
                    //Añade la Categoria a las select
                    cogerListaDeCategorias();
                    for (let index = 0; index < selectCategorias.length; index++) {
                        let optionCategoria = document.createElement('option');
                        let idCategoria = valor;
                        optionCategoria.className = 'optionCategoria' + idCategoria;
                        optionCategoria.value = idCategoria;
                        optionCategoria.textContent = nombreCategoria;
                        selectCategorias[index].insertBefore(optionCategoria, selectCategorias[index].firstChild);
                        //cambia el elemento selecciondo
                        selectCategorias[index].value=optionCategoria.value;
                    }
                    //Añade la Categoria como optgroup a las select de Productos
                    cogerListaDeProductos();
                    for (let index = 0; index < selectProductos.length; index++) {
                        let optgroupCategoria = document.createElement('optgroup');
                        optgroupCategoria.className = 'optgroup' + valor;
                        optgroupCategoria.label = nombreCategoria;
                        //Lo oculta ya que esta vacio
                        optgroupCategoria.style.display = "none";
                        //Lo añade
                        selectProductos[index].insertBefore(optgroupCategoria, selectProductos[index].firstChild);
                        //cambia el elemento selecciondo
                        selectProductos[index].value=optgroupCategoria.value;

                    }
                    valor--;

                    //Muestra mensaje de exito
                    let p = document.getElementById("comprobacionCrearCategoria");
                    p.textContent = "Exito al crear la categoria " + nombreCategoria;
                    p.className = "exito";
                    //Vacia el campo
                    nombreCategoria = document.getElementById("crearCategoria").value = '';
                } else {
                    //Muestra mensaje de error
                    let p = document.getElementById("comprobacionCrearCategoria");
                    p.textContent = "Error al crear la categoria " + nombreCategoria;
                    p.className = "error";
                }
            });
    }
}

function crearProducto() {
    let nombreProducto = document.getElementById("crearProducto").value;
    let categoriaDelProducto = document.getElementById("nombreCategoriaDelProducto");
    let nombreCategoria = categoriaDelProducto.options[categoriaDelProducto.selectedIndex].textContent;
    let valueCategoria = categoriaDelProducto.options[categoriaDelProducto.selectedIndex].value;
    if (hayContenido(nombreProducto)) {
        /*AJAX*/
        const data = new URLSearchParams('nombreProducto=' + nombreProducto + '&nombreCategoria=' + nombreCategoria);
        fetch('../AJAX/crearProducto.php', { method: 'POST', body: data })
            .then(response => response.text())
            .then(text => {
                let respuesta = text
                if (respuesta == "exito") {
                    //Añade el Producto a las select
                    cogerListaDeOptgroupFiltrado(valueCategoria);
                    for (let index = 0; index < optgroupFiltrado.length; index++) {
                        let optionProducto = document.createElement('option');
                        optionProducto.value = 000;
                        optionProducto.textContent = nombreProducto;
                        optgroupFiltrado[index].style.display = "block";
                        optgroupFiltrado[index].insertBefore(optionProducto, optgroupFiltrado[index].firstChild);
                        //cambia el elemento selecciondo
                        optgroupFiltrado[index].value=optionProducto.value;
                    }
                    //Muestra mensaje de exito
                    let p = document.getElementById("comprobacionCrearProducto");
                    p.textContent = "Exito al crear el producto " + nombreProducto;
                    p.className = "exito";
                    //Vacia el campo
                    nombreProducto = document.getElementById("crearProducto").value = '';
                } else {
                    //Muestra mensaje de error
                    let p = document.getElementById("comprobacionCrearProducto");
                    p.textContent = "Error al crear el producto " + nombreProducto;
                    p.className = "error";
                }
            });
    }
}

/*Borrar------------------------ */
function borrarLista() {
    cogerListaDeListas();
    let elementoLista = selectListas[0].options[selectListas[0].selectedIndex];
    if (elementoLista) {
        let nombreLista = selectListas[0].options[selectListas[0].selectedIndex].textContent;
        /*AJAX*/
        const data = new URLSearchParams('nombreLista=' + nombreLista);
        fetch('../AJAX/borrarLista.php', { method: 'POST', body: data })
            .then(response => response.text())
            .then(text => {
                let respuesta = text
                if (respuesta == "exito") {
                    //Añade la lista a las select
                    for (let index = selectListas.length - 1; index >= 0; index--) {
                        //Coge de la ultima a la primera lista de listas el option que es igual al que está selecionado en la primera select de lista
                        elementoLista = selectListas[index].options[selectListas[0].selectedIndex];
                        //Y lo borra
                        selectListas[index].removeChild(elementoLista);
                    }
                    //Muestra mensaje de exito
                    let p = document.getElementById("comprobacionBorrarLista");
                    p.textContent = "Exito al borrar la lista " + nombreLista;
                    p.className = "exito";
                } else {
                    //Muestra mensaje de error
                    let p = document.getElementById("comprobacionBorrarLista");
                    p.textContent = "Error al borrar la lista " + nombreLista;
                    p.className = "error";
                }
            });
    }
}

function borrarCategoria() {
    cogerListaDeCategorias()
    //Coge el option selecionado
    let elementoBorrarCategoria = selectCategorias[0].options[selectCategorias[0].selectedIndex];
    if (elementoBorrarCategoria) {
        //Coge el nombre del option selecionado
        let nombreCategoria = selectCategorias[0].options[selectCategorias[0].selectedIndex].textContent;
        //Coge el value del option selecionado
        let value = selectCategorias[0].options[selectCategorias[0].selectedIndex].value;
        //Crea artificialmente el nombre de la clase de sus optgroups asociados para cogerlos y borrarlos
        let valueOptgroupCategoria = "optgroup" + value;
        /*AJAX*/
        const data = new URLSearchParams('nombreCategoria=' + nombreCategoria);
        fetch('../AJAX/borrarCategoria.php', { method: 'POST', body: data })
            .then(response => response.text())
            .then(text => {
                let respuesta = text
                if (respuesta == "exito") {
                    //Borra los option a las select de categorias
                    for (let index = selectCategorias.length - 1; index >= 0; index--) {
                        //Coge de la ultima a la primera lista de categorias el option que es igual al que está selecionado en la primera select de categoria
                        elementoBorrarCategoria = selectCategorias[index].options[selectCategorias[0].selectedIndex];
                        //Y lo borra
                        elementoBorrarCategoria.parentNode.removeChild(elementoBorrarCategoria);
                    }
                    cogerListaDeProductos()
                    //Crea optgroupBorrarCategoria
                    let optgroupBorrarCategoria = '';
                    //Borra el optgroup a las select de productos
                    for (let index = 0; index < selectProductos.length; index++) {
                        //Coge de dentro de la select de productos el optgroup que tenga el mismo nombre de la clase que el nombre de clase creado arificialmente
                        optgroupBorrarCategoria = selectProductos[index].getElementsByClassName(valueOptgroupCategoria);
                        //Y lo borra
                        optgroupBorrarCategoria[0].parentNode.removeChild(optgroupBorrarCategoria[0]);
                    }
                    //Muestra mensaje de exito
                    let p = document.getElementById("comprobacionBorrarCategoria");
                    p.textContent = "Exito al borrar la lista " + nombreCategoria;
                    p.className = "exito";
                } else {
                    //Muestra mensaje de error
                    let p = document.getElementById("comprobacionBorrarCategoria");
                    p.textContent = "Error al borrar la lista " + nombreCategoria;
                    p.className = "error";
                }
            });
    }
}

function borrarProducto() {
    cogerListaDeProductos();
    let elementoProducto = selectProductos[0].options[selectProductos[0].selectedIndex];
    if (elementoProducto) {
        let nombreProducto = selectProductos[0].options[selectProductos[0].selectedIndex].textContent;
        /*AJAX*/
        const data = new URLSearchParams('nombreProducto=' + nombreProducto);
        fetch('../AJAX/borrarProducto.php', { method: 'POST', body: data })
            .then(response => response.text())
            .then(text => {
                let respuesta = text
                if (respuesta == "exito") {
                    //Añade la Producto a las select
                    for (let index = selectProductos.length - 1; index >= 0; index--) {
                        //Coge de la ultima a la primera lista de productos el option que es igual al que está selecionado en la primera select de producto
                        elementoProducto = selectProductos[index].options[selectProductos[0].selectedIndex];
                        //Y lo borra
                        elementoProducto.parentNode.removeChild(elementoProducto);
                    }
                    //Muestra mensaje de exito
                    let p = document.getElementById("comprobacionBorrarProducto");
                    p.textContent = "Exito al borrar la Producto " + nombreProducto;
                    p.className = "exito";
                    //Comprueba los optgroups
                    mostrar_ocultarOPTS();
                } else {
                    //Muestra mensaje de error
                    let p = document.getElementById("comprobacionBorrarProducto");
                    p.textContent = "Error al borrar la Producto " + nombreProducto;
                    p.className = "error";
                }
            });
    }
}

/*Renombrar------------------------ */
function renombrarLista() {
    cogerListaDeListas();
    let nombreLista = selectListas[1].options[selectListas[1].selectedIndex].textContent;
    let elementoLista = selectListas[1].options[selectListas[1].selectedIndex];
    let nuevoNombre = document.getElementById('nuevoNombreLista');
    let nombreNuevoLista = nuevoNombre.value;
    if (hayContenido(nombreNuevoLista)) {
        /*AJAX*/
        const data = new URLSearchParams('nombreAntiguoLista=' + nombreLista + '&nombreNuevoLista=' + nombreNuevoLista);
        fetch('../AJAX/renombrarLista.php', { method: 'POST', body: data })
            .then(response => response.text())
            .then(text => {
                let respuesta = text
                if (respuesta == "exito") {
                    //Cambia todos los option iguales al selecionado poniendoles su nuevo nombre
                    for (let index = 0; index < selectListas.length; index++) {
                        //Coge la lista
                        elementoLista = selectListas[index].options[selectListas[1].selectedIndex];
                        //Y cambia su nombre
                        elementoLista.textContent = nombreNuevoLista;
                    }
                    //Muestra mensaje de exito
                    let p = document.getElementById("comprobacionRenombrarLista");
                    p.textContent = "Exito al renombrar la lista " + nombreLista + " a " + nombreNuevoLista;
                    p.className = "exito";
                    //Vacia el campo
                    nombreLista = nuevoNombre.value = '';
                } else {
                    //Muestra mensaje de error
                    let p = document.getElementById("comprobacionRenombrarLista");
                    p.textContent = "Error al renombrar la lista " + nombreLista + " a " + nombreNuevoLista;
                    p.className = "error";
                }
            });
    }
}

function renombrarCategoria() {
    cogerListaDeCategorias();
    let nombreCategoria = selectCategorias[1].options[selectCategorias[1].selectedIndex].textContent;
    let elementoCategoria = selectCategorias[1].options[selectCategorias[1].selectedIndex];
    let nuevoNombre = document.getElementById('nuevoNombreCategoria');
    let nombreNuevoCategoria = nuevoNombre.value;
    if (hayContenido(nombreNuevoCategoria)) {
        /*AJAX*/
        const data = new URLSearchParams('nombreAntiguoCategoria=' + nombreCategoria + '&nombreNuevoCategoria=' + nombreNuevoCategoria);
        fetch('../AJAX/renombrarCategoria.php', { method: 'POST', body: data })
            .then(response => response.text())
            .then(text => {
                let respuesta = text
                if (respuesta == "exito") {
                    //Cambia todos los option iguales al selecionado poniendoles su nuevo nombre
                    for (let index = 0; index < selectCategorias.length; index++) {
                        //Coge la categoria
                        elementoCategoria = selectCategorias[index].options[selectCategorias[1].selectedIndex];
                        //Y cambia su nombre
                        elementoCategoria.textContent = nombreNuevoCategoria;
                    }

                    //Cambia todos los option que se han creado nuevos iguales al selecionado poniendoles su nuevo nombre
                    cogerListaDeOptgroupFiltrado(elementoCategoria.value);
                    for (let index = 0; index < optgroupFiltrado.length; index++) {
                        optgroupFiltrado[index].label = nombreNuevoCategoria
                    }

                    //Muestra mensaje de exito
                    let p = document.getElementById("comprobacionRenombrarCategoria");
                    p.textContent = "Exito al renombrar la categoria " + nombreCategoria + " a " + nombreNuevoCategoria;
                    p.className = "exito";
                    //Vacia el campo
                    nombreLista = nuevoNombre.value = '';
                } else {
                    //Muestra mensaje de error
                    let p = document.getElementById("comprobacionRenombrarCategoria");
                    p.textContent = "Error al renombrar la categoria " + nombreCategoria + " a " + nombreNuevoCategoria;
                    p.className = "error";
                }
            });
    }
}

function renombrarProducto() {
    cogerListaDeProductos();
    let nombreProducto = selectProductos[1].options[selectProductos[1].selectedIndex].textContent;
    let elementoProducto = selectProductos[1].options[selectProductos[1].selectedIndex];
    let nuevoNombre = document.getElementById('nuevoNombreProducto');
    let nombreNuevoProducto = nuevoNombre.value;
    if (hayContenido(nombreNuevoProducto)) {
        /*AJAX*/
        const data = new URLSearchParams('nombreAntiguoProducto=' + nombreProducto + '&nombreNuevoProducto=' + nombreNuevoProducto);
        fetch('../AJAX/renombrarProducto.php', { method: 'POST', body: data })
            .then(response => response.text())
            .then(text => {
                let respuesta = text
                if (respuesta == "exito") {
                    //Cambia todos los option iguales al selecionado poniendoles su nuevo nombre
                    for (let index = 0; index < selectProductos.length; index++) {
                        //Coge el producto 
                        elementoProducto = selectProductos[index].options[selectProductos[1].selectedIndex];
                        //Y cambia su nombre
                        elementoProducto.textContent = nombreNuevoProducto;
                    }
                    //Muestra mensaje de exito
                    let p = document.getElementById("comprobacionRenombrarProducto");
                    p.textContent = "Exito al renombrar el producto " + nombreProducto + " a " + nombreNuevoProducto;
                    p.className = "exito";
                    //Vacia el campo
                    nombreLista = nuevoNombre.value = '';
                } else {
                    //Muestra mensaje de error
                    let p = document.getElementById("comprobacionRenombrarProducto");
                    p.textContent = "Error al renombrar el producto " + nombreProducto + " a " + nombreNuevoProducto;
                    p.className = "error";
                }
            });
    }
}
/* CARRUSEL ----------------------------------------------------------------*/
var listsIndex = 1;  // index de las veces que se ejecuta el siguiente bucle
var lists = document.getElementsByClassName("lists");
var listsLength = document.getElementsByClassName("lists").length;
var numeroDeListaActaul = document.querySelector("h3");
showLists();  // llama a la funcion que creamos

function showLists() {
  for (i = 0; i < listsLength; i++) {
    lists[i].style.display = "none";  // hace que los div de clase "mylists" se oculten todos
  }
  lists[listsIndex - 1].style.display = "block";   // cambio a tipo bloque el elemento del array y así se visualiza solo un div de clase "mylists"
  numeroDeListaActaul.textContent = listsIndex + "/" + listsLength;
};

function listsIndexAumenta() {
  listsIndex++;
  if (listsIndex > listsLength) {
    listsIndex = 1; // hago que aumente el index y en caso de que se pase lo igualo a 1
  };
  showLists();
};

function listsIndexDisminuye() {
  listsIndex--;
  if (listsIndex == 0) {
    listsIndex = listsLength; // hago que disminuya el index y en caso de que se pase lo igualo al numero de listas
  };
  showLists();
};

/* Ocultar mensajes--------------------------------------------------------*/
function esconder(id) {
  let mensaje = document.getElementById(id);
  mensaje.style.display = "none";
}
/* Mostrar mensajes--------------------------------------------------------*/
function mostrar(id) {
  let mensaje = document.getElementById(id);
  mensaje.style.display = "block";
}
/* Tachar----------------------------------------------------------------*/
function tachar(id) {
  let p = document.getElementById(id);
  p = p.querySelector("span+button+p");
  const clase = p.getAttribute('class');
  if (clase === 'nombreProducto normal') {
    p.className = "nombreProducto tachado";
  } else {
    p.className = "nombreProducto normal";
  }
}

/* Cambiar unidades----------------------------------------------------------------*/
function aumentarProducto(id) {
  let elementoAumentar = document.getElementById(id);
  elementoAumentar = elementoAumentar.querySelector("button+p.num");
  let num = elementoAumentar.textContent;
  num = parseInt(num)
  if (99 > num) {
    num++;
    /*AJAX*/
    let section = elementoAumentar.parentNode.parentNode;
    let divElemento = elementoAumentar.parentNode;
    let nombreProducto = divElemento.querySelector(".nombreProducto");
    nombreProducto = nombreProducto.textContent;
    let idListaPedidos = section.id.substr(1);
    const data = new URLSearchParams('idListaPedidos=' + idListaPedidos + '&nombreProducto=' + nombreProducto + '&Cantidad=' + num);
    fetch('../AJAX/aumentar-disminuirProducto.php', { method: 'POST', body: data })
      .then(response => response.text())
      .then(text => {
        let respuesta = text
        if (respuesta == "exito") {
          elementoAumentar.textContent = num;
        }
      });
  }
};

function disminuirProducto(id) {
  let elementoDisminuir = document.getElementById(id);
  elementoDisminuir = elementoDisminuir.querySelector("button+p.num");
  let num = elementoDisminuir.textContent;
  num = parseInt(num)
  if (num > 1) {
    num--;
    /*AJAX*/
    let section = elementoDisminuir.parentNode.parentNode;
    let divElemento = elementoDisminuir.parentNode;
    let nombreProducto = divElemento.querySelector(".nombreProducto");
    nombreProducto = nombreProducto.textContent;
    let idListaPedidos = section.id.substr(1);
    const data = new URLSearchParams('idListaPedidos=' + idListaPedidos + '&nombreProducto=' + nombreProducto + '&Cantidad=' + num);
    fetch('../AJAX/aumentar-disminuirProducto.php', { method: 'POST', body: data })
      .then(response => response.text())
    fetch('../AJAX/aumentar-disminuirProducto.php', { method: 'POST', body: data })
      .then(response => response.text())
      .then(text => {
        let respuesta = text
        if (respuesta == "exito") {
          elementoDisminuir.textContent = num;
        }
      });
  }
};

/* Quitar Producto----------------------------------------------------------------*/
function borrarProducto(id) {
  let elementoBorrar = document.getElementById(id);
  /*AJAX*/
  let section = elementoBorrar.parentNode;
  let divElemento = elementoBorrar;
  let nombreProducto = divElemento.querySelector(".nombreProducto");
  nombreProducto = nombreProducto.textContent;
  let idListaPedidos = section.id.substr(1);
  const data = new URLSearchParams('idListaPedidos=' + idListaPedidos + '&nombreProducto=' + nombreProducto);
  fetch('../AJAX/borrarProductoDeLista.php', { method: 'POST', body: data })
    .then(response => response.text())
    .then(text => {
      let respuesta = text
      if (respuesta == "exito") {
        elementoBorrar.parentNode.removeChild(elementoBorrar);
        if (document.querySelector("h2+h2")) {
          elementoBorrar = document.querySelector("h2+h2").previousSibling;
          elementoBorrar.parentNode.removeChild(elementoBorrar);
        }
      }
    });
};

/* Eliminar Lista----------------------------------------------------------------*/
function borrarLista() {
  let listaBorrar = lists[listsIndex - 1];
  /*AJAX*/
  let section = listaBorrar;
  let idListaPedidos = section.id.substr(1);
  const data = new URLSearchParams('idListaPedidos=' + idListaPedidos);
  fetch('../AJAX/borrarTodosLosPorductosDeLista.php', { method: 'POST', body: data })
    .then(response => response.text())
    .then(text => {
      let respuesta = text
      if (respuesta == "exito") {
        listaBorrar = listaBorrar.querySelectorAll("div");
        for (let index = 0; index < listaBorrar.length; index++) {
          listaBorrar[index].parentNode.removeChild(listaBorrar[index]);
          if (document.querySelector("h2+h2")) {
            elementoBorrar = document.querySelector("h2+h2").previousSibling;
            elementoBorrar.parentNode.removeChild(elementoBorrar);
          }
        }
        esconder('borrarListaMSG');
      }
    });
}

/* Eliminar Todas las Listas----------------------------------------------------------------*/
function borrarTodasListas() {
  /*AJAX*/
  const data = new URLSearchParams('');
  fetch('../AJAX/borrarTodosLosPorductosDeTodasLasLista.php', { method: 'POST', body: data })
    .then(response => response.text())
    .then(text => {
      let respuesta = text
      if (respuesta == "exito") {
        let listaBorrar;
        for (let index = 0; index < lists.length; index++) {
          listaBorrar = lists[index].querySelectorAll("div");
          for (let index = 0; index < listaBorrar.length; index++) {
            listaBorrar[index].parentNode.removeChild(listaBorrar[index]);
            if (document.querySelector("h2+h2")) {
              elementoBorrar = document.querySelector("h2+h2").previousSibling;
              elementoBorrar.parentNode.removeChild(elementoBorrar);
            }
          }
        }
      esconder('borrarTodasListasMSG');
      }
    });
}

/* Añadir Porducto ----------------------------------------------------------------*/
let numElemento = -1;
function introducirProducto() {
  /*P*/
  let pText = document.getElementById("producto");
  pText = pText.options[pText.selectedIndex].text;
  /*-*/

  let list = lists[listsIndex - 1];
  list = list.querySelectorAll("span+button+p");
  let existe = false;
  for (let index = 0; index < list.length && !existe; index++) {
    if (pText == list[index].textContent) {
      existe = true;
    };
  };
  if (!existe) {
    numString = "elemento" + numElemento;
    numElemento--;
    /*DIV*/
    let div = document.createElement('div');
    div.id = numString;
    /*BUTTON MAS*/
    let buttonMas = document.createElement('button');
    buttonMas.type = "button";
    buttonMas.className = "pIcon mas";
    buttonMas.setAttribute("onclick", "aumentarProducto('" + numString + "')");
    /*P NUM*/
    let pNum = document.createElement('p');
    pNum.className = "num";
    pNum.textContent = "1";
    /*SPAN*/
    let span = document.createElement('span');
    span.textContent = " Uds.";
    /*BUTTON MENOS*/
    let buttonMenos = document.createElement('button');
    buttonMenos.type = "button";
    buttonMenos.className = "pIcon menos";
    buttonMenos.setAttribute("onclick", "disminuirProducto('" + numString + "')");
    /*P*/
    let p = document.createElement('p');
    p.className = "nombreProducto normal";
    p.setAttribute("onclick", "tachar('" + numString + "')");

    p.textContent = pText;
    /*BUTTON BASURA*/
    let buttonBASURA = document.createElement('button');
    buttonBASURA.type = "button";
    buttonBASURA.className = "pIcon basura";
    buttonBASURA.setAttribute("onclick", "borrarProducto('" + numString + "')");

    /*AJAX {{*/
    let section = lists[listsIndex - 1];
    let idListaPedidos = section.id.substr(1);
    const data = new URLSearchParams('idListaPedidos=' + idListaPedidos + '&nombreProducto=' + p.textContent + '&Cantidad=' + pNum.textContent);
    fetch('../AJAX/introducirProducto.php', { method: 'POST', body: data })
      .then(response => response.text())
      .then(text => {
        let respuesta = text
        if (respuesta == "exito") {
          /*COLGAR DE DIV*/
          div.appendChild(buttonMas);
          div.appendChild(pNum);
          div.appendChild(span);
          div.appendChild(buttonMenos);
          div.appendChild(p);
          div.appendChild(buttonBASURA);

          /*COLGAR DE LISTA*/
          lists[listsIndex - 1].appendChild(div)
          /*Vista abajo*/
          window.scrollTo(0, document.body.scrollHeight);
          /*MOSTRAR ERROR */
        } else {
          let mensaje = document.querySelector("section.mensaje");
          mensaje.style.display = "block";
        }
      });
  } else {
    let mensaje = document.querySelector("section.mensaje");
    mensaje.style.display = "block";
  }
}
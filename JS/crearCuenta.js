let nombreUsuarioValido=false;
let contrasenyaValida=false;
let contrasenyaCoincide=false;

function nombreUsuarioMSG() {
    nombreUsuario = document.querySelector("input[name=nombre]").value.trim();
    let msg = document.getElementById("nombreUsuarioMSG");

    const data = new URLSearchParams('nombreUsuario=' + nombreUsuario);
    fetch('../AJAX/nombreExiste.php', { method: 'POST', body: data })
        .then(response => response.text())
        .then(text => {
            let respuesta = text
            if (respuesta == "exito") {
                msg.classList.add('displayNone');
                nombreUsuarioValido=true;
            } else {
                msg.textContent= "Este nombre de usuario ya está en uso. Prueba con otro."
                msg.classList.remove('displayNone');
                nombreUsuarioValido=false;
            }
        });
}

function contrsenyaDebilMSG() {
    contrasenya = document.querySelector("input[name=contrasenya]").value.trim();
    let msg = document.getElementById("contrasenyaDebilMSG");

    let min = 0;
    let mas = 0;
    let num = 0;
    let sig = 0;
    let espacioBlanco = false;

    for (let i = 0; i < contrasenya.length; i++) {
        character = contrasenya.charAt(i);
        if (character * 2 > 0) {
            num++;
        } else if (character == character.match(/[-¡@!$%^&*·#()_+|~=`{}\[\]:";'<>¿?,.\/]/)) {
            sig++;
        } else if (character == character.match(/^ *$/)) {
            espacioBlanco = true;
        } else if (character == character.toLowerCase()) {
            min++;
        } else if (character == character.toUpperCase()) {
            mas++;
        }
    }

    if (!espacioBlanco && min > 0 && mas > 0 && num > 0 && sig > 0 && ((min + mas + num + sig) > 7)) {
        msg.classList.add('displayNone');
        contrasenyaValida=true;
    } else {
        msg.classList.remove('displayNone');
        contrasenyaValida=false;
    }
    contrsenyaNoCoincideMSG();
}

function contrsenyaNoCoincideMSG() {
    contrasenya = document.querySelector("input[name=contrasenya]").value.trim();
    contrasenyaComprovacion = document.querySelector("input[name=contrasenyaComprovacion]").value.trim();
    let msg = document.getElementById("contrasenyaNoCoincideMSG");
    if (contrasenya === contrasenyaComprovacion || contrasenyaComprovacion == '') {
        msg.classList.add('displayNone');
        contrasenyaCoincide=true;
    } else {
        msg.classList.remove('displayNone');
        contrasenyaCoincide=false;
    }
}

function validarFormulario(){
    nombreUsuarioMSG();
    contrsenyaDebilMSG();

    if (nombreUsuarioValido&&contrasenyaCoincide) {
        return true;
    } else{
        return false;
    }

}
document.addEventListener('DOMContentLoaded', () => {
   registrar()
   console.log("Se ha cargado el register.js modificado 3")
})

function registrar(){

    document.getElementById("btn-registrar").addEventListener("click", e => {
        validarDatos(e)
    })

    document.addEventListener("keydown", e => {
        if (e.key === 'Enter') {
            validarDatos(e)
          }
       
    })
}

function validarDatos(e){
    let nombre = document.getElementById("nombre").value.toLowerCase().trim()
    let apellidos = document.getElementById("apellidos").value.toLowerCase().trim()
    let email = document.getElementById("email").value.toLowerCase().trim()
    let pass = document.getElementById("pass").value.trim()
    let confirmpass = document.getElementById("confirmpass").value.trim()

    validar(nombre, apellidos, email, pass, confirmpass)
    e.preventDefault()

}

function validar(nombre,apellidos,email,pass,confirmpass) { 
 
    let valido = true
  
    if(!validarNombre(nombre)){
        document.getElementById("error-nombre").hidden = false
        valido = false
    }

    if(!validarNombre(apellidos)){
        document.getElementById("error-apellidos").hidden = false
        valido = false
    }

    if(!validarEmail(email)){
        document.getElementById("error-email").hidden = false
        valido = false
    }

    if(!validarPass(pass)){
        document.getElementById("error-pass").hidden = false
        document.getElementById("error-confirmpass").hidden = false
        valido = false
    } else {
        if(pass !== confirmpass){
            document.getElementById("error-confirmpass").hidden = false
            valido = false
        }
    }

    if(valido){
        document.getElementById("nombre").value = formatearNombre(nombre)
        document.getElementById("apellidos").value = formatearNombre(apellidos)
        document.getElementById("email").value = email
        document.getElementById("pass").value = pass
        document.getElementById("confirmpass").value = confirmpass

        console.log('formatearNombre(nombre): ', formatearNombre(nombre));
        console.log('formatearNombre(apellidos): ', formatearNombre(apellidos));
        console.log('email: ', email);
        console.log('pass: ', pass);
        console.log('confirmpass: ', confirmpass);

        document.getElementById("register-form").submit()
        
    }
 }



function validarEmail(email) {

    let valido = false;
    let expreg = /^[a-z][a-z_\.\-0-9\S]+@[a-z\.\S]+.[a-z]+$/i;
    if(expreg.test(email)){
        valido = true;
    }
    console.log
    return valido   
}


function validarNombre(nombre) {

    let valido = false;
    let expreg = /^[a-záéíóúñ][a-záéíóúñüªº\-\.\s]+[a-záéíóúñ\.]$/i;
    if(expreg.test(nombre)){
        valido = true;
    }
    return valido
}

function validarPass(pass) {

    let valido = false;
    let expreg = /^[a-záéíóúñA-ZÁÉÍÓÚÑ0-9\S][a-záéíóúñA-ZÁÉÍÓÚÑ0-9\S]{6,60}[a-záéíóúñA-ZÁÉÍÓÚÑ0-9\S]$/i;
    if(expreg.test(pass)){
        valido = true;
    }
    return valido
}

function formatearNombre(nombre) {
    
    let nombreFinal;
  
    
    if(nombre.includes(" ")){
       let array = nombre.split(" ")
       const nombres = array.map(nombre => capitalize(nombre));
       nombreFinal = nombres.join(" ")
    } else nombreFinal = capitalize(nombre)

    return nombreFinal;
}

function capitalize(str) {
    const lower = str.toLowerCase();
    return str.charAt(0).toUpperCase() + lower.slice(1);
  }


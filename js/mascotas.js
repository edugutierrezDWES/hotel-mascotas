document.addEventListener("DOMContentLoaded", () => {


    getMascotas()
    registrar()
    volver()
});

const registrar = () => {
  document.querySelector(".alert").style.display="none"  
  document.getElementById("register").addEventListener("click", (e) => {
    e.preventDefault();

    let nombre = document.getElementById("nombre").value;
    let raza = document.getElementById("raza").value;
    let descripcion = document.getElementById("descripcion").value;
    let tipo = document.getElementById("tipo").value;

    let verificar = verificarMascota(nombre, raza, descripcion, tipo);

    if (verificar) {
      const mascota = {
        nombre: nombre,
        raza: raza,
        descripcion: descripcion,
        tipo: tipo,
      };
      Swal.fire({
        title: "Estás seguro?",
        text: `Estás a punto de registrar a ${nombre}!`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, registrar!",
      }).then((result) => {
        if (result.isConfirmed) {
        
         saveMascota(mascota).then(res => {
           console.log(res.created)
          if(res && res.created) {
            Swal.fire("Hecho!", `Se ha registrado a <span style="font-weight:700;">${nombre}</span>`, "success");
            limpiarCampos()
          } else {
            Swal.fire("Oh no!", `Ha ocurrido un error al registrar <span style="font-weight:700;">${nombre}</span>`, "error");
            limpiarCampos()
          }
         })
    
        }
      });
    } else {
        document.querySelector(".alert").style.display="block"
    }
  });
};

const verificarMascota = (nombre, raza, descripcion, tipo) => true;

const limpiarCampos = () => {

    document.getElementById("nombre").value = ""
    document.getElementById("raza").value = ""
    document.getElementById("descripcion").value = ""
    document.getElementById("tipo").value = ""
}

const volver = () =>{
    document.querySelector(".cancelar").addEventListener('click', (e)=> { 
        e.preventDefault()
        window.location.href = "/hotelmascotas"
    })
}


//CRUD 

const getMascotas = async () => {

  let id="fBhKyRjW2ph2i"
  let send = {
    method: "GET",
    headers: {
      "Content-Type": "application/json",
    },
  };
  try {
    let res = await fetch(`./api/api_mascotas.php?id_usuario=${id}`, send);
    let data = await res.json();
    console.log(data)
  } catch (error) {
    console.log("Ha ocurrido el siguiente error " + error);
  }
};

const saveMascota = async (mascota) => {

  let send = {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(mascota)
  };
  try {
    let res = await fetch('./api/api_mascotas.php', send);
    let data = await res.json()
    return data;
    
    
  } catch (error) {
    console.log("Ha ocurrido el siguiente error " + error);
  }

}

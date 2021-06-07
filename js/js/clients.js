document.addEventListener("DOMContentLoaded", () => {
  getClientes();
  volver()
 
});

const getClientes = async () => {
  let send = {
    method: "GET",
    headers: {
      "Content-Type": "application/json",
    },
  };
  try {
    let res = await fetch("./api/api_clientes.php", send);
    let data = await res.json();
    mostrar(data);
  } catch (error) {
    console.log("Ha ocurrido el siguiente error " + error);
  }
};

const mostrar = (data) => {
  console.log(data)
  let row = document.getElementById("usuarios");
  row.innerHTML = "";
  data.forEach((usuario) => {
    row.innerHTML += `<tr>
      <th scope="row">${usuario.id_usuario}</th>
      <td>${usuario.nombre}</td>
      <td>${usuario.apellidos}</td>
      <td>${usuario.email}</td>
      <td>${usuario.rol}</td>
      <td>${usuario.fecha_alta}</td>
      <td>${usuario.fecha_baja}</td>
      <td><button class="btn btn-primary edit">Editar</button></td>
      <td><button class="btn btn-danger delete">Borrar</button></td>
      </tr>
      `;
  });

  eliminar();
  editar();
};

const eliminar = () => {
  let deleteButtons = document.querySelectorAll(".delete");
  deleteButtons.forEach((deleteButton) => {
    deleteButton.addEventListener("click", (e) => {
      const button = e.target;
      const id = button.closest("td").closest("tr").children[0].textContent;
      console.log("Se va a eliminar el cliente con id: ", id);
      e.preventDefault()
    });
  });
};

const editar = () => {
  let editButtons = document.querySelectorAll(".edit");
  editButtons.forEach((editButton) => {
    editButton.addEventListener("click", (e) => {
      const button = e.target;
      const data = button.closest("td").closest("tr");
      const usuario = {
        id_usuario: data.children[0].textContent,
        nombre: data.children[1].textContent,
        apellidos: data.children[2].textContent,
        email: data.children[3].textContent,
        rol: data.children[4].textContent,
      };
      console.log("Se va a editar el cliente con id: ", usuario.id_usuario);
      document.querySelector(".table").style.display = "none" 
      abrirFormularioEditar(usuario);
      e.preventDefault()
    });
  });
};

const verificarCampos = (nombre, apellidos, emai, rol) => true;


const abrirFormularioEditar = (usuario) => {
  console.log(usuario)
  document.querySelector("form").style.display = "block";
  document.getElementById("nombre").value = usuario.nombre;
  document.getElementById("apellidos").value = usuario.apellidos;
  document.getElementById("email").value = usuario.email;
  document.getElementById("rol").value = usuario.rol;

  document.getElementById("confirmedit").addEventListener("click", (e) => {
    e.preventDefault()
    let nombre = document.getElementById("nombre").value;
    let apellidos = document.getElementById("apellidos").value;
    let email = document.getElementById("email").value;
    let rol = document.getElementById("rol").value;

    let verificar = verificarCampos(nombre, apellidos, email, rol);

    if (verificar) {
      const sendUser = {
        id_usuario: usuario.id_usuario,
        nombre: nombre,
        apellidos: apellidos,
        email: email,
        rol: rol,
      };
      Swal.fire({
        title: 'Estás seguro?',
        text: `Estás a punto de editar el usuario ${nombre}!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, editar!'
      }).then((result) => {
        if (result.isConfirmed) {
          console.log("Vamos a mandar estos datos para actualizar el cliente", sendUser)
          Swal.fire(
            'Editado!',
            'Cliente ha sido actualizado.',
            'success'
          )
          document.querySelector("form").style.display = "none";
          document.querySelector(".table").style.display = "block" 
        }
      })


    } else {
      document.querySelector(".alert").style.display="block"
      document.querySelector(".close").addEventListener('click', ()=>{
      document.querySelector(".alert").style.display="none"
      })
    }
    
  });

  document.getElementById("canceledit").addEventListener("click", (e) => {
    e.preventDefault()
    document.querySelector("form").style.display = "none";
    document.querySelector(".table").style.display = "block" 
  });


};

const deleteClient = async (id) => {
  let send = {
    method: "DELETE",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
  };
  try {
    let res = await fetch(`./api/api_clientes.php?id_usuario=${id}`, send);
    let data = await res.json();
    mostrar(data);
  } catch (error) {
    console.log("Ha ocurrido el siguiente error " + error);
  }
};

const getClient = async (id) => {
  let send = {
    method: "GET",
    headers: {
      "Content-Type": "application/json",
    },
  };
  try {
    let res = await fetch(`./api/api_clientes.php?id_usuario=${id}`, send);
    let data = await res.json();
    console.log("gliente: ", data);
  } catch (error) {
    console.log("Ha ocurrido el siguiente error " + error);
  }
};

const volver = () =>{
  document.querySelector(".volver").addEventListener('click', (e)=> { 
      e.preventDefault()
      window.location.href = "/hotelmascotas"
  })
}






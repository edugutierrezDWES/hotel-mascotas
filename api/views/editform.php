  <!--  <div class="alert alert-danger alert-dismissible fade show" role="alert">
       <strong>Oh no, un error!</strong> Deberias verificar alguno de los campos aquí abajo.
       <button type="button" class="btn btn-danger close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">X</span>
       </button>
   </div><br> -->

   <form id="editar_usuario" action="/hotelmascotasmvc/cliente/editar/<?php echo $_GET["id_editform"];?>">
       <div class="form-group">
           <label for="nombre">Nombre</label>
           <input type="text" class="form-control" id="nombre" aria-describedby="nombre" placeholder="Editar Nombre...">
       </div><br>
       <div class="form-group">
           <label for="apellidos">Apellidos</label>
           <input type="text" class="form-control" id="apellidos" placeholder="Editar Apellidos...">
       </div><br>
       <div class="form-group">
           <label for="email">Email</label>
           <input type="email" class="form-control" id="email" placeholder="Editar Email...">
       </div><br>
       <div class="form-group">
           <label for="rol">Rol</label>
           <select class="form-control" id="rol">
               <option value="cliente">Cliente</option>
               <option value="empleado">Empleado</option>
               <option value="admin">Administrador</option>
           </select>
       </div>

       <br><br>
       <button type="submit" id="confirmedit" class="btn btn-primary">Confirmar Editar</button>
       <a href="/hotelmascotsamvc/clientes" id="canceledit" class="btn btn-danger">Concelar</a>
   </form><br><br>

   <!-- href="/hotelmascotasmvc/cliente/editar/<?php echo $_GET["id_editform"];?>" -->

   <script>

       document.getElementById("confirmedit").addEventListener('click', (e)=> {
         e.preventDefault();
         let id="<?php echo $_GET["id_editform"];?>"
        Swal.fire({
        title: 'Estás seguro?',
        text: `Estás a punto de editar el usuario con id ${id}!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, editar!'
      }).then((result) => {
        if (result.isConfirmed) {
          console.log("Vamos a mandar estos datos para actualizar el cliente", id)
          Swal.fire(
            'Editado!',
            'Cliente ha sido actualizado.',
            'success'
          )
          setTimeout(()=> {
            document.getElementById("editar_usuario").submit()
          }, 3000);
          
        }
      })
         
       })

   </script>
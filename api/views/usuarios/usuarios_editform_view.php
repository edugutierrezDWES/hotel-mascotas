  <!--  <div class="alert alert-danger alert-dismissible fade show" role="alert">
       <strong>Oh no, un error!</strong> Deberias verificar alguno de los campos aquí abajo.
       <button type="button" class="btn btn-danger close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">X</span>
       </button>
   </div><br> -->

   <form method="post" action="/hotelmascotasmvc/cliente/editar/<?php echo $id; ?>">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" readonly value="<?php echo $email; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Contraseña Actual</label>
                        <input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña Actual">
                    </div>
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" placeholder="Nombre" value="<?php echo $nombre; ?>">
                </div>
                <div class="form-group">
                    <label for="inputAddress2">Apellidos</label>
                    <input type="text" class="form-control" id="apellidos" placeholder="Apellidos" value="<?php echo $apellidos; ?>">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="cambiar contraseña">Cambiar Contraseña
                        </label>
                        <input type="password" class="form-control" id="changedpass">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="confirmar contraseña">Confirmar Contraseña</label>
                        <input type="password" class="form-control" id="confirmpass">
                    </div>
                </div>
                <br><br>
       <button type="submit" id="confirmedit" class="btn btn_orange bt_login">Confirmar Editar</button>
       <a href="/hotelmascotasmvc/clientes" id="canceledit" class="btn btn-danger">Concelar</a>
            </form>



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
            document.getElementById("editar_mascota").submit()
          }, 3000);
          
        }
      })
         
       })

   </script>
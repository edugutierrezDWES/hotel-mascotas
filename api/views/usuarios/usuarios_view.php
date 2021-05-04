
        <h2 class="card-title">Listado de Usuarios</h2>

        <?php
        if (count($respuesta) == 0) { ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Oh no</strong>No hay clientes en la base de datos.
            <button type="button" class="btn btn-danger close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">X</span>
            </button>
          </div><br>
        <?php }
        ?>
        <table class="table table-bordered table-striped table-light">
          <thead class="thead-dark">
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nombre</th>
              <th scope="col">Apellidos</th>
              <th scope="col">Email</th>
              <th scope="col">Rol</th>
              <th scope="col">Fecha Alta</th>
              <th scope="col">Fecha Baja</th>
            </tr>
          </thead>
          <tbody id="usuarios">

            <?php
            foreach ($respuesta as $user) {
            ?>
              <tr>
                <th scope="row"><?php echo $user["id_usuario"] ?></th>
                <td><?php echo $user["nombre"] ?></td>
                <td><?php echo $user["apellidos"] ?></td>
                <td><?php echo $user["email"] ?></td>
                <td><?php echo $user["rol"] ?></td>
                <td><?php echo $user["fecha_alta"] ?></td>
                <td><?php echo $user["fecha_baja"] ?></td>
                <td><a href="cliente/form/editar/<?php echo $user["id_usuario"]; ?>" class="btn btn-primary">Editar</a></td>
                <td><a href="cliente/borrar/<?php echo $user["id_usuario"]; ?>" class="btn btn-danger">Borrar</a></td>
              </tr>

            <?php }
            ?>
          </tbody>
        </table>
    
        <a href="/hotelmascotasmvc/home" class="btn btn-success volver">Volver</a>
  
 
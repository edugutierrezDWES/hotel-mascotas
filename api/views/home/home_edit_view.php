<div class="wrap wrap1">
    <div class="container">
        <!-- maincontent-->
        <!--title  -->
        <div class="row">
            <h2>Editar Datos de Usuario<em class="bi-grip-horizontal mar_l4"></em></h2>
        </div>
        <div class="container main_container mar_0_-15">
            <form method="post" action="/hotelmascotasmvc/cliente/editar/<?php echo $id; ?>">
                <div class="form-row">
                <div class="form-group col-md-6 text-secondary" style="font-size: 0.7rem;">
                   * Datos se actualizaran cuando se reinicie la sesión.
                </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" readonly value="<?php echo $email; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $nombre; ?>">
                </div>
                <div class="form-group">
                    <label for="inputAddress2">Apellidos</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos" value="<?php echo $apellidos; ?>">
                </div>

                <hr>
                <div class="form-group col-md-6 text-secondary" style="font-size: 0.7rem;">
                   * Datos solo necesarios si se va a actualizar la contraseña, para los demás campos dejarlo en blanco.
                </div>


                <div class="form-group col-md-6">
                    <label for="contraseña actual">Contraseña Actual</label>
                    <input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña Actual">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="cambiar contraseña">Cambiar Contraseña
                        </label>
                        <input type="password" class="form-control" placeholder="Nueva Contraseña" name="newpass" id="changedpass">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="confirmar contraseña">Confirmar Contraseña</label>
                        <input type="password" class="form-control" placeholder="Confirmar Nueva Contraseña" name="confirmpass" id="confirmpass">
                    </div>
                </div>

                
                <button type="submit" class="btn btn_orange bt_login">Editar</button>
            </form>
        </div>
    </div>
</div>
<?php
require_once("db/db.php");
session_start();
if(isset($_SESSION) && !empty($_SESSION)) {
    header("location: home");
}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <!-- <link href="css/bootstrap.css" rel="stylesheet"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link href="./css/bootstrap-icons.css" rel="stylesheet">

  <!-- My CSS -->
  <link href="./css/styles.css" rel="stylesheet">

  <title>Hotel Mascotas</title>
  <link rel="icon" 
      type="image/png" 
      href="img/patita.png" />
</head>
<style>
  .error-mensaje {

    color: #e43353;
    font-size: smaller;
    text-align: left;
    line-height: 100%;
  }
</style>

<body class="bg_login">
  <div class="container mt-5">
    <div class="row d-flex justify-content-center">
      <div class="col-md-6 col-lg-4 text-center"><img class="img-responsive mar_t15" src="img/logo_transp.png" alt="logo scarp" />

        <div class="login">
          <form role="form" method="POST" class="form-horizontal" id="register-form" action="clientes">
            <h2 class="mar_b20 ">Registro</h2>
            <div class="form-group">

              <div hidden class="alert alert-danger row form-group" id="error-alert" role="alert">
                <h5 class="alert-heading">Ha ocurrido un error!</h5>
                <p style="text-align: justify;">Comprueba que este email no está ya registrado y que todos los campos están correctos.</p>
              </div>

              <div class="row form-group">
                <div class="col-sm-2 ">
                  <label for="Nombre" class="control-label"><i class="bi bi-person-fill font_26"></i></label>
                </div>
                <div class="col-sm-10">
                  <input type="text" placeholder="Nombre" id="nombre" name="nombre" class="form-control form-control-login">
                  <div id="error-nombre" hidden class="error-mensaje">
                    Introduce un nombre válido.
                  </div>
                </div>

              </div>

              <div class="row form-group">
                <div class="col-sm-2 ">
                  <label for="Apellidos" class="col-xs-2 control-label"><i class="bi bi-person-fill font_26"></i></label>
                </div>
                <div class="col-sm-10">
                  <input type="text" placeholder="Apellidos" id="apellidos" name="apellidos" class="form-control form-control-login">
                  <div id="error-apellidos" hidden class="error-mensaje">
                    Introduce apellidos válidos.
                  </div>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-sm-2 ">
                  <label for="Email" class="col-xs-2 control-label"><i class="bi bi-envelope-fill font_26"></i></i></label>
                </div>
                <div class="col-sm-10">
                  <input type="email" placeholder="Email" id="email" name="email" class="form-control form-control-login">
                  <div id="error-email" hidden class="error-mensaje">
                    Introduce un email válido.
                  </div>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-sm-2 ">
                  <label for="Contraseña" class="col-xs-2 control-label"><i class="bi bi-unlock-fill font_26"></i></label>
                </div>
                <div class="col-sm-10">
                  <input autocomplete type="password" placeholder="Contraseña" id="pass" name="pass" class="form-control form-control-login">
                  <div id="error-pass" hidden class="error-mensaje">
                    La contraseña debe contener una minúscula, mayúscula, un número y al menos 8 carácteres.
                  </div>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-sm-2 ">
                  <label for="Confirmar Contraseña" class="col-xs-2 control-label"><i class="bi bi-unlock-fill font_26"></i></label>
                </div>
                <div class="col-sm-10">
                  <input autocomplete type="password" placeholder="Confirmar Contraseña" id="confirmpass" name="confirmpass" class="form-control form-control-login">
                  <div id="error-confirmpass" hidden class="error-mensaje">
                    Las contraseñas no coinciden.
                  </div>
                </div>
              </div><br>
              <div class="text-center form-group">
                <button type="button" id="btn-registrar" class="btn btn_orange bt_login col-12">Registrar</button>
              </div>
            </div>
            <div class="form-group mar_t40 ">
              <div class="mar_t10 text-center">
                <form role="form" method="post" novalidate>
                  <a class="color_white" href="login">Iniciar Sesión</a>
                  <i class="bi bi-slash"></i>
                  <a class="color_white" href="Change_Password.html">Olvidaste tu contraseña?</a>
                </form>
              </div>
            </div>
            <div class="form-group">
              <div class=" text-center"> <a data-toggle="modal" role="button" href="#modal" class="color_white font_12">Terms, conditions of use and privacy policy</a> </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--ventana modal Terms-->
  <div class="modal fade" id="modal" role="dialog" aria-="true">
    <div class="modal-dialog width_600">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="myModalLabel">Terms, conditions of use and privacy policy </h3>
          <a href="#" title="Close modal window" class="close" data-dismiss="modal" aria-="true"> <i class="bi bi-x-circle"></i></a>
        </div>
        <div class="modal-body">
          <div class="panel panel-default">
            <div class="panel-body">
              <h3 class="dotted">Terms</h3>
              <label>Lorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sit</label>
              <h3 class="dotted">Conditions of use</h3>
              <label>Lorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sit</label>
              <h3 class="dotted">Privacy policy</h3>
              <label>Lorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sitLorem ipsum dolor sit</label>
            </div>
          </div>
        </div>
      </div>

      <!--fin ventana modal-->

      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="./js/jquery-3.6.0.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/bootstrap-select.js"></script>
      <script src="./js/registro.js"></script>
      <?php
      if (isset($_GET["registered"]) && $_GET["registered"] == "false") {
  
        echo '<script>
              document.getElementById("error-alert").hidden = false;
              </script>';
        }
      ?>
</body>
</html>
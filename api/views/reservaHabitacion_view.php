<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="../../css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="../../css/bootstrap-select.css">
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">-->
    <link rel="stylesheet" href="../../css/index.css">
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> --> <!--Talvez borrar-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    

    <script src="../../js/moment.min.js"></script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>-->

    <script src="../../js/bootstrap-datepicker.min.js"></script>
    <script src="../../js/bootstrap-select.js"></script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>--> 

    <script src="../../js/bootstrap-datepicker.es.js" charset="UTF-8"></script> 

    <title>Hotel para mascotas</title>

    <link rel="icon" 
      type="image/png" 
      href="../../img/patita.png" />

</head>
<body>
    <header>
        <div class="d-flex justify-content-center">
            <img src="../../img/fondo transp.png" alt="logo"  style="width: 200px; height: 200px;">
        </div>
        <div class="d-flex justify-content-center">
	        <nav>
	            <ul class="nav nav-tabs ">
	                <li class="nav-item"><a class="nav-link text-dark" href="#">Inicio</a></li>
	                <li class="nav-item"><a class="nav-link text-dark" href="#">Servicios</a></li>
	                <li class="nav-item"><a class="nav-link text-dark" href="#">Reserva</a></li>
	                <li class="nav-item"><a class="nav-link text-dark" href="#">Contacto</a></li>
	                <li class="nav-item"><a class="nav-link text-dark" href="#">¿Quiénes somos?</a></li>
	            </ul> 
	         </nav>
         </div>
    </header>

    <div class="container" style="width: 500px;">
        
        <form method="post" class="form-horizontal" action="<?php echo htmlentities($_SERVER["PHP_SELF"]);?>" novalidate>
            
            <?php
                if($error_Mensaje != ""){
                    echo "<div class='alert alert-danger form-group ' role='alert'>";
                    echo $error_Mensaje;
                    echo "</div>";
                }
                elseif($todo_Correcto != ""){
                    echo "<div class='alert alert-success form-group ' role='alert'>";
                    echo $todo_Correcto;
                    echo "</div>";
                }
            ?>

            <div class="form-group ">
                <label for="rol">Tipo de Servicio</label>
                <select class="form-control" name="tipoReserva">
                    <option value="normal">Normal</option>
                    <option value="vip">VIP</option>
                    <option value="supervip">Super Vip</option>
                </select>
            </div>
            <div class="form-group ">
                <label for="rol ">Fecha de Entrada y Salida</label>
                <div class="input-group ">
                    <section class="col">
                        <div class="">
                            <div class='input-group date' id='entrada'>
                                <input type='text' class="form-control fecha_validacion" id="dato_entrada" name="datoEntrada" autocomplete="off" required/>
                                <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </section>
                    <div class="input-group-addon">a</div>
                    <section class="col">
                        <div class="">
                            <div class='input-group date' id='salida'>
                                <input type='text' class="form-control fecha_validacion" id="dato_salida" name="datoSalida" autocomplete="off" required/>
                                <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                                
                            </div>
                        </div>
                    </section>
                </div>
                <div class="invalid-feedback text-center" id="error_fechas">La primera fecha debe ser hoy como minimo y la segunda debe ser posterior a la primera</div>
                    
            </div>

            <div class="form-group ">
                <label for="rol">Tamaño de la Habitacion</label>
                <select class="form-control" name="tipoHabitacion" id="tipo_Habitacion" >
                <?php
                    foreach ($arrayTipoHabitaciones as $Fila => $arrayTipo) {
                        $tipo_Hab= utf8_encode ($arrayTipo['tipo_Hab']);
                        $precio_noche=$arrayTipo['precio_noche'];
                        $cantidad=$arrayTipo['cantidad'];
                        echo "<option value='$tipo_Hab'>$tipo_Hab : $cantidad -> $precio_noche €</option>";
                    }
                ?>
                </select>
                
            </div>

            <div class="form-group ">
                <label for="rol">Mascota</label>
                <select class="form-control selectpicker" name="mascotas[]" id="mascotas" multiple required>
                <?php
                    foreach ($arrayMascotas as $Fila => $arrayMascota) {
                        $id_mascota=$arrayMascota['id_mascota'];
                        $nombre_mascota=$arrayMascota['nombre'];
                        echo "<option value='$id_mascota'>$nombre_mascota</option>";
                    }
                ?>
                </select>
            </div>

            <div class="mt-2">
                <button type="submit" class="btn btn-primary" name="reserva">Crear Reserva</button>
                  <button type="reset" class="btn btn-primary">Limpiar</button>
            </div>

            
        </form>

    </div> 
    <script type="text/javascript">
        var today = new Date();
        
        $(function() {

            $('.date').datepicker({
                language: 'es',
                minDate: today
            }).on('change', function() {
                let dd = $("#dato_entrada").val().slice(0,2);
                let mm = $("#dato_entrada").val().slice(3,5);
                let yy = $("#dato_entrada").val().slice(6);
                let dato_entrada = new Date(yy+"-"+mm+"-"+dd);
                
                dd = $("#dato_salida").val().slice(0,2);
                mm = $("#dato_salida").val().slice(3,5);
                yy = $("#dato_salida").val().slice(6);
                let dato_salida = new Date(yy+"-"+mm+"-"+dd);
                if (today <= dato_entrada && dato_entrada < dato_salida)
                {
                    $('.fecha_validacion').removeClass('is-invalid');
                    $('#error_fechas').removeClass('d-block');
                    $('.fecha_validacion').addClass('is-valid');
                }
                else {
                    $('.fecha_validacion').removeClass('is-valid');
                    $('.fecha_validacion').addClass('is-invalid');
                    $('#error_fechas').addClass('d-block');
                }
                
            });
            $('select').selectpicker();

        });
        $(document).ready(function () {
              
            $('#tipo_Habitacion').on('change', function (e) {
                let tipo_Habitacion = $(this).val();
                <?php 
                $array_Habitacion = [];
                    foreach ($arrayTipoHabitaciones as $Fila => $arrayTipo) {
                        $array_Habitacion[utf8_encode ($arrayTipo['tipo_Hab'])] = $arrayTipo['cantidad'];
                    }
                ?>
                let array_Habitacion = JSON.parse('<?php echo JSON_encode($array_Habitacion);?>');

                var count = parseInt(array_Habitacion[tipo_Habitacion]);
                
                // set limit to SELECT tag
                if (count > 0) {
                    $('#mascotas').data('max-options', count)
                }
                
                // here you can remove extra values from SELECT
                var values = $('#mascotas').val(); 
                if (values.length > count) {
                    // how many items we need to remove
                    var toRemove = values.length - count;
                    $('#mascotas option:selected').each(function (index, item) {
                    if (toRemove) {
                        var option = $(item);
                        option.prop('selected', false);
                        toRemove--;
                    }
                    });
                }
                
                // update selectpickers
                $('.selectpicker').selectpicker('refresh');
            });


        });


        (function () {
            'use strict';
            window.addEventListener('load', function () {
                var forms = document.getElementsByClassName('form-horizontal');
                var validation = Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {

                        let dd = $("#dato_entrada").val().slice(0,2);
                        let mm = $("#dato_entrada").val().slice(3,5);
                        let yy = $("#dato_entrada").val().slice(6);
                        let dato_entrada = new Date(yy+"-"+mm+"-"+dd);
                        
                        dd = $("#dato_salida").val().slice(0,2);
                        mm = $("#dato_salida").val().slice(3,5);
                        yy = $("#dato_salida").val().slice(6);
                        let dato_salida = new Date(yy+"-"+mm+"-"+dd);
                        if (today <= dato_entrada && dato_entrada < dato_salida)
                        {
                            $('.fecha_validacion').removeClass('is-invalid');
                            $('#error_fechas').removeClass('d-block');
                            $('.fecha_validacion').addClass('is-valid');
                        }
                        else {
                            $('.fecha_validacion').removeClass('is-valid');
                            $('.fecha_validacion').addClass('is-invalid');
                            $('#error_fechas').addClass('d-block');
                            event.preventDefault();
                            event.stopPropagation();
                        }
                    }, false);
                });
            }, false);
        })();

    </script>
    
</body>
</html>
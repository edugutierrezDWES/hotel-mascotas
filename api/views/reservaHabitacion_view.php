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
    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>-->

    <script src="../../js/bootstrap-datepicker.min.js"></script>
    <script src="../../js/bootstrap-select.js"></script>
    <script src="../../js/i18n/defaults-es_ES.js"></script>
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
                <select class="form-control calcular" name="tipoReserva" id="tipo_servicio">
                    <?php
                    $tipoServicio = [
                        "normal" => "Normal",
                        "vip" => "VIP",
                        "supervip" => "Super Vip"
                    ];
                    foreach ($arrayTipoServicios as $Fila => $arrayTipo) {
                        $tipo= $arrayTipo['tipo'];
                        $precio_noche=$arrayTipo['precio_noche'];
                        echo "<option value='$tipo'>$tipoServicio[$tipo] : $precio_noche €</option>";
                    }
                ?>
                </select>
            </div>
            <div class="form-group ">
                <label for="rol ">Fecha de Entrada y Salida</label>
                <div class="input-group ">
                    <section class="col">
                        <div class="">
                            <div class='input-group date' id='entrada'>
                                <input type='text' class="form-control fecha_validacion calcular" id="dato_entrada" name="datoEntrada" autocomplete="off" required/>
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
                                <input type='text' class="form-control fecha_validacion calcular" id="dato_salida" name="datoSalida" autocomplete="off" required/>
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
                <select class="form-control calcular" name="tipoHabitacion" id="tipo_habitacion" >
                <?php
                    foreach ($arrayTipoHabitaciones as $Fila => $arrayTipo) {
                        $tipo_Hab= $arrayTipo['tipo_Hab'];
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
            <!-- nuevo -->
            <div class="form-group ">
                <label for="rol">Precio Total</label>
                <input type='text' class="form-control" readonly id="precio_total" />
            </div>
            <!-- Fin nuevo -->
            <div class="mt-2">
                <button type="submit" class="btn btn-primary" name="reserva">Crear Reserva</button>
                  <button type="reset" class="btn btn-primary">Limpiar</button>
            </div>


        </form>

    </div> 
    <script type="text/javascript">
        var today = new Date();
        
        $(function() {

            <?php 
                $array_servicio_precio = [];
                foreach ($arrayTipoServicios as $Fila => $arrayTipo) {
                    $array_servicio_precio[$arrayTipo['tipo']] = $arrayTipo['precio_noche'];
                }
            ?>
            var array_servicio_precio = JSON.parse('<?php echo JSON_encode($array_servicio_precio, JSON_UNESCAPED_UNICODE);?>');

            <?php 
                $array_Habitacion_Num_Mascotas = [];
                $array_Habitacion_precio = [];
                foreach ($arrayTipoHabitaciones as $Fila => $arrayTipo) {
                    $array_Habitacion_Num_Mascotas[$arrayTipo['tipo_Hab']] = $arrayTipo['cantidad'];
                    $array_Habitacion_precio[$arrayTipo['tipo_Hab']] = $arrayTipo['precio_noche'];
                }
            ?>
            var array_Habitacion_Num_Mascotas = JSON.parse('<?php echo JSON_encode($array_Habitacion_Num_Mascotas, JSON_UNESCAPED_UNICODE);?>');
            var array_Habitacion_precio = JSON.parse('<?php echo JSON_encode($array_Habitacion_precio, JSON_UNESCAPED_UNICODE);?>');
            

            $('.date').datepicker({
                language: 'es',
                minDate: today,
                autoclose: true
            }).on('change', function() {
                Validation_Dates();
            });
            
            $('form').on('submit', function(){
                if(!Validation_Dates())
                {
                    event.preventDefault();
                    event.stopPropagation();
                }
            } );
            $('select').selectpicker();
            
            Max_Mascota();
            Precio_Total();
            //Agregar change  tipo servicio
            
            $('#tipo_habitacion').on('change', Max_Mascota);
            $('.calcular').on('change', Precio_Total);
            
            function Max_Mascota(){
                
                let tipo_habitacion = $('#tipo_habitacion').val();
                let count = parseInt(array_Habitacion_Num_Mascotas[tipo_habitacion]);
                
                // set limit to SELECT tag
                if (count > 0) {
                    $('#mascotas').data('max-options', count)
                }
                
                // here you can remove extra values from SELECT
                let values = $('#mascotas').val(); 
                if (values.length > count) {
                    // how many items we need to remove
                    let toRemove = values.length - count;
                    $('#mascotas option:selected').each(function (index, item) {
                    if (toRemove) {
                        let option = $(item);
                        option.prop('selected', false);
                        toRemove--;
                    }
                    });
                }
                // update selectpicker
                $('#mascotas').selectpicker('refresh');
            }         
            function Precio_Total(){
                if($("#dato_entrada").val() !="" && $("#dato_salida").val() != "" )
                {
                    let tipo_servicio = $("#tipo_servicio").val();
                    let tipo_habitacion = $("#tipo_habitacion").val();
                    let date_entrada = Formato_YMD($("#dato_entrada").val());
                    let date_salida = Formato_YMD($("#dato_salida").val());
                    let today = moment(moment().format('YYYY-MM-DD'));

                    if(today.isSameOrBefore(date_entrada) && date_entrada.isBefore(date_salida)){
                        let precio_servicio = parseFloat(array_servicio_precio[tipo_servicio]);
                        let precio_habitacion = parseFloat(array_Habitacion_precio[tipo_habitacion]);
                        let diffDay = date_salida.diff(date_entrada, 'days');
                        
                        let total = ((precio_servicio + precio_habitacion) * diffDay).toFixed(2);
                        $("#precio_total").val(total +" €");
                    }
                    else $("#precio_total").val("0.00 €");
                    
                }
                else $("#precio_total").val("0.00 €");
                
            }
            function Validation_Dates(){
                let date_entrada = Formato_YMD($("#dato_entrada").val());
                let date_salida = Formato_YMD($("#dato_salida").val());
                let today = moment(moment().format('YYYY-MM-DD'));
                if(!today.isSameOrBefore(date_entrada))
                {
                    $('#dato_entrada').removeClass('is-valid');
                    $('#dato_entrada').addClass('is-invalid');
                } else if(today.isSameOrBefore(date_entrada))
                {
                    $('#dato_entrada').removeClass('is-invalid');
                    $('#dato_entrada').addClass('is-valid');
                }
                if(!date_entrada.isBefore(date_salida))
                {
                    $('#dato_salida').removeClass('is-valid');
                    $('#dato_salida').addClass('is-invalid');
                } else if(date_entrada.isBefore(date_salida))
                {
                    $('#dato_salida').removeClass('is-invalid');  
                    $('#dato_salida').addClass('is-valid');
                }
                if(!(today.isSameOrBefore(date_entrada) && date_entrada.isBefore(date_salida)))
                {
                    $('#error_fechas').addClass('d-block');
                    return false;
                }
                else{
                    $('#error_fechas').removeClass('d-block');
                    return true;
                }
            }
            function Formato_YMD(date){
                let dd = date.slice(0,2);
                let mm = date.slice(3,5);
                let yy = date.slice(6);
                return moment(yy+"-"+mm+"-"+dd, 'YYYY-MM-DD');
            }
        });

    </script>
    
</body>
</html>
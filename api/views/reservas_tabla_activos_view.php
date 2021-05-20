<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- DATATABLE -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css">
    <!-- fin DATATABLE -->

    <!-- ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- fin ICONS -->

    <!-- DATAPICKER -->
    <link rel="stylesheet" href="../../css/bootstrap-datepicker.min.css">
    <!-- fin DATAPICKER -->

    <!-- SELECT -->
    <link rel="stylesheet" href="../../css/bootstrap-select.css">
    <!-- fin SELECT -->

    <link rel="stylesheet" href="../../css/index.css">
    
    

    <title>Hotel para mascotas</title>

    <link rel="icon" 
      type="image/png" 
      href="../../img/patita.png" />

</head>
<body>
    <header class="">
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

    <div class="container bg-white p-4" >
        <?php
                if($error_Mensaje != ""){
                    echo "<div class='alert alert-danger form-group ' role='alert'>";
                    echo $error_Mensaje;
                    echo "</div>";
                }
            ?>
    <table id="tabla_RS_Activo" class="display nowrap" style="width:100%">
        <thead class="bg-primary" >
            <tr>
                <th>RS</th>
                <th>Email</th>
                <th>Tipo RS</th>
                <th>T. Habitacion</th>
                <th>Fech. Inicio</th>
                <th>Fech. Final</th>
                <th>Precio Total</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $clase = [
                    "en espera" => "btn btn-secondary",
                    "en progreso" => "btn btn-success",
                    "finalizado" => "btn btn-info",
                    "abandonado" => "btn btn-danger",
                    "cancelado" => "btn btn-warning"
                ];
                $tipos_reservas = [
                    "normal" => "Normal",
                    "vip" => "VIP",
                    "supervip" => "Super VIP",
                ];
                foreach ($arrayReservasActivas as $fila => $reservasActiva) {
                        $claseEstado = $reservasActiva['estado_reserva'];
                        $id_reserva = $reservasActiva['id_reserva'];
                        $email = $reservasActiva['email'];
                        $tipo_reserva = $tipos_reservas[$reservasActiva['tipo_reserva']];
                        $tipo_Hab = $reservasActiva['tipo_Hab'];
                        $date = new DateTime($reservasActiva['fecha_inicio']);
                        $fecha_inicio = $date->format('d/m/Y');
                        $date = new DateTime($reservasActiva['fecha_final']);
                        $fecha_final = $date->format('d/m/Y');
                        $Precio_Total = number_format($reservasActiva['Precio_Total'], 2, ',', ' ');
                    echo "<tr>";
                        
                        echo "<td> <a class='$clase[$claseEstado]  w-100' href='reserva_datos_controller.php?RS=$id_reserva'><i class='bi bi-eye-fill'></i> $claseEstado<a></td>";
                        echo "<td> $email </td>";
                        echo "<td> $tipo_reserva </td>";
                        echo "<td> $tipo_Hab </td>";
                        echo "<td> $fecha_inicio </td>";
                        echo "<td> $fecha_final</td>";
                        echo "<td> $Precio_Total € </td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
        <tfoot class="bg-primary">
            <tr>
                <th>RS</th>
                <th>Email</th>
                <th>Tipo RS</th>
                <th>T. Habitacion</th>
                <th>Fech. Inicio</th>
                <th>Fech. Final</th>
                <th>Precio Total</th>
            </tr>
        </tfoot>

    </div> 


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> --> <!--Talvez borrar-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
    <!-- DATATABLE -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    
    <script src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
    
    <!-- fin DATATABLE -->
    
    <!-- DATAPICKER -->
    <script src="../../js/moment.min.js"></script>
    <script src="../../js/bootstrap-datepicker.min.js"></script>
    <script src="../../js/bootstrap-datepicker.es.js" charset="UTF-8"></script> 
    <!-- fin DATAPICKER -->

    <!-- SELECT -->
    <script src="../../js/bootstrap-select.js"></script>
    <!-- fin SELECT -->
    
    <!-- DATETIME-MOMENT TABLE-->
    <script src="../../js/datetime-moment.js"></script>
    <!-- fin DATETIME-MOMENT TABLE-->
    <script type="text/javascript">
        $(document).ready(function() {
            $.fn.dataTable.moment('DD/MM/YYYY');
            $('#tabla_RS_Activo').DataTable( {
                "language":{
                    "url": "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
                    searchPlaceholder: "en toda la tabla"
                },
                responsive: true
            } );
        });

    </script>
    

    

</body>
</html>
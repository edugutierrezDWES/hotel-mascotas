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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- fin ICONS -->

    <!-- DATAPICKER -->
    <link rel="stylesheet" href="../../css/bootstrap-datepicker.min.css">
    <!-- fin DATAPICKER -->

    <!-- SELECT -->
    <link rel="stylesheet" href="../../css/bootstrap-select.css">
    <!-- fin SELECT -->

    <link rel="stylesheet" href="../../css/index.css">



    <title>Hotel para mascotas</title>

    <link rel="icon" type="image/png" href="../../img/patita.png" />


</head>

<body>
    <header class="">
        <div class="d-flex justify-content-center">
            <img src="../../img/fondo transp.png" alt="logo" style="width: 200px; height: 200px;">
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

    <div class="container bg-white p-4">
        <?php
        if ($error_Mensaje != "") {
            echo "<div class='alert alert-danger form-group ' role='alert'>";
            echo $error_Mensaje;
            echo "</div>";
        }
        $claseBtn = [
            //No se puede cambiar el estado a 'en espera'
            //"en espera" => "btn btn-secondary",
            "en progreso" => "btn btn-success",
            "finalizado" => "btn btn-info",
            "abandonado" => "btn btn-danger",
            "cancelado" => "btn btn-warning"
        ];
        $posiblesCambios = [
            "en espera" => ["cancelado", "abandonado", "en progreso"],
            "en progreso" => ["finalizado", "abandonado"],
        ];
        $cambiosPermisos = [
            //No se puede cambiar el estado a 'en espera'
            //"en espera" => ['admin'],
            "en progreso" => ["admin"],
            "finalizado" => ["admin"],
            "abandonado" => ["admin"],
            "cancelado" => ["admin", "cliente"]
        ];

        echo "<div class='container row justify-content-md-center pb-3'>";
        foreach ($arrayReserva as $fila => $reserva) {
            $estadoReserva = $reserva['estado_reserva'];
            $hoy = date("Y-m-d");
            $fecha_Fin=date($reserva['fecha_final']);
            if (array_key_exists($estadoReserva, $posiblesCambios)) {
                foreach ($posiblesCambios[$estadoReserva] as $key => $cambio) {
                    if (in_array($rol_usuario, $cambiosPermisos[$cambio]) && !($cambio == "finalizado" && $hoy < $fecha_Fin) )
                        echo "<div class='col-md-auto'><button type='button' name='NewEstado' value='$cambio' class='$claseBtn[$cambio] botonEstado'>$cambio</button></div>";
                }
            }
        }
        echo "</div>";

        ?>

        <table id="tabla_RS" class="display nowrap" style="width:100%">
            <thead class="bg-primary">
                <tr>
                    <th>RS</th>
                    <th>Email</th>
                    <th>Mascota/s</th>
                    <th>Precio Total</th>
                    <th>Tipo RS</th>
                    <th>T. Habitacion</th>
                    <th>Habitacion</th>
                    <th>Fech. Inicio</th>
                    <th>Fech. Final</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $claseIconSVG_Mascota = [
                    "perro" => "fas fa-dog",
                    "gato" => "fas fa-cat",
                ];
                $claseText = [
                    "en espera" => " text-secondary",
                    "en progreso" => " text-success",
                    "finalizado" => " text-info",
                    "abandonado" => " text-danger",
                    "cancelado" => " text-warning"
                ];
                $tipos_reservas = [
                    "normal" => "Normal",
                    "vip" => "VIP",
                    "supervip" => "Super VIP",
                ];

                foreach ($arrayReserva as $fila => $reserva) {
                    $claseEstado = $reserva['estado_reserva'];
                    $id_reserva = $reserva['id_reserva'];
                    $email = $reserva['email'];
                    $tipo_reserva = $tipos_reservas[$reserva['tipo_reserva']];
                    $tipo_Hab = $reserva['tipo_Hab'];
                    $habitacion = $reserva['habitacion'];
                    $date = new DateTime($reserva['fecha_inicio']);
                    $fecha_inicio = $date->format('d/m/Y');
                    $date = new DateTime($reserva['fecha_final']);
                    $fecha_final = $date->format('d/m/Y');
                    $Precio_Total = number_format($reserva['Precio_Total'], 2, ',', ' ');
                    echo "<tr>";

                    echo "<td class='$claseText[$claseEstado]'> $claseEstado</td>";
                    echo "<td> $email </td>";
                    echo "<td>";
                    echo "<table class='display table table-striped table-bordered'><tbody>";
                    foreach ($arrayMascotasReserva as $FilaMascota => $arrayMascota) {
                        $nombre_mascota = $arrayMascota['nombre'];
                        $id_mascota = $arrayMascota['id_mascota'];
                        $tipo_mascota = $arrayMascota['tipo'];
                        echo "<tr>";
                        echo "<td><a class='btn btn-light w-100' href='$id_mascota'><i class='$claseIconSVG_Mascota[$tipo_mascota]'></i> $nombre_mascota</a> </td>";
                        echo "</tr>";
                    }
                    echo "</tbody></table>";
                    echo "</td>";
                    echo "<td> $Precio_Total € </td>";
                    echo "<td> $tipo_reserva </td>";
                    echo "<td> $tipo_Hab </td>";
                    echo "<td> $habitacion </td>";
                    echo "<td> $fecha_inicio </td>";
                    echo "<td> $fecha_final</td>";

                    echo "</tr>";
                }
                ?>
            </tbody>
            <tfoot class="bg-primary">
                <tr>
                    <th>RS</th>
                    <th>Email</th>
                    <th>Mascota/s</th>
                    <th>Precio Total</th>
                    <th>Tipo RS</th>
                    <th>T. Habitacion</th>
                    <th>Habitacion</th>
                    <th>Fech. Inicio</th>
                    <th>Fech. Final</th>
                </tr>
            </tfoot>
        </table>
    </div>
    </div>
    <div id="ErrorCambioEstado" class="modal fade bd-example-modal-lg  " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content ">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title" id="memberModalLabel">ERROR</h4>
                </div>
                <div class="modal-body">
                    <h3 class="text-danger">Ha ocurrido un error al cambiar el estado</h3>
                </div>
                <div class="modal-footer ">
                    <div class="row container justify-content-end">
                        <button type="button" class="col-md-auto btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="CorrectoCambioEstado" class="modal fade modal-full-screen">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content ">
                <div class="modal-header bg-success">
                    <h4 class="modal-title" id="memberModalLabel">CAMBIO DE ESTADO</h4>
                </div>
                <div class="modal-body">
                    <h3 class="text-success">Se ha cambiado el estado</h3>
                </div>
                <div class="modal-footer ">
                    <div class="row container justify-content-end">
                        <button type="button" class="col-md-auto btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="myModal" class="modal fade bd-example-modal-lg  " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content ">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title" id="memberModalLabel">CAMBIAR ESTADO</h4>
                </div>
                <div class="modal-body">
                    <h3>Estas seguro de cambiar el estado???</h3>
                </div>
                <div class="modal-footer ">
                    <div class="row container justify-content-end">
                        <?php
                        if (isset($_GET['RS'])) {
                            $rs_get = $_GET['RS'];
                            $serv = htmlentities($_SERVER['PHP_SELF']);
                            $actionGet = $serv . "?RSupdate=" . $rs_get;
                            console_log($actionGet);

                            echo "<form action='$actionGet' method='post'>";
                            echo "<button type='submit' id='NewEstado' name='NewEstado' value='' class=''>SEGURO</button>";
                            echo "<button type='button' class='col btn btn-primary' data-dismiss='modal'>Close</button>";
                            echo "</form>";
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> -->
    <!--Talvez borrar-->
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


    <script type="text/javascript">
        $(document).ready(function() {
            //shortcut for $(document).ready
            $(function() {
                if (window.location.hash) {
                    var hash = window.location.hash;
                    console.log($(hash).modal('show'));
                    if (hash != "myModal")
                        $(hash).modal('show');
                }
            });
            var newEstado = "nuevo";
            var table = $('#tabla_RS').DataTable({
                dom: "t",
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
                },
                responsive: true
            });
            $(".botonEstado").click(function() {
                event.preventDefault()
                event.stopPropagation()
                newEstado = this.value;
                console.log(newEstado);
                $("#NewEstado").removeClass();
                var claseBtn = {
                    "en espera": "btn btn-secondary col ",
                    "en progreso": "btn btn-success col",
                    "finalizado": "btn btn-info col",
                    "abandonado": "btn btn-danger col",
                    "cancelado": "btn btn-warning col"
                };
                $("#NewEstado").addClass(claseBtn[newEstado]);
                $("#NewEstado").val(newEstado);
                $('#myModal').modal('show');
            });
        });
    </script>
</body>

</html>
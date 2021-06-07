<?php
//Rodrigo Cano
function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}
function limpiarCampo($campoformulario) {
	$campoformulario = trim($campoformulario); //elimina espacios en blanco por izquierda/derecha
	$campoformulario = stripslashes($campoformulario); //elimina la barra de escape "\", utilizada para escapar caracteres
	$campoformulario = htmlspecialchars($campoformulario);  
	return $campoformulario;  
}
require_once("../db/db.php");
require_once("../models/reservaHabitacion_model.php");
$id_cliente="B7ZOJEpKsu0PO";
//Poner errores aqui
$error_Mensaje = "";
$todo_Correcto = "";
try {
    
    $arrayMascotas=getAllMascotas($id_cliente);
    if (count($arrayMascotas)==0) 
        throw new Exception("No se han encontrado mascotas");

    $arrayTipoHabitaciones=getAllTipoHabitaciones();
    if (count($arrayTipoHabitaciones)==0) 
        throw new Exception("No se han encontrado los tipos de habitaciones");

    $arrayTipoServicios=getAllTipoServicio();
    if (count($arrayTipoServicios)==0) 
        throw new Exception("No se han encontrado los tipos de servicio");
    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {//Se obtiene los datos
        if (isset($_POST['reserva'])) {

            $tipoReserva = limpiarCampo($_POST["tipoReserva"]);

            if ($_POST["datoEntrada"]=="" || $_POST["datoSalida"]=="") 
                throw new Exception("No se ha introducido fechas");
            if (!isset($_POST['mascotas'])) 
                throw new Exception("No se ha seleccionado ninguna mascota");
            
            $datoEntrada = str_replace("/","-",$_POST["datoEntrada"]);
            
            $datoSalida = str_replace("/","-",$_POST["datoSalida"]);

            $tipoHabitacion = limpiarCampo($_POST["tipoHabitacion"]);
            
            
            $mascotas = $_POST["mascotas"];

            $hoy=date("Y-m-d");//Crear en reserva fecha de reserva -------------------------------------------
            //Crear precio en reserva -------------------------------------------

            //Convierte las fechas a formato Y-m-d H:i:s
            $dateEntrada=date("Y-m-d",strtotime($datoEntrada));
            $dateSalida=date("Y-m-d", strtotime($datoSalida));


                
                if($hoy < $dateEntrada && $dateEntrada < $dateSalida){
                    $dteStart = new DateTime($dateEntrada);
                    $dteEnd   = new DateTime($dateSalida);

                    $diferecia  = $dteStart->diff($dteEnd);

                    $diasDireferencia= $diferecia->days;//Esto da la diferencias entre dos fechas en dias
                    

                    $precio_noche_habitacion=0;

                    foreach ($arrayTipoHabitaciones as $Fila => $arrayTipo) {
                        $tipo_Hab= $arrayTipo['tipo_Hab'];
                        if($tipo_Hab == $tipoHabitacion)
                            $precio_noche_habitacion=$arrayTipo['precio_noche'];
                    }
                    $precio_noche_servicio=0;
                    foreach ($arrayTipoServicios as $Fila => $arrayTipo) {
                        $tipo_reserva= $arrayTipo['tipo'];
                        if($tipo_reserva == $tipoReserva)
                            $precio_noche_servicio=$arrayTipo['precio_noche'];
                    }
                    if($precio_noche_habitacion==0 || $precio_noche_servicio==0)
                        throw new Exception("El tipo de habitacion o de servicio es incorrecta");

                    $Precio_Total= $diasDireferencia * ($precio_noche_habitacion + $precio_noche_servicio);


                    $hoy=date("Y-m-d H:i:s");
                    $correcto = controlador_reservaHabitacionMascotas($datoEntrada, $datoSalida ,$id_cliente, $tipoReserva, $mascotas, $dateEntrada, $dateSalida, $hoy,$tipoHabitacion, $Precio_Total);
                    $todo_Correcto="La reserva se ha creado correctamente";
                }
                else throw new Exception("Las fecha de entrada tiene que ser anterior a la fecha de salida y posterior a hoy");
        }
    }  
} catch (\Throwable $th) {
    $error_Mensaje = "Error: " . $th->getMessage();
}
require_once("../views/reservaHabitacion_view.php");

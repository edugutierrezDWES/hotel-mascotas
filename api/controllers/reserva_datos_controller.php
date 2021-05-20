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
require_once("../db/db.php");
require_once("../models/reservas_info_model.php");
$id_usuario="B7ZOJEpKsu0PO";
$email_usuario="akagami.no@gmail.com";
$rol_usuario="admin";
//Poner errores aqui
$error_Mensaje = "";
$arrayReserva=[];//Tabla de la reserva
$arrayMascotasReserva=[];//Tabla de la reserva
try {
    
    if (isset($_GET['RS'])){
        $id_reserva=$_GET['RS'];
        console_log($id_reserva);
        if($rol_usuario=="admin"){
            $arrayReserva=ReservaInfo($id_reserva);
            if(count($arrayReserva)==0)
                throw new Exception("La Reserva no existe");
        }
        elseif($rol_usuario=="cliente"){
            $arrayReserva = ReservaInfoCliente($id_usuario, $id_reserva);
            //else no tiene permisos
        }
        if(count($arrayReserva)!=0){
            $arrayMascotasReserva = getAllMascotaReserva($id_reserva);
        }
        
    }
    if (isset($_GET['RSupdate']) && isset($_POST['NewEstado'])){
        $actionGet=$serv."?RS=".$id_reserva."#ErrorCambioEstado";
        $id_reserva=$_GET['RSupdate'];
        $NewEstado = $_POST['NewEstado'];
        console_log($id_reserva);
        console_log($NewEstado);
        $serv=htmlentities($_SERVER['PHP_SELF']); //ruta y archivo actual
        $arrayReserva=ReservaInfo($id_reserva);
        if(count($arrayReserva)!=0){
            
            $OldEstado=$arrayReserva[0]['estado_reserva'];
            
            $posiblesCambios = [
                "en espera" => ["cancelado","abandonado", "en progreso"],
                "en progreso" => ["finalizado","abandonado"],
            ];
            $cambiosPermisos = [
                //No se puede cambiar el estado a 'en espera'
                //"en espera" => ['admin'],
                "en progreso" => ["admin"],
                "finalizado" => ["admin"],
                "abandonado" => ["admin"],
                "cancelado" => ["admin","cliente"]
            ];
            $hoy = date("Y-m-d");
            $fecha_Fin=date($arrayReserva[0]['fecha_final']);
            if(array_key_exists($OldEstado, $posiblesCambios) && in_array($NewEstado,$posiblesCambios[$OldEstado]) && in_array($rol_usuario,$cambiosPermisos[$NewEstado]) && !($NewEstado == "finalizado" && $hoy < $fecha_Fin)){

                if($rol_usuario=="admin"){
                    $correcto = Update_EstadoReserva_Admin($id_reserva, $NewEstado);
                }
                elseif($rol_usuario=="cliente"){
                    $correcto = Update_EstadoReserva_Cliente($id_reserva, $id_usuario, $NewEstado);
                }
                console_log($correcto);
                if($correcto){
                    //Redirige a la reserva
                    $actionGet=$serv."?RS=".$id_reserva."#CorrectoCambioEstado";
                }   
                
            }

        }

        
        header("location: $actionGet");
    }
        
 
    
} catch (\Throwable $th) {
    $error_Mensaje = "Error: " . $th->getMessage();
}

require_once("../views/reservas_datos_view.php");
?>
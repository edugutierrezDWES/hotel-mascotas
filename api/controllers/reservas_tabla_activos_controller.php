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
require_once("../models/reservas_tabla_resumen.php");
$id_usuario="B7ZOJEpKsu0PO";
$email_usuario="akagami.no@gmail.com";
$rol_usuario="admin";
//Poner errores aqui
$error_Mensaje = "";
$arrayReservasActivas=[];//Tabla de las reservas
try { 
    if($rol_usuario=="admin")
        $arrayReservasActivas=getAllReservasActivas();
    elseif($rol_usuario=="cliente")
        $arrayReservasActivas=getAllReservasActivasCliente($email_usuario);
} catch (\Throwable $th) {
    $error_Mensaje = "Error: " . $th->getMessage();
}

require_once("../views/reservas_tabla_activos_view.php");
?>
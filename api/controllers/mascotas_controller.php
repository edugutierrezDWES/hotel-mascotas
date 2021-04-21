<?php
require_once("models/mascotas_model.php");

$respuesta;
switch($_SERVER['REQUEST_METHOD']){
    case 'GET':
        if(isset($_GET['id_usuario'])){
            $respuesta = getAllMascotas($_GET['id_usuario']);
        } else {
            $respuesta = array("message"=>"No se han encontrado mascotas para este cliente");
        }
        echo json_encode($respuesta);
        break;

    case 'POST':
    
        $mascota = json_decode(file_get_contents('php://input'), true);
        $respuesta = saveMascota($mascota);
        echo json_encode($respuesta);
        break;


            
    default:
        $respuesta = array("message"=>"No se han encontrado clientes");
        echo json_encode($respuesta);
        break;    
}

?>
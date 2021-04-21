<?php
require_once("models/clientes_model.php");

$respuesta;
switch($_SERVER['REQUEST_METHOD']){
    case 'GET':
        $respuesta = getAllUsers();
        echo json_encode($respuesta);
        break;

    case 'POST':
        $usuario = json_decode(file_get_contents('php://input'), true);
        $respuesta = saveUser($usuario);
        echo json_encode($respuesta);
        break;
            
    default:
        $respuesta = array("message"=>"No se han encontrado clientes");
        echo json_encode($respuesta);
        break;    
}

?>
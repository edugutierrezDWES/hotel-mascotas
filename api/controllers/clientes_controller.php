
<?php
require_once("models/clientes_model.php");

$respuesta;
switch($_SERVER["REQUEST_METHOD"]){
    case 'GET':
        if(isset($_GET["id_get"])){
            echo "Se va a obteener el cliente con ID:".$_GET["id_get"];
        }  else if(isset($_GET["id_delete"])){
            echo "Se va a eliminar el cliente con ID:".$_GET["id_delete"];
        } else if(isset($_GET["id_editform"])){

            echo "Mostrar tabla para editar al cliente con con ID:".$_GET["id_editform"];
            require("views/editform.php");
        } else if(isset($_GET["id_edit"])){
            echo "Se ha editado el cliente con ID: ".$_GET["id_edit"];
        } else {
            $respuesta = getAllUsers();
            require_once("views/clientes_view.php");
        }
        break;

    case 'POST':
        if(isset($_GET["id_edit"])){
            echo "Se va a actualizar  el cliente con ID:".$_GET["id_edit"];
        } else {
            if(isset($_POST)){
                $nombre =$_POST["nombre"] ;
                $apellidos = $_POST["apellidos"];
                $email = $_POST["email"];
                $pass = $_POST["pass"];
                $confirmpass = $_POST["confirmpass"];
                $rol = "cliente";

                if($pass==$confirmpass){

                    $usuario = array(
                        "nombre"=>$nombre,
                        "apellidos"=>$apellidos,
                        "email"=>$email,
                        "pass"=>$pass,
                        "rol"=>$rol);
            
                        $respuesta = saveUser($usuario);
                        var_dump($respuesta);

                } else {

                    var_dump("Revisar contraseñas que coincidan");

                 }    
            }
        } 
        break;
    }

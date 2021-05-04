
<?php
require_once("views/usuarios/usuarios_header_view.php");
require_once("models/usuarios_model.php");

$respuesta;
    switch($_SERVER["REQUEST_METHOD"]){
        case 'GET':

        if(isset($_SESSION["rol"]) && $_SESSION["rol"]=="admin"){
            if(isset($_GET["id_get"])){
                echo "Se va a obteener el cliente con ID:".$_GET["id_get"];
            }  else if(isset($_GET["id_delete"])){
                echo "Se va a eliminar el cliente con ID:".$_GET["id_delete"];
            } else if(isset($_GET["id_editform"])){
                echo "Mostrar tabla para editar al cliente con con ID:".$_GET["id_editform"];
                require_once("views/usuarios/usuarios_editform_view.php");
            } else if(isset($_GET["id_edit"])){
                echo "Se ha editado el cliente con ID: ".$_GET["id_edit"];
            } else {
                $respuesta = getAllUsers();
                require_once("views/usuarios/usuarios_view.php");     
            }
        } else echo "No tienes permisos para ver todos los clientes";
           
            break;
    
        case 'POST':
            if(isset($_GET["id_edit"])){
                if(isset($_POST)){
 
                    $id = $_GET["id_edit"];
                    $nombre = $_POST["nombre"] ;
                    $apellidos = $_POST["apellidos"];
                    $pass = $_POST["pass"];
                    $newpass = $_POST["newpass"];
                    $confirmpass = $_POST["confirmpass"];
                    
                    $usuario = array(
                        "id_usuario" => $id,
                        "nombre" => trim(strtolower($nombre)),
                        "apellidos" => trim(strtolower($apellidos)),
                        "pass" => $pass,
                        "confirmpass" => $confirmpass,
                        "newpass" => $newpass);

                     if(isset(validarCamposEditar($usuario)["changepass"]) && validarCamposEditar($usuario)["changepass"]==true){
                       
                        $respuesta = updateUserandPass($usuario);
                        if($respuesta) header("location: /hotelmascotasmvc/login");
                        else header("location: /hotelmascotasmvc/sadpuppy");

                    } else if(!isset(validarCamposEditar($usuario)["changepass"]) && validarCamposEditar($usuario)) {

                        $respuesta = updateUser($usuario);
                        if($respuesta) header("location: /hotelmascotasmvc/login");
                        else header("location: /hotelmascotasmvc/sadpuppy");

                    } else header("location: /hotelmascotasmvc/sadpuppy"); 
                }
               
            } else {
                if(isset($_POST)){
    
                    if(isset($_POST["login"])){
    
                        $email = $_POST["email"];
                        $pass = $_POST["pass"];

                        $respuesta = checkEmailandPass($email,$pass);
                        if($respuesta!=null && !isset($respuesta["error"])) login($respuesta);
                        else  header("location: login?login=false");
    
                    } else {
    
                        $nombre = $_POST["nombre"] ;
                        $apellidos = $_POST["apellidos"];
                        $email = $_POST["email"];
                        $pass = $_POST["pass"];
                        $confirmpass = $_POST["confirmpass"];
                        $rol = "cliente";

                        $usuario = array(
                            "nombre" => $nombre,
                            "apellidos" => $apellidos,
                            "email" => $email,
                            "pass" => $pass,
                            "confirmpass" => $confirmpass,
                            "rol" => $rol);

                            var_dump(validarCampos($usuario));

                         if(validarCampos($usuario)){

                            $respuesta = saveUser($usuario); 
                           
                            if(!isset($respuesta["error"]))  login($respuesta);
                            else  header("location: register?registered=false"); 
    
                        } else header("location: register?registered=false");
                    }
                }
            } 
        break;
    }
    require_once("views/usuarios/usuarios_footer_view.php");
    ?>








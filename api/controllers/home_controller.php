<?php
if(isset($_SESSION) && !empty($_SESSION)){


  $id = $_SESSION["id_usuario"];
  $nombre = $_SESSION["nombre"];
  $apellidos = $_SESSION["apellidos"];
  $email = $_SESSION["email"];
  $fecha_alta = $_SESSION["fecha_alta"];

require_once("views/home/home_header_view.php");

if(isset($_GET["edit"]) && $_GET["edit"]=="true"){
    require_once("views/home/home_edit_view.php");
} else {
    require_once("views/home/home_main_view.php");
}

require_once("views/home/home_footer_view.php");

} else header("location: login");


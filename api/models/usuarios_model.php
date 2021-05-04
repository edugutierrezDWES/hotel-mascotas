<?php

function getAllUsers() {

    global $conexion;
	try {
		$consulta = $conexion->prepare("SELECT * FROM usuario");
		$consulta->execute();
		return $consulta->fetchAll(PDO::FETCH_ASSOC); # Si falla, devuelve NULL por defecto

	} catch (PDOException $ex) {
		return array("error"=>$ex->getMessage());
	}
} 


function saveUser($usuario) {

    $id = uniqid("id", true);
    $password = password_hash($usuario["pass"], PASSWORD_DEFAULT);
    $fecha = date("Y-m-d");
    global $conexion;
	try {
		$conexion->beginTransaction();

		$insertarUsuario = $conexion->prepare("INSERT INTO usuario (id_usuario, nombre, apellidos, email, pass, fecha_alta, fecha_baja, rol) 
        VALUES (:id_usuario, :nombre, :apellidos, :email, :pass, :fecha_alta, NULL, :rol)");
        $insertarUsuario->bindParam(':id_usuario', $id);
		$insertarUsuario->bindParam(':nombre', $usuario["nombre"]);
		$insertarUsuario->bindParam(':apellidos', $usuario["apellidos"]);
        $insertarUsuario->bindParam(':email', $usuario["email"]);
        $insertarUsuario->bindParam(':rol', $usuario["rol"]);
        $insertarUsuario->bindParam(':pass', $password);
        $insertarUsuario->bindParam(':fecha_alta', $fecha);
        $insertarUsuario->execute();

        $conexion->commit();

		$consulta = $conexion->prepare("SELECT * FROM usuario where id_usuario = :id_usuario");
		$consulta->bindParam(":id_usuario", $id);
		$consulta->execute();
		$user = $consulta->fetch(PDO::FETCH_ASSOC); 

        return $user;

	} catch (PDOException $ex) {
		return array("error"=>$ex->getMessage());
	}
}


function checkEmailandPass($email,$pass){


	global $conexion;
	try {
		$consulta = $conexion->prepare("SELECT * FROM usuario WHERE email = :email");
		$consulta->bindParam(':email', $email);
		$consulta->execute();
		$usuario =  $consulta->fetch(PDO::FETCH_ASSOC);
	    return password_verify($pass, $usuario["pass"])? $usuario : null;
		# Si falla, devuelve NULL por defecto

	} catch (PDOException $ex) {
		return array("error"=>$ex->getMessage());
	}

}

function login($usuario){

	$_SESSION["id_usuario"] = $usuario["id_usuario"];
	$_SESSION["nombre"] = $usuario["nombre"];
	$_SESSION["apellidos"] = $usuario["apellidos"];
	$_SESSION["email"] = $usuario["email"];
	$_SESSION["fecha_alta"] = $usuario["fecha_alta"];
	$_SESSION["fecha_baja"] = $usuario["fecha_baja"];
	$_SESSION["pass"] = $usuario["pass"];
	$_SESSION["rol"] = $usuario["rol"];
    header("location: home");
} 

function validarCampos($usuario){

	$nombre = preg_match('/^[a-záéíóúñ][a-záéíóúñüªº\-\.\s]+[a-záéíóúñ\.]$/i',$usuario["nombre"]);
	$apellidos = preg_match('/^[a-záéíóúñ][a-záéíóúñüªº\-\.\s]+[a-záéíóúñ\.]$/i',$usuario["apellidos"]);
	$email = preg_match('/^[a-z][a-z_\.\-0-9\S]+@[a-z\.\S]+.[a-z]+$/i',$usuario["email"]);
	$pass = preg_match('/^[a-záéíóúñA-ZÁÉÍÓÚÑ0-9\S][a-záéíóúñA-ZÁÉÍÓÚÑ0-9\S]{6,60}[a-záéíóúñA-ZÁÉÍÓÚÑ0-9\S]$/i',$usuario["pass"]);
    $confirmpass = $usuario["pass"] == $usuario["confirmpass"];
    
	return $nombre && $apellidos && $email && $pass && $confirmpass;

}

function validarCamposEditar($usuario){

	$nombre = preg_match('/^[a-záéíóúñ][a-záéíóúñüªº\-\.\s]+[a-záéíóúñ\.]$/i',$usuario["nombre"]);
	$apellidos = preg_match('/^[a-záéíóúñ][a-záéíóúñüªº\-\.\s]+[a-záéíóúñ\.]$/i',$usuario["apellidos"]);
	$pass = password_verify($usuario["pass"],$_SESSION["pass"]);
	$newpass = preg_match('/^[a-záéíóúñA-ZÁÉÍÓÚÑ0-9\S][a-záéíóúñA-ZÁÉÍÓÚÑ0-9\S]{6,60}[a-záéíóúñA-ZÁÉÍÓÚÑ0-9\S]$/i',$usuario["newpass"]);
    $confirmpass = $usuario["newpass"] == $usuario["confirmpass"];

	if($usuario["pass"] != ""  && $usuario["newpass"] != "" && $usuario["confirmpass"] != ""){
		return array("changepass"=>$nombre && $apellidos && $newpass && $pass && $confirmpass);
	  }else if($usuario["pass"] == "" && $usuario["newpass"] == "" && $usuario["confirmpass"] == "")
	    return $nombre && $apellidos;
	  else false; 

}

function updateUserandPass($usuario) {

	$newpass = password_hash($usuario["newpass"], PASSWORD_DEFAULT);
	$nombre = formatearNombres($usuario["nombre"]);
	$apellidos = formatearNombres($usuario["apellidos"]);


	global $conexion;
		try {
			$actualizarUsuario = $conexion->prepare("UPDATE usuario SET nombre = :nombre, apellidos = :apellidos, pass = :newpass WHERE id_usuario = :id_usuario");
			$actualizarUsuario->bindParam(":id_usuario", $usuario["id_usuario"]);
			$actualizarUsuario->bindParam(":nombre", $nombre);
			$actualizarUsuario->bindParam(":apellidos", $apellidos);
			$actualizarUsuario->bindParam(":newpass", $newpass);
			$actualizarUsuario->execute();
            
			$consulta = $conexion->prepare("SELECT * FROM usuario where id_usuario:id_usuario");
			$consulta->bindParam(":id_usuario", $usuario["id_usuario"]);
			$consulta->execute();
			$updatedUser = $consulta->fetch(PDO::FETCH_ASSOC); 
			login($updatedUser);
			return true;

				
		} catch (PDOException $ex) {
			return array("error"=>$ex->getMessage());
	    }
}

function updateUser($usuario) {

	$nombre = formatearNombres($usuario["nombre"]);
	$apellidos = formatearNombres($usuario["apellidos"]);

	global $conexion;
		try {
			$actualizarUsuario = $conexion->prepare("UPDATE usuario SET nombre = :nombre, apellidos = :apellidos WHERE id_usuario = :id_usuario");
			$actualizarUsuario->bindParam(":id_usuario", $usuario["id_usuario"]);
			$actualizarUsuario->bindParam(":nombre", $nombre);
			$actualizarUsuario->bindParam(":apellidos",$apellidos);
			$actualizarUsuario->execute();
            
			$consulta = $conexion->prepare("SELECT * FROM usuario where id_usuario:id_usuario");
			$consulta->bindParam(":id_usuario", $usuario["id_usuario"]);
			$consulta->execute();
			$updatedUser = $consulta->fetch(PDO::FETCH_ASSOC); 

			login($updatedUser);
			return true;

				
		} catch (PDOException $ex) {
			return array("error"=>$ex->getMessage());
	    }

}


function formatearNombres($nombres){

	$nombreFinal = array();
	if(strpos($nombres, " ")!=false){

		$nombres = explode(" ", $nombres);
		foreach($nombres as $nombre){
			array_push($nombreFinal, ucfirst($nombre));
		}

		return implode(" ",$nombreFinal);
	} else return ucfirst($nombres);
}

?>
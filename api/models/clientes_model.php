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
		$usuario["id_usuario"]=$id;
		$usuario["fecha_alta"]=$fecha;

        return $usuario;

	} catch (PDOException $ex) {
		return array("error"=>$ex->getMessage());
	}
}

?>
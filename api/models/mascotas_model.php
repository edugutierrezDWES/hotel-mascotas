<?php

function getAllMascotas($id_usuario) {

    global $conexion;
	try {
		$consulta = $conexion->prepare("SELECT * FROM mascota WHERE id_usuario=:id_usuario");
        $consulta->bindParam(':id_usuario', $id_usuario);
		$consulta->execute();
		return $consulta->fetchAll(PDO::FETCH_ASSOC); # Si falla, devuelve NULL por defecto

	} catch (PDOException $ex) {
		return array("error"=>$ex->getMessage());
	}
} 


function saveMascota($mascota) {

    $id = uniqid("id", true);
    $id_usuario = 'id608091a07dc737.78829314';
    global $conexion;
	try {
		$conexion->beginTransaction();

		$insertarMascota = $conexion->prepare("INSERT INTO mascota (id_mascota, nombre, tipo, raza, descripcion, id_usuario) 
        VALUES (:id_mascota, :nombre, :tipo, :raza, :descripcion, :id_usuario)");
      
        $insertarMascota->bindParam(':id_mascota', $id);
		$insertarMascota->bindParam(':nombre', $mascota["nombre"]);
		$insertarMascota->bindParam(':tipo', $mascota["tipo"]);
        $insertarMascota->bindParam(':raza', $mascota["raza"]);
        $insertarMascota->bindParam(':descripcion', $mascota["descripcion"]);
        $insertarMascota->bindParam(':id_usuario', $id_usuario);
 
        $insertarMascota->execute();

        $conexion->commit();
        return array("created"=>true);

	} catch (PDOException $ex) {
		return array("error"=>$ex->getMessage());
	}
}

?>
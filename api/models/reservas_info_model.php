<?php
function ReservaInfo($id_reserva){
    # Función 'ReservaInfo'. 
	# Parámetros: 
	#
	# -$id_reserva
	#
	# Funcionalidad:
	# Busca una reserva
	#
	# Retorna: reserva encontrada
	#
	#  Código por Rodrigo Cano
    global $conexion;
    $hoy = date("Y-m-d");
    $consulta = $conexion->prepare("SELECT * FROM view_reserva_datoscompletos 
	WHERE id_reserva = :id_reserva ");
    $consulta->bindParam(':id_reserva', $id_reserva);
	$consulta->execute();
	return $consulta->fetchAll(PDO::FETCH_ASSOC);
}
function ReservaInfoCliente($id_usuario, $id_reserva){
    # Función 'ReservaInfo'. 
	# Parámetros: 
	# -$id_usuario 
	# -$id_reserva
	# 
	#
	#Funcionalidad:
	# Busca una reserva
	#
	# Retorna: reservas encontradas
	#
	#  Código por Rodrigo Cano
    global $conexion;
    $hoy = date("Y-m-d");
    $consulta = $conexion->prepare("SELECT * FROM view_reserva_datoscompletos 
	WHERE id_reserva = :id_reserva AND id_usuario = :id_usuario ");
    $consulta->bindParam(':id_usuario', $id_usuario);
	$consulta->bindParam(':id_reserva', $id_reserva);
	$consulta->execute();
	return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

function getAllMascotaReserva($id_reserva){
    # Función 'getAllMascotaReserva'. 
	# Parámetros: 
	#
	# -$id_reserva
	#
	# Funcionalidad:
	# Busca las mascotas de una reserva
	#
	# Retorna: todas las reservas
	#
	#  Código por Rodrigo Cano
    global $conexion;
    $consulta = $conexion->prepare("SELECT * FROM view_reserva_mascota_info
	WHERE id_reserva = :id_reserva");
	$consulta->bindParam(':id_reserva', $id_reserva);
	$consulta->execute();
	return $consulta->fetchAll(PDO::FETCH_ASSOC);
}
function Update_EstadoReserva_Cliente($id_reserva, $id_usuario, $new_Estado){
    # Función 'Reserva una habitacion'. 
	# Parámetros: 
    #   - $id_reserva
	# 	- $id_usuario
	# 	- $new_Estado
	#
	# Funcionalidad:
	# Cambia el estado de una reserva perteneciente al usuario
	#
	# Retorna: True en caso de que hizo correctamente / False si hubo algun error en el proceso.
	#
	#  Código por Rodrigo Cano
	global $conexion;
	try {
        $updateEstadoReserva  = $conexion->prepare("UPDATE reserva AS rs
		INNER JOIN reserva_mascota AS r_m
		ON rs.id_reserva = r_m.id_reserva 
		INNER JOIN mascota AS m
		ON r_m.id_mascota = m.id_mascota
		SET rs.estado = :new_Estado
		WHERE m.id_usuario LIKE :id_usuario
		AND rs.id_reserva LIKE :id_reserva");
        $updateEstadoReserva->bindParam(':id_reserva', $id_reserva);
        $updateEstadoReserva->bindParam(':id_usuario', $id_usuario);
		$updateEstadoReserva->bindParam(':new_Estado', $new_Estado);
        $updateEstadoReserva->execute();
        return true;
    }
	catch(PDOException $e)
	{
		return false;
	}
}
function Update_EstadoReserva_Admin($id_reserva, $new_Estado){
    # Función 'Reserva una habitacion'. 
	# Parámetros: 
    #   - $id_reserva
	# 	- $new_Estado
	#
	# Funcionalidad:
	# Cambia el estado de una reserva
	#
	# Retorna: True en caso de que hizo correctamente / False si hubo algun error en el proceso.
	#
	#  Código por Rodrigo Cano
	global $conexion;
	try {
        $updateEstadoReserva  = $conexion->prepare("UPDATE reserva AS rs
		SET rs.estado = :new_Estado
		WHERE rs.id_reserva LIKE :id_reserva");
        $updateEstadoReserva->bindParam(':id_reserva', $id_reserva);
		$updateEstadoReserva->bindParam(':new_Estado', $new_Estado);
        $updateEstadoReserva->execute();
        return true;
    }
	catch(PDOException $e)
	{
		return false;
	}
}
?>
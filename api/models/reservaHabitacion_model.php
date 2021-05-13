<?php
function controlador_reservaHabitacionMascotas($datoEntrada, $datoSalida, $id_cliente, $tipoReserva, $mascotas, $dateEntrada, $dateSalida, $hoy, $tipoHabitacion, $Precio_Total){
    # Función 'Reserva una habitacion'. 
	# Parámetros: 
	# 	- $id_cliente
    #   - $tipoReserva
    #   - $mascotas
    #   - $dateEntrada
    #   - $dateSalida
    #   - $hoy
    #   - $tipoHabitacion 
    #   - $Precio_Total
	#
	#
	# Funcionalidad:
	# Controla la creacion de las reservas y gestiona los errores
	#
	# Retorna: True en caso de que hizo correctamente / False si hubo algun error en el proceso.
	#
	#  Código por Rodrigo Cano
    
    
	global $conexion;
    $conexion->beginTransaction();

    $habitaciones_libres = obtener_Habitacion($dateEntrada, $dateSalida, $tipoHabitacion);

    if (count($habitaciones_libres)==0)
        throw new Exception("No se encuantras habitaciones de tipo $tipoHabitacion libres entre $datoEntrada a  $datoSalida");
    $id_habitacion = $habitaciones_libres[0]['id_hab'];
        

    foreach ($mascotas as $fila => $id_mascota) {
        $mascota_libre = mascota_libre($dateEntrada, $dateSalida, $id_mascota);
        if (!$mascota_libre)
            throw new Exception("Una o varias de las mascotas ya tiene una reserva");
    }
    $id_reserva = uniqid("RS_", true);
    
    $correcto = reservaHabitacionMascotas($id_reserva, $hoy, $tipoReserva, $dateEntrada, $dateSalida, $Precio_Total);
    if (!$correcto)
        throw new Exception("Error en la creacion de la reserva");

    $correcto= relacion_Reserva_Habitacion($id_reserva, $id_habitacion);
    if (!$correcto)
        throw new Exception("Error en la habitacion");

    foreach ($mascotas as $fila => $id_mascota) {
        $correcto= relacion_Reserva_Mascota( $id_reserva, $id_mascota);
        if (!$correcto)
            throw new Exception("Error en la mascota");
    }

    $conexion->commit();
}


function reservaHabitacionMascotas($id_reserva, $hoy, $tipoReserva, $dateEntrada, $dateSalida, $Precio_Total){   
    # Función 'Reserva una habitacion'. 
	# Parámetros: 
    # 	- $id_reserva
	# 	- $hoy
    #   - $tipoReserva
    #   - $dateEntrada
    #   - $dateSalida
    #   - $Precio_Total
	#
	# Funcionalidad:
	# Crea una reserva
	#
	# Retorna: True en caso de que hizo correctamente / False si hubo algun error en el proceso.
	#
	#  Código por Rodrigo Cano
    
    
	global $conexion;
	try {
        $insertReserva = $conexion->prepare("INSERT INTO reserva 
        (id_reserva , fecha_reserva, tipo, fecha_inicio,fecha_final, Precio_Total)
        VALUES (:id_reserva, :fecha_reserva, :tipoReserva, :fecha_entrada, :fecha_salida, :Precio_Total)");
            
        $insertReserva->bindParam(':id_reserva', $id_reserva);
        $insertReserva->bindParam(':fecha_reserva', $hoy);
        $insertReserva->bindParam(':tipoReserva', $tipoReserva);
        $insertReserva->bindParam(':fecha_entrada', $dateEntrada);
        $insertReserva->bindParam(':fecha_salida', $dateSalida);
        $insertReserva->bindParam(':Precio_Total', $Precio_Total);

        $insertReserva->execute();
        return true;
    }
	catch(PDOException $e)
	{
		return false;
	}
}



function relacion_Reserva_Mascota( $id_reserva, $id_mascota){
    # Función 'Reserva una habitacion'. 
	# Parámetros: 
    #   - $id_reserva
	# 	- $id_mascota
	#
	#
	# Funcionalidad:
	# Crea la relacion entre la Reserva y la Mascota individual
	#
	# Retorna: True en caso de que hizo correctamente / False si hubo algun error en el proceso.
	#
	#  Código por Rodrigo Cano
	global $conexion;
	try {
        $reservaMascota  = $conexion->prepare("INSERT INTO reserva_mascota (id_reserva, id_mascota)
        VALUES ( :id_reserva, :id_mascota)");
        $reservaMascota->bindParam(':id_reserva', $id_reserva);
        $reservaMascota->bindParam(':id_mascota', $id_mascota);
        $reservaMascota->execute();
        return true;
    }
	catch(PDOException $e)
	{
		return false;
	}
}

function obtener_Habitacion($dateEntrada, $dateSalida, $tipoHabitacion){
    global $conexion;
    
		$consulta = $conexion->prepare("SELECT * FROM habitacion 
        WHERE tipo_Hab LIKE :tipoHabitacion AND id_hab NOT IN 
        (SELECT id_hab FROM reserva_habitacion WHERE id_reserva IN 
        (SELECT id_reserva FROM reserva WHERE (fecha_inicio <= :dateEntrada AND :dateEntrada < fecha_final) 
        OR (fecha_inicio < :dateSalida AND :dateSalida < fecha_final)
        )) ");
        $consulta->bindParam(':tipoHabitacion', $tipoHabitacion);
        $consulta->bindParam(':dateEntrada', $dateEntrada);
        $consulta->bindParam(':dateSalida', $dateSalida);
		$consulta->execute();
        $result = $consulta->fetchAll(PDO::FETCH_ASSOC);
        /*
        if (count($result)==0)
            throw new Exception("No hay habitaciones");
        */
		return $result; # Si falla, devuelve NULL por defecto
}

function relacion_Reserva_Habitacion($id_reserva, $id_habitacion){
    # Función 'relacion_Reserva_Habitacion'. 
	# Parámetros: 
	# 	- $id_reserva
    #   - $id_habitacion
	#
	#
	# Funcionalidad:
	# Crea la relacion entre la Reserva y la Habitacion individual
	#
	# Retorna: True en caso de que hizo correctamente / False si hubo algun error en el proceso.
	#
	#  Código por Rodrigo Cano
	global $conexion;
	try {
        $reservaHabitacion  = $conexion->prepare("INSERT INTO reserva_habitacion (id_reserva, id_hab)
        VALUES (:id_reserva, :id_habitacion)");
        $reservaHabitacion->bindParam(':id_reserva', $id_reserva);
        $reservaHabitacion->bindParam(':id_habitacion', $id_habitacion);
        $reservaHabitacion->execute();
        return true;
    }
	catch(PDOException $ex)
	{
		return false;
	}
}

function getAllMascotas($id_usuario) {

    global $conexion;

	$consulta = $conexion->prepare("SELECT * FROM mascota WHERE id_usuario= :id_usuario");
    $consulta->bindParam(':id_usuario', $id_usuario);
	$consulta->execute();
	return $consulta->fetchAll(PDO::FETCH_ASSOC); # Si falla, devuelve NULL por defecto


}
function getAllTipoHabitaciones() {

    global $conexion;
		
    $consulta = $conexion->prepare("SELECT * FROM tipo_habitacion");
	$consulta->execute();
	return $consulta->fetchAll(PDO::FETCH_ASSOC); # Si falla, devuelve NULL por defecto
}

function mascota_libre($dateEntrada, $dateSalida, $id_mascota){
    # Función 'relacion_Reserva_Habitacion'. 
	# Parámetros: 
	# 	- $dateEntrada
    #   - $dateSalida
    #   - $id_mascota
	#
	#
	# Funcionalidad:
	# Busca si una mascota individual tiene una reserva entre 2 fechas
	#
	# Retorna: True en caso de estar libre / False en caso de no estar libre
	#
	#  Código por Rodrigo Cano
    global $conexion;
    
		$consulta = $conexion->prepare("SELECT * FROM reserva INNER JOIN reserva_mascota 
        ON reserva.id_reserva = reserva_mascota.id_reserva 
        WHERE reserva_mascota.id_mascota LIKE :id_mascota 
        AND (fecha_inicio <= :dateEntrada AND :dateEntrada < fecha_final) 
        OR (fecha_inicio < :dateSalida AND :dateSalida < fecha_final)");
        $consulta->bindParam(':id_mascota', $id_mascota);
        $consulta->bindParam(':dateEntrada', $dateEntrada);
        $consulta->bindParam(':dateSalida', $dateSalida);
		$consulta->execute();
        $result = $consulta->fetchAll(PDO::FETCH_ASSOC);
        if (count($result)>0)
            return false;
		return true; 
}



?>
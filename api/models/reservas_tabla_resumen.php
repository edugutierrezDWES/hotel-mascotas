<?php
function getAllReservasActivas(){
    # Función 'getAllReservasActivas'. 
	# Parámetros: 
	#
	# Funcionalidad:
	# Busca reservas de hoy
	#
	# Retorna: reservas encontradas
	#
	#  Código por Rodrigo Cano
    global $conexion;
    $hoy = date("Y-m-d");
    $consulta = $conexion->prepare("SELECT * FROM view_reservas_resumen WHERE 
     :hoy BETWEEN fecha_inicio AND fecha_final");
    $consulta->bindParam(':hoy', $hoy);
	$consulta->execute();
	return $consulta->fetchAll(PDO::FETCH_ASSOC);
}
function getAllReservasActivasCliente($email_usuario){
    # Función 'getAllReservasActivas'. 
	# Parámetros: 
	#
	# Funcionalidad:
	# Busca reservas de activas de un cliente en concreto
	#
	# Retorna: reservas encontradas
	#
	#  Código por Rodrigo Cano
    global $conexion;
    $hoy = date("Y-m-d");
	//AND :hoy BETWEEN fecha_inicio AND fecha_final
    $consulta = $conexion->prepare("SELECT * FROM view_reservas_resumen WHERE email LIKE :email_usuario 
    :hoy <= fecha_inicio OR :hoy <= fecha_final ");
    $consulta->bindParam(':email_usuario', $email_usuario);
    $consulta->bindParam(':hoy', $hoy);
	$consulta->execute();
	return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

function getAllReservasHistorial(){
    # Función 'getAllReservasActivas'. 
	# Parámetros: 
	#
	# Funcionalidad:
	# Busca reservas de hoy
	#
	# Retorna: todas las reservas
	#
	#  Código por Rodrigo Cano
    global $conexion;
    $consulta = $conexion->prepare("SELECT * FROM view_reservas_resumen");
	$consulta->execute();
	return $consulta->fetchAll(PDO::FETCH_ASSOC);
}
function getAllReservasHistorialCliente($email_usuario){
    # Función 'getAllReservasActivas'. 
	# Parámetros: 
	#
	# Funcionalidad:
	# Busca todas las reservas de un cliente
	#
	# Retorna: reservas encontradas
	#
	#  Código por Rodrigo Cano
    global $conexion;
    $consulta = $conexion->prepare("SELECT * FROM view_reservas_resumen WHERE email LIKE :email_usuario ");
    $consulta->bindParam(':email_usuario', $email_usuario);
	$consulta->execute();
	return $consulta->fetchAll(PDO::FETCH_ASSOC);
}
?>
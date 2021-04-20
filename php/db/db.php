<?php 
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "hotelmascotas";

	try {
		$conexion = new PDO("mysql:host=$servername;dbname=$database", $username, $password); 	 	 	 	 	 	
		$conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
        echo "Conectado a la base de datos";	 	 	 	 	 	
	} catch (PDOException $ex) {
		echo $ex->getMessage(); 	 	 	 	 	 	
	}
?>
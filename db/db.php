<?php 
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "hotelmascotas";

	try {
		$conexion = new PDO("mysql:host=$servername;dbname=$database", $username, $password); 	 	 	 	 	 	
		$conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 	 	 	 	 	 	
	} catch (PDOException $ex) {
		echo $ex->getMessage(); 	 	 	 	 	 	
	}
?>
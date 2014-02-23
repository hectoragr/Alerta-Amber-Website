<?php

	require_once("conexion/database.php");

	$db = new Database();
 	$homoclave ="";
  	$nombre = $_POST["nombre"];
  	$apellidos = "";
  	$genero = $_POST["genero"];
  	$estatura = $_POST["estatura"];
  	$peso = $_POST["peso"];
  	$fecha_nacimiento; = $_POST["fecha_nacimiento"]
  	$ropa = $_POST["ropa"];
  	$complexion = $_POST["complexion"];
  	$ojos = $_POST["ojos"];
  	$cabello = $_POST["cabello"];
  	$piel = $_POST["piel"];
  	$cicatrices = $_POST["cicatrices"];
  	$marcas = $_POST["marcas"];
  	$lugar = $_POST["lugar"];
  	$latitud = $_POST["latitud"];
  	$longitud = $_POST["longitud"];
  	$involucrados = $_POST["involucrados"];
  	$vehiculo = $_POST["vehiculo"];
	$Entidad_Federativa_id = $_POST["estado"];

	$data = array();

	
	$statement = $db->conexion->prepare("INSERT INTO 
		Alerta(nombre, apellidos, genero, estatura, peso, 
			fecha_nacimiento, ropa, complexion, ojos, cabello, 
			piel, cicatrices, marcas, fecha_suceso, lugar,
			latitud, longitud, involucrados, vehiculo, Entidad_Federativa_id) 
		VALUES(? , ?, ?, ?, ?,
		 ?, ?, ?, ?, ?,
		 ?, ?, ?, NOW(), ?,
		  ?, ?, ?, ?, ?)");
	$values = array($nombre, $apellidos, $genero, $estatura, $peso, 
		$fecha_nacimiento, $ropa, $complexion, $ojos, $cabello,
		$piel, $cicatrices, $marcas, $lugar, $latitud,
		$longitud, $involucrados, $vehiculo,$Entidad_Federativa_id);
	$statement->execute($values);
	$id = $db->conexion->lastInsertId();
	$statement = $db->conexion->prepare("SELECT clave FROM Entidad_Federativa WHERE id = ? LIMIT 1");
	$values = array($Entidad_Federativa_id);
	$statement->execute($values);
	$data = $statement->fetchAll(PDO::FETCH_ASSOC);
	$homoclave = $id.$data[0]['clave'];
	$statement = $db->conexion->prepare("UPDATE Alerta SET homoclave = ? WHERE id = ?");
	$values = array($homoclave, $id);
	$statement->execute($values);
	$output_dir = "img/";
 
	if(isset($_FILES["imagen"]))
	{
        $name = explode(".", $_FILES["imagen"]["name"]);
        $size = sizeof($name);
        move_uploaded_file($_FILES["imagen"]["tmp_name"],$output_dir.$homoclave.".".$name[$size-1]);
        $statement = $db->conexion->prepare("UPDATE Alerta SET fotografia = ? WHERE id = ?");
		$values = array($homoclave.".".$name[$size-1], $id);
		$statement->execute($values);
	}
	echo $homoclave;

?>
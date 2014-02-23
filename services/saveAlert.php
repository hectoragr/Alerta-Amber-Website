<?php

	//require_once("conexion/database.php");

	$db = new PDO('mysql:host=mysql.1freehosting.com;dbname=u148390976_amber', 'u148390976_amusr', 'gohe1106',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	try {
 	$homoclave ="";
  	$nombre = $_POST["nombre"];
  	$apellidos = $_POST["apellidos"];
  	$genero = $_POST["genero"];
  	$estatura = $_POST["estatura"];
  	$estatura = intval(floatval($estatura)*100);
  	$peso = $_POST["peso"];
  	$fecha_nacimiento = $_POST["fecha_nacimiento"];
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
	$Entidad_Federativa_id = 19;

	$data = array();
	$_POST["lugar"] = utf8_encode($_POST["lugar"]);
	

	
	$statement = $db->prepare("INSERT INTO 
		Alerta(nombre, apellidos, genero, estatura, peso, 
			fecha_nacimiento, ropa, complexion, ojos, cabello, 
			piel, cicatrices, marcas, fecha_suceso, lugar,
			latitud, longitud, involucrados, vehiculo, Entidad_Federativa_id, Status_id) 
		VALUES(? , ?, ?, ?, ?,
		 ?, ?, ?, ?, ?,
		 ?, ?, ?, NOW(), ?,
		  ?, ?, ?, ?, ?, 1)");
	$values = array($nombre, $apellidos, $genero, $estatura, $peso, 
		$fecha_nacimiento, $ropa, $complexion, $ojos, $cabello,
		$piel, $cicatrices, $marcas, $lugar, $latitud,
		$longitud, $involucrados, $vehiculo,$Entidad_Federativa_id);
	$statement->execute($values);
	$id = $db->lastInsertId();
	$statement = $db->prepare("SELECT clave FROM Entidad_Federativa WHERE id = ? LIMIT 1");
	$values = array($Entidad_Federativa_id);
	$statement->execute($values);
	$data = $statement->fetchAll(PDO::FETCH_ASSOC);
	$homoclave = $data[0]['clave'].$id;
	$statement = $db->prepare("UPDATE Alerta SET homoclave = ? WHERE id = ?");
	$values = array($homoclave, $id);
	$statement->execute($values);
	$output_dir = "../img/";
 
	if(isset($_FILES["imagen"]))
	{
        $name = explode(".", $_FILES["imagen"]["name"]);
        $size = sizeof($name);
        move_uploaded_file($_FILES["imagen"]["tmp_name"],$output_dir.$homoclave.".".$name[$size-1]);
        $statement = $db->prepare("UPDATE Alerta SET fotografia = ? WHERE id = ?");
		$values = array($homoclave.".".$name[$size-1], $id);
		$statement->execute($values);
	}

	} catch (Exception $e) {
	
	}
	echo $homoclave;

?>
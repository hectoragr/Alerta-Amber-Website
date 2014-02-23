<?php


	//$db = new PDO('mysql:host=localhost;dbname=ambermx', 'root', 'root',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	$db = new PDO('mysql:host=mysql.1freehosting.com;dbname=u148390976_amber', 'u148390976_amusr', 'gohe1106',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));


	$fecha = $_POST['fecha'];
	$lugar = $_POST['lugar'];
	$latitud = $_POST['latitud'];
	$longitud = $_POST['longitud'];	
	$alerta = $_POST['alerta'];
	$data = array();



	$statement = $db->prepare("INSERT INTO AVISTAMIENTOS (fecha, lugar, latitud, longitud, Alerta_id) 
									VALUES(? , ?, ?, ?, ?");
	$values = array($fecha, $lugar, $latitud, $longitud, $alerta);
	$statement->execute($values);
	$id = $db->lastInsertId();
	echo $id;
?>
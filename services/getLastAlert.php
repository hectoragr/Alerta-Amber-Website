<?php


	$db = new PDO('mysql:host=localhost;dbname=ambermx', 'root', 'root',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	$estado = "";

	if(isset($_POST['estado']))
	{
		$estado = $_POST['estado'];
	}

	$data = array();

	if (empty($estado))
	{
		$statement = $db->prepare("SELECT nombre, apellidos, fecha_suceso, fotografia FROM Alerta WHERE Status_id = 1 ORDER BY fecha_suceso DESC");
		$statement->execute();
		$data = $statement->fetchAll(PDO::FETCH_ASSOC);
	}
	else
	{
		$statement = $db->prepare("SELECT nombre, apellidos, fecha_suceso, fotografia FROM Alerta WHERE Entidad_Federativa_id = ?  AND Status_id = 1 ORDER BY fecha_suceso DESC LIMIT 1");
		$values = array($estado);
		$statement->execute($values);
		$data = $statement->fetchAll(PDO::FETCH_ASSOC);
	}

	header("application/json");
	echo json_encode($data[0]);
?>
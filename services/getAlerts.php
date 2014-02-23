<?php

	require_once("conexion/database.php");

	$db = new Database();
	$estado = "";

	if(isset($_POST['estado']))
	{
		$estado = $_POST'estado'];
	}

	$data = array();

	if (empty($estado))
	{
		$statement = $db->conexion->prepare("SELECT * FROM Alerta");
		$statement->execute();
		$data = $statement->fetchAll(PDO::FETCH_ASSOC);
	}
	else
	{
		$statement = $db->conexion->prepare("SELECT * FROM Alerta WHERE Entidad_Federativa_id = ?");
		$values = array($estado)
		$statement->execute($values);
		$data = $statement->fetchAll(PDO::FETCH_ASSOC);
	}

	header("application/json");
	echo json_encode($data);
?>
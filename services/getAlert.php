<?php

	require_once("conexion/database.php");

	$db = new Database();
	$alerta = "";

	if(isset($_POST['alerta']))
	{
		$alerta = $_POST'alerta'];
	}

	$data = array();

	if (empty($alerta))
	{
		$statement = $db->conexion->prepare("SELECT * FROM Alerta WHERE id = ?");
		$values = array($alerta);
		$statement->execute($values);
		$data = $statement->fetchAll(PDO::FETCH_ASSOC);
		if (!empty($data))
		{
			$data = $data[0];
		}
	}

	header("application/json");
	echo json_encode($data);
?>
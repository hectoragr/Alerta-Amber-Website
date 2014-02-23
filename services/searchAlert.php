<?php

	require_once("conexion/database.php");

	//$db = new Database();
	$db = new PDO('mysql:host=mysql.1freehosting.com;dbname=u148390976_amber', 'u148390976_amusr', 'gohe1106',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	$alerta = "";

	if(isset($_POST['alerta']))
	{
		$estado = $_POST'alerta'];
	}

	$data = array();

	if (empty($estado))
	{
		$statement = $db->conexion->prepare("SELECT * FROM Alerta WHERE id = ?");
		$values = array($alerta);
		$statement->execute($values);
		$data = $statement->fetchAll(PDO::FETCH_ASSOC);
	}

	header("application/json");
	echo json_encode($data);
?>
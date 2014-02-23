<?php

	

	//$db = new PDO('mysql:host=localhost;dbname=ambermx', 'root', 'root',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	$db = new PDO('mysql:host=mysql.1freehosting.com;dbname=u148390976_amber', 'u148390976_amusr', 'gohe1106',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	$alerta = "";

	if(isset($_POST['id']))
	{
		$alerta = $_POST['id'];
	}
	$extra_query = "";
	if(isset($_POST['nombre']))
	{
		$nombre = $_POST['nombre'];
		if(!empty($nombre))
			$extra_query .= "AND nombre like '%$nombre%'";
	}

	if(isset($_POST['homoclave']))
	{
		$homoclave = $_POST['homoclave'];
		if(!empty($homoclave))
			$extra_query .= " AND homoclave = '$homoclave'";
	}


	$data = array();

	if (!empty($alerta))
	{
		$statement = $db->prepare("SELECT * FROM Alerta WHERE id = ?".$extra_query);
		$values = array($alerta);
		$statement->execute($values);
		$data = $statement->fetchAll(PDO::FETCH_ASSOC);

	}
	header("access-control-allow-origin: *");
	header("application/json");
	echo json_encode($data);
?>
<?php 
 
abstract class configuracion {
	
	protected $datahost;
	protected function conectar($archivo = 'configuracion.ini'){
		
		if (!$ajustes = parse_ini_file($archivo, true)) throw new exception ('No se puede abrir el archivo ' . $archivo . '.');
		$env = "database";
		$controlador = $ajustes[$env]["driver"]; //controlador (MySQL la mayoría de las veces)
		$servidor = $ajustes[$env]["host"]; //servidor como localhost o 127.0.0.1 usar este ultimo cuando el puerto sea diferente
		$puerto = $ajustes[$env]["port"]; //Puerto de la BD
		$basedatos = $ajustes[$env]["database"]; //nombre de la base de datos

		try{
			return $this->datahost = new PDO (
										"mysql:host=$servidor;port=$puerto;dbname=$basedatos",
										$ajustes[$env]['username'], //usuario
										$ajustes[$env]['password'], //constrasena
										array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
										);
			}
		catch(PDOException $e){
				echo "Error en la conexión: ".$e->getMessage();
			}
	}
}
?>
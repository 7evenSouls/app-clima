<?php
	
	include 'database.php';

	// La respuesta será un Json
	header("Content-Type: application/json");
	
	// Hay variables en el vector de POST?
	if(count($_POST)>0){

		// Respuesta para el esp8266
		$body = array('errno' => 0,
				'error' => "Datos recibidos y almacenados.");

		// Sección para capturar las variables del vector de POST
		// y enviarlas a un tabla de una base de datos o un archivo de texto,
		// tambien se puede colocar en la respuesta Json variables con
		// el estado de algún actuador.
		//=============================

		$db = new DataBase();
		$res = $db->query("INSERT INTO `sensores` (`idLectura`, `chipid`, `analogico`, `digital`, `led`, `fechaHora`) VALUES (NULL, '".$_POST["chipid"]."', '".$_POST["analogico"]."', '".$_POST["digital"]."', '".$_POST["led"]."', CURRENT_TIMESTAMP); ");

		// Recorremos el vector de post (para DEBUG, así vemos los datos en la terminal del esp8266)
		foreach ($_POST as $item => $value) {
			// agrega a la respuesta la variable y su valor
			$body[$item] = $value;	
		}

		//cambiamos el estado del led
		$body["led"] = 1;
	
	// No hay variables en el vector de POST
	}else{ 
		// Respuesta para el esp8266
		$body = array('errno' => 1,
				'error' => "No hay datos por POST.");
	}

	// muestra la respuesta
	echo json_encode($body);
 ?>
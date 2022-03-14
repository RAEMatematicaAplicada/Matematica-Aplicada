<?php
	
	$host = 'localhost';
	$user = 'root';
	$password = '';
	$db = 'matematica_aplicada_db';

	$conection = @mysqli_connect($host,$user,$password,$db);

	if(!$conection){
		echo "Error en la conexión";
	}

?>
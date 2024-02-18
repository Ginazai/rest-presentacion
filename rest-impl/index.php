<?php
/*

Rafael Caballero 
8-1041-773
estudiante de ing. en sistemas informaticos

Aplicacion implementando API
version 1.0 

*/
// 1. permitimos acceso al localhost donde se encuentra nuestra API
header('Access-Control-Allow-Origin: http://localhost');
// 2. establecemos la url para conectarnos al API
$str_url = 'http://localhost/rest-presentacion/rest/index.php/user/list?limit=20';
// 3. solicitamos los contenidos de la pagina que son devueltos como "string"
$ar_response = file_get_contents($str_url);
/*
4. utilizamos la funcion "json_decode()" en conjunto con el parametro "true" que nos 
convertira el string en Array asociativo en lugar de "objeto"

nota: el parametro "true" asegura que el string se convierta en un objeto
*/ 
$ar_response = json_decode($ar_response, true);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>REST API Impl</title>
<!-- Estaremos implementando el Bootstrap de twitter para la estetica de la aplicacion, en 
conjunto con popper.js y Jquery para la interactividad y respuesta fluida de los elementos
en la pagina   -->
<script type="text/javascript" src="js/jquery-3.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery-3.7.1.min.map"></script>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css.map">
</head>
<body>
	<header class="text-center bg-primary">
		<h2 class="text-white">REST API Implementacion</h2>
	</header>
<table class="table table-hover shadow rounded-3" style="margin-top: 15px; margin-left: auto; margin-right: auto; width:50%;" border="1px">
	<thead>
		<tr>
			<th>Username</th>
			<th>Email</th>
			<th>Status</th>
		</tr><tr>
		</tr>
	</thead>
	<tbody>
		<?php
		/*

		5. debido a que el resultado es un Array y cada objeto del array es en este
		caso un usuario, iteramos sobre los usuarios para generar una tabla que
		proyecta sus datos:

		*/
		for($int_i=0; $int_i < count($ar_response); $int_i++) {
			$ar_elem = $ar_response[$int_i];
			$str_user = $ar_elem['username'];
			$str_email = $ar_elem['user_email'];
			$str_status = $ar_elem['user_status'];
			if($str_status == 0) {$str_status = 'Inactive';} else {$str_status = 'Active';} 
			echo("
				<tr>
					<td>$str_user</td>
					<td>$str_email</td>
					<td>$str_status</td>
				</tr>");
		}
		?>
	</tbody>
</table>
<!-- Algunos recursos de .js, como el popper.js, deben invocarse en orden jerarquico debido 
a que de otro modo puede no responder cuando es solicitado por el boostrap. Para evitar
errores estos archivos son invocados al final del codigo -->
<script type="text/javascript" src="js/popper.min.js"></script>
  <script type="text/javascript" src="js/popper.min.js.map"></script>
  <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.bundle.min.js.map"></script>
  <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
  <script type="text/javascript" src="js/script.js"></script>
</body>
</html>
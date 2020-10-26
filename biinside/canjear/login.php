<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<?php include 'php/head.php'; ?>
		<link rel="stylesheet" href="css/login.css"/>
		<title>Inicio de Sesión</title>
	</head>

	<body id="body-login">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div id="logoLogin" class="d-flex justify-content-center">
					
					</div>
				</div>

				<div class="col-12 titulo">
					<div class="col-12 d-flex justify-content-center rosa">
						<h1>Inicio de Sesión</h1>
					</div>
				</div>
				<div class="col-4 offset-4 mt-3">
                    <div class="mensaje d-flex align-items-center justify-content-center">
                    	<canvas id="canvasLineas"></canvas>
                        <h2>Ingrese con el dispositivo su <br> código  QR de Acceso</h2>
                    </div>
                </div>
			</div>
		</div>

		<div id="carga">
			<div id="cont-loader">
				<div id="loader">
				
				</div>
			</div>
		</div>

		<?php include 'php/headScripts.php'; ?>
		<script type="text/javascript" src="js/funcionesLogin.js"></script>
	</body>
</html>
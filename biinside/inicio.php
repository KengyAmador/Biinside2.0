<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<?php include 'php/head.php'; ?>
		<link rel="stylesheet" href="css/inicio.css"/>
		<title>BI INSIDE</title>
	</head>

	<body id="body-login">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="d-flex justify-content-center" id="logoLogin">
					
					</div>
				</div>
			</div>
			<div class="row">
				<!--Botones-->                
                <div class="col-12 col-md-6">
                    <!--Ingresar-->
                    <div class="d-flex justify-content-center justify-content-md-end">
		                <input type="submit" class="btnInicio" value="Iniciar Sesión" id="btnIniciar" name="btnIniciar"/>  
                    </div>
                </div>	

                <div class="col-12 col-md-6">
                    <!--Ingresar-->
                    <div class="d-flex justify-content-center justify-content-md-start">
		                <input type="submit" class="btnInicio" value="Registrarse" id="btnRegistrar" name="btnRegistrar"/>  
                    </div>
                </div>	
			</div>
		</div>

		<?php include 'php/headScripts.php'; ?>
		<script type="text/javascript" src="js/funcionesInicio.js"></script>
	</body>
</html>
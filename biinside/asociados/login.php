<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<?php include 'php/head.php'; ?>
		<link rel="stylesheet" href="css/login.css"/>
		<title>Login Sistema</title>
	</head>

	<body id="body-login">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div id="logoLogin">
					
					</div>
				</div>

				<div class="col-12">
				
					<!--Div que contiene el login-->
	        	<div id="divPLogin"> 
			        <form id="formIngresoUser" method="post" action="php/validarLogin.php">
			        	<!--Primer campo-->
		                <div class="row">
		                    <div class="col-4 offset-4" >
		                        <div class="form-group">
		                            <input id="usuario" name= "usuario" type="text" class="form-control borde" placeholder="Nombre de usuario" required>
		                        </div>
		                    </div>
		                </div>
		            	<!--Segundo campo-->                
		                <div class="row">
		                     <div class="col-4 offset-4" style="margin-top: 15px;">
		                          <div class="form-group">
		                            <input id="contrasena" name="contrasena" type="password" class="form-control borde" placeholder="Contraseña" required>
		                          </div>
		                    </div>
		                </div>
		        	</form>
            
	            	<!--Botones-->                
	                <div class="row">
	                    <!--Ingresar-->
	                    <div class="col-12 mt-4">
			                <input type="submit" class="btn btn-primary" value="Iniciar Sesión" id="btnLogin" name="btnLogin"/>  
	                    </div>
	                </div>	
            	</div>
				</div>
			</div>
		</div>

		<?php include 'php/headScripts.php'; ?>
		<script type="text/javascript" src="js/funcionesLogin.js"></script>
	</body>
</html>
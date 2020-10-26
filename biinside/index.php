<!DOCTYPE html>

<?php
	session_start();
	if(isset($_SESSION["codAfiliado"]))
	{
		$codAfiliado = $_SESSION["codAfiliado"];
		$empresa = $_SESSION["empresa"];
		$porcentaje = $_SESSION["porcentaje"];
		$afiPuntos = $_SESSION["puntos"];
		//Inicio de sesion
		$usuarioRol = $_SESSION["rol"];
		$usuarioNombre = $_SESSION["nombre"];
	}
	else
	{
        header("location:inicio.php");
	}
?>

<html lang="es">
	<head>
		<meta charset="UTF-8">
		<?php include 'php/head.php'; ?>
		<link rel="stylesheet" href="css/login.css"/>
		<link rel="stylesheet" href="css/stylenm.css"
	</head>

	<body>	
	<div class="container">
            <div class="btn-menu">
				<label for="btn-menu"><img src="img/menu.png"></label>
            </div>
    <input type="checkbox" id="btn-menu">
    <div class="container-menu">
        <div class="cont-menu">
            <nav>
                <a href="index.php">Inicio</a>
                <a href="menu">Menu</a>
                <a href="Ordenes">Ordenes</a>
                <a href="regalias">Canjeos</a>
                <a href="historial">Historial</a>
                <a href="rangos">Rangos de express</a>
				<a href="inicio.php">Cerrar Sesion</a>
            </nav>
            <label for="btn-menu"><img src="img/cancelar.png"></label>
        </div>
	</div>
		<div id="home-content" class="container-fluid customContainer">
			<div class="row">
			
			<div class="col 1">
					<div class="" id="logoLogin3">
						
					
					</div>
				</div>
				<div>
					<span style="position:absolute; top: 93%; left:90%"  class="rosa derecha"><?php echo $empresa; ?></span>
					<span style="position:absolute; top: 96%; left:90%" class="rosa derecha"><?php echo $usuarioNombre; ?></span>
					<span style="position:absolute; top: 19px; right:93%" class="rosa derecha"><?php echo $codAfiliado; ?></span>
				</div>
				<!-- INFORMACION -->
				
			</div>
<!--
			<div class="row">
				
				<div class="col-2">
						<label class="col-form-label labelTitulo">N° de Factura:</label>
					</div>
				<div class="col-2">
					<input type="text" class="form-control borde mt-2" id="factura" name="factura">
				</div>
					
				<div class="col-1">
						<label class="col-form-label labelTitulo">Monto:</label>
					</div>
				
				<div class="col-2">
					<input type="number" min='1' step=".01" class="form-control borde mt-2" id="monto" name="monto">
				</div>
				
				<div class="col-1">
					<button class="btn btn-primary mt-2 btnInit" id="btnGuardarFact" onclick="guardarFactura()">Guardar</button>
				</div>
				
				<div class="col-1">
					<a class="btn btn-primary mt-2 btnInit enlaceCanjeo" style="color:white;cursor:pointer;" href="canjear">Canjear</a>
				</div>
<<<<<<< HEAD
-->



				<?php
	/* Antiguos botones
					if($usuarioRol == '1' && $afiPuntos != '4'){ //Admin
<<<<<<< HEAD
						//echo '<div class="col-1"><a class="btn btn-primary mt-2 btnInit enlacePromos" style="color:white;cursor:pointer;" href="promos">Promos</a></div>';
						//echo '<div class="col-1"><a class="btn btn-primary mt-2 btnInit enlacePromos" style="color:white;cursor:pointer;" href="regalias">Regalías</a></div>';
						echo '<div class="col-1"><a class="btn btn-primary mt-2 btnInit enlaceCanjeo" style="color:white;cursor:pointer;" href="menu">Menú</a></div>';
						echo '<div class="col-1"><a class="btn btn-primary mt-2 btnInit enlacePromos" style="color:white;cursor:pointer;" href="ordenes">Ordenes</a></div>';
						//echo '<div class="col-1"><a class="btn btn-primary mt-2 btnInit enlacePromos" style="color:white;cursor:pointer;" href="express">Express</a></div>';
=======
						/*
						echo '<div class="col-1"><a class="btn btn-primary mt-2 btnInit enlacePromos" style="color:white;cursor:pointer;" href="promos">Promos</a></div>';
						*/
						/*echo '<div class="col-1"><a class="btn btn-primary mt-2 btnInit enlacePromos" style="color:white;cursor:pointer;" href="regalias">Canjeos</a></div>';//antes se llamaba regalias
						echo '<div class="col-1"><a class="btn btn-primary mt-2 btnInit enlaceCanjeo" style="color:white;cursor:pointer;" href="menu">Menú</a></div>';
						echo '<div class="col-1"><a class="btn btn-primary mt-2 btnInit enlacePromos" style="color:white;cursor:pointer;" href="ordenes">Ordenes</a></div>';
						/*
						echo '<div class="col-1"><a class="btn btn-primary mt-2 btnInit enlacePromos" style="color:white;cursor:pointer;" href="express">Express</a></div>';
		
						echo '<div class="col-1"><a class="btn btn-primary mt-2 btnInit enlacePromos" style="color:white;cursor:pointer;" href="rangos">Rangos Express</a></div>';
						echo '<div class="col-1"><a class="btn btn-primary mt-2 btnInit enlacePromos" style="color:white;cursor:pointer;" href="historial">Historial</a></div>';
						if($codAfiliado === 'BI0003'){//Don Fran
							echo '<div class="col-1"><a class="btn btn-primary mt-2 btnInit enlacePromos" style="color:white;cursor:pointer;" href="asociados">Asociados</a></div>';
						}
					}
					else if($usuarioRol == '2' && $afiPuntos != '4'){ //Cajero
						if($codAfiliado === 'BI0008' || $codAfiliado === 'BI0009' || $codAfiliado === 'BI0010'){//Chinito
							echo '<div class="col-1"><a class="btn btn-primary mt-2 btnInit enlaceCanjeo" style="color:white;cursor:pointer;" href="menu">Menú</a></div>';
						}
						echo '<div class="col-1"><a class="btn btn-primary mt-2 btnInit enlacePromos" style="color:white;cursor:pointer;" href="ordenes">Ordenes</a></div>';
						echo '<div class="col-1"><a class="btn btn-primary mt-2 btnInit enlacePromos" style="color:white;cursor:pointer;" href="express">Express</a></div>';
						echo '<div class="col-1"><a class="btn btn-primary mt-2 btnInit enlacePromos" style="color:white;cursor:pointer;" href="historial">Historial</a></div>';
					}
	*/		
				?>
	       
	<!-- cambiarlo a index principal-->
	<div class="form-group col-md-12 mt-4 ml-1" >
					<h3>Estado del menú en la aplicación móvil:</h3>
					<button class="btn btn-success" id="accesoMenu" >ACTIVAR</button>
				</div>
	

<!-- Cerrar Sesion
				<div class="col-1">
					<a class="btn btn-primary mt-2 btnInit enlaceCanjeo" style="color:white;cursor:pointer;" href="javascript:void(0)" onclick="cerrarSesion()">Cerrar sesion</a>
				</div>
			</div>
<<<<<<< HEAD
				-->

<!--
			<div class="row">
				<div class="col-4 offset-4 mt-3" id="divLector">
                    <div class="mensaje d-flex align-items-center justify-content-center">
                    	<canvas id="canvasLineas"></canvas>
                        <h2>Escanear el código  QR de su <br> aplicación móvil aquí</h2>
                    </div>
                </div>
			</div>
			-->

			<div class="row">
				<div class="col-12">
					<h3 id="nCliente" class="mt-5"></h3>
				</div>
			</div>

			<div id="carga">
				<div id="cont-loader">
					<div id="loader">
					
					</div>
				</div>
			</div>

		</div>

		<div class="modalClase">
		  <div class="modal fade" id="modalFactura" tabindex="-1" role="dialog" aria-labelledby="modalFacturaLabel" aria-hidden="true">
		    <div class="customModal modal-dialog" role="document">
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		            <span aria-hidden="true">&times;</span>
		          </button>
		          <h4 class="modal-title" id="modalFacturaLabel" style="color: red;">DEBE INGRESAR EL NÚMERO DE FACTURA Y EL MONTO DE LA MISMA</h4>
		        </div>
		        <div class="modal-footer">
		          <button type="button" class="btn btn-secondary" data-dismiss="modal">ACEPTAR</button>
		        </div>
		      </div>
		    </div>
		  </div>
		</div>


		<?php include 'php/headScripts.php'; ?>
		<script type="text/javascript">
			var afiliadCodX = '<?php echo $codAfiliado; ?>';
			var porcentajeX = '<?php echo $porcentaje; ?>';
			var afiPuntos = '<?php echo $afiPuntos; ?>';
			/* Inicio de Sesion */
			var rolEncargado = '<?php echo $usuarioRol; ?>';
			var nombreEncargado = '<?php echo $usuarioNombre; ?>';
		</script>
		<script type="text/javascript" src="js/funcionesInit.js"></script>
	</body>
</html>
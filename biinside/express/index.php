<!DOCTYPE html>

<?php
	session_start();
	if(isset($_SESSION["codAfiliado"]))
	{
		$codAfiliado = $_SESSION["codAfiliado"];
		$empresa = $_SESSION["empresa"];
		$porcentaje = $_SESSION["porcentaje"];
		$afiPuntos = $_SESSION["puntos"];
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
		<title>BiInside</title>
	</head>

	<body>	
		<div id="home-content" class="container-fluid customContainer">
			<div class="row">
				<div class="col-6 mt-5">
					<div class="" id="logoLogin3">
					
					</div>
				</div>
				<div class="col-6 mt-5">
					<h3 class="rosa derecha"><?php echo $empresa; ?></h3>
					<h3 class="gris derecha"><?php echo $codAfiliado; ?></h3>
				</div>
			</div>

			<div class="row">
				<div class="col-2">
						<label class="col-form-label labelTitulo">Buscar Cliente:</label>
				</div>
				<div class="col-2">
					<input type="text" class="form-control borde mt-2" id="cliente" name="cliente">
				</div>
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
					<button class="btn btn-primary mt-2 btnInit" id="btnProcesso" onclick="verificarCliente()">Procesar</button>
				</div>
				<div>
					<a class="btn btn-primary btnInit enlaceCanjeo" style="color:white;cursor:pointer; left:0px;" href="../">Regresar</a>
				</div>
			</div>

			<div class="row">
				<div class="col-4 mt-3">
					<label for="clientesList" class="form-control-label">Resultados búsqueda:</label>
					  <select id="clientesList" size="15" class="form-control selection" style="width:300px;height: 200px;">
					  </select>
				</div>
				<div class="col-4 mt-3" id="divLector">
                    <div class="mensaje d-flex align-items-center justify-content-center">
                    	<canvas id="canvasLineas"></canvas>
                        <h2>Escanear el código  QR de su <br> aplicación móvil aquí</h2>
                    </div>
                </div>
			</div>

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
		</script>
		<script type="text/javascript" src="js/funcionesInit.js"></script>
	</body>
</html>
<?php
	session_start();
	if(isset($_SESSION["codAfiliado"]))
	{
		$codAfiliado = $_SESSION["codAfiliado"];
		$empresa = $_SESSION["empresa"];
		$porcentaje = $_SESSION["porcentaje"];
	}
	else
	{
        header("location:../inicio.php");
	}
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
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
					<h3 class="gris derecha">Asociados</h3>
					<a class="btn btn-primary btnInit enlaceCanjeo" style="color:white;cursor:pointer; left:0px;" href="../">Regresar</a>
				</div>
			</div>

			<div class="row">
				<div class="col-12">
					<?php include 'afiliados.php';?>
				</div>
			</div>

			<div id="carga">
				<div id="cont-loader">
					<div id="loader">
					
					</div>
				</div>
			</div>
		</div>


		<?php include 'php/headScripts.php'; ?>
		<script type="text/javascript">
			var afiliadCodX = '<?php echo $codAfiliado; ?>';
			var porcentajeX = '<?php echo $porcentaje; ?>';
		</script>
		<script type="text/javascript" src="js/clientes/javascript.js"></script>
	</body>
</html>
<!DOCTYPE html>

<?php
	session_start();
	if(isset($_SESSION["id"]))
	{
		$usuarioRol = $_SESSION["rol"];
		$usuarioNombre = $_SESSION["nombre"];
	}
	else
	{
        header("location:login.php");
	}
?>

<html lang="es">
	<head>
		<meta charset="UTF-8">
		<?php include 'php/head.php'; ?>
		<link rel="stylesheet" href="css/home.css"/>
		<link rel="stylesheet" href="css/solid.min.css"/>
		<link rel="stylesheet" href="css/fontawesome.min.css"/>
		<title>BiInside</title>
	</head>

	<body>
		<?php include 'php/header.php'; ?>
		<div class="contenedor">
			<?php include 'php/cabecera.php';?>
			<div id="home-content" class="container-fluid customContainer">	
				<div class="row">
					<div class="col-12 content" id="contenidoMostrar">
						<?php include 'afiliados.php';?>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			var rolEncargado = '<?php echo $usuarioRol; ?>';
			var nombreEncargado = '<?php echo $usuarioNombre; ?>';
		</script>
		<?php include 'php/headScripts.php'; ?>
		<script type="text/javascript" src="js/javascript.js"></script>
		<script type="text/javascript" src="js/seguridad/seguridad.js"></script>
		<script type="text/javascript" src="js/clientes/javascript.js"></script>
	</body>
</html>
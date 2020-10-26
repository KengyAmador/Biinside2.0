<!DOCTYPE html>

<?php
	session_start();
	if(isset($_SESSION["codAfiliado"]))
	{
		$codAfiliado = $_SESSION["codAfiliado"];
		$empresa = $_SESSION["empresa"];
		$porcentaje = $_SESSION["porcentaje"];
		$usuarioRol = $_SESSION["rol"];
	}
	else
	{
        header("location:../inicio.php");
	}
?>

<html lang="es">
	<head>
		<meta charset="UTF-8">
		
		<?php include 'php/head.php'; ?>
		<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="../css/stylenm.css">
		
		
		<title>BiInside</title>
	</head>

	<body>
	
		<div id="home-content" class="container-fluid customContainer">
			<div class="row">
			

				<div class="form-group col-md-12 mt-2 text-center" id="alertAccesos">
	              		<div class="alert alert-info alert-dismissible fade show " id="alertRegistroGeneral" role="alert" style="display:none;">
	              		<strong>Registrado!</strong> El dato se ha <strong>registrado</strong> exitosamente.
	            		</div>
	        	</div>
				<div class="form-group col-md-12 text-center" id="alertAccesos">
						<div class="alert alert-danger alert-dismissible fade show " id="alertEliminarGeneral" role="alert" style="display:none;">
						<strong>Eliminado!</strong> El dato se ha <strong>eliminado</strong> exitosamente.
						</div>
				</div>
				<div class="form-group col-md-12 text-center" id="alertAccesos">
						<div class="alert alert-warning alert-dismissible fade show " id="alertEditarGeneral" role="alert" style="display:none;">
						<strong>Editado!</strong> El dato se ha <strong>editado</strong> exitosamente.
						</div>
				</div>
				<div class="form-group col-md-12 text-center" id="alertAccesos">
						<div class="alert alert-dark alert-dismissible fade show " id="alertSubidoGeneral" role="alert" style="display:none;">
						<strong>Cargado!</strong> El arte se ha <strong>cargado</strong> exitosamente.
						</div>
				</div>
				
				<div class="col-md-6 left">
					<div class="" id="logoLogin3">
					
					</div>
				</div>
				
			
				
				
				<!--<div class="col-6 mt-5 ">
				<a class="btn btn-primary btn_regresar" style="color:white;cursor:pointer;" href="../">Regresar</a>
					<h3 class="rosa derecha"> <?php echo $empresa;?></h3>
					<h3 class="gris derecha"><?php echo $codAfiliado;?></h3>
					<h3 class="gris derecha">Menú</h3>
					

				</div>-->
			</div>

			<div class="row">
				<div class="col-12">
					<?php 
						if($usuarioRol !== '2' && $codAfiliado !== 'BI0008' && $codAfiliado !== 'BI0009' && $codAfiliado !== 'BI0010'){
							include 'menus.php';
						}
						else if($usuarioRol === '1' && ($codAfiliado === 'BI0008' || $codAfiliado === 'BI0009' || $codAfiliado === 'BI0010')){
							include 'menus.php';	
						}
					?>
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
		<script type="text/javascript" src="js/menu/javascript.js"></script>
		<script type="text/javascript" src="js/menu/DragDrop.js"></script>

		<div class="container">
            <div class="btn-menu">
                <label for="btn-menu"><img src="img/menu.png"></label>
            </div>
           
    <input type="checkbox" id="btn-menu">
    <div class="container-menu">
        <div class="cont-menu">
            <nav>
                <a href="../index.php">Inicio</a>
                <a href="index.php">Menu</a>
                <a href="../Ordenes">Ordenes</a>
                <a href="../regalias">Canjeos</a>
                <a href="../historial">Historial</a>
                <a href="../rangos">Rangos de express</a>
            </nav>
            <label for="btn-menu"><img src="img/cancelar.png"></label>
        </div>
	</div>
	</body>
</html>
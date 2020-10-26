<!DOCTYPE html>

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

<html lang="es">
	<head>
		<meta charset="UTF-8">
		<?php include 'php/head.php'; ?>
		<link rel="stylesheet" href="css/login.css"/>
		<link rel="stylesheet" href="../css/stylenm.css"/>
		<title>BiInside</title>
	</head>

	<body>	
		<div id="home-content" class="container-fluid customContainer">
			<div class="row">
				<div class="col 1">
					<div class="" id="logoLogin3">
					
					</div>
				</div>
				<div stlyle> </div>
				<!--<div class="col-6 mt-5 ">
				<a class="btn btn-primary btn_regresar" style="color:white;cursor:pointer;" href="../">Regresar</a>
					<h3 class="rosa derecha"> <?php echo $empresa;?></h3>
					<h3 class="gris derecha"><?php echo $codAfiliado;?></h3>
					<h3 class="gris derecha">Menú</h3>
					
				</div>-->
			</div>

			<div class="row" style="margin-top:40px">
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

		<div class="modalClase">
		  <div class="modal fade" id="modalFactura" tabindex="-1" role="dialog" aria-labelledby="modalFacturaLabel" aria-hidden="true">
		    <div class="customModal modal-dialog" role="document">
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		            <span aria-hidden="true">&times;</span>
		          </button>
		          <h4 class="modal-title" id="modalFacturaLabel" style="color: red;">DEBE INGRESAR LOS BII CHECKS (PUNTOS)</h4>
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
		</script>
		<script type="text/javascript" src="js/clientes/javascript.js"></script>
		<div class="container">
            <div class="btn-menu">
                <label for="btn-menu"><img src="img/menu.png"></label>
            </div>
           
    <input type="checkbox" id="btn-menu">
    <div class="container-menu">
        <div class="cont-menu">
            <nav>
                <a href="../index.php">Inicio</a>
                <a href="../menu">Menu</a>
                <a href="../Ordenes">Ordenes</a>
                <a href="../regalias">Canjeos</a>
                <a href="../historial">Historial</a>
                <a href="index.php">Rangos de express</a>
				<a href="../inicio.php">Cerrar Sesion</a>
            </nav>
            <label for="btn-menu"><img src="img/cancelar.png"></label>
        </div>
	</div>
	</body>
</html>
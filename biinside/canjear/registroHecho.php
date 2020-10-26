
<?php
	if(isset($_GET["codigo"]))
	{$codigo = $_GET["codigo"];}
	else
	{$codigo = 0;}
	if(isset($_GET["empresa"]))
	{$empresa = str_replace("%"," ",$_GET["empresa"]);}
	else
	{$empresa = 0;}
?>

<div class="row">
	<div class="col-12">
		<div class="d-flex justify-content-center" id="logoLogin">
		
		</div>
	</div>
	<div class="col-12">
		<div class="col-12 d-flex justify-content-center">
			<h1 class="titulo2 gris">¡BIENVENIDO!</h1>
		</div>
		<div class="col-12 d-flex justify-content-center">
			<h1 class="tituloGran"><?php echo $empresa; ?></h1>
		</div>
		<div class="col-12 d-flex justify-content-center">
			<h2 class="mt-4">SU NÚMERO DE AFILIADO ES:</h2>
		</div>

		<div class="col-12 d-flex justify-content-center align-items-center fondoHecho">
			<h1 id="codEmpresa" class="mr-5 tituloHecho"><?php echo $codigo; ?></h1><?php echo "<img id='codQR' src='php/generarCodigo.php?codigoAfi=" . $codigo . "'>" ?>
		</div>
	</div>

	<!--Botones-->                
    <div class="col-12 col-md-6">
        <!--Iniciar-->
        <div class="d-flex justify-content-center justify-content-md-end">
            <input type="submit" class="btnInicio hechoBtn" value="Iniciar Sesión" id="btnIniciar" name="btnIniciar" onclick="abrirSesion()"/>  
        </div>
    </div>	

    <div class="col-12 col-md-6">
        <!--Imprimir-->
        <div class="d-flex justify-content-center justify-content-md-start">
            <input type="submit" class="btnInicio hechoBtn" value="Imprimir QR de Acceso" id="btnImprimir" name="btnImprimir" onclick="imprimirQR()"/>
        </div>
    </div>	
</div>
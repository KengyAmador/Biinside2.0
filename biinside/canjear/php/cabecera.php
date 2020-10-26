<div id="barra-informacion">
	<h1 id="tituloActual">Inicio</h1>
	<div class="row">
		<div class="col-10">
			<div id="logoCabecera"></div>	
		</div>
		<div id="usuario-actual" onclick="activarMenu()">
			<span class="fas fa-user imgU" id="imgUsuario"></span>
			<h4><?php echo $_SESSION['usuario'];?></h4>
		</div>
	</div>
	<div id="barraMenuUsuario" class="sidenav">

		<div class="customDBU">
			<a href="javascript:void(0)" class="closebtnBU" onclick="closeNav()">&times;</a>
		</div>

		<div class="divBarraUsuario" onclick="cerrarSesion()">
			<a href="javascript:void(0)">Cerrar sesión<span class="glyphicon glyphicon-off"></span></a>
		</div>

	</div>
</div>
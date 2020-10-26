<div id="barra-informacion">
	<h1 id="tituloActual">Inicio</h1>
	<div class="row">
		<div class="col-xs-10">
			<svg id="logoCabecera"></svg>	
		</div>
		<div id="usuario-actual" class="col-xs-12" onclick="activarMenu()">
			<span class="glyphicon glyphicon-user imgU" id="imgUsuario"></span>
			<h4>Gacer</h4>
		</div>
	</div>
	<div id="barraMenuUsuario" class="sidenav">

		<div class="customDBU">
			<a href="javascript:void(0)" class="closebtnBU" onclick="closeNav()">&times;</a>
		</div>

		<div class="divBarraUsuario">
			<a href="javascript:void(0)">Configuración<span class="glyphicon glyphicon-cog"></span></a>
		</div>

		<div class="divBarraUsuario" onclick="cerrarSesion()">
			<a href="javascript:void(0)">Cerrar sesión<span class="glyphicon glyphicon-off"></span></a>
		</div>

	</div>
</div>
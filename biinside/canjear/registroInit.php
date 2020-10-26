<div class="row">
	<div class="col-12">
		<div class="d-flex justify-content-center" id="logoLogin">
					
		</div>
	</div>
	<div class="col-12">
		<div class="col-12 d-flex justify-content-center rosa">
			<h2>REGISTRESE</h2>
		</div>
		
		<div class="col-12 col-md-12">
			<form id="frmRegistro">
				<div class="form-row">
					<div class="col-7">
					  <input type="text" class="form-control borde" id="empresa" name="empresa" placeholder="Nombre del Negocio o Empresa">
					</div>
					<div class="col-5">
					  <input type="text" class="form-control borde" id="cedula" name="cedula" placeholder="Cédula Jurídica del negocio">
					</div>
					<div class="col-12 mt-3">
					  <input type="text" class="form-control borde" id="encargado" name="encargado" placeholder="Nombre Encargado o representante">
					</div>
					<div class="col-12 col-md-4 mt-3">
					  <select class="form-control borde" id="provincia" name="provincia">
					  	<option value="" disabled selected>Provincia</option>
					  </select>
					</div>
					<div class="col-12 col-md-4 mt-3">
					  <select class="form-control borde" id="canton" name="canton">
					  	<option value="" disabled selected>Cantón</option>
					  </select>
					</div>
					<div class="col-12 col-md-4 mt-3">
					  <select class="form-control borde" id="distrito" name="distrito">
					  	<option value="" disabled selected>Distrito</option>
					  </select>
					</div>
					<div class="col-12 mt-3">
					  <input class="form-control borde" name="direccion" id="direccion" placeholder="Dirección Exacta"></input>
					</div>
					<div class="col-6 mt-3">
					  <input type="email" class="form-control borde" id="correo" name="correo" placeholder="Correo electrónico">
					</div>
					<div class="col-6 mt-3">
					  <input type="text" class="form-control borde" id="celular" name="celular" placeholder="Teléfono">
					</div>	
				</div>
		  	</form>
		</div>
		<div class="col-12 col-md-7">
			<div class="d-flex justify-content-end">
				<button type="button" class="btn btn-primary btnInit" id="btnEnviar" onclick="procesar()">ENVIAR INFORMACIÓN</button>
			</div>
		</div>
	</div>
</div>
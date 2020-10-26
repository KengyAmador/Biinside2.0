<script type="text/javascript" src="js/controlAcc/javascript.js"></script>

<div id="barra-herramientas" class="row toolBar">
   <div class="row form-group col-12">
    
	   <div class="col-3">
			  <div class="form-group">
				  <label for="recipient-name" class="form-control-label">Fecha Inicial:</label>
				  <input type="date" class="form-control" step="1" id="fechaControlIni" name="fechaControlIni">
            </div>
	   </div>

		<div class="col-3">
			  <div class="form-group">
				  <label for="recipient-name" class="form-control-label">Fecha Final:</label>
				  <input type="date" class="form-control" step="1" id="fechaControlFin" name="fechaControlFin">
            </div>
	   </div>	   
	   
	   <div class="form-group col-2">
			<button type="button" style="margin-top: 31px" class="btn  optionsBarBTN" id="btnConsultar" onclick="actualizarTabla()">Consultar</button>
	   </div>
  </div>
</div>


<div class="contenidoPrincipal">
    <div id="table-content3">
    <table id="tablaControlAcc" class="table table-bordered  tablaEvento" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="tablaRoundIzq">Fecha de acceso</th>
				<th>Nombre Persona</th>
				<th>Nombre de usuario</th>
                <th class="tablaRoundDer">Rol</th>
            </tr>
        </thead>
    </table>
    </div>
</div>

<script type="text/javascript" src="js/inventarios/javascript.js"></script>

<div class="bd-example">
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="customModal modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel">Agregar productos al inventario</h4>
        </div>
        <div class="modal-body col-xs-12">

        <div class="col-xs-5">
            
            <form id="frmAgregarProdI">
            <div class="form-group">
              <label for="recipient-name" class="form-control-label">Código:</label>
              <input type="text" class="form-control" id="codEsp" name="codEsp" readonly>
            </div>
            <div class="form-group">
              <label for="recipient-name" class="form-control-label">Nombre:</label>
              <input type="text" class="form-control" id="nomProdEsp" name="nomProdEsp" readonly>
            </div>
			<div class="form-group">
              <label for="recipient-name" class="form-control-label">Cantidad de unidades:</label>
              <input type="text" class="form-control" id="pesoProdEsp" name="pesoProdEsp">
            </div>
			
          </form>

        </div>
		
		<div id="divProductos" class="col-xs-7">
            <table id="tablaProducts" class="table compact table-bordered  tablaEvento" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th class="tablaRoundIzq">Código</th>
						<th>Descripción</th>
						<th>Grabado</th>
						<th class="tablaRoundDer">Precio</th>
					</tr>
				</thead>
			</table>
        </div>
		

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" id="btnAgregar" onclick="agregarEspecial()">Agregar</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="barra-herramientas" class="toolBar">
   <div class="form-group col-xs-12"> 
	  <div class="col-xs-3">
			<label for="fechaFactura" class="form-control-label">Fecha:</label>
			  <input type="text" class="form-control" id="fechaInventario" readonly>
	  </div>
	  
	  <div class="col-xs-8">
			<button style="margin-top: 24px" type="button" class="btn optionsBarBTN " id="btnOtro" data-toggle="modal" onclick="otroProducto()" data-target="#exampleModal">Agregar al Inventario</button>
			<button type="button" style="margin-top: 24px" class="btn btn-warning optionsBarBTN" id="btnQuitar" onclick="quitarProducto()">Quitar Producto</button>
			<button type="button" style="margin-top: 24px" class="btn btn-success optionsBarBTN" id="btnNueva" onclick="procesarInventario()">Guardar Inventario</button>
			<button type="button" style="margin-top: 24px" class="btn btn-danger optionsBarBTN" id="btnCancelar" onclick="cancelarInventario()">Limpiar</button>
	  </div>	   
 </div>
 
	 <div class="form-group col-xs-12">
		<div class="col-xs-6">
			<label for="descripcionInv" class="form-control-label">Descripción del inventario:</label>
			<textarea class="form-control" id="descripcionInv" name="descripcionInv" maxlength="200"></textarea>
		</div>
	 </div>
 
  
</div>


<div class="contenidoPrincipal">
    <div id="table-content2">
    <table id="tablaInventarios" class="table table-bordered  tablaEvento" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="tablaRoundIzq">Código Producto</th>
                <th>Descripción Producto</th>
				<th class="tablaRoundDer">Cantidad de unidades</th>
            </tr>
        </thead>
    </table>
    </div>
</div>

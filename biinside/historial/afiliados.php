<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-title">DETALLES DE ORDEN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align:left;">
        <h3>DETALLES</h3>
        <hr>
        <div id="detaOrden">
            <table id="tablaDetaOrd" class="table tablaEvento" cellspacing="0" width="100%">
              <thead>
                  <tr>
                      <th>FILA</th>
                      <th>CATEGORIA</th>
                      <th>PRODUCTO</th>
                      <th>CARACTERISTICA</th>
                      <th>CANTIDAD</th>
                  </tr>
              </thead>
          </table>
        </div>
        <h3>EXTRAS</h3>
        <hr>
        <div id="extraDeta">
            <table id="tablaExtOrd" class="table tablaEvento" cellspacing="0" width="100%">
              <thead>
                  <tr>
                      <th>NOMBRE</th>
                      <th>DESCRIPCION</th>
                      <th>CANTIDAD</th>
                      <th>Fila Asociada</th>
                  </tr>
              </thead>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="imprimirComanda()">IMPRIMIR COMANDA</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalNotifiPro" tabindex="-1" role="dialog" aria-labelledby="modalNotifiPro" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-title">ENVIAR NOTIFICACIONES</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align:left;">
        <form id="frmClientes">
            <div class="form-group">
              <label for="titulo" class="form-control-label">Mensaje:</label>
              <input type="text" class="form-control" id="contmensaje" name="contmensaje">
            </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success" onclick="enviarNotiOrden()">Enviar</button>
      </div>
    </div>
  </div>
</div>

<div class="col-3 form-group">
    <label for="recipient-name" class="form-control-label">Fecha de consulta:</label>
    <input type="date" class="form-control" step="1" id="fechaReporte" name="fechaReporte">
 </div>  

  <div class="col-3 form-group">
    <button type="button" style="margin-top: 24px" class="btn btn-primary optionsBarBTN" id="btnConsultar" onclick="listarFacturasD()">Consultar</button>
 </div>

<div class="col-12 form-group">
    <div id="table-content">
    <table id="tablaClientes" class="table tablaEvento" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Orden</th>
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Código Cliente</th>
                <th>Express</th>
                <th>Valor Orden</th>
                <th>Venta Total</th>
                <th>Método Pago</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Retiro</th>
                <th>Paga con</th>
        				<th></th>
        				<th></th>
                <th></th>
            </tr>
        </thead>
    </table>
  </div>
 </div>   
 <!--
 <div class="col-12 form-group">
    <div id="table-content">
		 <table id="tablaPromos" class="table tablaEvento" cellspacing="0" width="100%">
          <thead>
              <tr>
                  <th>ID</th>
                  <th>FECHA</th>
                  <th>PROMO</th>
                  <th>CLIENTE</th>
                  <th>RETIRO</th>
                  <th>DIRECCION</th>
				          <th>PRECIO</th>
				          <th>METODO PAGO</th>
                  <th>EXPRESS</th>
                  <th>TOTAL</th>
				          <th>PAGO CLIENTE</th>
                  <th>Teléfono</th>
                  <th></th>
                  <th></th>S
                  <th></th>
              </tr>
          </thead>
      </table>
  </div>
 </div>
-->

<div id="carga">
  <div id="cont-loader">
    <div id="loader">
    
    </div>
  </div>
</div>

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
      <div class="modal-body" style="text-align:left;float: left;">
       
        
        <div id="detaOrden" style="float: left; display:inline-block">
        <h3>DETALLES</h3>
            <table id="tablaDetaOrd" class="table tablaEvento" cellspacing="0" width="34%">
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
          <hr>
        </div>
        
        
        <div id="extraDeta" style="float: left; display:inline-block">
        <h3>EXTRAS</h3>
            <table id="tablaExtOrd" class="table tablaEvento" cellspacing="0" width="34%">
              <thead>
                  <tr>
                      <th>NOMBRE</th>
                      <th>DESCRIPCION</th>
                      <th>CANTIDAD</th>
                      <th>FILA ASOCIADA</th>
                  </tr>
              </thead>
          </table>
        </div>

        
       
        <div id="pedidoPremios" style="float: left; display:inline-block">
        <h3>PREMIOS CANJEOS</h3>
            <table id="tablaPreOrd" class="table tablaEvento" cellspacing="0" width="34%">
              <thead>
                  <tr>
                      <th>ID</th>
                      <th>COD</th>
                      <th>NOMBRE</th>
                      <th>CANTIDAD</th>
                      <th>VALOR</th>
                      <th>TOTAL</th>
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

<div class="modal fade" id="modalError" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tmErrorTi">Se produjo un error</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="tmErrorCu">
        <p>Se ha producido un error. Intentalo nuevamente.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<div>
    <h2 style="margin-top: 50px">Ordenes de Menu</h2>
	<div id="table-content">
      <table id="tablaClientes" class="table tablaEvento" cellspacing="0" width="100%">
          <thead>
              <tr>
                  <th>ID</th>
                  <th>Cliente</th>
                  <th>Codigo Cliente</th>
                  <th>Fecha</th>
                  <th>Retiro</th>
                  <th>Dirección/Comentarios</th>
                  <th>Paga con</th>
                  <th>Subtotal</th>
                  <th>Express</th>
                  <th>Total</th>
				          <th>Pago Cliente</th>
                  <th>Teléfono</th>
                  <th></th>
                  <th></th>
                  <th></th>
				          <th></th>
                  <th></th>
                  <th></th>
              </tr>
          </thead>
      </table>
    </div>

    <!--
	<h2>Ordenes de Promos</h2>
    <div id="contenidoPromos">
      <table id="tablaPromos" class="table tablaEvento" cellspacing="0" width="100%">
          <thead>
              <tr>
                  <th>ID</th>
                  <th>FECHA</th>
                  <th>PROMO</th>
                  <th>CLIENTE</th>
                  <th>RETIRO</th>
                  <th>DIRECCION</th>
                  <th>PAGA CON</th>
                  <th>PRECIO</th>
                  <th>EXPRESS</th>
                  <th>TOTAL</th>
				          <th>PAGO CLIENTE</th>
                  <th>TELÉFONO</th>
                  <th>COMENTARIOS ADICIONALES</th>
                  <th></th>
                  <th></th>
				          <th></th>
                  <th></th>
                  <th></th>
              </tr>
          </thead>
      </table>
    </div>
-->
</div>

<div id="carga">
  <div id="cont-loader">
    <div id="loader">
    
    </div>
  </div>
</div>

<audio preload="none">
    <source src="sonido.wav" type="audio/wav">
</audio>

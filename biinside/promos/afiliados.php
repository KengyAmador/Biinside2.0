<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-title">Editar promoción</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align:left;">
        <form id="frmClientes">
            <div class="form-group">
              <label for="titulo" class="form-control-label">Título:</label>
              <input type="text" class="form-control" id="titulo" name="titulo">
            </div>
            <div class="form-group">
              <label for="descripcion" class="form-control-label">Descripción:</label>
              <input type="text" class="form-control" id="descripcion" name="descripcion">
            </div>
            <div class="form-group">
              <label for="imagen" class="form-control-label">Imagen:</label>
              <input type="text" class="form-control" id="imagen" name="imagen">
            </div>
            <div class="form-group">
              <label for="precio" class="form-control-label">Precio:</label>
              <input type="number" min='1' step=".01" class="form-control" id="precio" name="precio">
            </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success" onclick="procesarCliente()">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalArtes" tabindex="-1" role="dialog" aria-labelledby="modalArtes" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalArtes-title">Subir Arte</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align:left;">
        <form id="frmArtes" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="listaPromos" class="form-control-label">Selecciones una promoción:</label>
              <select id="listaPromos" name="listaPromos" class="form-control" required=""></select>
            </div>
            
            <div class="form-group">
              <label for="arte" class="form-control-label">Imagen:</label>
              <input type="file" id="arte" name="arte" required="">
            </div>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <input type="submit" name="submit_image" value="Guardar Arte" class="btn btn-primary mt-2 mb-3" style="float:right;">
          </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Eliminar Promociones</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>¿Esta seguro(a) de eliminar las promociones seleccionadas?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="btnDelete" onclick="eliminarClientes()">Eliminar</button>
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
    <div id="table-content">
    <table id="tablaClientes" class="table tablaEvento" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Título</th>
                <th>Descripción</th>
                <th>Imagen</th>
                <th>Precio</th>
            </tr>
        </thead>
    </table>
    </div>
</div>

<div id="carga">
  <div id="cont-loader">
    <div id="loader">
    
    </div>
  </div>
</div>

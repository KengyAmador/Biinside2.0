<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-title">Editar regalía</h5>
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
              <label for="descripcion" class="form-control-label">Requisito (descripción):</label>
              <input type="text" class="form-control" id="descripcion" name="descripcion">
            </div>
            <div class="form-group">
              <label for="puntos" class="form-control-label">Puntos:</label>
              <input type="number" min='0' class="form-control" id="puntos" name="puntos">
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

<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Eliminar Regalías</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>¿Esta seguro(a) de eliminar las regalías seleccionadas?</p>
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
                <th>Descripción/requisito</th>
                <th>Puntos</th>
            </tr>
        </thead>
    </table>
    </div>
</div>

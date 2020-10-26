<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-title">Editar cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmClientes">
            <div class="form-group">
              <label for="nombre" class="form-control-label">Nombre Negocio:</label>
              <input type="text" class="form-control" id="nombre" name="nombre">
            </div>
            <div class="form-group">
              <label for="encargado" class="form-control-label">Encargado:</label>
              <input type="text" class="form-control" id="encargado" name="encargado">
            </div>
            <div class="form-group">
              <label for="telefono" class="form-control-label">Teléfono:</label>
              <input type="text" class="form-control" id="telefono" name="telefono">
            </div>
            <div class="form-group">
              <label for="industria" class="form-control-label">Industria:</label>
              <input type="text" class="form-control" id="industria" name="industria" disabled>
            </div>
            <div class="form-group">
              <label for="porcentaje" class="form-control-label">Porcentaje:</label>
              <input type="number" min='1' step=".01" class="form-control" id="porcentaje" name="porcentaje">
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

<div class="modal fade" id="modalIndustria" tabindex="-1" role="dialog" aria-labelledby="modalIndustria" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Asignar Industrias a los elementos seleccionados</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmIndustria">
            <div class="form-group">
              <label for="recipient-name" class="form-control-label">Industria:</label>
             <select class="form-control" id="industria2" name="industria2">
            </select>
            </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success" onclick="asignarIndus()">Asignar Industria</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Eliminar Afiliados</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>¿Esta seguro(a) de eliminar el/los afiliados(s) seleccionado(s)?</p>
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
                <th>Número Afiliado</th>
                <th>Nombre</th>
                <th>Nombre Encargado</th>
                <th>Teléfono</th>
                <th>Industria</th>
                <th>%</th>
            </tr>
        </thead>
    </table>
    </div>
</div>

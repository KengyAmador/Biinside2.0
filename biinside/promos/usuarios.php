<script type="text/javascript" src="js/usuarios/javascript.js"></script>
<div class="bd-example">
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel">Crear Nuevo Usuario</h4>
        </div>
        <div class="modal-body col-xs-12">

        <div class="col-xs-12">
            
            <form id="frmUsuarios">
            <div class="form-group">
              <label for="recipient-name" class="form-control-label">Nombre completo:</label>
              <input type="text" class="form-control" id="nombre" name="nombre">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="form-control-label">Nombre de usuario:</label>
              <input type="text" class="form-control" id="usuario" name="usuario">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="form-control-label">Rol de usuario:</label>
              <select class="form-control" id="rol" name="rol">
                  <option value="1">ADMINISTRADOR</option>
                  <option value="2">CAJERO</option>
                </select>
            </div>
            <div class="form-group">
              <label for="recipient-name" class="form-control-label">Contraseña:</label>
              <input type="password" class="form-control" id="contrasena" name="contrasena">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="form-control-label">Teléfono:</label>
              <input type="text" class="form-control" id="telefono" name="telefono">
            </div>
          </form>

        </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" id="btn_guardar" onclick="procesarUsuario()">Guardar</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal de eliminar -->
<div class="bd-example2">
  <div class="modal fade" id="borrarModal" tabindex="-2" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="deleteModalLabel">Eliminar Usuario</h4>
        </div>
        <div class="modal-body col-xs-12">

          <div>
              <p>¿Esta seguro(a) de eliminar el usuario seleccionado?</p>
        <p>Una vez borrado ya no se puede volver a recuperar la información.</p>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-danger" id="btnDelete" onclick="eliminarUsuario()">Eliminar</button>
        </div>
      </div>
    </div>
  </div>
</div>


<div id="barra-herramientas" class="toolBarExport">
	<span id="btnCrear" class="glyphicon glyphicon-file iconoD" data-toggle="modal"  data-placement="bottom" title="Nuevo" data-target="#exampleModal" onclick="nuevoUsuario()"></span>
	<span id="btnEditar" class="glyphicon glyphicon-pencil iconoD" data-toggle="modal"  data-placement="bottom" title="Editar" data-target="#exampleModal" onclick="editarUsuario()"></span>
	<span id="btnEliminar" class="glyphicon glyphicon-trash iconoD" data-toggle="modal" data-placement="bottom" title="Borrar" data-target="#borrarModal" onclick="abrirEliminar()"></span>
	<span id="btnRecargar" class="glyphicon glyphicon-refresh iconoD" data-placement="bottom" title="Actualizar" onclick="updateData()"></span>
	<span class="oculto">
		<strong>Datos actualizados!</strong>
	</span>
</div>


<div class="contenidoPrincipal">
    <div id="table-content">
    <table id="tablaUsuarios" class="table table-bordered  tablaEvento" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="tablaRoundIzq">ID</th>
                <th>Nombre completo</th>
                <th>Nombre de usuario</th>
                <th class="tablaRoundDer">Teléfono</th>
            </tr>
        </thead>
    </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-title">Editar Asociado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align:left;">
        <form id="frmClientes">
            <div class="form-group">
              <label for="titulo" class="form-control-label">Nombre:</label>
              <input type="text" class="form-control" id="titulo" name="titulo">
            </div>
             <div class="form-group">
              <label for="descbasica" class="form-control-label">Descripcion Basica:</label>
              <input type="text" class="form-control" id="descbasica" name="descbasica">
            </div>
            <div class="form-group">
              <label for="descripcion" class="form-control-label">Beneficio (Descripcion detallada):</label>
              <input type="text" class="form-control" id="descripcion" name="descripcion">
            </div>
            <div class="form-group">
              <label for="sitioweb" class="form-control-label">Enlace Sitio Web:</label>
              <input type="text" class="form-control" id="sitioweb" name="sitioweb">
            </div>
            <div class="form-group">
              <label for="facebook" class="form-control-label">Enlace Facebook:</label>
              <input type="text" class="form-control" id="facebook" name="facebook">
            </div>
            <div class="form-group">
              <label for="instagram" class="form-control-label">Enlace Instagram:</label>
              <input type="text" class="form-control" id="instagram" name="instagram">
            </div>
            <div class="form-group">
              <label for="imagen" class="form-control-label">Imagen:</label>
              <input type="text" class="form-control" id="imagen" name="imagen">
            </div>
			     <div class="form-group">
              <label for="categorias" class="form-control-label">Seleccionar Categoria:</label>
              <select id="categorias" name="categorias" class="form-control" required></select>
            </div>
			     <div class="form-group">
              <label for="orden" class="form-control-label">Orden:</label>
              <input  type="number" id="orden" name="orden" class="form-control" required></input>
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

<div class="modal fade" id="modalCategorias" tabindex="-1" role="dialog" aria-labelledby="modalCategorias" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document"><div class="modal-content"><div class="modal-header">
		<h5 class="modal-title" id="modal-title">Categorias</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
		</div><div class="modal-body">
		<form id="frmCategorias" class="row">
			<label for="nombreCategoria" class="form-control-label">Nombre:</label>
			<input type="text" class="form-control" id="nombreCategoria" name="nombreCategoria">
		</form>
		<div>
		<button id="btnEncargadoMatri" type="button" class="btn btn-primary mt-4 mb-4" onclick="agregarCategoria()">Agregar Categoria</button>
		</div>
		<div id="divTablaCategorias">
			<table id="tablaCategorias" class="table table-bordered  tablaEvento" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Nombre</th>
					</tr>
				</thead>
			</table>
		</div>
		</div>
		<div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
		</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalCategoriaEditar" tabindex="-1" role="dialog" aria-labelledby="modalCategoriaEditar" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document"><div class="modal-content"><div class="modal-header">
		<h5 class="modal-title" id="modal-title">Editar Categoria</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
		</div><div class="modal-body">
		<form id="frmCategoriasEditar" class="row">
			<label for="nombreCategoriaEdt" class="form-control-label">Nombre:</label>
			<input type="text" class="form-control" id="nombreCategoriaEdt" name="nombreCategoriaEdt">
		</form>
		
		</div>
		<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
		<button id="btnEditarCat" type="button" class="btn btn-primary mt-4 mb-4" onclick="editarCategoria()">Editar Categoria</button>
		</div>
		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalArtes" tabindex="-1" role="dialog" aria-labelledby="modalArtes" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalArtes-title">Subir Logotipo Asociado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align:left;">
        <form id="frmArtes" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="listaPromos" class="form-control-label">Seleccionar un asociado:</label>
              <select id="listaPromos" name="listaPromos" class="form-control" required=""></select>
            </div>
            
            <div class="form-group">
              <label for="arte" class="form-control-label">Logotipo:</label>
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
        <h5 class="modal-title">Eliminar Asociado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Â¿Esta seguro(a) de eliminar los asociados seleccionados?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="btnDelete" onclick="eliminarClientes()">Eliminar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalEliminarCat" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Eliminar Categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>¿Esta seguro(a) de eliminar las categorias seleccionadas?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="btnDeleteCat" onclick="eliminarCategorias()">Eliminar</button>
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
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Beneficios/Detalle</th>
                <th>Sitio Web</th>
                <th>Facebook</th>
                <th>Instagram</th>
                <th>Imagen</th>
        				<th>Categoria</th>
        				<th>Orden</th>
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

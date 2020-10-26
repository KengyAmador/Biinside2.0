
<!-- Modal -->

<div class="modal fade bd-example-modal-lg" id="modal_menuCategoria" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-title"> Menú</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align:left;">
      
      <div class="form-group pointer">
              <label for="nombre" class="form-control-label">Tipo:</label>
              <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-info active">
              <input type="radio" name="options" id="option1" value="CATEGORIA"  autocomplete="off" checked> CATEGORIA MENÚ
            </label>
            <label class="btn btn-info">
              <input type="radio" name="options" id="option2" value="ACCION"  autocomplete="off"> ACCIÓN
            </label>
            <label class="btn btn-info">
              <input type="radio" name="options" id="option3" value="EXTRA"  autocomplete="off"> EXTRAS MENÚ
            </label>
          </div>           
           </div>

           <div class="form-group">
          <button type="button" class="btn btn-dark btn-sm" id="btnAccesosShowOrHide"  onclick="mostrarAgregarAccesos()">Agregar Datos</button>
          </div>

          <div class="form-group text-center" id="alertAccesos">
              <div class="alert alert-warning alert-dismissible fade show " id="alertEditarAccesos" style="display:none;" role="alert">
              <strong>Editado!</strong> El dato se ha <strong>editado</strong> exitosamente.
            </div>
        </div>
        <div class="form-group text-center" id="alertAccesos">
              <div class="alert alert-info alert-dismissible fade show " id="alertRegistroAccesos" role="alert" style="display:none;">
              <strong>Registrado!</strong> El dato se ha <strong>registrado</strong> exitosamente.
            </div>
          </div>
          <div class="form-group text-center" id="alertAccesos">
              <div class="alert alert-danger alert-dismissible fade show " id="alertEliminarAccesos" role="alert" style="display:none;">
              <strong>Eliminado!</strong> El dato se ha <strong>eliminado</strong> exitosamente.
            </div>
          </div>
        <div class="form-group col-md-12 text-center" id="alertAccesos">
					<div class="alert alert-dark alert-dismissible fade show " id="alertSubidoAccesos" role="alert" style="display:none;">
					<strong>Cargado!</strong> El arte se ha <strong>cargado</strong> exitosamente.
					</div>
			</div>
        <form id="frmCategoria" style="display:none;">
            <div class="form-group">
              <label for="nombreMenuCategoria" class="form-control-label">Nombre:</label>
              <input type="text" class="form-control" id="nombreMenuCategoria" name="nombreMenuCategoria" placeholder="Nombre acceso..."/>
            </div>
            <div class="form-group">
              <label for="descripcionMenuCategoria" class="form-control-label">Descripción:</label>
              <input type="text" class="form-control" id="descripcionMenuCategoria" name="descripcionMenuCategoria" placeholder="Descripción acceso..."/>
            </div>
            <div class="form-group">
              <label for="imagenAcceso" class="form-control-label">Imagen:</label>
              <input type="text" class="form-control" id="imagenAcceso" name="imagenAcceso" placeholder="URL imagen..."/>
            </div>
            <div class="form-group">
            <input id="esPromo" type="checkbox" /> <label for="esPromo"> ES PROMO</label> <hr>
          <button type="button" class="btn btn-success" onclick="procesarCategoria()">Guardar</button>
          </div>
          </form>
          
          <div class="form-group">
            <label for="extraExtraSelect" class="form-control-label">Accesos Guardados:</label>
        
            <table class="table" id="table-accesos">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Nombre</th>
                  <th scope="col">Descripción</th>
                  <th scope="col">Imagen</th>
                  <th scope="col">Tipo</th>
                  <th scope="col">Evento</th>
                </tr>
              </thead>
              <tbody id="tableAccesos">
                
              </tbody>
            </table>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
       
      </div>
    </div>
  </div>
</div>


<!-- Modal -->

<div class="modal fade bd-example-modal-lg" id="modal_menuEditarCategoria" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-title">Editar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align:left;">
      
        <form id="frmEditarCategoria">
        <input type="text" class="form-control" id="codigoEditarAcceso" style="display:none;"  name="codigoEditarAcceso" placeholder="Codigo"/>

            <div class="form-group">
              <label for="nombreMenuCategoria" class="form-control-label">Nombre:</label>
              <input type="text" class="form-control" id="nombreEditarCategoria" name="nombreEditarCategoria" placeholder="Nombre acceso..."/>
            </div>
            <div class="form-group">
              <label for="descripcionMenuCategoria" class="form-control-label">Descripción:</label>
              <input type="text" class="form-control" id="descripcionEditarCategoria" name="descripcionEditarCategoria" placeholder="Descripción acceso..."/>
            </div>
            <div class="form-group">
              <label for="imagenAcceso" class="form-control-label">Imagen:</label>
              <input type="text" class="form-control" id="imagenEditarAcceso" name="imagenEditarAcceso" placeholder="URL imagen..."/>
            </div>
            <input id="esPromoEdt" type="checkbox" /> <label for="esPromoEdt"> ES PROMO</label> 
          </form>
         
          
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
       
        <button type="button" class="btn btn-success ml-4" onclick="procesarEditarCategoria()">Actualizar</button>
        
      </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modal_menu" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-title"> Menú</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align:left;">
      <div class="form-group">
          <button type="button" class="btn btn-dark btn-sm" id="btnProductosShowOrHide"  onclick="mostrarAgregarProductos()">Agregar Datos</button>
          </div>
          
      <div class="form-group col-md-12 text-center" id="alertAccesos">
					<div class="alert alert-dark alert-dismissible fade show " id="alertSubidoProductos" role="alert" style="display:none;">
					<strong>Cargado!</strong> El arte se ha <strong>cargado</strong> exitosamente.
					</div>
			</div>
      <div class="form-group text-center" id="alertAccesos" >
              <div class="alert alert-warning alert-dismissible fade show " id="alertEditarMenu" style="display:none;" role="alert">
              <strong>Editado!</strong> El dato se ha <strong>editado</strong> exitosamente.
            </div>
        </div>
        <div class="form-group text-center" id="alertAccesos">
              <div class="alert alert-info alert-dismissible fade show " id="alertRegistroMenu" role="alert">
              <strong>Registrado!</strong> El dato se ha <strong>registrado</strong> exitosamente.
            </div>
          </div>
          <div class="form-group text-center" id="alertAccesos">
              <div class="alert alert-danger alert-dismissible fade show " id="alertEliminarMenu" role="alert">
              <strong>Eliminado!</strong> El dato se ha <strong>eliminado</strong> exitosamente.
            </div>
          </div>
        <form id="frmMenu" style="display:none;">
        
        
            <div class="form-group">
            <label for="categoriaSelect" class="form-control-label">Categoria:</label>

              <div class="input-group mb-3">
              <div class="input-group-prepend">
                <button class="btn btn-outline-secondary" type="button" onclick = "cargarMenusCategoriasLista()" title="Refrescar datos">⚡</button>
              </div>
              <select class="custom-select" id="categoriaSelect" name="categoriaSelect">
                
              </select>
            </div>
            </div>
            <div class="form-group">
              <label for="nombre" class="form-control-label">Nombre:</label>
              <input type="text" class="form-control" id="nombreMenu" name="nombreMenu" placeholder="Nombre producto..."/>
            </div>
            <div class="form-group">
              <label for="descripcion" class="form-control-label">Descripción:</label>
              <input type="text" class="form-control" id="descripcionMenu" name="descripcionMenu" placeholder="Descripción producto..."/>
            </div>
            <div class="form-group">
              <label for="descripcion" class="form-control-label">Imagen:</label>
              <input type="text" class="form-control" id="imagenMenu" name="imagenMenu" placeholder="URL o imagen de producto..."/>
            </div>
            <div class="form-group">
        <button type="button" class="btn btn-success" onclick="procesarMenus()">Guardar</button>
        </div>
        </form>
       
        <hr>
        
        <div class="form-group">
            <label for="tableMenu" class="form-control-label">Productos Guardados:</label>
        
            <table class="table" id="table-menu">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Categoria</th>
                  <th scope="col">Nombre</th>
                 <!-- <th scope="col">Imagen</th>-->
                  <th scope="col">Descripcion</th>
                  <th scope="col">Imagen</th>
                  <th scope="col">Evento</th>
                </tr>
              </thead>
              <tbody id="tableMenu">
                
              </tbody>
            </table>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modal_menuEditarMenu" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-title"> Menú</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align:left;">
      
        <form id="frmEditarMenu">
        

        <input type="text" style="display:none;" class="form-control" id="codigoEditarMenu" name="codigoEditarMenu" placeholder="Codigo..."/>

            <div class="form-group">
            <label for="categoriaSelect" class="form-control-label">Categoria:</label>

              <div class="input-group mb-3">
              <div class="input-group-prepend">
                <button class="btn btn-outline-secondary" type="button" onclick = "cargarMenusCategoriasLista()" title="Refrescar datos">⚡</button>
              </div>
              <select class="custom-select" id="categoriaSelectEditar" name="categoriaSelectEditar">
                <option selected>Elegir...</option>
              </select>
            </div>
            </div>
            <div class="form-group">
              <label for="nombre" class="form-control-label">Nombre:</label>
              <input type="text" class="form-control" id="nombreMenuEditar" name="nombreMenuEditar" placeholder="Nombre producto..."/>
            </div>
            <div class="form-group">
              <label for="descripcion" class="form-control-label">Descripción:</label>
              <input type="text" class="form-control" id="descripcionMenuEditar" name="descripcionMenuEditar" placeholder="Descripción producto..."/>
            </div>
            <div class="form-group">
              <label for="descripcion" class="form-control-label">Imagen:</label>
              <input type="text" class="form-control" id="imagenMenuEditar" name="imagenMenuEditar" placeholder="URL o imagen de producto..."/>
            </div>
        </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success ml-4" onclick="procesarEditarMenus()">Actualizar</button>
      </div>
    </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modal_detallemenu" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-title"> Menú</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align:left;">
      
        <form id="frmDetalleMenu">
            <div class="form-group">
            <label for="menuSelect" class="form-control-label">Menú:</label>

              <div class="input-group mb-3">
              <div class="input-group-prepend">
                <button class="btn btn-outline-secondary" type="button" onclick="cargarMenusLista()"title="Refrescar datos">⚡</button>
              </div>
              <select class="custom-select" id="menuSelect">
                <option selected>Elegir...</option>
                
              </select>
            </div>
            </div>
            <div class="form-group">
            <label for="accionSelect" class="form-control-label">Accion:</label>

              <div class="input-group mb-3">
              <div class="input-group-prepend">
                <button class="btn btn-outline-secondary" type="button" onclick = "cargarMenusAccionLista()" title="Refrescar datos">⚡</button>
              </div>
              <select class="custom-select" id="accionSelect" name="accionSelect">
                <option selected>Elegir...</option>
              </select>
            </div>
            </div>
            <div class="form-group">
              <label for="descripcion" class="form-control-label">Valor:</label>
              <input type="text" class="form-control" id="valorDetMenu" name="valorDetMenu" placeholder="Ej: Grande, Mediano, Pequeño..."/>
            </div>
           
            <div class="form-group">
              <label for="descripcion" class="form-control-label">Precio:</label>
              <input type="number" class="form-control" id="precioDetMenu" name="precioDetMenu" placeholder="Precio menu..."/>
            </div>
            <div class="form-group">
              <label for="incluidoDetMenu" class="form-control-label">Incluido:</label>
              <textarea class="form-control" id="incluidoDetMenu" name="incluidoDetMenu" rows="3" placeholder="Describa el combo del menu..."></textarea>
            </div>
           
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success" onclick="procesarDetalleMenus()">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal EDITAR-->
<div class="modal fade" id="modal_detallemenuedit" tabindex="-1" role="dialog" aria-labelledby="modal_detallemenu" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-title"> Menú</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align:left;">
      
        <form id="frmDetalleMenuEdit">
            <div class="form-group">
            <label for="menuSelectEdit" class="form-control-label">Menú:</label>

              <div class="input-group mb-3">
              <div class="input-group-prepend">
                <button class="btn btn-outline-secondary" type="button" onclick="cargarMenusLista()"title="Refrescar datos">⚡</button>
              </div>
              <select class="custom-select" id="menuSelectEdit" name="menuSelectEdit">
                <option selected>Elegir...</option>
                
              </select>
            </div>
            </div>
            <div class="form-group">
            <label for="accionSelectEdit" class="form-control-label">Accion:</label>

              <div class="input-group mb-3">
              <div class="input-group-prepend">
                <button class="btn btn-outline-secondary" type="button" onclick = "cargarMenusAccionLista()" title="Refrescar datos">⚡</button>
              </div>
              <select class="custom-select" id="accionSelectEdit" name="accionSelectEdit">
                <option selected>Elegir...</option>
              </select>
            </div>
            </div>
            <div class="form-group">
              <label for="valorDetMenuEdit" class="form-control-label">Valor:</label>
              <input type="text" class="form-control" id="valorDetMenuEdit" name="valorDetMenuEdit" placeholder="Ej: Grande, Mediano, Pequeño..."/>
            </div>
           
            <div class="form-group">
              <label for="precioDetMenuEdit" class="form-control-label">Precio:</label>
              <input type="number" class="form-control" id="precioDetMenuEdit" name="precioDetMenuEdit" placeholder="Precio menu..."/>
            </div>
            <div class="form-group">
              <label for="incluidoDetMenuEdit" class="form-control-label">Incluido:</label>
              <textarea class="form-control" id="incluidoDetMenuEdit" name="incluidoDetMenuEdit" rows="3" placeholder="Describa el combo del menu..."></textarea>
            </div>
           
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success" onclick="procesarDetalleMenusEdit()">Guardar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modal_menuExtras" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-title"> Menú Extras</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align:left;">
      
        <form id="frmExtras">
        <div class="form-group">
            <label for="menuSelect" class="form-control-label">Extras:</label>

              <div class="input-group mb-3">
              <div class="input-group-prepend">
                <button class="btn btn-outline-secondary" type="button" onclick="cargarMenuExtrasLista()"title="Refrescar datos">⚡</button>
              </div>
              <select class="custom-select" id="menuExtraSelect">
                <option selected>Elegir...</option>
                
              </select>
            </div>
            </div>
            <div class="form-group">
              <label for="descripcion" class="form-control-label">Precio:</label>
              <input type="number" class="form-control" id="precioextra" name="precioextra" placeholder="Precio extra..."/>
            </div>
            <div class="form-group">
            <button type="button" class="btn btn-success" onclick="procesarExtraDetalleMenu()">Guardar</button>
            </div>
            
          </form>
          <hr>
          <div class="form-group text-center" id="alertAccesos">
              <div class="alert alert-info alert-dismissible fade show " id="alertRegistroExtras" role="alert">
              <strong>Registrado!</strong> El dato se ha <strong>registrado</strong> exitosamente.
            </div>
          </div>
          <div class="form-group text-center" id="alertAccesos">
              <div class="alert alert-danger alert-dismissible fade show " id="alertEliminarExtras" role="alert">
              <strong>Eliminado!</strong> El dato se ha <strong>eliminado</strong> exitosamente.
            </div>
          </div>
          <div class="form-group">
            <label for="extraExtraSelect" class="form-control-label">Extras de próducto:</label>
        
            <table class="table" id="table-extras">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Extra</th>
                  <th scope="col">Descripción</th>
                  <th scope="col">Precio</th>
                  <th scope="col">Evento</th>
                </tr>
              </thead>
              <tbody id="tableExtras">
                
              </tbody>
            </table>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
       
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modalArtes" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalArtes-title">Subir Arte</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align:left;">
        <form id="frmMenuArtes" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="menuSelect" class="form-control-label">Seleccione el Menú:</label>

              <div class="input-group mb-3">
              <div class="input-group-prepend">
                <button class="btn btn-outline-secondary" type="button" onclick="cargarMenusLista()"title="Refrescar datos">⚡</button>
              </div>
              <select class="custom-select" id="arteselect" name="arteselect">
                <option selected>Elegir...</option>
                
              </select>
            </div>
            </div>
            
            <div class="form-group">
              <label for="menuarte" class="form-control-label">Imagen:</label>
              <input type="file" id="menuarte" name="menuarte" required="">
            </div>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <input type="submit" name="submit_image" value="Guardar Arte" class="btn btn-primary mt-2 mb-3" style="float:right;">
          </form>
      </div>
    </div>
  </div>
</div>

<!--MODAL SUBIR ARTE ACCESOS-->
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modalSubirArteAccesos" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalArtes-title">Subir Arte</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align:left;">        
      <form id="frmSubirArteAccesos" method="POST" enctype="multipart/form-data">
      <div class="form-group">
              <input type="text" class="form-control" id="codAccesoSubirAcceso" name="codAccesoSubirAcceso" placeholder="Codigo Accesos" style="display:none;"/>
      </div>
      <div class="file-upload">    
      <button class="file-upload-btn" type="button" onclick="$('#file-upload-input-acceso').trigger( 'click' )">Selecionar Imagen</button>

          <div class="image-upload-wrap" id="image-upload-wrap-acceso">
            <input class="file-upload-input" type="file" id="file-upload-input-acceso" name="accesoArte" onchange="readURLacceso(this);" accept="image/*" />
            <div class="drag-text">
              <h3>Arrastre y suelte su imagen o click y selecione su imagen.</h3>
            </div>
          </div>
          <div class="file-upload-content" id="file-upload-content-acceso">
            <img class="file-upload-image" id="file-upload-image-acceso" src="#" alt="your image" />
            <div class="image-title-wrap">
              <button type="button" onclick="removeUploadAcceso()" class="remove-image">Eliminar <span class="image-title" id="image-title-acceso">Uploaded Image</span></button>
            </div>
          </div>
        </div>
    
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <input type="submit" name="submit_image" value="Guardar Arte" class="btn btn-primary" style="float:right;">
          
            </form>
      </div>
    </div>
  </div>
</div>


<!--MODAL SUBIR ARTE Menu "PRODUCTOS"-->
<!-- Modal -->
<div class="modal fade bd-example-modal-lg"id="modalSubirArteProductos" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalArtes-title">Subir Arte</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align:left;">        
      <form id="frmSubirArteProductos" method="POST" enctype="multipart/form-data">
      <div class="form-group">
              <input type="text" class="form-control" id="codMenuSubirProducto" name="codMenuSubirProducto" placeholder="Codigo Accesos" style="display:none;"/>
      </div>  
      <div class="file-upload">
      <button class="file-upload-btn" type="button" onclick="$('#file-upload-input-producto').trigger( 'click' )">Selecionar Imagen</button>
          <div class="image-upload-wrap" id="image-upload-wrap-producto" >
            <input class="file-upload-input" type="file" id="file-upload-input-producto" name="produtoArte" onchange="readURLProducto(this);" accept="image/*" />
            <div class="drag-text">
              <h3>Arrastre y suelte su imagen o click y selecione su imagen.</h3>
            </div>
          </div>
          <div class="file-upload-content" id="file-upload-content-producto">
            <img class="file-upload-image" id="file-upload-image-producto" src="#" alt="your image" />
            <div class="image-title-wrap">
              <button type="button" onclick="removeUploadProducto()" class="remove-image">Eliminar <span class="image-title" id="image-title-productos">Uploaded Image</span></button>
            </div>
          </div>
        </div>
    
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <input type="submit" name="submit_image" value="Guardar Arte" class="btn btn-primary" style="float:right;">
          
            </form>
      </div>
    </div>
  </div>
</div>
    


<!--MODAL ELIMINAR ACCESOS-->

<div class="modal fade" id="modalEliminarAccesos" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Eliminar Acceso de Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <p><strong>Si eliminas este acceso, los otros datos del menu relacionados a este también serán eliminados.</strong></p>
        <p>¿Esta seguro(a) de eliminar el Acceso seleccionado?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="btnDelete" onclick="eliminarAccesoMenus()"><i class="fa fa-trash"> </i> Eliminar</button>
      </div>
    </div>
  </div>
</div>

<!--MODAL ELIMINAR MENUS-->
<div class="modal fade" id="modalEliminarMenu" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Eliminar Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <p><strong>Si eliminas este producto, los otros datos relacionados a este producto también serán eliminados.</strong></p>
        <p>¿Esta seguro(a) de eliminar el menu seleccionado?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="btnDelete" onclick="eliminarMenus()"><i class="fa fa-trash"> </i> Eliminar</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Eliminar Menú</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>¿Esta seguro(a) de eliminar los Menús  seleccionados?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="btnDelete" onclick="eliminarDetalleMenus()">Eliminar</button>
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
    <table id="tablaMenu" class="table tablaEvento" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Categoria</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th></th>
                <th></th>
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

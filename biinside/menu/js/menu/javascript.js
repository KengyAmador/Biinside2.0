var codigoSeleccionado;
var tablaVol=null;
var registrar = false;
var codigoAccesoSeleccionado= 0;
var codigoMenuSeleccionado= 0;


$(document).ready(function(){
	GetStatusMenu();
	cargarDatos();	
	validarDatos();
	validarFormEnterCli();
	cargarMenusCategoriasLista();  //Inserta al Select de categorias
	cargarMenusLista();		//Inserta al Select de MeNus
	cargarMenusAccionLista(); // Insertar al select de Accion
	cargarMenuExtrasLista();
	cargarPromosLista();
	enviarArte();
	enviarArteAccesos();
	enviarArteProductos();

	removeUploadAcceso();


	//oculta o muestra el campo para guardar la url en el apartado de Accesos
	$("input[name=options]").change(function(){

		var acceso = $('input[name=options]:checked').val();
		switch (acceso) {
			case 'CATEGORIA':
			$("#imagenAcceso").val('');
			$("#imagenAcceso").prop('disabled', false);
			listarTableAccesosMenu();
		break;
			
			default:
					$("#imagenAcceso").val('');
					$("#imagenAcceso").prop('disabled', true);
					listarTableAccesosMenu();
				break;
		}
		
		
	});
	


});

function GetStatusMenu(){
	$.ajax({
		dataType:'json',
		url:"php/menus/statusMenu.php",
		type:"POST",
		data:{
			  'afiliado': afiliadCodX
			  ,'modulo': 'MENU'
		},
		success: function(data){ 
			console.log(data);
			if(data[0].estado === 'A'){
				$('#accesoMenu').text('DESACTIVAR')
			$('#accesoMenu').removeClass('btn btn-success').addClass('btn btn-danger');
			}else{
				$('#accesoMenu').text('ACTIVAR')
		$('#accesoMenu').removeClass('btn btn-danger').addClass('btn btn-success');
			}
			
			
		}
	});
}
function mostrarAgregarAccesos(){
	var valor = $('#btnAccesosShowOrHide').text();
	
	
	if(valor.toUpperCase() === 'AGREGAR DATOS'){
		$('#frmCategoria').fadeIn();
		$('#btnAccesosShowOrHide').text('Ocultar datos');
	
	}
	else{
		$('#frmCategoria').fadeOut();
		$('#btnAccesosShowOrHide').text('Agregar datos');
	}

}
function mostrarAgregarProductos(){
	var valor = $('#btnProductosShowOrHide').text();
	
	
	if(valor.toUpperCase() === 'AGREGAR DATOS'){
		$('#frmMenu').fadeIn();
		$('#btnProductosShowOrHide').text('Ocultar datos');
	
	}
	else{
		$('#frmMenu').fadeOut();
		$('#btnProductosShowOrHide').text('Agregar datos');
	}

}


function enviarArte(){
	$("#frmMenuArtes").on('submit', function(e){
		mostrarCarga();
	   e.preventDefault();

	   $.ajax({
		   type: 'POST',
		   url: 'php/subirArte.php',
		   data: new FormData(this),
		   dataType: 'json',
		   contentType: false,
		   cache: false,
		   processData:false,
		   success: function(response){ 
			   console.log(response);
			   if(response == 1)
			   {
				   actualizarTabla();
				   ocultarCarga();
				   $('#modalArtes').modal('hide');

				   $("#alertSubidoGeneral").fadeIn();
					setTimeout(function() {
						$("#alertSubidoGeneral").fadeOut();  

				   },5000);
			   }
			   else  if(response == 3)
			   {
				   alert("OcurriÃ³ un problema, No carga imagen");
				   actualizarTabla();
				   ocultarCarga();
			   }else{
				alert("OcurriÃ³ un problema, intentalo nuevamente");
				actualizarTabla();
				   ocultarCarga();
			   }
		   }
	   });
   });

}


function enviarArteAccesos(){
	$("#frmSubirArteAccesos").on('submit', function(e){
		mostrarCarga();
	   e.preventDefault();

	   $.ajax({
		   type: 'POST',
		   url: 'php/subirArteAccesos.php',
		   data: new FormData(this),
		   dataType: 'json',
		   contentType: false,
		   cache: false,
		   processData:false,
		   success: function(response){ 
			   console.log(response);
			   if(response == 1)
			   {
				   actualizarTabla();
				   listarTableAccesosMenu();
				   ocultarCarga();
				   $('#modalSubirArteAccesos').modal('hide');

				   $("#alertSubidoAccesos").fadeIn();
					setTimeout(function() {
						$("#alertSubidoAccesos").fadeOut();  

				   },5000);
			   }
			   else  if(response == 3)
			   {
				   alert("OcurriÃ³ un problema, No carga imagen");
				   actualizarTabla();
				   ocultarCarga();
			   }else{
				alert("OcurriÃ³ un problema, intentalo nuevamente");
				actualizarTabla();
				   ocultarCarga();
			   }
		   }
	   });
   });

}


function enviarArteProductos(){
	$("#frmSubirArteProductos").on('submit', function(e){
		mostrarCarga();
	   e.preventDefault();

	   $.ajax({
		   type: 'POST',
		   url: 'php/subirArteMenus.php',
		   data: new FormData(this),
		   dataType: 'json',
		   contentType: false,
		   cache: false,
		   processData:false,
		   success: function(response){ 
			   console.log(response);
			   if(response == 1)
			   {
				   actualizarTabla();
				   listarTableMenu();
				   ocultarCarga();
				   $('#modalSubirArteProductos').modal('hide');

				   $("#alertSubidoProductos").fadeIn();
					setTimeout(function() {
						$("#alertSubidoProductos").fadeOut();  

				   },5000);
			   }
			   else  if(response == 3)
			   {
				   alert("OcurriÃ³ un problema, No carga imagen");
				   actualizarTabla();
				   ocultarCarga();
			   }else{
				alert("OcurriÃ³ un problema, intentalo nuevamente");
				actualizarTabla();
				   ocultarCarga();
			   }
		   }
	   });
   });

}

function validarDatos(){
    $('#frmMenu').bootstrapValidator({
        message: 'Los datos no son validos',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        excluded:[':disabled'],
        fields: {
            nombre: {
                validators: {
                    notEmpty: {
                        message: 'El nombre es requerido'
                    },
                    stringLength: {
                        max: 50,
                        message: 'El nombre es demasiado grande'
                    }
                }
            },
            apellidos: {
                validators: {
                    stringLength: {
                        max: 200,
                        message: 'Los apellidos son muy grandes'
                    }
                }
            },
			telefono: {
                validators: {
                    stringLength: {
                        max: 15,
                        message: 'El telefono es demasiado grande'
                    }
                }
            }
        }
    });
}

function updateData(){
	actualizarTabla();
	mostrarOculto();
}

function cargarDatos(){
	var table = $('#tablaMenu').DataTable({
		dom: 'Blfrtip',
		 "stripeClasses": [ '', 'strip2'],
        "ajax": 
    		{
			"url":"php/menus/listar.php",
			"type":"POST",
			"data":{'afiliado':afiliadCodX},
			"dataType":"JSON"
		},
	     select: {
            style: 'multi'
        },
    	sAjaxDataProp: "",
    	"aoColumns": [
	        { "mData": "categoria" },
	        { "mData": "nombre" },
	        { "mData": "descripcion" },
			{ "mData": "precio" },
			{ "mData": null,  "sDefaultContent": "<button class='btnNotificar btn btn-sucess' style='background-color:#1c1c1c;color:white;'>NOTIFICAR</button>"},
			{ "mData": null,  "sDefaultContent": "<button class='btnEstado btn btn-sucess' style='background-color:#1c1c1c;color:white;'>HABILITAR/DESHABILITAR</button>"}
	    ],
		rowId: 'codigoDetMenu',
		"createdRow": function(row, data, dataIndex){
            if(data.estado === 'D'){
				$(row).addClass('colorNaranja');	
			}
            $(".btnNotificar", row)[0].addEventListener('click', (event) => notificarElemento(event, data), false);
			$(".btnEstado", row)[0].addEventListener('click', (event) => cambiarEstado(event, data), false);
        },
        buttons: [
			{
                text: 'Opciones de acceso',
                className: 'btn-tablas',
                action: function () {
                	registrar = true;
                   $('#frmCategoria').bootstrapValidator('resetForm',true);
					    $('#frmCategoria').data('bootstrapValidator').resetForm();
						$('#modal_menuCategoria').on('show.bs.modal', function (event) {
						  var button = $(event.relatedTarget);
						  var modal = $(this);	
						  modal.find('.modal-title').text('Formulario de Accesos');
						  $("#nombreMenuCategoria").val('');
						  $("#descripcionMenuCategoria").val('');
						  $("#imagenAcceso").val('');
						  //Oculto las alertas
						  $("#alertRegistroAccesos").hide();
						  $("#alertEliminarAccesos").hide();
						  //Llenar tabla de accesos
						  listarTableAccesosMenu();
					});
					$('#modal_menuCategoria').modal('show');
                }
			},
			{
                text: 'Mis productos',
                className: 'btn-tablas',
                action: function () {
                	registrar = true;
                   $('#frmMenu').bootstrapValidator('resetForm',true);
					    $('#frmMenu').data('bootstrapValidator').resetForm();
						$('#modal_menu').on('show.bs.modal', function (event) {
						  var button = $(event.relatedTarget);
						  var modal = $(this);	
						  modal.find('.modal-title').text('Formulario de Productos');
						  $("#categoriaSelect").val('');
						  $("#nombreMenu").val('');
						  $("#descripcionMenu").val('');
						  $("#imagenMenu").val('');

						  //Ocultar Alert
						  $("#alertRegistroMenu").hide();
						  $("#alertEliminarMenu").hide();
						  //Listar tabla
						  listarTableMenu();
						  
					});
					$('#modal_menu').modal('show');
                }
			},

			{
                text: 'Registro de Menú',
                className: 'btn-tablas',
                action: function () {
                	registrar = true;
                   $('#frmDetalleMenu').bootstrapValidator('resetForm',true);
					    $('#frmDetalleMenu').data('bootstrapValidator').resetForm();
						$('#modal_detallemenu').on('shown.bs.modal', function (event) {
						  var button = $(event.relatedTarget);
						  var modal = $(this);	
						  modal.find('.modal-title').text('Formulario de Menú');
						  $('#menuSelect').val('');
						  $('#accionSelect').val('');
						  $('#valorDetMenu').val('');
						  $('#precioDetMenu').val('');
						  $('#incluidoDetMenu').val('');

						  //oculto las alertas
						  $('#alertRegistroMenu').hide();
						  $('#alertEliminarMenu').hide();
					});
					$('#modal_detallemenu').modal('show');
                }
			},
			{
                text: 'Extras Menú',
                className: 'btn-tablas',
                action: function () {
                	registrar = true;
                    if(table.rows( { selected: true } ).count() == 1)
                	{
                		codigoSeleccionado = table.rows( { selected: true } ).data()[0].id;

						$('#frmExtras').bootstrapValidator('resetForm',true);
					    $('#frmExtras').data('bootstrapValidator').resetForm();
						$('#modal_menuExtras').on('show.bs.modal', function (event) {
							  var button = $(event.relatedTarget);
							  var modal = $(this);	
							  modal.find('.modal-title').text('Formulario de Extras: ');
							  $('#precioextra').val('');
							 //Oculto las alertas
							 $("#alertRegistroExtras").hide();
							 $("#alertEliminarExtras").hide();

							  listarExtraDetalleMenu(codigoSeleccionado);



						});
						$('#modal_menuExtras').modal('show');
                	}
                	else if(table.rows( { selected: true } ).count() > 1)
                	{
                		$('#modalError').on('show.bs.modal', function (event) {
						  var button = $(event.relatedTarget);
						  var modal = $(this);	
						  modal.find('#tmErrorTi').text('Multiples datos seleccionados');
						  modal.find('#tmErrorCu').text('Se debe seleccionar solamente una fila, verifique las filas seleccionadas y seleccione solamente la que desea editar');
						});
						$('#modalError').modal('show');
                	}
                	else if((table.rows( { selected: true } ).count() <= 0))
                	{
                		$('#modalError').on('show.bs.modal', function (event) {
						  var button = $(event.relatedTarget);
						  var modal = $(this);	
						  modal.find('#tmErrorTi').text('No hay datos seleccionados');
						  modal.find('#tmErrorCu').text('Debe seleccionar alguna fila de la tabla.');
						});
						$('#modalError').modal('show');
                	}
                }
            },
        	{
                text: 'Eliminar',
                className: 'btn-tablas',
                action: function () {
                	if(table.rows( { selected: true } ).count() > 0)
                	{
                		$('#modalEliminar').modal('show');
                	}
                	else
                	{
                		$('#modalError').on('show.bs.modal', function (event) {
						  var button = $(event.relatedTarget);
						  var modal = $(this);	
						  modal.find('#tmErrorTi').text('No hay datos seleccionados');
						  modal.find('#tmErrorCu').text('Debe seleccionar alguna fila de la tabla.');
						});
						$('#modalError').modal('show');
                	}
                }
            },
            {
                text: 'Editar',
                className: 'btn-tablas',
                action:  function () {
                	registrar = false;
                    if(table.rows( { selected: true } ).count() == 1)
                	{
                		codigoSeleccionado = table.rows( { selected: true } ).data()[0].id;

						$('#frmDetalleMenuEdit').bootstrapValidator('resetForm',true);
					    $('#frmDetalleMenuEdit').data('bootstrapValidator').resetForm();
						$('#modal_detallemenuedit').on('show.bs.modal', function (event) {
							  var button = $(event.relatedTarget);
							  var modal = $(this);	
							  modal.find('.modal-title').text('Editar Menú: ');
							  $('#menuSelectEdit').val('');
							  $('#accionSelectEdit').val('');
							  $('#valorDetMenuEdit').val('');
							  $('#precioDetMenuEdit').val('');
							  $('#incluidoDetMenuEdit').val('');
							 consultarEditarDetalleMenu(codigoSeleccionado);
						});
						$('#modal_detallemenuedit').modal('show');
                	}
                	else if(table.rows( { selected: true } ).count() > 1)
                	{
                		$('#modalError').on('show.bs.modal', function (event) {
						  var button = $(event.relatedTarget);
						  var modal = $(this);	
						  modal.find('#tmErrorTi').text('Multiples datos seleccionados');
						  modal.find('#tmErrorCu').text('Se debe seleccionar solamente una fila, verifique las filas seleccionadas y seleccione solamente la que desea editar');
						});
						$('#modalError').modal('show');
                	}
                	else if((table.rows( { selected: true } ).count() <= 0))
                	{
                		$('#modalError').on('show.bs.modal', function (event) {
						  var button = $(event.relatedTarget);
						  var modal = $(this);	
						  modal.find('#tmErrorTi').text('No hay datos seleccionados');
						  modal.find('#tmErrorCu').text('Debe seleccionar alguna fila de la tabla.');
						});
						$('#modalError').modal('show');
                	}
                }
			},
            {
                text: 'Refrescar tabla',
                className: 'btn-tablas',
                action: function () {
					actualizarTabla();
					
                }
            }/*,
            {
                text: 'Subir Arte',
                className: 'btn-tablas',
                action: function () {
					$('#menuarte').val('');
					$('#arteselect').val('');
					
					
					
                	$('#modalArtes').modal('show');
                }
            }*/
    	],
		language: {
		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún dato disponible en esta tabla",
		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix":    "",
		"sSearch":         "Buscar:",
		"sUrl":            "",
		"sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Ãšltimo",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		},
        select: {
            rows: "%d filas seleccionadas"
        }
    }
    });
     
     tablaVol = table;

    $(window).scroll(function(){
    	$(".paginate_button > a").blur();
  	});

  	/*if(pantalla == "clientes")
    {
     	hiloGlobal = setInterval(function(){
    		actualizarTabla();
    	}, 5000);	
    }*/
}

function notificarElemento(event, arg){
	if(arg.estado === 'A'){//Notificar
		$.ajax({
			url:"php/menus/notificarElemento.php",
			type:"POST",
			data:{
					'afiliado':afiliadCodX,
					'titulo': arg.categoria,
					'mensaje': arg.nombre + ': ' + arg.descripcion
				 },
			success:function(data)
			{
				//Cambiar el estado de la orden aquí
				if(data==1)
				{
					actualizarTabla();
					alert("Se notificó correctamente");
				}
				else{
					actualizarTabla();
					alert("Ocurrió un error al notificar, intente nuevamente");
				}
			}
		});
	}else{
		alert('Este producto esta desactivado, no puede notificarse');
		actualizarTabla();
	}
}

function cambiarEstado(event, arg){
	var thisEstado = 'A';
	if(arg.estado === 'A'){
		thisEstado = 'D';
	}else{
		thisEstado = 'A';
	}

	$.ajax({
		url:"php/menus/cambiarEstado.php",
		type:"POST",
		data:{'id': arg.id
				,'afiliado': afiliadCodX
				,'estado': thisEstado
			 },
		success:function(data)
		{
			if(data = 1)
			{
				actualizarTabla();
				if(thisEstado === 'A'){
					alert("Se activo")
				}else{
					alert("Se desactivo")
				}
			}
			else
			{
				actualizarTabla();
				alert("Ocurrió un problema");
			}
		}
	});
}

$('#accesoMenu').click(function(){
	if($('#accesoMenu').text() === 'ACTIVAR'){
		
		// $('#accesoMenu').text('DESACTIVAR')
		// $('#accesoMenu').removeClass('btn btn-success').addClass('btn btn-danger');
		$.ajax({
			dataType:'json',
			url:"php/menus/ActualizarPermisoMenu.php",
			type:"POST",
			data:{
				  'afiliado': afiliadCodX
				  ,'modulo': 'MENU'
				  ,'estado': 'A'
			},
			success: function(data){ 
				// console.log(data);
				if(data[0].estado === 'A'){
					$('#accesoMenu').text('DESACTIVAR')
				$('#accesoMenu').removeClass('btn btn-success').addClass('btn btn-danger');
				}else{
					$('#accesoMenu').text('ACTIVAR')
			$('#accesoMenu').removeClass('btn btn-danger').addClass('btn btn-success');

				}
			}
		});
	}else{
		// $('#accesoMenu').removeClass('btn btn-danger').addClass('btn btn-success');
		// $('#accesoMenu').text('ACTIVAR')

		$.ajax({
			dataType:'json',
			url:"php/menus/ActualizarPermisoMenu.php",
			type:"POST",
			data:{
				  'afiliado': afiliadCodX
				  ,'modulo': 'MENU'
				  ,'estado': 'I'
			},
			success: function(data){ 
				// console.log(data);
				if(data[0].estado === 'A'){
					$('#accesoMenu').text('DESACTIVAR')
				$('#accesoMenu').removeClass('btn btn-success').addClass('btn btn-danger');
				}else{
					$('#accesoMenu').text('ACTIVAR')
					$('#accesoMenu').removeClass('btn btn-danger').addClass('btn btn-success');

				}
			}
		});
	}
})


function actualizarTabla(){
	tablaVol.ajax.reload(null,false);
}

/*function abrirEliminar(){
	$('#borrarModal').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget);
	  var modal = $(this);
	  modal.find('.modal-title').text('Eliminar la promoción: ' + clienteSeleccionado.nombre);
	});
}*/

function consultarEditarDetalleMenu(codigo){
	mostrarCarga();
	$.ajax({
		dataType:'json',
		url:"php/menus/consultarDetalleMenus.php",
		type:"POST",
		data:{'codigo':codigo
			 },
		success:function(data)
		{
			ocultarCarga();
			console.log('Test 22');
			
			$("#menuSelectEdit").val(data[0].menu);
			$("#accionSelectEdit").val(data[0].accion);
			$("#valorDetMenuEdit").val(data[0].valor);
			$("#precioDetMenuEdit").val(data[0].precio);
			$("#incluidoDetMenuEdit").val(data[0].incluido);
		}});
	
}

function listarExtraDetalleMenu(codigo){
	$.ajax({
		dataType:'json',
		url:"php/menus/consultarExtraDetalleMenus.php",
		type:"POST",
		data:{'codigo':codigo
			 },
		success:function(data)
		{
			$('#tableExtras > tr').remove();
			var datosHTML ='';
			data.map((item)=>{
				datosHTML+= 
				'<tr>'+
				'<td>'+item.extra+'</td>'+
				'<td>'+item.descripcion+'</td>'+
				'<td>CRC '+item.precioextra+'</td>'+
				'<td><button class="btn btn-danger" onclick="eliminarExtraDetalleMenu('+item.codigoextra+')">Eliminar</button></td>'+
			  	'</tr>'
			})
			
			$('#tableExtras').append(datosHTML);
			
			
		}});
	
}

function listarTableAccesosMenu(){
	var referencia = $('input[name=options]:checked').val();
	
	$.ajax({
		dataType:'json',
		url:"php/menus/consultarAccesosForTable.php",
		type:"POST",
		data:{'codigo':afiliadCodX,
				'referencia': referencia},
		success:function(data)
		{
			$('#tableAccesos > tr').remove();
			var datosHTML ='';
			data.map((item)=>{
				let nombre = item.nombre;
				
				datosHTML+= 
				'<tr>'+
				'<td>'+item.nombre+'</td>'+
				'<td>'+item.descripcion+'</td>';
				if(referencia ==='CATEGORIA'){
					datosHTML+= '<td><img src="'+item.imagen+'" width="30"></img></td>'
				}else{
					datosHTML+='<td></td>';
				}
				datosHTML+= 
				'<td>'+item.referencia+'</td>'+
				'<td>'+
					'<div class="dropdown">'+
						'<button class="btn btn-info dropdown-toggle btn-sm" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
						'Eventos'+
						'</button>'+
						'<div class="dropdown-menu text-center " aria-labelledby="dropdownMenu2">'+
							"<button class='btn btn-warning btn-sm' title='Editar' onclick='mostrarFormularioEditarAccesos("+item.codigo+")' >✎</button>";
							if(referencia ==='CATEGORIA'){
								datosHTML+= '<button class="btn btn-success btn-sm ml-1" title="Subir arte" onclick="mostrarFormularioSubirArteAccesos('+item.codigo+')">📤</button>';
							}
							datosHTML+= 
							'<button class="btn btn-danger btn-sm ml-1" title="Eliminar" onclick="eliminarAccesoMenusMensajeAlerta('+item.codigo+')"><i class="fa fa-car"></i>✖</button>'+

						'</div>'+
					'</div>'+
			  	'</td>'+
				
				'</tr>';
			})
			
			$('#tableAccesos').html(datosHTML);
			
			
		}});
}

/**
 * Abre el modal con el codigo de acceso incluido para subir el arte de accesos
 * @function mostrarFormularioSubirArteAccesos
 * @param {codigo} codigo 
 */
function mostrarFormularioSubirArteAccesos(codigo){
	
	$('#codAccesoSubirAcceso').val(codigo);
	$('#frmSubirArteAccesos').bootstrapValidator('resetForm',true);
			$('#frmSubirArteAccesos').data('bootstrapValidator').resetForm();
			$('#modalSubirArteAccesos').on('show.bs.modal', function (event) {
			  var button = $(event.relatedTarget);
			  var modal = $(this);
			  
			  //Iniciar valores en null del dropzone	
			  removeUploadAcceso();

			  modal.find('.modal-title').text('Subir Arte');
			  

		});
		$('#modalSubirArteAccesos').modal('show');


}


/**
 * Abre el modal con los datos repectivos de los accesos para sobrescribir la informacion
 * @function mostrarFormularioEditarAccesos
 * @param {codigo} codigo 
 */
function mostrarFormularioEditarAccesos(codigo){
	var referencia = $('input[name=options]:checked').val();
	registrar = false;
	$.ajax({
		dataType:'json',
		url:"php/menus/consultarAccesos.php",
		type:"POST",
		data:{'codigo':codigo},
			
		success:function(data)
		{
			
			$('#frmEditarCategoria').bootstrapValidator('resetForm',true);
			$('#frmEditarCategoria').data('bootstrapValidator').resetForm();
			$('#modal_menuEditarCategoria').on('show.bs.modal', function (event) {
			  var button = $(event.relatedTarget);
			  var modal = $(this);	

			  modal.find('.modal-title').text('Editar '+data[0].referencia.toLowerCase());
			  $('#codigoEditarAcceso').val(data[0].codigo);
			 	$('#nombreEditarCategoria').val(data[0].nombre);
				$('#descripcionEditarCategoria').val(data[0].descripcion);
				if(data[0].referencia !== 'CATEGORIA'){
					$('#imagenEditarAcceso').val('');
					$('#imagenEditarAcceso').prop('disabled', true);
				}else{
					$('#imagenEditarAcceso').val(data[0].imagen);
					$('#imagenEditarAcceso').prop('disabled', false);
				}
				
					

		});
		$('#modal_menuEditarCategoria').modal('show');

			
		}});
}

function listarTableMenu(){
	$.ajax({
		dataType:'json',
		url:"php/menus/consultarMenuForTable.php",
		type:"POST",
		data:{'codigo':afiliadCodX},
				
		success:function(data)
		{
			
			
			$('#tableMenu > tr').remove();
			var datosHTML ='';
			data.map((item)=>{
				
				datosHTML+= 
				'<tr>'+
				'<td>'+item.categoria+'</td>'+
				'<td>'+item.nombre+'</td>'+
				'<td>'+item.descripcion+'</td>'+
				'<td><img src="'+item.imagen+'" width="40"></img></td>'+
				'<td>'+
					'<div class="dropdown">'+
						'<button class="btn btn-info dropdown-toggle btn-sm" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
						'Eventos'+
						'</button>'+
						'<div class="dropdown-menu text-center " aria-labelledby="dropdownMenu2">'+
							"<button class='btn btn-warning btn-sm' title='Editar' onclick='mostrarFormularioEditarMenu("+item.codigo+")' >✎</button>"+
							'<button class="btn btn-success btn-sm ml-1" title="Subir arte" onclick="mostrarFormularioSubirArteMenu('+item.codigo+')">📤</button>'+
							'<button class="btn btn-danger btn-sm ml-1" title="Eliminar" onclick="eliminarMenusMensajeAlerta('+item.codigo+')">✖</button>'+

						'</div>'+
					'</div>'+
			  	'</td>'+  
				'</tr>';
			})
			
			$('#tableMenu').append(datosHTML);
			
			
		}});
}

/**
 * Abre el modal con el codigo de menu incluido para subir el arte de productos
 * @function mostrarFormularioSubirArteMenu
 * @param {codigo} codigo 
 */
function mostrarFormularioSubirArteMenu(codigo){
	
	$('#codMenuSubirProducto').val(codigo);
	$('#frmSubirArteProductos').bootstrapValidator('resetForm',true);
			$('#frmSubirArteProductos').data('bootstrapValidator').resetForm();
			$('#modalSubirArteProductos').on('show.bs.modal', function (event) {
			  var button = $(event.relatedTarget);
			  var modal = $(this);
			  
			  //Iniciar valores en null del dropzone	
			  removeUploadProducto();
			  modal.find('.modal-title').text('Subir Arte');
			  

		});
		$('#modalSubirArteProductos').modal('show');


}

/**
 * Abre el modal con los datos repectivos del menu para actualizar la informacion
 * @function mostrarFormularioEditarMenu
 * @param {codigo} codigo 
 */
function mostrarFormularioEditarMenu(codigo){
	var referencia = $('input[name=options]:checked').val();
	registrar = false;
	$.ajax({
		dataType:'json',
		url:"php/menus/consultarMenus.php",
		type:"POST",
		data:{'codigo':codigo},
			
		success:function(data)
		{
			
			$('#frmEditarMenu').bootstrapValidator('resetForm',true);
			$('#frmEditarMenu').data('bootstrapValidator').resetForm();
			$('#modal_menuEditarMenu').on('show.bs.modal', function (event) {
			  var button = $(event.relatedTarget);
			  var modal = $(this);	

			  modal.find('.modal-title').text('Editar producto');
			  $('#codigoEditarMenu').val(data[0].codigo);
			  $('#categoriaSelectEditar').val(data[0].categoria);
			 	$('#nombreMenuEditar').val(data[0].nombre);
				$('#descripcionMenuEditar').val(data[0].descripcion);
				$('#imagenMenuEditar').val(data[0].imagen);
				
		});
		$('#modal_menuEditarMenu').modal('show');

			
		}});


}

function mostrarOculto(){
    var div = document.getElementsByClassName("oculto");
    for (var i = 0; i < 2; i = i + 1) {
      $(div).addClass("nOculto");   
      $(div).fadeOut("slow");
      $(div).fadeIn("slow");
    }
    $(div).fadeOut("slow");
}

function procesarCategoria()
{
	var valido = $("#frmCategoria").data('bootstrapValidator');
    valido.validate();
	if(valido.isValid()) //Los datos son validos
    {
		//Edita
		var nombre = $("#nombreMenuCategoria").val().toUpperCase();
		var descripcion = $("#descripcionMenuCategoria").val().toUpperCase();
		var radioValue = $("input[name='options']:checked").val();
		var imagen = $('#imagenAcceso').val();
		var esPromo = 0;
		if($('#esPromo').is(":checked")){
			esPromo = 1;
		}else{
			esPromo = 0;
		}
		
		if(imagen === ''){
			imagen = 'http://3.16.186.99/sistema/menu/artes/null.jpg';
		}
		
		if(registrar)
		{
			$.ajax({
				dataType:'json',
				url:"php/menus/registrar.php",
				type:"POST",
				data:{'nombre':nombre
					  ,'descripcion':descripcion
					  ,'referencia':radioValue
					  ,'afiliado': afiliadCodX
					  ,'imagen': imagen
					  ,'esPromo': esPromo
				},
				success:function(data)
				{
					if(data == 1)
					{
						
					$("#nombreMenuCategoria").val('');
					$("#descripcionMenuCategoria").val('');
					 $('#imagenAcceso').val('');
					 
					 listarTableAccesosMenu();
						actualizarTabla();
						
					
						$("#alertRegistroAccesos").show();
						setTimeout(function() {
							$("#alertRegistroAccesos").fadeOut();  

					   },3000);
						
					}
					else{
						$('#modalError').on('show.bs.modal', function (event) {
						  var button = $(event.relatedTarget);
						  var modal = $(this);	
						  modal.find('#tmErrorTi').text('Se produjo un error');
						  modal.find('#tmErrorCu').text('Se ha producido un error. Intentalo nuevamente.');
						});
						$('#modalError').modal('show');
					}
				}
			});
		}
		
	}
	else
	{
		//Es Invalido
        $(".has-error:first input").focus();
	}
}

function procesarEditarCategoria(){
	var valido = $("#frmEditarCategoria").data('bootstrapValidator');
    valido.validate();
	if(valido.isValid()) //Los datos son validos
    {
		//Edita
		var codigo = $('#codigoEditarAcceso').val();
		var nombre = $("#nombreEditarCategoria").val().toUpperCase();
		var descripcion = $("#descripcionEditarCategoria").val().toUpperCase();
		var imagen = $('#imagenEditarAcceso').val();
		var esPromo = 0;
		if($('#esPromoEdt').is(":checked")){
			esPromo = 1;
		}else{
			esPromo = 0;
		}
		
		
		if(imagen === ''){
			imagen = 'http://3.16.186.99/sistema/menu/artes/null.jpg';
		}
			$.ajax({
				dataType:'json',
				url:"php/menus/editarAccesos.php",
				type:"POST",
				data:{'codigo':codigo
					  ,'nombre':nombre
					  ,'descripcion':descripcion
					  ,'imagen': imagen
					  ,'esPromo': esPromo
				},
				success:function(data)
				{
					if(data == 1)
					{
						
					 listarTableAccesosMenu();
						actualizarTabla();
						$('#modal_menuEditarCategoria').modal('hide');
					
						$("#alertEditarAccesos").fadeIn();
						setTimeout(function() {
							$("#alertEditarAccesos").fadeOut();  

					   },3000);
						
					}
					else{
						$('#modalError').on('show.bs.modal', function (event) {
						  var button = $(event.relatedTarget);
						  var modal = $(this);	
						  modal.find('#tmErrorTi').text('Se produjo un error');
						  modal.find('#tmErrorCu').text('Se ha producido un error. Intentalo nuevamente.');
						});
						$('#modalError').modal('show');
					}
				}
			});
		
		
	}
	else
	{
		//Es Invalido
        $(".has-error:first input").focus();
	}
}


function procesarMenus()
{
	var valido = $("#frmMenu").data('bootstrapValidator');
    valido.validate();
	if(valido.isValid()) //Los datos son validos
    {
		//Edita
		var categoria = $("#categoriaSelect").val();
		var nombre = $("#nombreMenu").val().toUpperCase();
		var descripcion = $("#descripcionMenu").val().toUpperCase();
		var imagen =  $("#imagenMenu").val();
		
		if(registrar)
		{
			$.ajax({
				dataType:'json',
				url:"php/menus/registrarMenus.php",
				type:"POST",
				data:{'categoria': categoria
					,'nombre':nombre
					  ,'descripcion':descripcion
					  ,'imagen': imagen
				},
				success:function(data)
				{
					if(data == 1)
					{
						$("#categoriaSelect").val('');
						$("#nombreMenu").val('');
						$("#descripcionMenu").val('');
						$("#imagenMenu").val('');
						
						actualizarTabla();
						listarTableMenu();
						//Mostrar alertas
						$("#alertRegistroMenu").show();
						setTimeout(function() {
							$("#alertRegistroMenu").fadeOut();  

					   },3000);
						
					}
					else{
						console.log("Error al insertar");
						
						
						$('#modalError').on('show.bs.modal', function (event) {
						  var button = $(event.relatedTarget);
						  var modal = $(this);	
						  modal.find('#tmErrorTi').text('Se produjo un error');
						  modal.find('#tmErrorCu').text('Se ha producido un error. Intentalo nuevamente.');
						});
						$('#modalError').modal('show');
					}
				}
				
			});
		}
		
	}
	else
	{
		//Es Invalido
		console.log('ERROR NI VALIDADO EL FORM');
		
        $(".has-error:first input").focus();
	}
}

function procesarEditarMenus(){
	var valido = $("#frmEditarMenu").data('bootstrapValidator');
    valido.validate();
	if(valido.isValid()) //Los datos son validos
    {
		//Edita
		var codigo = $('#codigoEditarMenu').val();
		var categoria = $('#categoriaSelectEditar').val();
		var nombre = $("#nombreMenuEditar").val().toUpperCase();
		var descripcion = $("#descripcionMenuEditar").val().toUpperCase();
	
		var imagen = $('#imagenMenuEditar').val();
		
		if(imagen === ''){
			imagen = 'http://3.16.186.99/sistema/menu/artes/null.jpg';
		}
			$.ajax({
				dataType:'json',
				url:"php/menus/editarMenus.php",
				type:"POST",
				data:{'codigo':codigo
					  ,'categoria':categoria
					  ,'nombre':nombre
					  ,'descripcion':descripcion
					  ,'imagen': imagen
				},
				success:function(data)
				{
					if(data == 1)
					{
						
						actualizarTabla();
						listarTableMenu();

						$('#modal_menuEditarMenu').modal('hide');
					
						$("#alertEditarMenu").fadeIn();
						setTimeout(function() {
							$("#alertEditarMenu").fadeOut();  

					   },3000);
						
					}
					else{
						$('#modalError').on('show.bs.modal', function (event) {
						  var button = $(event.relatedTarget);
						  var modal = $(this);	
						  modal.find('#tmErrorTi').text('Se produjo un error');
						  modal.find('#tmErrorCu').text('Se ha producido un error. Intentalo nuevamente.');
						});
						$('#modalError').modal('show');
					}
				}
			});
		
		
	}
	else
	{
		//Es Invalido
        $(".has-error:first input").focus();
	}
}

function procesarDetalleMenus()
{
	var valido = $("#frmDetalleMenu").data('bootstrapValidator');
    valido.validate();
	if(valido.isValid()) //Los datos son validos
    {
		//Inserta
		var	menu = $("#menuSelect").val();
		var	accion = $("#accionSelect").val();
		var	valor = $("#valorDetMenu").val().toUpperCase();
		var	precioM =  $("#precioDetMenu").val(); 
		var	incluido = $("#incluidoDetMenu").val().toUpperCase(); 

			$.ajax({
				dataType:'json',
				url:"php/menus/registrarDetalleMenus.php",
				type:"POST",
				data:{'menu': menu
					,'accion':accion
					  ,'valor':valor
					  ,'precio': precioM
					  ,'incluido':incluido
				},
				success:function(data)
				{
					if(data == 1)
					{
						actualizarTabla();
						$('#modal_detallemenu').modal('hide');
					//Mostrar alertas
					$("#alertRegistroGeneral").fadeIn();
					setTimeout(function() {
						$("#alertRegistroGeneral").fadeOut();  

				   },3000);
					}
					else{
						console.log("Error al insertar");
						
						
						$('#modalError').on('show.bs.modal', function (event) {
						  var button = $(event.relatedTarget);
						  var modal = $(this);	
						  modal.find('#tmErrorTi').text('Se produjo un error');
						  modal.find('#tmErrorCu').text('Se ha producido un error. Intentalo nuevamente.');
						});
						$('#modalError').modal('show');
					}
				}
				
			});
		
	
	}
	else
	{
		//Es Invalido
		console.log('ERROR NI VALIDADO EL FORM');
		
        $(".has-error:first input").focus();
	}
}
function procesarDetalleMenusEdit()
{
	var valido = $("#frmDetalleMenuEdit").data('bootstrapValidator');
    valido.validate();
	if(valido.isValid()) //Los datos son validos
    {
			var menu = $("#menuSelectEdit").val();
			var accion = $("#accionSelectEdit").val();
			var valor = $("#valorDetMenuEdit").val().toUpperCase();
			var precioM =  $("#precioDetMenuEdit").val(); 
			var incluido = $("#incluidoDetMenuEdit").val().toUpperCase(); 

			$.ajax({
				dataType:'json',
				url:"php/menus/editar.php",
				type:"POST",
				data:{'codigo': codigoSeleccionado
					  ,'menu':menu
					  ,'accion':accion
					  ,'valor':valor
					  ,'precio':precioM
					  ,'incluido':incluido
					 },
				success:function(data)
				{
					if(data == 1)
					{
						actualizarTabla();
						$('#modal_detallemenuedit').modal('hide');
							//Mostrar alertas
					$("#alertEditarGeneral").fadeIn();
					setTimeout(function() {
						$("#alertEditarGeneral").fadeOut();  

				   },3000);
					}
					else{
						$('#modalError').on('show.bs.modal', function (event) {
						  var button = $(event.relatedTarget);
						  var modal = $(this);	
						  modal.find('#tmErrorTi').text('Se produjo un error');
						  modal.find('#tmErrorCu').text('Se ha producido un error. Intentalo nuevamente.');
						});
						$('#modalError').modal('show');
					}
				}
			});
		
	}
	else
	{
		//Es Invalido
		console.log('ERROR NI VALIDADO EL FORM');
		
        $(".has-error:first input").focus();
	}
}
function procesarExtraDetalleMenu()
{
	var valido = $("#frmExtras").data('bootstrapValidator');
    valido.validate();
	if(valido.isValid()) //Los datos son validos
    {
		//Edita
		var extra = $("#menuExtraSelect").val();
		var precio = $('#precioextra').val();
		
		if(registrar)
		{
			$.ajax({
				dataType:'json',
				url:"php/menus/registrarExtraDetalleMenu.php",
				type:"POST",
				data:{'detallemenu':codigoSeleccionado
					  ,'extra':extra
					  ,'precio':precio
					  
				},
				success:function(data)
				{
					if(data == 1)
					{
						listarExtraDetalleMenu(codigoSeleccionado);
						$('#menuExtraSelect').val('');
						$('#precioextra').val('');


							//Mostrar alertas
					$("#alertRegistroExtras").fadeIn();
					setTimeout(function() {
						$("#alertRegistroExtras").fadeOut();  

				   },3000);
						
					}
					else{
						$('#modalError').on('show.bs.modal', function (event) {
						  var button = $(event.relatedTarget);
						  var modal = $(this);	
						  modal.find('#tmErrorTi').text('Se produjo un error');
						  modal.find('#tmErrorCu').text('Se ha producido un error. Intentalo nuevamente.');
						});
						$('#modalError').modal('show');
					}
				}
			});
		}
		else{
			$.ajax({
				dataType:'json',
				url:"php/menu/editar.php",
				type:"POST",
				data:{'id': codigoSeleccionado
					  ,'titulo':titulo
					  ,'descripcion':descripcion
					  ,'imagen':imagen
					  ,'precio':precio
					 },
				success:function(data)
				{
					if(data == 1)
					{
						$('#exampleModal').modal('hide');
						actualizarTabla();
						cargarPromosLista();
					}
					else{
						$('#modalError').on('show.bs.modal', function (event) {
						  var button = $(event.relatedTarget);
						  var modal = $(this);	
						  modal.find('#tmErrorTi').text('Se produjo un error');
						  modal.find('#tmErrorCu').text('Se ha producido un error. Intentalo nuevamente.');
						});
						$('#modalError').modal('show');
					}
				}
			});
		}
	}
	else
	{
		//Es Invalido
        $(".has-error:first input").focus();
	}
}


//EVENTOS DE ELIMINAR
function eliminarDetalleMenus()
{
	var menu = 0;
	var ultimo = tablaVol.rows( { selected: true } ).count();
	for (var i = 0; i < tablaVol.rows( { selected: true } ).count(); i++){
    	$.ajax({
			dataType:'json',
			url:"php/menus/eliminarDetMenus.php",
			type:"POST",
			data:{'codigo':tablaVol.rows( { selected: true } ).data()[i].id,
					'afiliado': afiliadCodX
				 },
			success:function(data)
			{
				if( i == (tablaVol.rows( { selected: true } ).count() - 1) )
				{
					menu = 1;
				}

				if(data == 0) //Se produce un error
				{
					menu = 0;
				}

				if(i == ultimo) //Si es el ultimo
				{
					if(menu = 1)
				    {
				    	$('#modalEliminar').modal('hide');
				    	actualizarTabla();
				    	//Mostrar alertas
					$("#alertEliminarGeneral").fadeIn();
					setTimeout(function() {
						$("#alertEliminarGeneral").fadeOut();  

				   },3000);
				    }
				    else
				    {
				    	$('#modalError').on('show.bs.modal', function (event) {
						  var button = $(event.relatedTarget);
						  var modal = $(this);	
						  modal.find('#tmErrorTi').text('Se produjo un error');
						  modal.find('#tmErrorCu').text('Se ha producido un error. Intentalo nuevamente.');
						});
						$('#modalError').modal('show');
						
				    }
				}
			}
		});
    }
}

function eliminarExtraDetalleMenu(codigo){
	
    	$.ajax({
			dataType:'json',
			url:"php/menus/eliminarExtraDetalleMenus.php",
			type:"POST",
			data:{'codigo': codigo,
					'afiliado': afiliadCodX
				 },
			success:function(data)
			{
				
					if(data = 1)
				    {
				    	
						listarExtraDetalleMenu(codigoSeleccionado);
				    		//Mostrar alertas
					$("#alertEliminarExtras").fadeIn();
					setTimeout(function() {
						$("#alertEliminarExtras").fadeOut();  

				   },3000);
				    }
				    else
				    {
				    	$('#modalError').on('show.bs.modal', function (event) {
						  var button = $(event.relatedTarget);
						  var modal = $(this);	
						  modal.find('#tmErrorTi').text('Se produjo un error');
						  modal.find('#tmErrorCu').text('Se ha producido un error. Intentalo nuevamente.');
						});
						$('#modalError').modal('show');
						cargarPromosLista();
				    }
				
			}
		});
    
}

function eliminarAccesoMenusMensajeAlerta(codigo){
	codigoAccesoSeleccionado = codigo;
	$('#modalEliminarAccesos').modal('show');

}



function eliminarAccesoMenus(){
	$('#modalEliminarAccesos').modal('hide');
	
	var codigo = codigoAccesoSeleccionado;
	$.ajax({
		dataType:'json',
		url:"php/menus/eliminarAccesoMenus.php",
		type:"POST",
		data:{'codigo': codigo,
				'afiliado': afiliadCodX
			 },
		success:function(data)
		{
			
				if(data = 1)
				{
					
					listarTableAccesosMenu();
					actualizarTabla();

					//mostrar alerta
					$("#alertEliminarAccesos").fadeIn();
					setTimeout(function (){
						$("#alertEliminarAccesos").fadeOut();
					},3000)
				}
				else
				{
					$('#modal_menuCategoria').modal('hide');
					$('#modalError').on('show.bs.modal', function (event) {
					  var button = $(event.relatedTarget);
					  var modal = $(this);	
					  modal.find('#tmErrorTi').text('Se produjo un error');
					  modal.find('#tmErrorCu').text('Se ha producido un error. Intentalo nuevamente.');
					});
					$('#modalError').modal('show');
					actualizarTabla();
				}
			
		}
	});

}

function eliminarMenusMensajeAlerta(codigo){
	codigoMenuSeleccionado = codigo;
	$('#modalEliminarMenu').modal('show');

}

function eliminarMenus(){
	$('#modalEliminarMenu').modal('hide');
	
	var codigo = codigoMenuSeleccionado;
	$.ajax({
		dataType:'json',
		url:"php/menus/eliminarMenus.php",
		type:"POST",
		data:{'codigo': codigo
				,'afiliado': afiliadCodX
			 },
		success:function(data)
		{
				if(data = 1)
				{
					
					listarTableMenu();
					actualizarTabla();
					$("#alertEliminarMenu").fadeIn();
					setTimeout(function (){
						$("#alertEliminarMenu").fadeOut();
					},3000)
				}
				else
				{
					$('#modal_menuCategoria').modal('hide');
					$('#modalError').on('show.bs.modal', function (event) {
					  var button = $(event.relatedTarget);
					  var modal = $(this);	
					  modal.find('#tmErrorTi').text('Se produjo un error');
					  modal.find('#tmErrorCu').text('Se ha producido un error. Intentalo nuevamente.');
					});
					$('#modalError').modal('show');
					actualizarTabla();
				}
			
		}
	});

}







function validarFormEnterCli(){
    document.getElementById("frmMenu").onkeypress = function(e) {
        var key = e.charCode || e.keyCode || 0;     
        if (key == 13) { //Si es enter
            e.preventDefault();
            procesarCliente();
        }
    }
}

function cargarMenusCategoriasLista(){
	$("#categoriaSelect > option").remove();
	$("#categoriaSelectEditar > option").remove();
    $.ajax({
            dataType:'json',
            url:"php/menus/listarmenucategorias.php",
            type:"POST",
			data:{'afiliado':afiliadCodX
				,'referencia':'CATEGORIA'},
            success:function(data)
            {
                for(i = 0; i < data.length; i++){
					$("#categoriaSelect").append('<option value="'+ data[i]["codigo"] +'">'+data[i]["nombre"] +'</option>');
					$("#categoriaSelectEditar").append('<option value="'+ data[i]["codigo"] +'">'+data[i]["nombre"] +'</option>');
                   // $("select[id=categoriaSelect]").append(new Option(data[i]["nombre"],data[i]["codigo"]));
                }
            }
    });
}

function cargarMenusAccionLista(){
	$("#accionSelect > option").remove();
	$("#accionSelectEdit > option").remove();
	
    $.ajax({
            dataType:'json',
            url:"php/menus/listarmenucategorias.php",
            type:"POST",
			data:{'afiliado':afiliadCodX
				,'referencia':'ACCION'},
            success:function(data)
            {
                for(i = 0; i < data.length; i++){
					$("#accionSelect").append('<option value="'+ data[i]["codigo"] +'">'+data[i]["nombre"] +'</option>');
				   // $("select[id=categoriaSelect]").append(new Option(data[i]["nombre"],data[i]["codigo"]));
				   $("#accionSelectEdit").append('<option value="'+ data[i]["codigo"] +'">'+data[i]["nombre"] +'</option>');

                }
            }
    });
}
function cargarMenusLista(){
	$("#menuSelect > option").remove();
	$("#menuSelectEdit > option").remove();
	$("#arteselect > option").remove();
    $.ajax({
            dataType:'json',
            url:"php/menus/listarmenus.php",
            type:"POST",
            data:{'afiliado':afiliadCodX},
            success:function(data)
            {
                for(i = 0; i < data.length; i++){
					
					$("#menuSelect").append('<option value="'+ data[i]["codigo"] +'">'+data[i]["nombre"] +'</option>');
					$("#menuSelectEdit").append('<option value="'+ data[i]["codigo"] +'">'+data[i]["nombre"] +'</option>');
					
					$("#arteselect").append('<option value="'+ data[i]["codigo"] +'">'+data[i]["nombre"] +'</option>');
                }
            }
    });
}
function cargarMenuExtrasLista(){
	$("#menuExtraSelect > option").remove();
    $.ajax({
            dataType:'json',
            url:"php/menus/listarmenuextras.php",
            type:"POST",
            data:{'afiliado':afiliadCodX},
            success:function(data)
            {
                for(i = 0; i < data.length; i++){
					
					$("#menuExtraSelect").append('<option value="'+ data[i]["codigo"] +'">'+data[i]["nombre"] +'</option>');
					
                }
            }
    });
}
function cargarPromosLista(){
	$("#listaPromos > option").remove();
    $.ajax({
            dataType:'json',
            url:"php/menus/listar.php",
            type:"POST",
            data:{'afiliado':afiliadCodX},
            success:function(data)
            {
                for(i = 0; i < data.length; i++){
					$("select[id=listaPromos]").append(new Option(data[i]["titulo"],data[i]["id"]));
					
                }
            }
    });
}

function ocultarCarga(){
    $("#carga").removeClass("carga");
    $("#cont-loader").removeClass("cont-loader");
    $("#loader").removeClass("loader");
}

function mostrarCarga(){
    $("#carga").addClass("carga");
    $("#cont-loader").addClass("cont-loader");
    $("#loader").addClass("loader");
}


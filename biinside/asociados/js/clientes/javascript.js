

/******************************************************************************************************
JavaScript Bienvenida
*****************************************************************************************************/

var codigoSeleccionado;
var tablaVol=null;
var tablaCat=null;
var registrar = false;
var codigoCategoria;

$(document).ready(function(){
	cargarDatos();	
	validarDatos();
	validarFormEnterCli();
	cargarPromosLista();
	cargarCategoriasLista();
	enviarArte();
	cargarTablaCategorias();
});

function enviarArte(){
	 $("#frmArtes").on('submit', function(e){
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
            success: function(response){ //console.log(response);
                if(response == 1)
                {
                	actualizarTabla();
                	ocultarCarga();
                	$('#modalArtes').modal('hide');
                }
                else{
                	alert("Ocurrió un problema, intentalo nuevamente");
                }
            }
        });
    });
}

function validarDatos(){
    $('#frmClientes').bootstrapValidator({
        message: 'Los datos no son validos',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        excluded:[':disabled'],
        fields: {
            titulo: {
                validators: {
                    notEmpty: {
                        message: 'El nombre es requerido'
                    },
                    stringLength: {
                        max: 60,
                        message: 'El nombre es demasiado grande'
                    }
                }
            },
            descbasica: {
                notEmpty: {
                        message: 'La descripcion básica es requerida'
                }
            },
            descripcion: {
                notEmpty: {
                        message: 'El beneficio(s) es requerido'
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
	var table = $('#tablaClientes').DataTable({
		dom: 'Blfrtip',
		 "stripeClasses": [ '', 'strip2'],
        "ajax": 
    		{
			"url":"php/afiliados/listar.php", // Cargar archivo de listar los usuarios
			"type":"POST", // Metodo post debido a la cantidad y el tipo de datos
			"data":{'afiliado':afiliadCodX}, // Los datos que nos interesan solicitar
			"dataType":"JSON" // Indicamos que es un JSON
		},
	     select: {
            style: 'multi'
        },
    	sAjaxDataProp: "",
    	"aoColumns": [
	        { "mData": "nombre" },
	        { "mData": "descripcion" },
	        { "mData": "beneficio" },
	        { "mData": "sitioweb" },
	        { "mData": "facebook" },
	        { "mData": "instagram" },
	        { "mData": "logo" },
			{ "mData": "categoriaNombre" },
			{ "mData": "orden" }
	    ],
		rowId: 'id',
		"createdRow": function(row, data, dataIndex){
        },
        buttons: [
        	{
                text: 'Nuevo',
                className: 'btn-tablas',
                action: function () {
                	registrar = true;
                   $('#frmClientes').bootstrapValidator('resetForm',true);
					    $('#frmClientes').data('bootstrapValidator').resetForm();
						$('#exampleModal').on('show.bs.modal', function (event) {
						  var button = $(event.relatedTarget);
						  var modal = $(this);	
						  modal.find('.modal-title').text('Nuevo Asociado');
						  $("#titulo").val('');
						  $("#descripcion").val('');
						  $("#imagen").val('');
						  $("#categorias").val(1);
						  $("#orden").val("");
						  $("#descbasica").val("");
						  $("#sitioweb").val("");
						  $("#facebook").val("");
						  $("#instagram").val("");
					});
					$('#exampleModal').modal('show');
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
                action: function () {
                	registrar = false;
                    if(table.rows( { selected: true } ).count() == 1)
                	{
                		codigoSeleccionado = table.rows( { selected: true } ).data()[0].id;

						$('#frmClientes').bootstrapValidator('resetForm',true);
					    $('#frmClientes').data('bootstrapValidator').resetForm();
						$('#exampleModal').on('show.bs.modal', function (event) {
							  var button = $(event.relatedTarget);
							  var modal = $(this);	
							  modal.find('.modal-title').text('Editar promoción: ');
							  $("#titulo").val(table.rows( { selected: true } ).data()[0].nombre);
							  $("#descbasica").val(table.rows( { selected: true } ).data()[0].descripcion);
							  $("#descripcion").val(table.rows( { selected: true } ).data()[0].beneficio);
							  $("#imagen").val(table.rows( { selected: true } ).data()[0].logo);
							  $("#categorias").val(table.rows( { selected: true } ).data()[0].categoria);
							  $("#orden").val(table.rows( { selected: true } ).data()[0].orden);
							  $("#sitioweb").val(table.rows( { selected: true } ).data()[0].sitioweb);
							  $("#facebook").val(table.rows( { selected: true } ).data()[0].facebook);
							  $("#instagram").val(table.rows( { selected: true } ).data()[0].instagram);
						});
						$('#exampleModal').modal('show');
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
                text: 'Actualizar Datos',
                className: 'btn-tablas',
                action: function () {
                    actualizarTabla();
                }
            },
            {
                text: 'Subir Arte',
                className: 'btn-tablas',
                action: function () {
                	$('#modalArtes').modal('show');
                }
            },
			{
				text: 'Categorias',
                className: 'btn-tablas',
                action: function () {
                	$('#modalCategorias').modal('show');
                }
			}
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

function cargarTablaCategorias(){
	var table = $('#tablaCategorias').DataTable({
		dom: 'Blfrtip',
		 "stripeClasses": [ '', 'strip2'],
        "ajax": 
    		{
			"url":"php/afiliados/listarCategorias.php", // Cargar archivo de listar los usuarios
			"type":"POST", // Metodo post debido a la cantidad y el tipo de datos
			"data":{'afiliado':afiliadCodX}, // Los datos que nos interesan solicitar
			"dataType":"JSON" // Indicamos que es un JSON
		},
	     select: {
            style: 'multi'
        },
    	sAjaxDataProp: "",
    	"aoColumns": [
	        { "mData": "nombre" }
	    ],
		rowId: 'id',
		"createdRow": function(row, data, dataIndex){
        },
        buttons: [
        	{
                text: 'Eliminar',
                className: 'btn-tablas',
                action: function () {
                	if(table.rows( { selected: true } ).count() > 0)
                	{
                		$('#modalEliminarCat').modal('show');
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
                action: function () {
                    if(table.rows( { selected: true } ).count() == 1)
                	{
                		codigoCategoria = table.rows( { selected: true } ).data()[0].id;
						
						$('#modalCategoriaEditar').on('show.bs.modal', function (event) {
							  var button = $(event.relatedTarget);
							  var modal = $(this);	
							  modal.find('.modal-title').text('Editar categoria: ');
							  $("#nombreCategoriaEdt").val(table.rows( { selected: true } ).data()[0].nombre);
						});
						$('#modalCategoriaEditar').modal('show');
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
                text: 'Actualizar Datos',
                className: 'btn-tablas',
                action: function () {
                    actualizarTablaCat();
                }
            }
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

    $(window).scroll(function(){
    	$(".paginate_button > a").blur();
  	});
	
	tablaCat  = table;
}

function actualizarTabla(){
	tablaVol.ajax.reload(null,false);
}

function actualizarTablaCat(){
	tablaCat.ajax.reload(null,false);
}

function abrirEliminar(){
	$('#borrarModal').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget);
	  var modal = $(this);
	  modal.find('.modal-title').text('Eliminar el Asociado: ' + clienteSeleccionado.nombre);
	});
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

function procesarCliente()
{
	var valido = $("#frmClientes").data('bootstrapValidator');
    valido.validate();
	if(valido.isValid()) //Los datos son validos
    {
		//Edita
		var titulo = $("#titulo").val().toUpperCase();
		var descbasica = $("#descbasica").val().toUpperCase();
		var descripcion = $("#descripcion").val().toUpperCase();
		var imagen = $("#imagen").val();
		var categoria = $("#categorias").val();
		var orden = $("#orden").val();
		var sitioweb = $("#sitioweb").val();
		var facebook = $("#facebook").val();
		var instagram = $("#instagram").val();

		if(registrar)
		{
			$.ajax({
				dataType:'json',
				url:"php/afiliados/registrar.php",
				type:"POST",
				data:{'titulo':titulo
					  ,'descbasica':descbasica
					  ,'descripcion':descripcion
					  ,'imagen':imagen
					  ,'categoria':categoria
					  ,'orden':orden
					  ,'facebook':facebook
					  ,'sitioweb':sitioweb
					  ,'instagram':instagram
					  ,'afiliado':afiliadCodX
				},
				success:function(data)
				{
					if(data == 1)
					{
						$('#exampleModal').modal('hide');
						actualizarTabla();
						cargarPromosLista();
						$('#modalNotifiPro').modal('hide');
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
				url:"php/afiliados/editar.php",
				type:"POST",
				data:{'id': codigoSeleccionado
					  ,'titulo':titulo
					   ,'descbasica':descbasica
					  ,'descripcion':descripcion
					  ,'imagen':imagen
					  ,'categoria':categoria
					  ,'orden':orden
					   ,'facebook':facebook
					  ,'sitioweb':sitioweb
					  ,'instagram':instagram
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


function agregarCategoria()
{
	$.ajax({
		dataType:'json',
		url:"php/afiliados/guardarCat.php",
		type:"POST",
		data:{'nombre': $("#nombreCategoria").val()
			,'afiliado': afiliadCodX
			 },
		success:function(data)
		{
			if(data == 1)
			{
				actualizarTablaCat();
				cargarCategoriasLista();
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

function editarCategoria()
{
	$.ajax({
		dataType:'json',
		url:"php/afiliados/editarCat.php",
		type:"POST",
		data:{'nombre': $("#nombreCategoria").val()
			,'id': codigoCategoria
			 },
		success:function(data)
		{
			if(data == 1)
			{
				$('#modalCategoriaEditar').modal('hide');
				actualizarTablaCat();
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

function eliminarClientes()
{
	var afiliado = 0;
	var ultimo = tablaVol.rows( { selected: true } ).count();
	for (var i = 0; i < tablaVol.rows( { selected: true } ).count(); i++){
    	$.ajax({
			dataType:'json',
			url:"php/afiliados/eliminar.php",
			type:"POST",
			data:{'codigo':tablaVol.rows( { selected: true } ).data()[i].id
				 },
			success:function(data)
			{
				if( i == (tablaVol.rows( { selected: true } ).count() - 1) )
				{
					afiliado = 1;
				}

				if(data == 0) //Se produce un error
				{
					afiliado = 0;
				}

				if(i == ultimo) //Si es el ultimo
				{
					if(afiliado = 1)
				    {
				    	$('#modalEliminar').modal('hide');
				    	actualizarTabla();
				    	cargarPromosLista();
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
			}
		});
    }
}

function eliminarCategorias()
{
	var afiliado = 0;
	var ultimo = tablaCat.rows( { selected: true } ).count();
	for (var i = 0; i < tablaCat.rows( { selected: true } ).count(); i++){
    	$.ajax({
			dataType:'json',
			url:"php/afiliados/eliminarCat.php",
			type:"POST",
			data:{'codigo':tablaCat.rows( { selected: true } ).data()[i].id
				 },
			success:function(data)
			{
				if( i == (tablaCat.rows( { selected: true } ).count() - 1) )
				{
					afiliado = 1;
				}

				if(data == 0) //Se produce un error
				{
					afiliado = 0;
				}

				if(i == ultimo) //Si es el ultimo
				{
					if(afiliado = 1)
				    {
				    	$('#modalEliminarCat').modal('hide');
				    	actualizarTablaCat();
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

function validarFormEnterCli(){
    document.getElementById("frmClientes").onkeypress = function(e) {
        var key = e.charCode || e.keyCode || 0;     
        if (key == 13) { //Si es enter
            e.preventDefault();
            procesarCliente();
        }
    }
}

function cargarPromosLista(){
	$("#listaPromos > option").remove();
    $.ajax({
            dataType:'json',
            url:"php/afiliados/listar.php",
            type:"POST",
            data:{'afiliado':afiliadCodX},
            success:function(data)
            {
                for(i = 0; i < data.length; i++){
                    $("select[id=listaPromos]").append(new Option(data[i]["nombre"],data[i]["id"]));
                }
            }
    });
}

function cargarCategoriasLista(){
	$("#categorias > option").remove();
    $.ajax({
            dataType:'json',
            url:"php/afiliados/listarCategorias.php",
            type:"POST",
            data:{'afiliado':afiliadCodX},
            success:function(data)
            {
                for(i = 0; i < data.length; i++){
                    $("select[id=categorias]").append(new Option(data[i]["nombre"],data[i]["id"]));
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

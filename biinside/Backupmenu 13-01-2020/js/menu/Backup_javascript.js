var codigoSeleccionado;
var tablaVol=null;
var registrar = false;

$(document).ready(function(){
	cargarDatos();	
	validarDatos();
	validarFormEnterCli();
	cargarPromosLista();
	enviarArte();
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
	        { "mData": "titulo" },
	        { "mData": "descripcion" },
	        { "mData": "imagen" },
	        { "mData": "precio" }
	    ],
		rowId: 'id',
		"createdRow": function(row, data, dataIndex){
            if(data.industria === 'NO ASIGNADA'){
                //$(row).addClass('nAsignada');
            }
            else
            {
            	//$(row).addClass('asignada');	
            }
        },
        buttons: [
        	{
                text: 'Nuevo',
                className: 'btn-tablas',
                action: function () {
                	registrar = true;
                   $('#frmMenu').bootstrapValidator('resetForm',true);
					    $('#frmMenu').data('bootstrapValidator').resetForm();
						$('#exampleModal').on('show.bs.modal', function (event) {
						  var button = $(event.relatedTarget);
						  var modal = $(this);	
						  modal.find('.modal-title').text('Nueva promoción');
						  $("#titulo").val('');
						  $("#descripcion").val('');
						  $("#imagen").val('');
						  $("#precio").val('');
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

						$('#frmMenu').bootstrapValidator('resetForm',true);
					    $('#frmMenu').data('bootstrapValidator').resetForm();
						$('#exampleModal').on('show.bs.modal', function (event) {
							  var button = $(event.relatedTarget);
							  var modal = $(this);	
							  modal.find('.modal-title').text('Editar promoción: ');
							  $("#titulo").val(table.rows( { selected: true } ).data()[0].titulo);
							  $("#descripcion").val(table.rows( { selected: true } ).data()[0].descripcion);
							  $("#imagen").val(table.rows( { selected: true } ).data()[0].imagen);
							  $("#precio").val(table.rows( { selected: true } ).data()[0].precio);
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

function actualizarTabla(){
	tablaVol.ajax.reload(null,false);
}

function abrirEliminar(){
	$('#borrarModal').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget);
	  var modal = $(this);
	  modal.find('.modal-title').text('Eliminar la promoción: ' + clienteSeleccionado.nombre);
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
	var valido = $("#frmMenu").data('bootstrapValidator');
    valido.validate();
	if(valido.isValid()) //Los datos son validos
    {
		//Edita
		var titulo = $("#titulo").val().toUpperCase();
		var descripcion = $("#descripcion").val().toUpperCase();
		var imagen = $("#imagen").val().toUpperCase();
		var precio = $("#precio").val();

		if(registrar)
		{
			$.ajax({
				dataType:'json',
				url:"php/menus/registrar.php",
				type:"POST",
				data:{'titulo':titulo
					  ,'descripcion':descripcion
					  ,'imagen':imagen
					  ,'precio':precio
					  ,'afiliado': afiliadCodX
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

function eliminarClientes()
{
	var menu = 0;
	var ultimo = tablaVol.rows( { selected: true } ).count();
	for (var i = 0; i < tablaVol.rows( { selected: true } ).count(); i++){
    	$.ajax({
			dataType:'json',
			url:"php/menus/eliminar.php",
			type:"POST",
			data:{'codigo':tablaVol.rows( { selected: true } ).data()[i].id
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

function validarFormEnterCli(){
    document.getElementById("frmMenu").onkeypress = function(e) {
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

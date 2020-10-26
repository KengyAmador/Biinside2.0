

/******************************************************************************************************
JavaScript Bienvenida
*****************************************************************************************************/

var codigoSeleccionado;
var tablaVol=null;

$(document).ready(function(){
	cargarDatos();	
	validarDatos();
	validarFormEnterCli();
	cargarIndustrias();
});

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
	var table = $('#tablaClientes').DataTable({
		dom: 'Blfrtip',
		 "stripeClasses": [ '', 'strip2'],
        "ajax": 
    		{
			"url":"php/afiliados/listar.php", // Cargar archivo de listar los usuarios
			"type":"POST", // Metodo post debido a la cantidad y el tipo de datos
			"data":{}, // Los datos que nos interesan solicitar
			"dataType":"JSON" // Indicamos que es un JSON
		},
	     select: {
            style: 'multi'
        },
    	sAjaxDataProp: "",
    	"aoColumns": [
	        { "mData": "codigo" },
	        { "mData": "nombre" },
	        { "mData": "encargado" },
	        { "mData": "telefono" },
	        { "mData": "industria" },
	        { "mData": "porcentaje" }
	    ],
		rowId: 'codigo',
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
                text: 'Asignar Industria',
                className: 'btn-tablas',
                action: function () {
                   if(table.rows( { selected: true } ).count() > 0)
                	{
                		$('#modalIndustria').on('show.bs.modal', function (event) {
						  var button = $(event.relatedTarget);
						  var modal = $(this);
						});
						$('#modalIndustria').modal('show');
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
                text: 'Actualizar Datos',
                className: 'btn-tablas',
                action: function () {
                    actualizarTabla();
                }
            },
            {
                text: 'Editar',
                className: 'btn-tablas',
                action: function () {
                    if(table.rows( { selected: true } ).count() == 1)
                	{
                		codigoSeleccionado = table.rows( { selected: true } ).data()[0].codigo;

						$('#frmClientes').bootstrapValidator('resetForm',true);
					    $('#frmClientes').data('bootstrapValidator').resetForm();
						$('#exampleModal').on('show.bs.modal', function (event) {
							  var button = $(event.relatedTarget);
							  var modal = $(this);	
							  modal.find('.modal-title').text('Editar cliente código: ' + codigoSeleccionado);
							  $("#nombre").val(table.rows( { selected: true } ).data()[0].nombre);
							  $("#encargado").val(table.rows( { selected: true } ).data()[0].encargado);
							  $("#telefono").val(table.rows( { selected: true } ).data()[0].telefono);
							  $("#industria").val(table.rows( { selected: true } ).data()[0].industria);
							  $("#porcentaje").val(table.rows( { selected: true } ).data()[0].porcentaje);
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
	  modal.find('.modal-title').text('Eliminar el cliente: ' + clienteSeleccionado.nombre);
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
		var nombre = $("#nombre").val().toUpperCase();
		var encargado = $("#encargado").val().toUpperCase();
		var telefono = $("#telefono").val().toUpperCase();
		var industria = $("#industria").val().toUpperCase();
		var porcentaje = $("#porcentaje").val();

		$.ajax({
			dataType:'json',
			url:"php/afiliados/editar.php",
			type:"POST",
			data:{'codigo': codigoSeleccionado
				  ,'nombre':nombre
				  ,'encargado':encargado
				  ,'telefono':telefono
				  ,'industria':industria
				  ,'porcentaje':porcentaje
				 },
			success:function(data)
			{
				if(data == 1)
				{
					$('#exampleModal').modal('hide');
					actualizarTabla();
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

function eliminarClientes()
{
	var afiliado = 0;
	for (var i = 0; i < tablaVol.rows( { selected: true } ).count(); i++){
    	$.ajax({
			dataType:'json',
			url:"php/afiliados/eliminar.php",
			type:"POST",
			data:{'codigo':tablaVol.rows( { selected: true } ).data()[i].codigo
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
			}
		});
    }

    if(afiliado = 1)
    {
    	$('#modalEliminar').modal('hide');
    	actualizarTabla();
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

function validarFormEnterCli(){
    document.getElementById("frmClientes").onkeypress = function(e) {
        var key = e.charCode || e.keyCode || 0;     
        if (key == 13) { //Si es enter
            e.preventDefault();
            procesarCliente();
        }
    }
}

function cargarIndustrias(){
     $.ajax({
            dataType:'json',
            url:"php/industrias/listar.php",
            type:"POST",
            success:function(data)
            {
                for(i = 0; i < data.length; i++){
                    $("select[id=industria]").append(new Option(data[i]["categoria"], data[i]["categoria"]));
                    $("select[id=industria2]").append(new Option(data[i]["categoria"], data[i]["categoria"]));
                }
            }
    });
}

function asignarIndus(){
	var afiliado = 0;
	for (var i = 0; i < tablaVol.rows( { selected: true } ).count(); i++){
    	$.ajax({
			dataType:'json',
			url:"php/afiliados/asignarIndus.php",
			type:"POST",
			data:{'id':tablaVol.rows( { selected: true } ).data()[i].codigo,
					'industria': $("#industria2").val()
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
			}
		});
    }

    if(afiliado = 1)
    {
    	$('#modalIndustria').modal('hide');
    	actualizarTabla();
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


/******************************************************************************************************
JavaScript Bienvenida
*****************************************************************************************************/

var codigoSeleccionado;
var tablaVol=null;
var tablaPros=null;
var tablaDet=null;
var tablaExt=null;
var registrar = false;
var titleNotif = ''; //Notificaciones
var verificaciones;
var verificacionesPro;
var updates;
var tokenActual = '';
//Datos para imprimir la orden (seleccionada)
var clienteOrden = '';
var codigoClienteOrden = '';
var numeroOrden = '';
var expressOrden = 0;
var metodoPagoOrden = '';
var fechaRetiroOrden = '';
var telefonoOrden = '';

$(document).ready(function(){
	inicializarTablaReporte(0, '');
	setTimeout(function(){ 
		inicializarTablaReportePro(0, '');
	}, 2000);
});

var tablaDet=null;
var tablaExt=null;

function inicializarTablaReporte(valor, fecha)
{
	tablaVol = $('#tablaClientes').DataTable({
			dom: 'Blfrtip',
			select:false,
			 "stripeClasses": [ '', 'strip2'],
		    "ajax": 
				{
				"url":"php/afiliados/listar.php", // Cargar archivo de listar los usuarios
				"type":"POST", // Metodo post debido a la cantidad y el tipo de datos
				"data":{'afiliado':valor, 'fecha':fecha}, // Los datos que nos interesan solicitar
				"dataType":"JSON" // Indicamos que es un JSON
			},
			sAjaxDataProp: "",
			"aoColumns": [
		        { "mData": "codigo" },
		        { "mData": "fechaorden" },
		        { "mData": "cliente" },
		        { "mData": "codigocliente" },
		        { "mData": "totalexpress" },
		        { "mData": "totalparcial" },
		        { "mData": "totalfinal" },
		        { "mData": "metodopago" },
		        { "mData": "telefono" },
		        { "mData": "direccion" },
		        { "mData": "fecharetiro" },
		        { "mData": "pagocliente" },
		        { "mData": null,  "sDefaultContent": "<button class='btnMapa btn btn-sucess' style='background-color:#1c1c1c;color:white;'>VER MAPA</button>"},
				{ "mData": null,  "sDefaultContent": "<button class='btnVerDetalles btn btn-sucess' style='background-color:#1c1c1c;color:white;'>DETALLES</button>"},
				{ "mData": null,  "sDefaultContent": "<button class='btnNotificar btn btn-sucess' style='background-color:#1c1c1c;color:white;'>ENVIAR NOTIFICACION</button>"}
		    ],
			rowId: 'codigo',
			"createdRow": function(row, data, dataIndex){
				$(".btnVerDetalles", row)[0].addEventListener('click', (event) => detallesOrdenes(event, data), false);
				$(".btnNotificar", row)[0].addEventListener('click', (event) => notificarOrden(event, data), false);
				if(parseInt(data.totalexpress)===0)
				{
					$(".btnMapa", row)[0].addEventListener('click', (event) => indicarRecoger(event, data), false);
				}
				else{
					$(".btnMapa", row)[0].addEventListener('click', (event) => verMapa(event, data), false);
				}
			},
		    buttons: [
		        {
		            text: 'Actualizar Tabla',
		            className: 'btn-tablas',
		            action: function () {
		                actualizarTabla();
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
}

function inicializarTablaReportePro(valor, fecha){
	tablaPros = $('#tablaPromos').DataTable({
		select:false,
		 "stripeClasses": [ '', 'strip2'],
        "ajax": 
    		{
			"url":"php/afiliados/listarPromos.php", // Cargar archivo de listar los usuarios
			"type":"POST", // Metodo post debido a la cantidad y el tipo de datos
			"data":{'afiliado':valor, 'fecha':fecha}, // Los datos que nos interesan solicitar
			"dataType":"JSON" // Indicamos que es un JSON
		},
    	sAjaxDataProp: "",
    	"aoColumns": [
	        { "mData": "id" },
	        { "mData": "fechaorden" },
	        { "mData": "orden" },
	        { "mData": "cliente" },
	        { "mData": "fecharetiro" },
	        { "mData": "direccion" },
	        { "mData": "precio" },
	        { "mData": "metodopago" },
	        { "mData": "express" },
	        { "mData": "preciototal" },
			{ "mData": "pagocliente" },
			{ "mData": "telefono" },
			{ "mData": null,  "sDefaultContent": "<button class='btnMapaPro btn btn-sucess' style='background-color:#1c1c1c;color:white;'>VER MAPA</button>"},
			{ "mData": null,  "sDefaultContent": "<button class='btnNotificarPro btn btn-sucess' style='background-color:#1c1c1c;color:white;'>NOTIFICAR</button>"},
			{ "mData": null,  "sDefaultContent": "<button class='btnComandaPro btn btn-sucess' style='background-color:#1c1c1c;color:white;'>IMPRIMIR COMANDA</button>"}

	    ],
		rowId: 'id',
		"createdRow": function(row, data, dataIndex){
			$(".btnNotificarPro", row)[0].addEventListener('click', (event) => notificarOrdPromo(event, data), false);
			if(parseInt(data.express)===0)
			{
				$(".btnMapaPro", row)[0].addEventListener('click', (event) => indicarRecogerPro(event, data), false);
			}
			else{
				$(".btnMapaPro", row)[0].addEventListener('click', (event) => verMapaPro(event, data), false);
			}

			$(".btnComandaPro", row)[0].addEventListener('click', (event) => imprimirComandaPro(event, data), false);
        },
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
}

function notificarOrdPromo(event, arg) {
	$("#contmensaje").val("");
	tokenActual = arg.token;
	$('#modalNotifiPro').modal('show');
}

function detallesOrdenes(event, arg) {
	numeroOrden = arg.codigo;
	clienteOrden = arg.cliente;
	codigoClienteOrden = arg.codigocliente;
	expressOrden = arg.totalexpress;
	metodoPagoOrden = arg.metodopago;
	fechaRetiroOrden = arg.fecharetiro;
	telefonoOrden = arg.telefono;

	var tablaEx = $('#tablaExtOrd').DataTable({
		paging: false,
		retrieve: true,
    	searching: false,
		"stripeClasses": [ '', 'strip2'],
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
			}
		}	
	});

	var tablaDe = $('#tablaDetaOrd').DataTable({
		paging: false,
    	searching: false,
		"stripeClasses": [ '', 'strip2'],
        "ajax": 
    		{
			"url":"php/afiliados/listarDetalles.php", // Cargar archivo de listar los usuarios
			"type":"POST", // Metodo post debido a la cantidad y el tipo de datos
			"data":{'codigo':arg.codigo, 'afiliado':afiliadCodX}, // Los datos que nos interesan solicitar
			"dataType":"JSON" // Indicamos que es un JSON
		},
    	sAjaxDataProp: "",
    	"aoColumns": [
    		{ "mData": null },
	        { "mData": "categoria" },
	        { "mData": "nombreproducto" },
	        { "mData": "aspectocompra" },
	        { "mData": "cantidad" }
	    ],
	    "createdRow": function(row, data, dataIndex){
			$.ajax({
				url:"php/afiliados/listarExtras.php",
				type:"POST",
				data:{'codigo':data.codigoDetalle, 'afiliado':afiliadCodX},
				success:function(datoss)
				{
					if(datoss.length != 0){
						datoss.forEach(function (value, i) {
						   var indice = dataIndex+1;
						   tablaEx.row.add([
					            datoss[i].nombreextras,
					            datoss[i].descripcion,
					            datoss[i].cantidad,
					            indice
					        ]).draw(false); 
						});
					}
				}
			});
        },
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

	tablaDet = tablaDe;
    tablaExt = tablaEx;

	$('#exampleModal').on('hide.bs.modal', function (event) {
	  tablaDe.destroy();
	  tablaEx.clear().draw();
	  numeroOrden = '';
	  clienteOrden = '';
	  codigoClienteOrden = '';
	  expressOrden = 0;
	  fechaRetiroOrden = '';
	  metodoPagoOrden = '';
	  telefonoOrden = '';
	});

	tablaDet.on( 'order.dt search.dt', function () {
        tablaDet.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

	$('#exampleModal').modal('show'); //Mostrar el modal con los detalles y los extras
}

function notificarOrden(event, arg) {
	$("#contmensaje").val("");
	tokenActual = arg.token;
	console.log(tokenActual);
	$('#modalNotifiPro').modal('show');
}

function enviarNotiOrden(){
	$.ajax({
		url:"php/afiliados/notificarOrden.php",
		type:"POST",
		data:{
				'token': tokenActual,
				'afiliado':afiliadCodX,
				'mensaje':$("#contmensaje").val()
			 },
		success:function(data)
		{
			//Cambiar el estado de la orden aquí
			if(data==1)
			{
				$('#modalNotifiPro').modal('hide');
			}
			else{
				alert("Ocurrió un error al notificar, intente nuevamente");
				actualizarTabla();
			}
		}
	});
}

function listarFacturasD(){
	tablaVol.destroy();
    inicializarTablaReporte(afiliadCodX, $('#fechaReporte').val());
	tablaPros.destroy();
    inicializarTablaReportePro(afiliadCodX, $('#fechaReporte').val());
}

function actualizarTabla(){
	tablaVol.ajax.reload(null,false);
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

function verMapa(event, arg) {
  var URL = "https://www.google.com/maps/search/?api=1&query="+arg.ubicacion;
  window.open(URL, '_blank');
}

function indicarRecoger() {
  alert("Esta orden es para recoger");
}

function verMapaPro(event, arg) {
  var URL = "https://www.google.com/maps/search/?api=1&query="+arg.ubicacion;
  window.open(URL, '_blank');
}

function indicarRecogerPro() {
  alert("Esta orden de promo es para recoger");
}

/* IMPRESIONES */

function imprimirComanda(){ //Imprimir orden a la comanda
	var productosDet = [];
	var productosExt = [];
	var tipo  = '';
	
	tablaDet.rows().every(function(index)
	{
		var datas = this.data();
		var filaDatos = [];
		var nombre = datas["categoria"] + " - " + datas["nombreproducto"] + " - " + datas["aspectocompra"] ;
		filaDatos.push(index+1);
		filaDatos.push(nombre);
		filaDatos.push(datas["cantidad"]);
		productosDet.push(filaDatos);
	});

	tablaExt.rows().every(function()
	{
		var datas = this.data();
		var filaDatos = [];
		var nombre = datas[0] + " - " + datas[1];
		filaDatos.push(nombre);
		filaDatos.push(datas[2]);
		filaDatos.push(datas[3]);
		productosExt.push(filaDatos);
	});

	if(parseInt(expressOrden)==0){
		tipo = "Recoger";
		console.log(metodoPagoOrden);
		if(metodoPagoOrden === 'Restaurante'){
			tipo = 'Comer en Restaurante';
		}
	}else{
		tipo = "Express";
	}
	
	$.ajax({
        url: 'php/afiliados/imprimir/imprimirComanda.php',
        type: 'POST',
        data:{
        		'numero':numeroOrden,
        		'cliente':clienteOrden,
        		'codigo':codigoClienteOrden,
        		'tipo':tipo,
				'productosDet':productosDet,
				'productosExt':productosExt,
				'fechaRetiro': fechaRetiroOrden,
				'telefono': telefonoOrden
			 },
        success: function() {
            var win = window.open("http://3.16.186.99/biinside/historial/php/afiliados/imprimir/comanda.pdf", '_blank');
  			win.focus();
        }
    });
}

function imprimirComandaPro(event, arg){ //Imprimir orden a la comanda para promos
	var tipo  = '';
	var nombre = "PROMO: " + arg.orden;

	if(parseInt(arg.express)==0){
		tipo = "Recoger";
		console.log(arg.metodopago);
		if(arg.metodopago === 'Restaurante'){
			tipo = "Comer en Restaurante";
		}
	}else{
		tipo = "Express";
	}
	
	$.ajax({
        url: 'php/afiliados/imprimir/imprimirComandaPro.php',
        type: 'POST',
        data:{
        		'numero':arg.id,
        		'cliente': arg.cliente,
        		'tipo': tipo,
				'nombrepromo':nombre,
				'comentario':arg.comentario,
				'fechaRetiro': arg.fecharetiro,
				'telefono': arg.telefono
			 },
        success: function(data) {
        	var win = window.open("http://3.16.186.99/biinside/historial/php/afiliados/imprimir/comandapro.pdf", '_blank');
  			win.focus();
        }
    });
}




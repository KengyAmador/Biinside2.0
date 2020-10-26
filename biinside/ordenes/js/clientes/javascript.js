

/******************************************************************************************************
JavaScript Bienvenida
*****************************************************************************************************/

var codigoSeleccionado;
var tablaVol=null;
var tablaPros=null;
var tablaDet=null;
var tablaExt=null;
var tablaPre=null;
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
var expressPagoOrden = 0;
var metodoOrden = '';
var pagaConOrden = 0;
var dirComentarioOrden = 0;
var pagoTotalOrden = 0;
//
var sonidoSiempre = 0;

var textoDespachar = "DESPACHAR";

var audio = null;

$(document).ready(function(){
	if(afiliadCodX === 'BI0013'){
		textoDespachar = 'RECIBIDA';
	}
	else{
		textoDespachar = 'DESPACHAR';
	}

	cargarDatos();
	cargarDatosPromos();
	activarUpdates();
	titleNotif = document.title;
	audio = new Audio("http://apps.biinsidecr.com/sistema/ordenes/sonido.wav");
});

//NOTIFICACIONES CAMBIOS
function validarNotif(counterNot) {
    if(counterNot>0){
		var newTitle = '(*)' + titleNotif;
		document.title = newTitle;
		playSonido();
	}
}

function validarNotifPromos(counterNotP) {
    if(counterNotP>0){
		var newTitle = '(*)' + titleNotif;
		document.title = newTitle;
		playSonidoPro();
	}
}

$(window).on("blur focus", function(e) {
    var prevType = $(this).data("prevType");
    if (prevType != e.type) {   //  reduce double fire issues
        switch (e.type) {
            case "blur":
					activarNotif();
                break;
            case "focus":
					desactivarNotif();
                break;
        }
    }

    $(this).data("prevType", e.type);
});

function activarUpdates(){
	updates = setInterval(function(){
		actualizarTabla();
		actualizarTablaPro();
	}, 5000);

	if(afiliadCodX === 'BI0013'){
		sonidoSiempre = setInterval(function(){
			actSonidoSi();
		}, 1000);
	}
}
var activado = true;
function desactivarSonGlobal(){
	if(activado) {activado = false;}else{activado = true;}
	if(sonidoSiempre != 0){
		clearInterval(sonidoSiempre);
		sonidoSiempre = 0;
	}else{
		if(afiliadCodX === 'BI0013'){
			sonidoSiempre = setInterval(function(){
				actSonidoSi();
			}, 1000);
		}
	}
}

function desactivarUpdates(){
	clearInterval(updates);
	updates = 0;
	clearInterval(sonidoSiempre);
	sonidoSiempre = 0;
}

function activarNotif(){
	desactivarUpdates();
	verificaciones = setInterval(function(){
		actualizarTabla();
		validarNotif(tablaVol.data().count());
	}, 1000);
	
	verificacionesPro = setInterval(function(){
		actualizarTablaPro();
		validarNotifPromos(tablaPros.data().count());
	}, 1000);
}

function desactivarNotif(){
	clearInterval(verificaciones);
	clearInterval(verificacionesPro);
	verificaciones = 0;
	verificacionesPro = 0;
	document.title = "BiInside";
	stopSonido();
	activarUpdates();
}

function playSonido(soundObj) {
	if(afiliadCodX === 'BI0013'){
		if(activado){
			audio.play();
		}
	}else{
		audio.play();
	}
}

function playSonidoPro(soundObj) {
	audio.play();
}

function stopSonido() {
	audio.pause();
}

function actSonidoSi(){
	if(afiliadCodX === 'BI0013' && activado){
		if(tablaVol.data().count() > 0 || tablaPros.data().count() > 0){
			playSonido();
		}else{
			stopSonido();
		}
	}
}

/////////////// FIN CAMBIOS NOTIFICACIONES

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
    	sAjaxDataProp: "",
    	"aoColumns": [
	        { "mData": "codigo" },
	        { "mData": "cliente" },
	        { "mData": "codigocliente" },
	        { "mData": "fechaorden" },
	        { "mData": "fecharetiro" },
	        { "mData": "direccion" },
	        { "mData": "metodopago" },
	        { "mData": "totalparcial" },
	        { "mData": "totalexpress" },
	        { "mData": "totalfinal" },
			{ "mData": "pagocliente" },
			{ "mData": "telefono" },
	        { "mData": null,  "sDefaultContent": "<button class='btnVerDetalles btn btn-sucess' style='background-color:#1c1c1c;color:white;'>DETALLES</button>"},
			{ "mData": null,  "sDefaultContent": "<button class='btnNotificar btn btn-sucess' style='background-color:#1c1c1c;color:white;'>NOTIFICAR</button>"},
	        { "mData": null,  "sDefaultContent": "<button class='btnMapa btn btn-sucess' style='background-color:#1c1c1c;color:white;'>VER MAPA</button>"},
	        { "mData": null,  "sDefaultContent": "<button class='btnOrdenLista btn btn-sucess' style='background-color:#1c1c1c;color:white;'>ORDEN LISTA</button>"},
	        { "mData": null,  "sDefaultContent": "<button class='btnDespachar btn btn-sucess' style='background-color:#1c1c1c;color:white;'>"+textoDespachar+"</button>"},
	        { "mData": null,  "sDefaultContent": "<button class='btnRechazar btn btn-sucess' style='background-color:red;color:white;'>RECHAZAR</button>"}
	    ],
		rowId: 'codigo',
		"createdRow": function(row, data, dataIndex){
			if(parseInt(data.totalexpress)===0)
			{
				$(".btnMapa", row)[0].addEventListener('click', (event) => indicarRecoger(event, data), false);
			}
			else{
				$(".btnMapa", row)[0].addEventListener('click', (event) => verMapa(event, data), false);
			}

			if(parseInt(data.puntos) > 0)
			{
				$(row).addClass('colorAmarilloPremios');	
			}

			$(".btnNotificar", row)[0].addEventListener('click', (event) => notificarOrden(event, data), false);
			$(".btnDespachar", row)[0].addEventListener('click', (event) => despacharOrden(event, data), false);
			
			$(".btnVerDetalles", row)[0].addEventListener('click', (event) => detallesOrdenes(event, data), false);
			$(".btnOrdenLista", row)[0].addEventListener('click', (event) => ordenLista(event, data), false);
			$(".btnRechazar", row)[0].addEventListener('click', (event) => rechazarOrden(event, data), false);
        },
        buttons: [
            {
                text: 'Actualizar Datos',
                className: 'btn-tablas',
                action: function () {
                    actualizarTabla();
                }
            },
            {
                text: 'Silenciar',
                className: 'btn-tablas',
                action: function () {
                    desactivarSonGlobal();
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
}

function cargarDatosPromos(){
	var tablePr = $('#tablaPromos').DataTable({
		dom: 'Blfrtip',
		 "stripeClasses": [ '', 'strip2'],
        "ajax": 
    		{
			"url":"php/afiliados/listarPromos.php", // Cargar archivo de listar los usuarios
			"type":"POST", // Metodo post debido a la cantidad y el tipo de datos
			"data":{'afiliado':afiliadCodX}, // Los datos que nos interesan solicitar
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
	        { "mData": "metodopago" },
	        { "mData": "precio" },
	        { "mData": "express" },
	        { "mData": "preciototal" },
			{ "mData": "pagocliente" },
			{ "mData": "telefono" },
			{ "mData": "comentario" },
	        { "mData": null,  "sDefaultContent": "<button class='btnMapaPro btn btn-sucess' style='background-color:#1c1c1c;color:white;'>VER MAPA</button>"},
			{ "mData": null,  "sDefaultContent": "<button class='btnNotificarPro btn btn-sucess' style='background-color:#1c1c1c;color:white;'>NOTIFICAR</button>"},
			{ "mData": null,  "sDefaultContent": "<button class='btnComandaPro btn btn-sucess' style='background-color:#1c1c1c;color:white;'>IMPRIMIR COMANDA</button>"},
	        { "mData": null,  "sDefaultContent": "<button class='btnDespacharPro btn btn-sucess' style='background-color:#1c1c1c;color:white;'>"+textoDespachar+"</button>"},
	        { "mData": null,  "sDefaultContent": "<button class='btnRechazarPro btn btn-sucess' style='background-color:red;color:white;'>RECHAZAR</button>"},
	    ],
		rowId: 'id',
		"createdRow": function(row, data, dataIndex){
			if(parseInt(data.express)===0)
			{
				$(".btnMapaPro", row)[0].addEventListener('click', (event) => indicarRecogerPro(event, data), false);
			}
			else{
				$(".btnMapaPro", row)[0].addEventListener('click', (event) => verMapaPro(event, data), false);
			}

			$(".btnNotificarPro", row)[0].addEventListener('click', (event) => notificarOrdPromo(event, data), false);
			$(".btnDespacharPro", row)[0].addEventListener('click', (event) => despacharPromo(event, data), false);
			$(".btnComandaPro", row)[0].addEventListener('click', (event) => imprimirComandaPro(event, data), false);
			$(".btnRechazarPro", row)[0].addEventListener('click', (event) => rechazarPromo(event, data), false);
        },
        buttons: [
            {
                text: 'Actualizar Datos',
                className: 'btn-tablas',
                action: function () {
                    actualizarTablaPro();
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
     
     tablaPros = tablePr;

    $(window).scroll(function(){
    	$(".paginate_button > a").blur();
  	});
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

function indicarDespacho() {
  alert("Esta orden ya fue despachada");
}

function despacharOrden(event, arg) {
	mostrarCarga();
  $.ajax({
		url:"php/afiliados/despachar.php",
		type:"POST",
		data:{
				'token': arg.token,
				'afiliado':afiliadCodX
			 },
		success:function(data)
		{
			//Cambiar el estado de la orden aquí
			if(data==1)
			{
				$.ajax({
					url:"php/afiliados/actualizarOrden.php",
					type:"POST",
					data:{
							'id': arg.codigo
						 },
					success:function(datos)
					{
						if(afiliadCodX !== 'BI0003') //Solo FRAN no aplica
						{
							if(datos==1)//Asignar puntos automaticos
							{
								$.ajax({
									url:"php/afiliados/puntosPedido.php",
									type:"POST",
									data:{
											'afiliado': afiliadCodX,
											'codigo': arg.codigocliente,
											'orden': arg.codigo,
											'fechaOrden': arg.fechaorden,
											'precio': arg.totalparcial,
											'porcentaje': parseInt(porcentajeX),
											'puntos': afiPuntos
										 },
									success:function(data2)
									{
										if(parseInt(arg.puntos) >= 0){//Rebajar puntos si hay canjeo
											if(data2 == 1){
												$.ajax({
													url:"php/afiliados/premiosCanjeoPedido.php",
													type:"POST",
													data:{
															'afiliado': afiliadCodX,
															'cliente': arg.codigocliente,
															'monto': arg.puntos
														 },
													success:function(data3)
													{
														if(data3 == 1){ //Rebajar si tiene puntos
															ocultarCarga();
															if(afiliadCodX === 'BI0013'){
																alert("Orden recibida correctamente");
															}else{
																alert("La orden se despacho correctamente");
															}
															actualizarTabla();
														}else{
															ocultarCarga();
															alert("Se proceso la orden correctamente y se asignaron los puntos, pero ocurrió un problema al canjear puntos");
															actualizarTabla();
														}
														actualizarTabla();
													}
												});
											}else{
												ocultarCarga();
												alert("Se proceso la orden correctamente, pero ocurrió un problema al asignar los puntos");
												actualizarTabla();
											}
										}else{//No rabajar puntos solo asignados
											if(data2 == 1){ //Rebajar si tiene puntos
												ocultarCarga();
												if(afiliadCodX === 'BI0013'){
													alert("Orden recibida correctamente");
												}else{
													alert("La orden se despacho correctamente");
												}
												actualizarTabla();
											}else{
												ocultarCarga();
												alert("Se proceso la orden correctamente, pero ocurrió un problema al asignar los puntos");			
												actualizarTabla();
											}
											actualizarTabla();
										}
									}
								});
							}
							else{
								ocultarCarga();
								alert("Se notificó la orden, pero ocurrió un error al despachar(registrar) la orden");
								actualizarTabla();
							}
						}else{
							if(datos == 1){
								ocultarCarga();
								if(afiliadCodX === 'BI0013'){
									alert("Orden recibida correctamente");
								}else{
									alert("La orden se despacho correctamente");
								}
								actualizarTabla();
							}else{
								ocultarCarga();
								alert("Se notificó la orden, pero ocurrió un error al despachar(registrar) la orden");
								actualizarTabla();
							}
						}
						actualizarTabla();
					}
				});
			}
			else{
				ocultarCarga();
				alert("Ocurrió un error al notificar la orden, intente nuevamente");
				actualizarTabla();
			}
		}
	});
}

function ordenLista(event, arg) {
  $.ajax({
		url:"php/afiliados/ordenLista.php",
		type:"POST",
		data:{
				'token': arg.token,
				'afiliado':afiliadCodX
			 },
		success:function(data)
		{
			//Cambiar el estado de la orden aquí
			if(data==1)
			{
				alert("Se notificó la orden correctamente");
			}
			else{
				alert("Ocurrió un error al notificar la orden, intente nuevamente");
				actualizarTabla();
			}
		}
	});
}

function despacharPromo(event, arg) {
  $.ajax({
		url:"php/afiliados/despachar.php",
		type:"POST",
		data:{
				'token': arg.token,
				'afiliado':afiliadCodX
			 },
		success:function(data)
		{
			//Cambiar el estado de la orden aquí
			if(data==1)
			{
				$.ajax({
					url:"php/afiliados/actualizarPromo.php",
					type:"POST",
					data:{
							'id': arg.id
						 },
					success:function(datos)
					{
						if(afiliadCodX === 'BI0013')
						{
							if(datos==1)//Asignar puntos automaticos
							{
								$.ajax({
									url:"php/afiliados/puntosPedido.php",
									type:"POST",
									data:{
											'afiliado': afiliadCodX,
											'codigo': arg.codigoCliente,
											'orden': arg.id,
											'fechaOrden': arg.fechaorden,
											'precio': arg.totalparcial,
											'porcentaje': parseInt(porcentajeX),
											'puntos': afiPuntos
										 },
									success:function(data2)
									{
										if(data2 == 1){
											if(afiliadCodX === 'BI0013'){
												alert("Orden recibida correctamente");
											}else{
												alert("La orden se despacho correctamente");
											}
											actualizarTablaPro();
										}else{
											alert("Se proceso la orden correctamente, pero ocurrió un problema al asignar los puntos");			
											actualizarTablaPro();
										}
										actualizarTablaPro();
									}
								});
							}
							else{
								alert("Se notificó la orden, pero ocurrió un error al despachar(registrar) la orden");
								actualizarTablaPro();
							}
						}else{
							if(afiliadCodX === 'BI0013'){
								alert("Orden recibida correctamente");
							}else{
								alert("La orden se despacho correctamente");
							}
							actualizarTablaPro();
						}
						actualizarTablaPro();
					}
				});
			}
			else{
				alert("Ocurrió un error al notificar la orden, intente nuevamente");
				actualizarTablaPro();
			}
		}
	});
}

function rechazarOrden(event, arg) {
  $.ajax({
		url:"php/afiliados/rechazarOrden.php",
		type:"POST",
		data:{
				'id': arg.codigo
			 },
		success:function(data)
		{
			//Cambiar el estado de la orden aquí
			if(data==1)
			{
				alert("Orden rechazada correctamente");
				actualizarTabla();
			}
			else{
				alert("Ocurrió un error al rechazar la orden, intente nuevamente");
				actualizarTabla();
			}
		}
	});
}

function rechazarPromo(event, arg) {
  $.ajax({
		url:"php/afiliados/rechazarPromo.php",
		type:"POST",
		data:{
				'id': arg.id
			 },
		success:function(data)
		{
			//Cambiar el estado de la orden aquí
			if(data==1)
			{
				alert("Orden rechazada correctamente");
				actualizarTablaPro();
			}
			else{
				alert("Ocurrió un error al rechazar la orden, intente nuevamente");
				actualizarTablaPro();
			}
		}
	});
}

function notificarOrden(event, arg) {
	$("#contmensaje").val("");
	tokenActual = arg.token;
	$('#modalNotifiPro').modal('show');
}

function notificarOrdPromo(event, arg) {
	$("#contmensaje").val("");
	tokenActual = arg.token;
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

function detallesOrdenes(event, arg) {
	tokenActual = arg.token;
	numeroOrden = arg.codigo;
	clienteOrden = arg.cliente;
	codigoClienteOrden = arg.codigocliente;
	expressOrden = arg.totalexpress;
	metodoPagoOrden = arg.metodopago;
	fechaRetiroOrden = arg.fecharetiro;
	telefonoOrden = arg.telefono;
	expressPagoOrden = arg.totalexpress;
	metodoOrden = arg.metodopago;
	pagaConOrden = arg.pagocliente;
	dirComentarioOrden = arg.direccion;
	pagoTotalOrden = arg.totalfinal;

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

     var tablaPr = $('#tablaPreOrd').DataTable({
		paging: false,
    	searching: false,
		"stripeClasses": [ '', 'strip2'],
        "ajax": 
    		{
			"url":"php/afiliados/listarPremios.php", // Cargar archivo de listar los usuarios
			"type":"POST", // Metodo post debido a la cantidad y el tipo de datos
			"data":{'codigo':arg.codigo, 'afiliado':afiliadCodX}, // Los datos que nos interesan solicitar
			"dataType":"JSON" // Indicamos que es un JSON
		},
    	sAjaxDataProp: "",
    	"aoColumns": [
    		{ "mData": "id" },
	        { "mData": "codigo" },
	        { "mData": "nombre" },
	        { "mData": "cantidad" },
	        { "mData": "valor" },
	        { "mData": "total" },
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

	tablaDet = tablaDe;
    tablaExt = tablaEx;
    tablaPre = tablaPr;

	$('#exampleModal').on('hide.bs.modal', function (event) {
	  tablaDe.destroy();
	  tablaEx.clear().draw();
	  tablaPr.destroy();
	  numeroOrden = '';
	  clienteOrden = '';
	  codigoClienteOrden = '';
	  expressOrden = 0;
	  fechaRetiroOrden = '';
	  metodoPagoOrden = '';
	  telefonoOrden = '';
	  expressPagoOrden = 0;
	  metodoOrden = '';
	  pagaConOrden = 0;
	  dirComentarioOrden = '';
      pagoTotalOrden = 0;
	});

	tablaDet.on( 'order.dt search.dt', function () {
        tablaDet.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

	$('#exampleModal').modal('show'); //Mostrar el modal con los detalles y los extras
}

function actualizarTabla(){
	tablaVol.ajax.reload(null,false);
}

function actualizarTablaPro(){
	tablaPros.ajax.reload(null,false);
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

/* IMPRESIONES */

function imprimirComanda(){ //Imprimir orden a la comanda
	var productosDet = [];
	var productosExt = [];
	var productosPre = [];
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

	tablaPre.rows().every(function()
	{
		var datas = this.data();
		var filaDatos = [];
		filaDatos.push(datas['nombre']);
		filaDatos.push(datas['cantidad']);
		productosPre.push(filaDatos);
	});

	if(parseInt(expressOrden)==0){
		tipo = "Recoger";
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
				'productosPre':productosPre,
				'fechaRetiro': fechaRetiroOrden,
				'telefono': telefonoOrden,
				'express': expressPagoOrden,
				'pagaCon': pagaConOrden,
				'dirComentario': dirComentarioOrden,
				'metodoPago': metodoOrden,
				'pagoTotal': pagoTotalOrden
			 },
        success: function() {
            var win = window.open("http://apps.biinsidecr.com/biinside/ordenes/php/afiliados/imprimir/comanda.pdf", '_blank');
  			win.focus();
  			if(afiliadCodX === 'BI0008' || afiliadCodX==="BI0009" || afiliadCodX === "BI0010"){
  				$.ajax({
					url:"php/afiliados/notificarOrden.php",
					type:"POST",
					data:{
							'token': tokenActual,
							'afiliado':afiliadCodX,
							'mensaje': 'Orden recibida y en proceso'
						 },
					success:function(data)
					{
						//Cambiar el estado de la orden aquí
						if(data==1)
						{
							$('#modalNotifiPro').modal('hide');
						}
						else{
							alert("Ocurrió un error al notificar la comanda");
							actualizarTabla();
						}
					}
				});
  			}
        }
    });
}

function imprimirComandaPro(event, arg){ //Imprimir orden a la comanda para promos
	var tipo  = '';
	var nombre = "PROMO: " + arg.orden;

	if(parseInt(arg.express)==0){
		tipo = "Recoger";
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
				'telefono': arg.telefono,
				'express': arg.express,
				'pagaCon': arg.pagocliente,
				'metodoPago': arg.metodopago,
				'pagoTotal': arg.preciototal
			 },
        success: function(data) {
        	var win = window.open("http://apps.biinsidecr.com/biinside/ordenes/php/afiliados/imprimir/comandapro.pdf", '_blank');
  			win.focus();
        }
    });
}




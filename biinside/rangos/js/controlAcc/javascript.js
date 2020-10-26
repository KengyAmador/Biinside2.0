

/******************************************************************************************************
JavaScript Control de Accesos
*****************************************************************************************************/

var tablaControlAcc = null;

$(document).ready(function(){
	clearInterval(hiloGlobal);
	inicializarTbContAcc();
});

function cargarDatos(){
	var fechaIni = $('#fechaControlIni').val();
	var	fechaFin = $('#fechaControlFin').val();

	var table = $('#tablaControlAcc').DataTable({
        "ajax": 
    		{
			"url":"php/controlAcc/listar.php", // Cargar archivo de listar los usuarios
			"type":"POST", // Metodo post debido a la cantidad y el tipo de datos
			"data":{
				'fechaIni': fechaIni,
				'fechaFin': fechaFin
			}, // Los datos que nos interesan solicitar
			"dataType":"JSON" // Indicamos que es un JSON
		},
	    select: true,
    	sAjaxDataProp: "",
    	"aoColumns": [
	        { "mData": "fecha" },
	        { "mData": "nombrepersona" },
	        { "mData": "nombreusuario" },
	        { "mData": "rol" }
	    ],
		rowId: 'id',
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
     
     tablaControlAcc = table;

    $(window).scroll(function(){
    	$(".paginate_button > a").blur();
  	});
}


function actualizarTabla(){
	tablaControlAcc.destroy();
	cargarDatos();
}

function inicializarTbContAcc()
{
	tablaControlAcc = $('#tablaControlAcc').DataTable({
		select:true,
	    searching: true,
		paging: true,
		language: {
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sEmptyTable":     "Ningún dato disponible en esta tabla",
		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix":    "",
		"sSearch":         "Buscar:",
		 "sUrl":            "",
        "sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
		},
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
    });
}
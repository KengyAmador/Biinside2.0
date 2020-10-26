

/******************************************************************************************************
JavaScript Principal (index)
*****************************************************************************************************/

var hiloGlobal; //Hilo que actualiza la tabla actual
var pantalla = "ninguna"; //Identifica la pantalla actual para el hilo
var menuActivo = false;
var fechaGlobalHoy = null;

$(document).ready(function(){
	 cargarFechaGlobalHoy();
	 cargarPInicio();
});

function cargarFechaGlobalHoy() {
   var fechaActual = new Date();
   var dia = ("0" + fechaActual.getDate()).slice(-2);
   var mes = ("0" + (fechaActual.getMonth() + 1)).slice(-2);
   var hoy = (dia) + "-" + (mes) + "-" + fechaActual.getFullYear();
   fechaGlobalHoy = hoy;
}


function cerrarSesion(){
    $('#timer').fadeIn(30);
//    $('#alertBoxes').html('<div class="box-success"></div>');
//    $('.box-success').hide(0).html('Espera un momento');
//    $('.box-success').slideDown(timeSlide);
    setTimeout(function(){
        window.location.href = "logout.php";
    },25);
}

function irInicio()
{
	window.location.href = "index.php";
}

/* Carga de paginas */

function cargarPInicio(){
	
}

function cargarPClientes(){
	$("#contenidoMostrar").load('clientes.php');
	$("#tituloActual").html("Mantenimiento de Afiliados");
}

function cargarPUsuarios(){
	$("#contenidoMostrar").load('usuarios.php');
	$("#tituloActual").html("Mantenimiento de Usuarios");
}

function cargarPControlAcc(){
	$("#contenidoMostrar").load('controlAcc.php');
	$("#tituloActual").html("Control de accesos");
}


function cargarPConfig(){
	$("#contenidoMostrar").load('configuracion.php');
	$("#tituloActual").html("Configuración");
}




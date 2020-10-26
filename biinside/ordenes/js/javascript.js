

/******************************************************************************************************
JavaScript Principal (index)
*****************************************************************************************************/
$(document).ready(function(){
});

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

function cargarPAfiliados(){
	//$("#contenidoMostrar").load('afiliados.php');
	//$("#tituloActual").html("Mantenimiento de Afiliados");
}


/////////////

/*function validateEnterForm(){
	$(window).keydown(function(event){
		if(event.keyCode == 13) {
		  event.preventDefault();
		  return false;
		}
	});
}*/



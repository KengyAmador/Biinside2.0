
$(document).ready(function(){
    verificarRolUsuario();
});

/* Seguridad */
//Esta funcion permite la evaluacion de la seguridad segun rol de usuario (ocultar las opciones del menu)
function verificarRolUsuario()
{
	if(rolEncargado == 1)
	{
		/* TIENE TODOS LOS PERMISOS, 
		NO ES NECESARIO OCULTAR NADA */
	}
	else{
		/*BOLETAS*/
		$("#imp1Link").hide();
		$("#imp1").hide();

		$("#imp2Link").hide();
		$("#imp2").hide();

		$("#imp3Link").hide();
		$("#imp3").hide();

		$("#imp4Link").hide();
		$("#imp4").hide();

		$("#imp5Link").hide();
		$("#imp5").hide();

		$("#imp6Link").hide();
		$("#imp6").hide();

		$("#enlaceProductos").hide();
		$("#enlaceClientes").hide();
		$("#enlaceMesas").hide();
	}
}
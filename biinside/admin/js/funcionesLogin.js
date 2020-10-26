$(document).ready(function(){
    $('#btnLogin').click(verificarUsuario)//Para validar login
});

function verificarUsuario(e){//Verifica que si el usuario es el mismo al que retorna conexiones.php, e es un evento del form
	//"use strict";
    //e.preventDefault();//prevenir que se reenvie el form;
	filePHP = $("#formIngresoUser").attr("action");
	metodo = $("#formIngresoUser").attr("method");
	$.ajax({
		beforeSend:function(){//Antes que se envie la petición, hace algo que muestre que está procesando
			//spin.min.js
		},
		dataType:'json',//Se debe poner para poder manejar la respuesta como json
		url:filePHP,
		data: $("#formIngresoUser").serialize(),
		type:metodo,
		success:function(respuesta){//Si el archivo manda algo es un success
			if(respuesta == 0)
			{
                 alert("Verifique el usuario y la contraseña");
			}
			else
			{
				window.location.assign("index.php");
			}
		},
		error:function(jqXHR, estado, error){//si no se establece conexion jqXHR: archivo JQuery XML HTTP Request, estado: estado del server, error:msj de error
			console.log(estado);
			console.log(error);
		},
		complete:function(jqXHR, estado){//Ejecutado despues de que suceda alguna de las anteriores, manda un msj de success o de error y que se acabo el tiempo
			console.log(estado);
		},
		timeout:15000//Tiempo para esperar una respuesta en milisegundos
	});
}
(function($) {
    var _timeoutHandler = 0,
        _inputString = '',
        _onKeypress = function(e) {
        	if(e.key !== 'Enter')
            {
             	if (_timeoutHandler) {
	                clearTimeout(_timeoutHandler);
	            }
	            _inputString += e.key;

	            _timeoutHandler = setTimeout(function () {
	                if (_inputString.length <= 3) {
	                    _inputString = '';
	                    return;
	                }
	                verificarCliente(_inputString);
	                _inputString = '';

	            }, 20);   
            }
        };
    $(document).on({
        keypress: _onKeypress
    });
})($);

$(document).ready(function(){
	dibujarLineas();
	$("#divLector").addClass("desactLector");
	valFormEnterFact();
    $(document).on("click", "#btnPruebaReg", function () {
		verificarCliente("1559858000020");
	});
});

function verificarCliente(datos){
	if(biichecks == 0)
		{
			mostrarError();
		}
		else
		{
			mostrarCarga();
			$.ajax({
		        url: 'php/afiliados/consultar/listar.php?peticion=cliente&detalle=' + datos,
		        type: 'POST',
		        data:{},
		        success: function(data) {
		            if(data != 0)
		            {
		            	//Se pasa a validar los puntos que tiene el cliente
		            	$.ajax({
					        url: 'php/canjear/puntos.php',
					        type: 'POST',
					        data:{
					        	"afiliado": afiliadCodX,
					        	"cliente": datos
					        },
					        success: function(datpun) {
					            if(parseInt(datpun[0].puntos) >= parseInt(biichecks))
					            {
					       			$.ajax({
								        url: 'php/canjear/registrar.php',
								        type: 'POST',
								        data:{
								        	"afiliado": afiliadCodX,
								        	"cliente": datos,
								        	"monto": biichecks
								        },
								        success: function(dat) {
								            if(dat == 1)
								            {
								       			$("#nCliente").html("Usuario: " + data[0].nombre);
								            	$("#biichecks").val("");
								            	$("#divLector").addClass("desactLector"); //Desabilitar lector
								            	biicheks = 0; //Limpiar el numero de factura
								            	$("#biichecks").prop("disabled", false); //Activar nuevamente el campo para ingresar el numero de otra factura
								            	setTimeout(function(){
								            		$("#nCliente").html("");
								            	}, 20000);     	
								            }
								            else
								            {
								 				alert("Ocurrió un problema al registrar, intente nuevamente.");	
								            }
								            ocultarCarga();
								        },
								        error: function (result) {
								            ocultarCarga();
								            alert("Se produjo un error al registrar, vuelve a intentarlo");
								        }
								    });
					            }
					            else
					            {
					 				alert("Los puntos del cliente no son suficientes, verifique los Bii Cheks.");
					 				$("#biichecks").prop("disabled", false); //Activar nuevamente el campo para ingresar el numero de otra factura
					 				$("#divLector").addClass("desactLector"); //Desabilitar lector
					            }
					            ocultarCarga();
					        },
					        error: function (result) {
					            ocultarCarga();
					            alert("Se produjo un error al registrar, vuelve a intentarlo");
					        }
					    });
		            }
		            else
		            {
		 				alert("El cliente no existe");
		 				$("#biichecks").prop("disabled", false); //Activar nuevamente el campo para ingresar el numero de otra factura
					 	$("#divLector").addClass("desactLector"); //Desabilitar lector
		            }
		            ocultarCarga();
		        },
		        error: function (result) {
		            ocultarCarga();
		            alert("Se produjo un error, vuelve a intentarlo");
		        }
		    });	
		}
}

function mostrarError(){
  $('#modalFactura').modal("show");
}

function mostrarCarga(){
    $("#carga").addClass("carga");
    $("#cont-loader").addClass("cont-loader");
    $("#loader").addClass("loader");
}

function ocultarCarga(){
    $("#carga").removeClass("carga");
    $("#cont-loader").removeClass("cont-loader");
    $("#loader").removeClass("loader");
}

//Dibujar las lineas en el canvas
function dibujarLineas(){
    var canv = document.getElementById("canvasLineas");
    var ctx = canv.getContext("2d");
    var posX = canv.width/2;
    var posY = canv.width-20;
    // vertical
    ctx.moveTo(posX, 20);
    ctx.lineTo(posX, 130);
    ctx.strokeStyle = "grey";
    ctx.lineWidth = 0.8;
    ctx.stroke();
    // horizontal
    ctx.moveTo(20, 75);
    ctx.lineTo(posY, 75);
    ctx.stroke();
}

var biichecks = 0;

//Guardar Factura
function guardarCanjeo(){
	if($("#biichecks").val() == "" || $("#biichecks").val() == null)
	{
		mostrarError();
	}
	else
	{
		biichecks = parseFloat(parseFloat($("#biichecks").val()).toFixed(2));
		$("#biichecks").prop("disabled", true);
		habilitarLectura();
	}
}

//Habilitar lector
function habilitarLectura(){
	$("#divLector").removeClass("desactLector");
}

function valFormEnterFact(){
    $("#biichecks").onkeypress = function(e) {
        var key = e.charCode || e.keyCode || 0;     
        if (key == 13) { //Si es enter
            e.preventDefault();
        }
    }
}
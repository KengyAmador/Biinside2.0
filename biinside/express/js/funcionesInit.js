var clienteGlobal = '';

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
	buscarCliente();
	cambioCliente();
    $(document).on("click", "#btnPruebaReg", function () {
		verificarCliente("1559858000020");
	});
});

function verificarCliente(){
	if(numeroFactura == 0)
	{
		mostrarError();
	}
	else
	{
		if(montoFactura == 0)
		{
			mostrarError();
		}
		else
		{
			mostrarCarga();
			$.ajax({
		        url: 'php/afiliados/consultar/listar.php?peticion=cliente&detalle=' + clienteGlobal,
		        type: 'POST',
		        data:{},
		        success: function(data) {
		            if(data != 0)
		            {
		            	$.ajax({
					        url: 'php/facturas/registrar.php',
					        type: 'POST',
					        data:{
					        	"afiliado": afiliadCodX,
					        	"cliente": clienteGlobal,
					        	"numero": numeroFactura,
					        	"monto": montoFactura,
					        	"porcentaje": porcentajeX,
					        	"puntos": afiPuntos
					        },
					        success: function(dat) {
					            if(dat == 1)
					            {
					       			$("#nCliente").html("Usuario: " + data[0].nombre);
					            	$("#factura").val("");
					            	$("#monto").val("");
					            	$("#divLector").addClass("desactLector"); //Desabilitar lector
					            	numeroFactura = 0; //Limpiar el numero de factura
					            	montoFactura = 0; //Limpiar el numero de factura
					            	$("#factura").prop("disabled", false); //Activar nuevamente el campo para ingresar el numero de otra factura
					            	$("#monto").prop("disabled", false); //Activar nuevamente el campo para ingresar el numero de otra factura
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
		 				alert("El cliente no existe");
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

var numeroFactura = 0;
var montoFactura = 0;

//Guardar Factura
function guardarFactura(){
	if($("#factura").val() == "" || $("#factura").val() == null)
	{
		mostrarError();
	}
	else
	{
		if($("#monto").val() == "" || $("#monto").val() == null)
		{
			mostrarError();
		}
		else
		{
			numeroFactura = $("#factura").val();
			montoFactura = parseFloat(parseFloat($("#monto").val()).toFixed(2));
			$("#factura").prop("disabled", true);
			$("#monto").prop("disabled", true);
			habilitarLectura();
		}
	}
}

//Habilitar lector
function habilitarLectura(){
	$("#divLector").removeClass("desactLector");
}

function valFormEnterFact(){
    $("#factura").onkeypress = function(e) {
        var key = e.charCode || e.keyCode || 0;     
        if (key == 13) { //Si es enter
            e.preventDefault();
        }
    }
}

function buscarCliente(){
	$("#cliente").keyup(function(){
		var texto = $(this).val();
		$.ajax({
	        url: 'php/clientes/listar.php',
	        type: 'POST',
	        data:{
	        	"afiliado": afiliadCodX,
	        	"cliente": texto
	        },
	        success: function(data) {
				$("#clientesList").find('option').remove();
	        	if(data.length != 0){
	        		//Cargar combo aqui
	        		for(i = 0; i < data.length; i++){
						$("select[id=clientesList]").append(new Option(data[i]["codigo"]));
					}
	        	}
	        	else{
	        		document.getElementById("clientesList").options.length = 0;
	        		$("#divLector").addClass("desactLector"); //Desabilitar lector
	        	}
	        },
	        error: function (result) {
	            console.log("Error");
	        }
	    });
	});
}

function cambioCliente()
{
	$("#clientesList").on('change',
		function(){
			clienteGlobal = this.value;
			console.log(clienteGlobal);
			habilitarLectura();
	});
}
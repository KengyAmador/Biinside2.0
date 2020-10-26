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
                    verificarAfiliado(_inputString);
                    _inputString = '';

                }, 20);
            }
        };
    $(document).on({
        keypress: _onKeypress
    });
})($);

var puerta = true;
$(document).ready(function(){
    dibujarLineas();
    $(document).on("click", "#btnPruebaLog", function () {
		verificarAfiliado($("#textAfiliado").val());
	});
});

function verificarAfiliado(datos){ //Recibe el codigo del afiliado
	 mostrarCarga();
        $.ajax({
                dataType:'json',
                url:"php/validarLogin.php",
                type:"POST",
                data:{"codAfiliado": datos},
                success:function(data)
                {
                    if(data != 0)
                    {
                        window.location.assign("index.php");    
                    }
                    else
                    {
                        alert("El afiliado no existe o no se encuentra habilitado");
                        ocultarCarga();
                    }
                },
                error:function(jqXHR, estado, error){//si no se establece conexion jqXHR: archivo JQuery XML HTTP Request, estado: estado del server, error:msj de error
                    alert("Se produjo un error, , vuelve a intentarlo");
                    ocultarCarga();
                }
          });
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
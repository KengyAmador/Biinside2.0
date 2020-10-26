$(document).ready(function(){
    $('#btnIniciar').click(mostrarLogin)
    $('#btnRegistrar').click(mostrarRegistro)
});

function mostrarLogin(e){
	window.location.assign("login.php");
}

function mostrarRegistro(e){
	window.location.assign("registro.php");
}
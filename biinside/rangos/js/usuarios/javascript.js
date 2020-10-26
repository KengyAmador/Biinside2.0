

/******************************************************************************************************
JavaScript Usuarios
*****************************************************************************************************/

var usuarioSeleccionado;
var registrar=true;
var tablaVol=null;
var filaSeleccionada = null;
pantalla = "usuarios";
var eliminar = true;

$(document).ready(function(){
	clearInterval(hiloGlobal);
	cargarDatos();	
	iniciarTooltips();
	desabilitarBotones();
	validarDatos();
	validarFormEnterUsr();
});

function validarDatos(){
	$('#frmUsuarios').bootstrapValidator({
        message: 'Los datos no son validos',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        excluded:[':disabled'],
        fields: {
            nombre: {
                message: 'El nombre de la persona no es valido',
                validators: {
                    notEmpty: {
                        message: 'El nombre de la persona es requerido'
                    },
                    stringLength: {
                        min: 10,
                        max: 250,
                        message: 'Nombre demasiado extenso o muy pequeño'
                    }
                }
            },
            usuario: {
                validators: {
                	notEmpty: {
                        message: 'El nombre de usuario es requerido'
                    },
                    stringLength: {
                    	max:20,
                        message: 'El nombre de usuario es demasiado grande'
                    }
                }
            },
            contrasena:{
            	validators: {
                    notEmpty: {
                        message: 'La contraseña es requerida'
                    },
                    stringLength: {
                    	max:20,
                        message: 'La contraseña es muy grande'
                    }
                }
            },
            rol:{
            	validators: {
                    notEmpty: {
                        message: 'El rol es requerido'
                    }
                }
            },
            telefono: {
                validators: {
                     stringLength: {
                    	max:10,
                        message: 'El telefono no es válido, es muy grande'
                    }
                }
            }
        }
    });
}


function desabilitarBotones(){
	document.getElementById("btnEliminar").disabled = true;
	$("#btnEliminar").addClass("btnDesabilitar");
	document.getElementById("btnEditar").disabled = true;
	$("#btnEditar").addClass("btnDesabilitar");
}

function habilitarBotones(){
	document.getElementById("btnEliminar").disabled = false;
	$("#btnEliminar").removeClass("btnDesabilitar");
	document.getElementById("btnEditar").disabled = false;
	$("#btnEditar").removeClass("btnDesabilitar");
}

function iniciarTooltips(){
	$('#btnCrear').tooltip();
	$('#btnEditar').tooltip();
	$('#btnEliminar').tooltip();
	$('#btnRecargar').tooltip();
}

function updateData(){
	actualizarTabla();
	mostrarOculto();
}

function cargarDatos(){
	var table = $('#tablaUsuarios').DataTable({
        "ajax": 
    		{
			"url":"php/usuarios/listar.php", // Cargar archivo de listar los usuarios
			"type":"POST", // Metodo post debido a la cantidad y el tipo de datos
			"data":{}, // Los datos que nos interesan solicitar
			"dataType":"JSON" // Indicamos que es un JSON
		},
	    select: true,
    	sAjaxDataProp: "",
    	"aoColumns": [
    		{ "mData": "id" },
	        { "mData": "nombrepersona" },
	        { "mData": "nombreusuario" },
	        { "mData": "telefono" }
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

     tablaVol = table;

    $('#tablaUsuarios tbody').on('click', 'tr', function () {
        registrar=false;
        filaSeleccionada = table.row(this).index();
		usuarioSeleccionado = table.row(this).data();
		if(!$(this).hasClass('selected')){
			desabilitarBotones();
		}
		else{
			habilitarBotones();	
		}
    } );

    $('#tablaUsuarios tbody').on('dblclick', 'tr', function () {
        registrar=false;
        filaSeleccionada = table.row(this).index();
		usuarioSeleccionado = table.row(this).data();
		$('#exampleModal').modal('show');
        editarUsuario();
    } );

    $(window).scroll(function(){
    	$(".paginate_button > a").blur();
  	});

  	/*(if(pantalla == "usuarios")
    {
     	hiloGlobal = setInterval(function(){
    		actualizarTabla();
    	}, 5000);	
    }*/
}

function actualizarTabla(){
	tablaVol.ajax.reload(null,false);
	if(usuarioSeleccionado == null)
	{
		desabilitarBotones();
	}
	else{
		usuarioSeleccionado = tablaVol.row(filaSeleccionada).data();
	}
}


function editarUsuario(){
	$('#frmUsuarios').bootstrapValidator('resetForm',true);
    $('#frmUsuarios').data('bootstrapValidator').resetForm();
	$('#exampleModal').on('show.bs.modal', function (event) {
	  registrar=false;
	  var button = $(event.relatedTarget);
	  var modal = $(this);	
	  modal.find('.modal-title').text('Editar usuario: ' + usuarioSeleccionado.nombre);
	  $("#nombre").val(usuarioSeleccionado.nombrepersona);
	  $("#usuario").val(usuarioSeleccionado.nombreusuario);
	  $("#rol").val(usuarioSeleccionado.idrol);
	  $("#telefono").val(usuarioSeleccionado.telefono);
	});
}

function nuevoUsuario()
{
	$('#frmUsuarios').bootstrapValidator('resetForm',true);
    $('#frmUsuarios').data('bootstrapValidator').resetForm();
	$('#exampleModal').on('show.bs.modal', function (event) {
	  registrar=true;
	  var button = $(event.relatedTarget);
	  var modal = $(this);
	  modal.find('.modal-title').text('Crear nuevo usuario');
	  modal.find('.modal-body input').val(""); 
	});
}

function eliminarUsuario()
{
	if(eliminar==true)
	{	//Elimina
		var id = usuarioSeleccionado.id;
		$.ajax({
			dataType:'json',
			url:"php/usuarios/eliminar.php",
			type:"POST",
			data:{'id':id
				 },
			success:function()
			{
				alert("El usuario ha sido eliminado");
				actualizarTabla();
				$('#borrarModal').modal('hide');
			}
		});
	}
}

function abrirEliminar(){
	eliminar = true;
	$('#borrarModal').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget);
	  var modal = $(this);
	  modal.find('.modal-title').text('Eliminar el usuario: ' + usuarioSeleccionado.nombre);
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

function procesarUsuario()
{
	$.ajax({
		url:"php/usuarios/validar.php",
		type:"POST",
		data:{'usuarioNombre': $("#usuario").val().toUpperCase()},
		success:function(data)
		{
			if(data == 1 || (data==0 && registrar==false))
			{
				var valido = $("#frmUsuarios").data('bootstrapValidator');
				valido.validate();

				if(valido.isValid()) //Los datos son validos
				{
					if(registrar==true)
					{	//Registra
						var nombre = $("#nombre").val().toUpperCase();
						var usuario = $("#usuario").val().toUpperCase();
						var rol = $("#rol").val().toUpperCase();
						var contrasena = $("#contrasena").val();
						var telefono = $("#telefono").val().toUpperCase();
						$.ajax({
							dataType:'json',
							url:"php/usuarios/registrar.php",
							type:"POST",
							data:{'nombre':nombre
								 ,'usuario':usuario
								 ,'rol':rol
								 ,'contrasena':contrasena
								 ,'telefono':telefono
								 },
							success:function()
							{
								alert("Usuario registrado con éxito");
								actualizarTabla();
								$('#exampleModal').modal('hide');
							}
						});
					}
					else
					{
						//Edita
						var id = usuarioSeleccionado.id;
						var nombre = $("#nombre").val().toUpperCase();
						var usuario = $("#usuario").val().toUpperCase();
						var rol = $("#rol").val().toUpperCase();
						var contrasena = $("#contrasena").val();
						var telefono = $("#telefono").val().toUpperCase();

						$.ajax({
							dataType:'json',
							url:"php/usuarios/editar.php",
							type:"POST",
							data:{'id': id
								 ,'nombre':nombre
								 ,'usuario':usuario
								 ,'rol':rol
								 ,'contrasena':contrasena
								 ,'telefono':telefono
								 },
							success:function()
							{
								alert("Usuario editado con éxito");
								actualizarTabla();
								usuarioSeleccionado.nombrepersona = nombre;
								usuarioSeleccionado.nombreusuario = usuario;
								usuarioSeleccionado.idrol = rol;
								usuarioSeleccionado.telefono = telefono;
								$('#exampleModal').modal('hide');
							}
						});
					}
				}
				else{
					//Invalido
			        $(".has-error:first input").focus();
				}
			}
			else
			{
				alert("El nombre de usuario ya existe.");
			}
		}
	});
}

function validarFormEnterUsr(){
    document.getElementById("frmUsuarios").onkeypress = function(e) {
        var key = e.charCode || e.keyCode || 0;     
        if (key == 13) { //Si es enter
            e.preventDefault();
            procesarUsuario();   
        }
    }
}

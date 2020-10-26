

/*------------------------ JAVASCRIPT PARA REGISTRO ------------------------*/

/*Variables(constantes) globales */

var URLWS = "http://3.16.186.99/webservice"; //Url donde se encuentra el webservice

/*  Operaciones dentro del Webservice (ejemplos de URL´s para cada accion dentro del webservice)

    Guardar = '/guardar/{lo que queremos guardar}'
    Listar =  '/consultar/{lo que queremos listar}/{parametro del elemento de la lista que deseamos listar, puede ser un id o la palaba 'lista' para listar todos los datos}
    Editar/actualizar = '/actualizar/{lo que deseamos actualizar}'

    Los ejemplos anteriores se adjuntan a la variable URL dentro de cada AJAX para poder ejecutar las operaciones respectivas.
    
*/

$(document).ready(function(){
	validarDatos();
	validarFormEnterUsr();
    cargarProvincias();
    asignarEventos();
});

function validarDatos(){
    bootstrapValidate('#empresa', 'required:El nombre de la empresa es requerido');
    bootstrapValidate('#cedula', 'required:La cédula es requerida');
    bootstrapValidate('#encargado', 'required:El encargado es requerido');
    bootstrapValidate('#provincia', 'required:La provincia es requerida');
    bootstrapValidate('#canton', 'required:El cantón es requerido');
    bootstrapValidate('#distrito', 'required:El distrito es requerido');
    bootstrapValidate('#correo', 'email:Ingrese un correo válido|required:El correo es requerido');
    bootstrapValidate('#celular', 'integer:Solo se admiten números|required:El teléfono/celular es requerido');
    bootstrapValidate('#direccion', 'required:La dirección es requerida');
}

function procesar()
{
    /* VALIDAR EL FORMULARIO AQUI */

    mostrarCarga();
    var cedula = $("#cedula").val();
    var nombre = $("#empresa").val().toUpperCase();
    var encargado = $("#encargado").val().toUpperCase();
    var provincia = $("#provincia").val().toUpperCase();
    var canton = $("#canton").val().toUpperCase();
    var distrito = $("#distrito").val().toUpperCase();
    var correo = $("#correo").val();
    var celular = $("#celular").val();
    var direccion = $("#direccion").val().toUpperCase();

     $.ajax({
        url: 'php/afiliados/funciones.php?peticion=guardar&detalle=afiliado',
        type: 'POST',
        data:{
                'cedula':cedula,
                'nombre':nombre,
                'encargado':encargado,
                'provincia':provincia,
                'canton':canton,
                'distrito':distrito,
                'correo':correo,
                'telefono':celular,
                'direccion':direccion
             },
        success: function(data) {
            if (data == 1) //Si la respuesta del webservice es 1, significa que todo se registró correctamente
            {
                $.ajax({
                    url: 'php/afiliados/consultar/listar.php?peticion=afiliados&detalle=ultimo',
                    type: 'POST',
                    data:{},
                    success: function(data) {
                        if (data != "") //Si la respuesta del webservice es 1, significa que todo se registró correctamente
                        {
                            ocultarCarga();
                            mostrarBienvenida(data[0].codigo, data[0].nombre);
                        }
                        else
                        {
                            ocultarCarga();
                            alert("Se produjo un error al listar vuelve a intentar");
                        }
                    },
                    error: function (result) {
                        ocultarCarga();
                        alert("Se produjo un error al listar, vuelve a intentarlo");
                    }
                });
            }
            else if (data == 2) // Si la respuesta del servidor es 2, significa que hay datos en blanco (vacios)
            {
                ocultarCarga();
                alert("Faltan datos");
            }
            else //Si la respuesta no es 1 ni 2 (probablemente 0), entonces significa que si se enviaron todos los datos pero que no se registraron en la BD.
            {
                ocultarCarga();
                alert("Se produjo un error vuelve a intentarlo");
            }
        },
        error: function (result) {
            ocultarCarga();
            alert("Se produjo un error a registrar, vuelve a intentarlo");
        }
    });
}

function validarFormEnterUsr(){
    document.getElementById("frmRegistro").onkeypress = function(e) {
        var key = e.charCode || e.keyCode || 0;     
        if (key == 13) { //Si es enter
            e.preventDefault();
            procesar();
        }
    }
}

function bloquear(){ //Bloquear los componentes del formulario
    $("#nombre").prop("disabled", true);
    $("#apellidos").prop("disabled", true);
    $("#cedula").prop("disabled", true);
    $("#correo").prop("disabled", true);
    $("#celular").prop("disabled", true);
    $("#telefono").prop("disabled", true);
    $("#encargado").prop("disabled", true);
    $("#tutor").prop("disabled", true);
    $("#institucion").prop("disabled", true);
    $("#tipocole").prop("disabled", true);
    $("#nivel").prop("disabled", true);
    $("#modalidad").prop("disabled", true);
}

function mostrarBienvenida(pCod, pEmp){ //Recibe el codigo y la empresa
    //Convertir la url
    var nomEmp = pEmp.replace(/ /g, "%");
    $("#contenidoReg").load('registroHecho.php?codigo='+pCod+"&empresa="+nomEmp);
}

function imprimirQR(){
    cod = document.getElementById("codEmpresa").textContent;
    img = document.getElementById("codQR");

    var doc = new jsPDF('p', 'pt', 'a4', false);
    doc.setFontSize(30);
    doc.text(40, 100, "Código de Afiliado BI INSIDE");
    doc.text(40, 170, cod);
    doc.addImage(img, 'JPEG', 35, 180, 161, 161);
    doc.save('BiInsideQR.pdf')
}

function abrirSesion(){
   window.open("login.php");
}

/**
 * Funcion cargarProvincias()
 * Esta funcion carga todas las provincias desde la BD en la pagina de registro.
 */
function cargarProvincias() {
    $.ajax({
        dataType: 'json', //recibe un objeto tipo json
        url: URLWS + "/consultar/provincias/lista", //Direccion del webservice + la accion que se desea realizar (consultar(listar) datos del cliente)
        type: "POST", //Por medio de POST se cargan los datos
        success: function (data) {
            for (i = 0; i < data.length; i++) {
                //Cargar las provincias en el combo respectivo
                $("select[id=provincia]").append(new Option(data[i]["DSC_PROVINCIA"], data[i]["COD_PROVINCIA"]));
            }
        }
    });
}


/**
 * Funcion cargarCantones()
 * Esta funcion permite cargar los cantones en el combo respectivo, dentro de la pagina de registro,
 * recibe el parametro id, donde id = id de la provincia
 * @param {any} id
 */
function cargarCantones(id) {
    $.ajax({
        dataType: 'json',
        url: URLWS + "/consultar/cantones/" + id, //Agregamos el id a la URL para poder listar los cantones x provincia
        type: "POST",
        success: function (data) {
            for (i = 0; i < data.length; i++) {
                $("select[id=canton]").append(new Option(data[i]["DSC_CANTON"], data[i]["COD_CANTON"]));
            }
        }
    });
}

/**
 * Funcion cargarDistritos()
 * Esta funcion permite cargar los distritos en el combo respectivo, dentro de la pagina de registro,
 * recibe el parametro id, donde id = id del canton. Esta funcion necesita dos parametros para listar los
 * distritos, uno es el canton (id) y el otro es la provincia con la que se encuentra relacionado, en esta caso
 * ese otro parametro (la provincia) se manda por POST, para asegurar la seleccion de los campos geograficos.
 * @param {any} id
 */
function cargarDistritos(id) {
    $.ajax({
        dataType: 'json',
        url: URLWS + "/consultar/distritos/" + id,
        type: "POST",
        data: {
            'provincia': $("#provincia").val(), //Se manda por POST el id de la provincia
        },
        success: function (data) {
            for (i = 0; i < data.length; i++) {
                $("select[id=distrito]").append(new Option(data[i]["DSC_DISTRITO"], data[i]["COD_DISTRITO"]));
            }
        }
    });
}

/**
 * Funcion asignarEventos()
 */
function asignarEventos() {
    //Limpiar cantones y distritos cada vez que se selecciona una nueva provincia
    $("#provincia").on("change", function () {
        //Limpiar combo de cantones:
        $("#canton").find('option').remove().end().append('<option value="" disabled selected>Cantón</option>');
        //Limpiar combo de distritos:
        $("#distrito").find('option').remove().end().append('<option value="" disabled selected>Distrito</option>');
        //Cargar los cantones x provincia
        cargarCantones($("#provincia").val());
    });

    //Limpiar distritos cada vez que se selecciona una nuevo canton
    $("#canton").on("change", function () {
        //Limpiar combo de distritos:
        $("#distrito").find('option').remove().end().append('<option value="" disabled selected>Distrito</option>');
        //Cargar los distritos x canton y provincia (post)
        cargarDistritos($("#canton").val());
    });
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
<?php

	 /* Evitar a intrusos accesar a este archivo */
    if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
        /* 
           HEADER, SE PODRIA USAR UN 404 ANQUE EXISTA EL ARCHIVO, POR SEGURIDAD
        */
        header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );

        /* ESCOGEMOS LA DIRECCION DONDE REENVIAREMOS AL USUARIO */
        die( header( 'location: /error.php' ) );
    }

   class Conecta
	{
		const USUARIO = "bi_pruebas";
        const CONTRASENA = "{zZOYeazk9zJ\~";
        const SERVIDOR = "datosmodelo.cfgpnxnd8epo.us-east-2.rds.amazonaws.com";
        const BASEDATOS = "pruebas";
	}

?>
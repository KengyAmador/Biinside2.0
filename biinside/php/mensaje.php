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

	//Declaracion de variables
	$nombre = 0;
	$correo = 0;
	$telefono = 0;
	$asunto = 0;
	$consulta = 0;
	//
	$correcto = true;
	$para = 'info@codilate.net';

	//Recepcion de variables tipo POST
    if (isset($_POST['nombre'])) { $nombre = $_POST['nombre']; }

	if (isset($_POST["correo"])) { $correo = $_POST['correo']; }

	if (isset($_POST["asunto"])) { $asunto = $_POST['asunto']; }

	if (isset($_POST["mensaje"])) { $mensaje = $_POST['mensaje']; }

	//Verificamos que las variables existan
	if($nombre === 0 || $correo === 0 || $mensaje === 0)
	{
		echo "Verifique los datos requeridos.";
		exit;
	}
	else
	{
		$encabezados = "From: ". $correo . "\r\n".
		"Reply-To: " . $correo . "\r\n".
		'X-Mailer: PHP/'.phpversion();

		if(inyeccion($correo))
		{
		    echo "El correo eléctronico tiene valores incorrectos.";
		    exit;
		}
		else
		{
			if($correcto)
			 {
			 	mail($para, $asunto, $mensaje, $encabezados);
			 	echo 0;
			 }
			 else
			 {
			 	echo 1;
			 }	
		}
	}

	function inyeccion($str)
	{
	    $inyecciones = array('(\n+)',
	           '(\r+)',
	           '(\t+)',
	           '(%0A+)',
	           '(%0D+)',
	           '(%08+)',
	           '(%09+)'
	           );
	               
	    $inyec = join('|', $inyecciones);
	    $inyec = "/$inyec/i";
	    
	    if(preg_match($inyec,$str))
	    {
	      return true;
	    }
	    else
	    {
	      return false;
	    }
	}
?>
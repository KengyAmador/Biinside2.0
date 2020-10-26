<?php include('../cred.php'); ?>

<?php

	/******************---------------- ENCABEZADOS ----------------******************/
	header('Access-Control-Allow-Origin: *'); //CORS
	header('Access-Control-Allow-Methods: POST, GET, OPTIONS'); //Compartir los metodos

	/******************---------------- VARIABLES POST ----------------******************/
	
	if(isset($_POST["cedula"])){
        $cedula = $_POST["cedula"];
    }
    else $cedula = "";

	if(isset($_POST["nombre"])){
        $nombre = $_POST["nombre"];
    }
    else $nombre = "";

    if(isset($_POST["encargado"])){
        $encargado = $_POST["encargado"];
    }
    else $encargado = "";

    if(isset($_POST["provincia"])){
        $provincia = $_POST["provincia"];
    }
    else $provincia = "";

    if(isset($_POST["canton"])){
        $canton = $_POST["canton"];
    }
    else $canton = "";

    if(isset($_POST["distrito"])){
        $distrito = $_POST["distrito"];
    }
    else $distrito = "";

    if(isset($_POST["correo"])){
        $correo = $_POST["correo"];
    }
    else $correo = "";

    if(isset($_POST["telefono"])){
        $telefono = $_POST["telefono"];
    }
    else $telefono = "";

    if(isset($_POST["direccion"])){
        $direccion = $_POST["direccion"];
    }
    else $direccion = "";

    $industria = "NO ASIGNADA";


    /******************---------------- FUNCIONAMIENTO PRINCIPAL ----------------******************/

	if( $_GET['peticion'] == 'guardar' ) //Peticion relacionada a los productos
	{
		if($_GET['detalle'] == 'afiliado')
		{
			if($cedula !== "" && $nombre !== "" && $encargado !== "" && $provincia !== "" && $canton !== "" && $distrito !== "" && $correo !== "" && $telefono !== "" && $direccion !== "" && $industria !== "")
			{
				guardarAfiliado($cedula, $nombre, $encargado, $provincia, $canton, $distrito, $correo, $telefono, $direccion, $industria);
			}
			else
			{
				echo 2;
			}
		}
	}
	else if( $_GET['peticion'] == 'actualizar' ) //Peticion relacionada a los productos
	{
		if($_GET['detalle'] == 'datos')
		{
			if($cedula !== "" && $nombre !== "" && $encargado !== "" && $provincia !== "" && $canton !== "" && $distrito !== "" && $correo !== "" && $telefono !== "" && $direccion !== "" && $industria !== "")
			{
				actualizarDatos($cedula, $nombre, $encargado, $provincia, $canton, $distrito, $correo, $telefono, $direccion, $industria);
			}
			else
			{
				echo 2;
			}
		}
	}
	else
	{
		header('HTTP/1.1 405 Peticion no permitida');
		exit;
	}

	/******************---------------- FUNCIONES ----------------******************/

	function guardarAfiliado($pCedula, $pNombre, $pEncargado, $pProvincia, $pCanton, $pDistrito, $pCorreo, $pTelefono, $pDireccion, $pIndustria)
	{
		try{
			$conexion = new PDO("mysql:host=" . Conecta::SERVIDOR.";dbname=".Conecta::BASEDATOS. '; charset=utf8;', Conecta::USUARIO, Conecta::CONTRASENA);
			$consulta = $conexion->prepare('CALL `sp_RegistrarAfiliados`(?,?,?,?,?,?,?,?,?,?)'); //Hacer la consulta
			$consulta->bindValue(1, $pCedula, PDO::PARAM_STR);//Parametros
			$consulta->bindValue(2, $pNombre, PDO::PARAM_STR);//Parametros
		    $consulta->bindValue(3, $pEncargado, PDO::PARAM_STR);//Parametros
		    $consulta->bindValue(4, $pProvincia, PDO::PARAM_STR);//Parametros
		    $consulta->bindValue(5, $pCanton, PDO::PARAM_STR);//Parametros
		    $consulta->bindValue(6, $pDistrito, PDO::PARAM_STR);//Parametros
		    $consulta->bindValue(7, $pCorreo, PDO::PARAM_STR);//Parametros
		    $consulta->bindValue(8, $pTelefono, PDO::PARAM_STR);//Parametros
		    $consulta->bindValue(9, $pDireccion, PDO::PARAM_STR);//Parametros
		    $consulta->bindValue(10, $pIndustria, PDO::PARAM_STR);//Parametros

		    $datosRegistrados = $consulta->execute(); //Habilitar la consulta

		    if($datosRegistrados == 1){//Si lo registra bien
            	echo 1;
	        }
	        else{ //Si no lo registra
	            echo 0;
	        }
		}
		catch(PDOException $e)
	    {
	        echo $e->getMessage();
	    }
	}

	function actualizarDatos($pCedula, $pNombre, $pEncargado, $pProvincia, $pCanton, $pDistrito, $pCorreo, $pTelefono, $pDireccion, $pIndustria)
	{
		try{
			$conexion = new PDO("mysql:host=" . Conecta::SERVIDOR.";dbname=".Conecta::BASEDATOS. '; charset=utf8;', Conecta::USUARIO, Conecta::CONTRASENA);
			$consulta = $conexion->prepare('CALL `sp_ActualizarAfiliados`(?,?,?,?,?,?,?,?,?,?,?)'); //Hacer la consulta
			$consulta->bindValue(1, $pCedula, PDO::PARAM_STR);//Parametros
			$consulta->bindValue(2, $pNombre, PDO::PARAM_STR);//Parametros
		    $consulta->bindValue(3, $pEncargado, PDO::PARAM_STR);//Parametros
		    $consulta->bindValue(4, $pProvincia, PDO::PARAM_STR);//Parametros
		    $consulta->bindValue(5, $pCanton, PDO::PARAM_STR);//Parametros
		    $consulta->bindValue(6, $pDistrito, PDO::PARAM_STR);//Parametros
		    $consulta->bindValue(7, $pCorreo, PDO::PARAM_STR);//Parametros
		    $consulta->bindValue(8, $pTelefono, PDO::PARAM_STR);//Parametros
		    $consulta->bindValue(9, $pDireccion, PDO::PARAM_STR);//Parametros
		    $consulta->bindValue(10, $pIndustria, PDO::PARAM_STR);//Parametros
		    $consulta->bindValue(11, $pCodigo, PDO::PARAM_STR);//Parametros

		    $datosRegistrados = $consulta->execute(); //Habilitar la consulta

		    if($datosRegistrados == 1){//Si lo registra bien
            	echo 1;
	        }
	        else{ //Si no lo registra
	            echo 0;
	        }
		}
		catch(PDOException $e)
	    {
	        echo $e->getMessage();
	    }
	}
?>
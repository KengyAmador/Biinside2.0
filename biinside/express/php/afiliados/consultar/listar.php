<?php include('../../cred.php'); ?>

<?php

	//Encabezado, define el documento como de tipo json
	header('Content-Type: application/json');
	header('Access-Control-Allow-Origin: *'); //CORS
	header('Access-Control-Allow-Methods: POST, GET, OPTIONS'); //Compartir los metodos
	//Credenciales de la BD

	//Conectar con la BD
	function listarAfiliado($detalle)
	{
		if($detalle == 'ultimo')
		{
			try{
				$conexion = new PDO("mysql:host=" . Conecta::SERVIDOR.";dbname=".Conecta::BASEDATOS, Conecta::USUARIO, Conecta::CONTRASENA);
				$consulta = $conexion->prepare('CALL `sp_ListarAfiliadoReg`'); //Hacer la consulta
				$consulta->execute(); //Habilitar la consulta
				$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
			}
			catch(PDOException $e)
		    {
		        echo $e->getMessage();
		    }
		}
		else
		{
			try{
				$conexion = new PDO("mysql:host=" . Conecta::SERVIDOR.";dbname=".Conecta::BASEDATOS, Conecta::USUARIO, Conecta::CONTRASENA);
				$consulta = $conexion->prepare('CALL `sp_ListarAfiliadoXCod`(?)'); //Hacer la consulta
				$consulta->bindValue(1, $detalle, PDO::PARAM_STR);//Parametros
				$consulta->execute(); //Habilitar la consulta
				$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
			}
			catch(PDOException $e)
		    {
		        echo $e->getMessage();
		    }
		}
		return $resultado;
	}

	function listarClienteXCod($detalle)
	{
		try{
			$conexion = new PDO("mysql:host=" . Conecta::SERVIDOR.";dbname=".Conecta::BASEDATOS. '; charset=utf8;', Conecta::USUARIO, Conecta::CONTRASENA);
			$consulta = $conexion->prepare('CALL `sp_ListarClienteXCod`(?)'); //Hacer la consulta
			$consulta->bindValue(1, $detalle, PDO::PARAM_STR);//Parametros
			$consulta->execute(); //Habilitar la consulta
			$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
		}
		catch(PDOException $e)
	    {
	        echo $e->getMessage();
	    }
		return $resultado;
	}

	if( $_GET['peticion'] == 'afiliados' ) //Peticion relacionada a los productos
	{
		$resultados = listarAfiliado($_GET['detalle']);
	}
	else if($_GET['peticion'] == 'cliente')
	{
		$resultados = listarClienteXCod($_GET['detalle']);
	}
	else
	{
		header('HTTP/1.1 405 Peticion no permitida');
		exit;
	}

	echo json_encode($resultados);
?>
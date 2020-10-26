<?php include '../conexion.php';?>

<?php
header('Content-type: application/json');
	
	if(isset($_POST["fechaIni"])){
        $fechaIni = $_POST["fechaIni"];
    }
    else $fechaIni = "";
	
	if(isset($_POST["fechaFin"])){
        $fechaFin = $_POST["fechaFin"];
    }
    else $fechaFin = "";
	
    try {
        $conexion = new PDO("mysql:host=$servidor;dbname=$basededatos; charset=utf8", $usuario, $contrasena); //Abrir la conexion con la BD\
		$consulta = $conexion->prepare('CALL `sp_ListarControlAcc`(?,?)'); //Hacer la consulta
		$consulta->bindValue(1, $fechaIni, PDO::PARAM_STR);//Parametros
		$consulta->bindValue(2, $fechaFin, PDO::PARAM_STR);//Parametros
		$consulta->execute(); //Habilitar la consulta
		  
		$filas = $consulta->fetchAll(PDO::FETCH_ASSOC);
		//Convertir a json valido
		$jsonSalida = json_encode($filas);
		
		if($jsonSalida !="")
		{ //Si hay datos
			echo $jsonSalida;
		}
		else
		{
		  echo 'no hay datos';
		}
			
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
   
?> 
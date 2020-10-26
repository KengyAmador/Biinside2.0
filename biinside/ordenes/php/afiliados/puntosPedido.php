<?php /******************---------------- ENCABEZADOS ----------------******************/
    header('Access-Control-Allow-Origin: *'); //CORS
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS'); //Compartir los metodos
    header('Content-type: application/json');
?>
<?php include('../conexion.php'); ?>
<?php
     //Ordenes
    if(isset($_POST["afiliado"])){ //Codigo afiliado
        $afiliado = $_POST["afiliado"];
        if($afiliado === 'BI0009' || $afiliado === 'BI0010'){
            $afiliado = 'BI0008';
        }
    }
    else $afiliado = "";

    if(isset($_POST["codigo"])){ //Codigo/Id cliente
        $codigo = $_POST["codigo"];
    }
	else $codigo = "";

    if(isset($_POST["orden"])){ //Codigo/id de la orden
        $orden = $_POST["orden"];
    }
    else $orden = "";

    if(isset($_POST["fechaOrden"])){
        $fechaOrden = $_POST["fechaOrden"];
    }
    else $fechaOrden = "";

    if(isset($_POST["precio"])){
        $precio = $_POST["precio"];
    }
    else $precio = "";

	if(isset($_POST["porcentaje"])){
        $porcentaje = $_POST["porcentaje"];
    }
	else $porcentaje = "";

	if(isset($_POST["puntos"])){
        $puntos = $_POST["puntos"];
    }
	else $puntos = "";

    try {
			$conexion = new PDO("mysql:host=$servidor;dbname=$basededatos; charset=utf8", $usuario, $contrasena);
			$consulta2 = $conexion->prepare('CALL `sp_RegistrarFactura`(?,?,?,?,?,?)'); //Hacer la consulta
			$consulta2->bindValue(1, $afiliado, PDO::PARAM_STR);//Parametros
			$consulta2->bindValue(2, $codigo, PDO::PARAM_STR);//Parametros
			$consulta2->bindValue(3, "a-".$orden, PDO::PARAM_STR);//Parametros
			$consulta2->bindValue(4, $fechaOrden, PDO::PARAM_STR);//Parametros
			$consulta2->bindValue(5, $precio, PDO::PARAM_STR);//Parametros
			$consulta2->bindValue(6, $porcentaje, PDO::PARAM_STR);//Parametros

			$datosRegistrados2 = $consulta2->execute(); //Habilitar la consulta
			  
			if($datosRegistrados2 == 1){
				$conexion = new PDO("mysql:host=$servidor;dbname=$basededatos; charset=utf8", $usuario, $contrasena); //Abrir la conexion con la BD
				$consultd = $conexion->prepare('CALL `sp_InsertarPuntos`(?,?,?,?,?)'); //Hacer la consulta
				$consultd->bindValue(1, $afiliado, PDO::PARAM_STR);//Parametros
				$consultd->bindValue(2, $codigo, PDO::PARAM_STR);//Parametros
				$consultd->bindValue(3, $precio, PDO::PARAM_STR);//Parametros
				$consultd->bindValue(4, $porcentaje, PDO::PARAM_STR);//Parametros
				$consultd->bindValue(5, $puntos, PDO::PARAM_STR);//Parametros

    			$datosRegist = $consultd->execute(); //Habilitar la consulta

    			if($datosRegist == 1){//Si lo registra bien
    				echo 1;
    			}
    			else{ //Si no lo registra
    				echo 0;
    			}
            }else{
                echo 0;
            }
      }
      catch(PDOException $e)
      {
          echo $e->getMessage();
      }   
?> 
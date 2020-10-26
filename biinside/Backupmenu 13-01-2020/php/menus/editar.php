<?php include '../conexion.php';?>

<?php
    header('Content-type: application/json');
    
    if(isset($_POST["codigo"])){
        $codigo = $_POST["codigo"];
    }
    else $codigo = "";

	if(isset($_POST["menu"])){
        $menu = $_POST["menu"];
    }
    else $menu = "";
	
	if(isset($_POST["accion"])){
        $accion = $_POST["accion"];
    }
    else $accion = "";

    if(isset($_POST["valor"])){
        $valor = $_POST["valor"];
    }
    else $valor = "";
	
    if(isset($_POST["precio"])){
        $precio = $_POST["precio"];
    }
    else $precio = "";

    if(isset($_POST["incluido"])){
        $incluido = $_POST["incluido"];
    }
    else $incluido = "";

    try {
      $conexion = new PDO("mysql:host=$servidor;dbname=$basededatos; charset=utf8", $usuario, $contrasena); //Abrir la conexion con la BD
      $consulta = $conexion->prepare('CALL `sp_EditarDetalleMenu`(?,?,?,?,?,?)'); //Hacer la consulta
	  $consulta->bindValue(1, $codigo, PDO::PARAM_INT);//Parametros
	  $consulta->bindValue(2, $menu, PDO::PARAM_INT);//Parametros
	  $consulta->bindValue(3, $accion, PDO::PARAM_INT);//Parametros
	  $consulta->bindValue(4, $valor, PDO::PARAM_STR);//parametros
      $consulta->bindValue(5, $precio, PDO::PARAM_STR);//parametros
      $consulta->bindValue(6, $incluido, PDO::PARAM_STR);//parametros
        
    $datosRegistrados = $consulta->execute(); //Habilitar la consulta
      
    $filas = $consulta->fetchAll(PDO::FETCH_ASSOC);
    //Convertir a json valido
    if($datosRegistrados == 1){//Si lo registra
            echo 1;
        }
        else{
            echo 0;
        }
        $dbh = null;
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
   
?> 
<?php include '../conexion.php';?>

<?php
    header('Content-type: application/json');
    
    if(isset($_POST["codigo"])){
        $codigo = $_POST["codigo"];
    }
    else $codigo = "";

	if(isset($_POST["nombre"])){
        $nombre = $_POST["nombre"];
    }
    else $nombre = "";
	
	if(isset($_POST["encargado"])){
        $encargado = $_POST["encargado"];
    }
    else $encargado = "";

    if(isset($_POST["telefono"])){
        $telefono = $_POST["telefono"];
    }
    else $telefono = "";
	
    if(isset($_POST["industria"])){
        $industria = $_POST["industria"];
    }
    else $industria = "";

     if(isset($_POST["porcentaje"])){
        $porcentaje = $_POST["porcentaje"];
    }
    else $porcentaje = "";
    

    try {
      $conexion = new PDO("mysql:host=$servidor;dbname=$basededatos; charset=utf8", $usuario, $contrasena); //Abrir la conexion con la BD
      $consulta = $conexion->prepare('CALL `sp_EditarAfiliado`(?,?,?,?,?,?)'); //Hacer la consulta
	  $consulta->bindValue(1, $codigo, PDO::PARAM_STR);//Parametros
	  $consulta->bindValue(2, $nombre, PDO::PARAM_STR);//Parametros
	  $consulta->bindValue(3, $encargado, PDO::PARAM_STR);//Parametros
	  $consulta->bindValue(4, $telefono, PDO::PARAM_STR);//parametros
      $consulta->bindValue(5, $industria, PDO::PARAM_STR);//parametros
      $consulta->bindValue(6, $porcentaje, PDO::PARAM_STR);//parametros
        
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
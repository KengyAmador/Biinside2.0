<?php include '../conexion.php';?>

<?php
header('Content-type: application/json');

    if(isset($_POST["nombreper"])){
        $nombreper = $_POST["nombreper"];
    }
    else $nombreper = "";
	
	if(isset($_POST["nombreusu"])){
        $nombreusu = $_POST["nombreusu"];
    }
    else $nombreusu = "";

    if(isset($_POST["rol"])){
        $rol = $_POST["rol"];
    }
    else $rol = "";
	
    $fecha = 

    try {
      $conexion = new PDO("mysql:host=$servidor;dbname=$basededatos", $usuario, $contrasena); //Abrir la conexion con la BD
      $consulta = $conexion->prepare('CALL `sp_registrarAcceso`(?,?,?,?)'); //Hacer la consulta
	  
      $consulta->bindValue(1, $fecha, PDO::PARAM_STR);//Parametros
	  $consulta->bindValue(2, $nombreper, PDO::PARAM_STR);//Parametros
	  $consulta->bindValue(3, $nombreusu, PDO::PARAM_STR);//Parametros
	  $consulta->bindValue(4, $rol, PDO::PARAM_STR);//parametros
        
    $datosRegistrados = $consulta->execute(); //Habilitar la consulta
      
    $filas = $consulta->fetchAll(PDO::FETCH_ASSOC);
    //Convertir a json valido
    if($datosRegistrados == 1){//Si lo registra
            echo 1;
        }
        else{
            echo 0;
        }
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
   
?> 

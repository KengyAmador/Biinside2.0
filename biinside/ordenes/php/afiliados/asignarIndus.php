<?php include '../conexion.php';?>

<?php
header('Content-type: application/json');
    if(isset($_POST["id"])){
        $id = $_POST["id"];
    }
    else $id = 0;

    if(isset($_POST["industria"])){
        $industria = $_POST["industria"];
    }
    else $industria = 0;
	
    try {
      $conexion = new PDO("mysql:host=$servidor;dbname=$basededatos", $usuario, $contrasena); //Abrir la conexion con la BD
      $consulta = $conexion->prepare('CALL `sp_AsignarIndustria`(?,?)'); //Hacer la consulta
	  $consulta->bindValue(1, $id, PDO::PARAM_STR);//Parametros
      $consulta->bindValue(2, $industria, PDO::PARAM_STR);//Parametros
        
    $datosGuardados = $consulta->execute(); //Habilitar la consulta
      
    $filas = $consulta->fetchAll(PDO::FETCH_ASSOC);
    //Convertir a json valido
    if($datosGuardados == 1){//Si lo registra
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

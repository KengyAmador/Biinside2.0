<?php include '../conexion.php';?>

<?php
header('Content-type: application/json');
    if(isset($_POST["codigo"])){
        $codigo = $_POST["codigo"];
    }
    else $codigo = 0;
	
    try {
      $conexion = new PDO("mysql:host=$servidor;dbname=$basededatos", $usuario, $contrasena); //Abrir la conexion con la BD
      $consulta = $conexion->prepare('CALL `sp_EliminarAfiliado`(?)'); //Hacer la consulta
	  $consulta->bindValue(1, $codigo, PDO::PARAM_STR);//Parametros
        
    $datosEliminados = $consulta->execute(); //Habilitar la consulta
      
    $filas = $consulta->fetchAll(PDO::FETCH_ASSOC);
    //Convertir a json valido
    if($datosEliminados == 1){//Si lo registra
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

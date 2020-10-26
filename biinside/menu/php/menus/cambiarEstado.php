<?php include '../conexion.php';?>
<?php
    if(isset($_POST["id"])){
        $id = $_POST["id"];
    }
    else $id = 0;

    if(isset($_POST["afiliado"])){
        $afiliado = $_POST["afiliado"];
    }
    else $afiliado = 0;

    if(isset($_POST["estado"])){
        $estado = $_POST["estado"];
    }
    else $estado = 0;
	
    try {
      $conexion = new PDO("mysql:host=$servidor;dbname=$basededatos", $usuario, $contrasena); //Abrir la conexion con la BD
      $consulta = $conexion->prepare('CALL `sp_CambiarEstadoDetalle`(?,?)'); //Hacer la consulta
	  $consulta->bindValue(1, $id, PDO::PARAM_STR);//Parametros
      $consulta->bindValue(2, $estado, PDO::PARAM_STR);//Parametros
        
    $datosEliminados = $consulta->execute(); //Habilitar la consulta
    if($datosEliminados == 1){//Si lo registra
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

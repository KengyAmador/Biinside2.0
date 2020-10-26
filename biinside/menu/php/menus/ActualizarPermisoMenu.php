<?php include '../conexion.php';?>

<?php
    header('Content-type: application/json');
    if(isset($_POST["afiliado"])){
            $afiliado = $_POST["afiliado"];
            
    }
    else $afiliado = '';

    if(isset($_POST["modulo"])){
        $modulo = $_POST["modulo"];
        
    }
    else $modulo = '';

    
    if(isset($_POST["estado"])){
        $estado = $_POST["estado"];
        
    }
    else $estado = '';


    try {
        $conexion = new PDO("mysql:host=$servidor;dbname=$basededatos; charset=utf8", $usuario, $contrasena); //Abrir la conexion con la BD
        
        $consulta = $conexion->prepare('CALL `sp_ActualizarEstadoAccesos`(?,?,?)'); //Hacer la consulta
        $consulta->bindValue(1, $afiliado, PDO::PARAM_STR);//Parametros
        $consulta->bindValue(2, $estado, PDO::PARAM_STR);//Parametros
        $consulta->bindValue(3, $modulo, PDO::PARAM_STR);//Parametros
    $consulta->execute(); //Habilitar la consulta
      
    $filas = $consulta->fetchAll(PDO::FETCH_ASSOC);
    //Convertir a json valido
    $jsonSalida = json_encode($filas);
    
        if($jsonSalida !=""){ //Si hay datos
        echo $jsonSalida;
    }
    else{
      echo 'no hay datos';
    }
        
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
   
?>
<?php include '../conexion.php';?>

<?php
    header('Content-type: application/json');
    if(isset($_POST["codigo"])){
            $codigo = $_POST["codigo"];
    }
    else $codigo = '';

    try {
        $conexion = new PDO("mysql:host=$servidor;dbname=$basededatos; charset=utf8", $usuario, $contrasena); //Abrir la conexion con la BD
        
        $consulta = $conexion->prepare("SELECT * from tbdetallemenus WHERE codigo = ".$codigo.";"); //Hacer la consulta
        
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
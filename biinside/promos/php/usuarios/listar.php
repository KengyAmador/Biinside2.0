<?php include '../conexion.php';?>

<?php
header('Content-type: application/json');
if(isset($_POST["Nombre"])){
        $nombre = $_POST["Nombre"];
    }
    else $nombre = 0;

    try {
        $conexion = new PDO("mysql:host=$servidor;dbname=$basededatos; charset=utf8", $usuario, $contrasena); //Abrir la conexion con la BD
        
        if($nombre == ""){ //Verificar que hayan datos en la tabla
      $consulta = $conexion->prepare('SELECT * FROM usuarios'); //Hacer la consulta
    }
        
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

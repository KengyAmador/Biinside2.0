<?php include '../conexion.php';?>

<?php
    header('Content-type: application/json');
    if(isset($_POST["codigo"])){
            $codigo = $_POST["codigo"];
            
    }
    else $codigo = '';
    if(isset($_POST["referencia"])){
        $referencia = $_POST["referencia"];
        
}
else $referencia = '';

    try {
        $conexion = new PDO("mysql:host=$servidor;dbname=$basededatos; charset=utf8", $usuario, $contrasena); //Abrir la conexion con la BD
        
        $consulta = $conexion->prepare('SELECT * FROM tbmenucategorias WHERE referencia = "'.$referencia.'"'.
                                        'AND afiliado = "'.$codigo.'"'.
                                        'AND estado = "A"'); //Hacer la consulta
        
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
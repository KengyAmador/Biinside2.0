<?php include '../conexion.php';?>

<?php
    header('Content-type: application/json');
    if(isset($_POST["afiliado"])){
            $afiliado = $_POST["afiliado"];
    }
    else $afiliado = 0;
    
    if(isset($_POST["cliente"])){
            $cliente = $_POST["cliente"];
    }
    else $cliente = 0;

    try {
        $conexion = new PDO("mysql:host=$servidor;dbname=$basededatos; charset=utf8", $usuario, $contrasena); //Abrir la conexion con la BD
        $consulta = $conexion->prepare('SELECT puntos FROM tbpuntos WHERE afiliado = "'. $afiliado. '" AND cliente = "'. $cliente .'"'); //Hacer la consulta
        $consulta->execute(); //Habilitar la consulta
          
        $filas = $consulta->fetchAll(PDO::FETCH_ASSOC);
        //Convertir a json valido
        $jsonSalida = json_encode($filas);
        
        if($jsonSalida !=""){ //Si hay datos
            echo $jsonSalida;
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

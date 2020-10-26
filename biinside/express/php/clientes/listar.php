<?php include '../conexion.php';?>

<?php
    header('Content-type: application/json');
    if(isset($_POST["cliente"])){
        $cliente = $_POST["cliente"];
    }
    else $cliente = '';
	
	if(isset($_POST["afiliado"])){
        $afiliado = $_POST["afiliado"];
        if($afiliado === 'BI0009' || $afiliado === 'BI0010'){
            $afiliado = 'BI0008';
        }
    }
    else $afiliado = '';

    try {
        $conexion = new PDO("mysql:host=$servidor;dbname=$basededatos; charset=utf8", $usuario, $contrasena); //Abrir la conexion con la BD
        
        $consulta = $conexion->prepare("SELECT codigo FROM tbclientes WHERE nombre = '" . $cliente ."' AND afiliado = '".$afiliado."'"); //Hacer la consulta
        
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
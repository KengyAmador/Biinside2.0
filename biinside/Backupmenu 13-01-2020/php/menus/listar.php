<?php include '../conexion.php';?>

<?php
    header('Content-type: application/json');
    if(isset($_POST["afiliado"])){
            $afiliado = $_POST["afiliado"];
    }
    else $afiliado = '';

    try {
        $conexion = new PDO("mysql:host=$servidor;dbname=$basededatos; charset=utf8", $usuario, $contrasena); //Abrir la conexion con la BD
        
        $consulta = $conexion->prepare("SELECT mc.nombre as categoria, m.nombre as nombre , dm.valor as descripcion, dm.precio as precio, dm.codigo as id  from tbmenucategorias mc JOIN tbmenus m ON mc.codigo = m.categoria JOIN tbdetallemenus dm ON m.codigo = dm.menu where mc.afiliado = '" .$afiliado."'"); //Hacer la consulta
        
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

<?php include '../conexion.php';?>

<?php
    header('Content-type: application/json');
    if(isset($_POST["codigo"])){
            $codigo = $_POST["codigo"];
    }
    else $codigo = '';

    try {
        $conexion = new PDO("mysql:host=$servidor;dbname=$basededatos; charset=utf8", $usuario, $contrasena); //Abrir la conexion con la BD
        
        $consulta = $conexion->prepare("SELECT dm.* , m.nombre as producto,mc.nombre as extra, mc.descripcion as descripcion, me.codigo as codigoextra, me.precio as precioextra FROM tbdetallemenus dm JOIN tbmenuextras me ON dm.codigo = me.detallemenu JOIN tbmenucategorias mc ON me.extra = mc.codigo JOIN tbmenus m ON dm.menu = m.codigo WHERE dm.codigo = ".$codigo.";"); //Hacer la consulta
        
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
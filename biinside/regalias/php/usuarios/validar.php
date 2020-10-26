<?php include '../conexion.php';?>

<?php
    if(isset($_POST["usuarioNombre"])){
        $usuarioNombre = $_POST["usuarioNombre"];
    }
    else $usuarioNombre = "NADIE";

    try {
        $conexion = new PDO("mysql:host=$servidor;dbname=$basededatos; charset=utf8", $usuario, $contrasena); //Abrir la conexion con la BD
        
        $consulta = $conexion->prepare('SELECT nombreusuario FROM usuarios where nombreusuario = "'. $usuarioNombre .'";'); //Hacer la consulta     
        $consulta->execute(); //Habilitar la consulta
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        
        if(count($resultado) == 0){ //Si no hay datos
            echo 1; //Puede registrar
        }
        else{
            echo 0; //No puede registrar
        }
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
?> 

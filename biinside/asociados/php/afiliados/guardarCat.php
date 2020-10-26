<?php include '../conexion.php';?>

<?php
    header('Content-type: application/json');

    if(isset($_POST["nombre"])){
        $nombre = $_POST["nombre"];
    }
    else $nombre = "";

    if(isset($_POST["afiliado"])){
        $afiliado = $_POST["afiliado"];
    }
    else $afiliado = "";

    $estado = 1;

    try {
      $conexion = new PDO("mysql:host=$servidor;dbname=$basededatos; charset=utf8", $usuario, $contrasena); //Abrir la conexion con la BD
      $consulta = $conexion->prepare('CALL `sp_RegistrarCatAsociado`(?,?)'); //Hacer la consulta
      $consulta->bindValue(1, $nombre, PDO::PARAM_STR);//Parametros
	  $consulta->bindValue(2, $afiliado, PDO::PARAM_STR);//Parametros
        
    $datosRegistrados = $consulta->execute(); //Habilitar la consulta
      
    $filas = $consulta->fetchAll(PDO::FETCH_ASSOC);
    //Convertir a json valido
    if($datosRegistrados == 1){//Si lo registra
            echo 1;
        }
        else{
            echo 0;
        }
        $dbh = null;
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
   
?> 
<?php include '../conexion.php';?>

<?php
    header('Content-type: application/json');

    if(isset($_POST["nombre"])){
        $nombre = $_POST["nombre"];
    }
    else $nombre = "";
    
    if(isset($_POST["descripcion"])){
        $descripcion = $_POST["descripcion"];
    }
    else $descripcion = "";

    if(isset($_POST["afiliado"])){
        $afiliado = $_POST["afiliado"];
    }
    else $afiliado = "";

    if(isset($_POST["referencia"])){
        $referencia = $_POST["referencia"];
    }

    if(isset($_POST["imagen"])){
        $imagen = $_POST["imagen"];
    }
    else $imagen = "";

    try {
      $conexion = new PDO("mysql:host=$servidor;dbname=$basededatos; charset=utf8", $usuario, $contrasena); //Abrir la conexion con la BD
      $consulta = $conexion->prepare('CALL `sp_RegistrarMenuCategoria`(?,?,?,?,?)'); //Hacer la consulta
      $consulta->bindValue(1, $nombre, PDO::PARAM_STR);//Parametros
      $consulta->bindValue(2, $descripcion, PDO::PARAM_STR);//Parametros
      $consulta->bindValue(3, $afiliado, PDO::PARAM_STR);//parametros
      $consulta->bindValue(4, $referencia, PDO::PARAM_STR);//parametros  
      $consulta->bindValue(5, $imagen, PDO::PARAM_STR);//parametros  
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
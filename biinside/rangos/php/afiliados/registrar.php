<?php include '../conexion.php';?>
<?php
    header('Content-type: application/json');

    if(isset($_POST["rango"])){
        $rango = $_POST["rango"];
    }
    else $rango = "";
    
    if(isset($_POST["precio"])){
        $precio = $_POST["precio"];
    }
    else $precio = "";

    if(isset($_POST["afiliado"])){
        $afiliado = $_POST["afiliado"];
    }
    else $afiliado = "";

    $estado = 0;

    try {
      $conexion = new PDO("mysql:host=$servidor;dbname=$basededatos; charset=utf8", $usuario, $contrasena); //Abrir la conexion con la BD
      $consulta = $conexion->prepare('CALL `sp_RegistrarRango`(?,?,?,?)'); //Hacer la consulta
      $consulta->bindValue(1, $afiliado, PDO::PARAM_STR);//Parametros
      $consulta->bindValue(2, $rango, PDO::PARAM_STR);//Parametros
      $consulta->bindValue(3, $precio, PDO::PARAM_STR);//Parametros
      $consulta->bindValue(4, $estado, PDO::PARAM_STR);//parametros
        
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
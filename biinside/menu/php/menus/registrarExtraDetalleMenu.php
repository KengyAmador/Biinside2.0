<?php include '../conexion.php';?>

<?php
    header('Content-type: application/json');

    if(isset($_POST["detallemenu"])){
        $detallemenu = $_POST["detallemenu"];
    }
    else $detallemenu = "";
   

    if(isset($_POST["extra"])){
        $extra = $_POST["extra"];
    }
    else $extra = "";

    if(isset($_POST["precio"])){
        $precio = $_POST["precio"];
    }
    else $precio = "";

    try {
      $conexion = new PDO("mysql:host=$servidor;dbname=$basededatos; charset=utf8", $usuario, $contrasena); //Abrir la conexion con la BD
      $consulta = $conexion->prepare('CALL `sp_RegistrarMenuExtras`(?,?,?)'); //Hacer la consulta
      $consulta->bindValue(1, $detallemenu, PDO::PARAM_STR);//Parametros
      $consulta->bindValue(2, $extra, PDO::PARAM_STR);//Parametros
      $consulta->bindValue(3, $precio, PDO::PARAM_STR);//Parametros
      
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
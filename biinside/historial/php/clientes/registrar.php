<?php include '../conexion.php';?>

<?php
header('Content-type: application/json');
    if(isset($_POST["nombre"])){
        $nombre = $_POST["nombre"];
    }
    else $nombre = "";
	
	if(isset($_POST["apellidos"])){
        $apellidos = $_POST["apellidos"];
    }
    else $apellidos = "";

    if(isset($_POST["telefono"])){
        $telefono = $_POST["telefono"];
    }
    else $telefono = "";
	
    try {
      $conexion = new PDO("mysql:host=$servidor;dbname=$basededatos", $usuario, $contrasena); //Abrir la conexion con la BD
      $consulta = $conexion->prepare('CALL `sp_RegistrarClientes`(?,?,?)'); //Hacer la consulta
	  $consulta->bindValue(1, $nombre, PDO::PARAM_STR);//Parametros
	  $consulta->bindValue(2, $apellidos, PDO::PARAM_STR);//Parametros
	  $consulta->bindValue(3, $telefono, PDO::PARAM_STR);//parametros
        
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

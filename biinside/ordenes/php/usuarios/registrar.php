<?php include '../conexion.php';?>

<?php
header('Content-type: application/json');
    if(isset($_POST["nombre"])){
        $nombre = $_POST["nombre"];
    }
    else $nombre = "";

    if(isset($_POST["usuario"])){
        $user = $_POST["usuario"];
    }
    else $user = "";

    if(isset($_POST["rol"])){
        $rol = $_POST["rol"];
    }
    else $rol = "";
	
	if(isset($_POST["contrasena"])){
        $opciones = [
            'cost' => 8,
        ];
        $passw = password_hash($_POST["contrasena"], PASSWORD_DEFAULT, $opciones);
    }
    else $passw = "0";

    if(isset($_POST["telefono"])){
        $telefono = $_POST["telefono"];
    }
    else $telefono = "";
	
    try {
      $conexion = new PDO("mysql:host=$servidor;dbname=$basededatos;", $usuario, $contrasena); //Abrir la conexion con la BD
      $consulta = $conexion->prepare('CALL `sp_RegistrarUsuarios`(?,?,?,?,?)'); //Hacer la consulta
	  $consulta->bindValue(1, $nombre, PDO::PARAM_STR);//Parametros
	  $consulta->bindValue(2, $user, PDO::PARAM_STR);//Parametros
      $consulta->bindValue(3, $rol, PDO::PARAM_STR);//Parametros
      $consulta->bindValue(4, $passw, PDO::PARAM_STR);//Parametros
      $consulta->bindValue(5, $telefono, PDO::PARAM_STR);//Parametros
        
      $datosRegistrados = $consulta->execute(); //Habilitar la consulta
      
    //$filas = $consulta->fetchAll(PDO::FETCH_ASSOC);
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

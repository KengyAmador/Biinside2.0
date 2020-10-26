<?php include '../conexion.php';?>

<?php
header('Content-type: application/json');
    if(isset($_POST["nombre"])){
        $nombre = $_POST["nombre"];
    }
    else $nombre = "";

    if(isset($_POST["usuario"])){
        $usuario = $_POST["usuario"];
    }
    else $usuario = "";

    if(isset($_POST["rol"])){
        $rol = $_POST["rol"];
    }
    else $rol = "";
    
    if(isset($_POST["contrasena"])){
        $opciones = [
            'cost' => 8,
        ];
        $contrasena = password_hash($_POST["contrasena"], PASSWORD_DEFAULT, $opciones);
    }
    else $contrasena = "0";

    if(isset($_POST["telefono"])){
        $telefono = $_POST["telefono"];
    }
    else $telefono = "";
    
    try {
        echo $usuario;
    
        $dbh = null;
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
   
?> 

<?php include '../conexion.php';?>

<?php
header('Content-type: application/json');
    if(isset($_POST["id"])){
        $id = $_POST["id"];
    }
    else $id = "";
	
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
    else $passw = "";

    if(isset($_POST["telefono"])){
        $telefono = $_POST["telefono"];
    }
    else $telefono = "";

    try {
		$conexion = new PDO("mysql:host=$servidor;dbname=$basededatos;", $usuario, $contrasena); //Abrir la conexion con la BD
		$consulta = $conexion->prepare('CALL `sp_EditarUsuarios`(?,?,?,?,?,?)'); //Hacer la consulta
		$consulta->bindValue(1, $id, PDO::PARAM_STR);//Parametros
		$consulta->bindValue(2, $nombre, PDO::PARAM_STR);//Parametros
		$consulta->bindValue(3, $user, PDO::PARAM_STR);//Parametros
	    $consulta->bindValue(4, $rol, PDO::PARAM_STR);//Parametros
	    $consulta->bindValue(5, $passw, PDO::PARAM_STR);//Parametros
	    $consulta->bindValue(6, $telefono, PDO::PARAM_STR);//Parametros
	    
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
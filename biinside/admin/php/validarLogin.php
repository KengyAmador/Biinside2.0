<?php

include 'conexion.php';

session_start();//Iniciar la sesión
    
///Validaciones de usuario en el login
    if(isset($_POST["usuario"])){
        $user = $_POST["usuario"];
    }
    else $user = "default";

    if(isset($_POST["contrasena"])){
        $pass = $_POST["contrasena"];
    }
    else $pass = "123";

///Fin validaciones usuario en en login

///Funciones
    try {
        $conexion = new PDO("mysql:host=$servidor;dbname=$basededatos;charset=utf8", $usuario, $contrasena); //Abrir la conexion con la BD
        $stmt = $conexion->prepare('CALL `sp_ValidarUsuario`(?)');
        $stmt->bindValue(1, $user, PDO::PARAM_STR);//Parametros
        $stmt->execute();
        
		$rows = $stmt->fetchAll();

        if(count($rows) > 0){//Si obtiene algo
            if (password_verify($pass, $rows[0][4])) {
                    foreach($rows as $row){
                    $_SESSION['id'] = $row[0];
                    $_SESSION['rol'] = $row[1];
                    $_SESSION['nombre'] = $row[2];
                    $_SESSION['usuario'] = $row[3];
                }

                echo json_encode($rows);    
            } else {
                echo 0;
            }
		}
		else{
			echo 0;
		}
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
?> 



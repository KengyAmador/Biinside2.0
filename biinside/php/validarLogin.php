<?php
    include 'conexion.php';

    if(isset($_POST["usuario"])){
        $user = $_POST["usuario"];
    }
    else $user = "";

    if(isset($_POST["contrasena"])){
        $pass = $_POST["contrasena"];
    }
    else $pass = "";


///Funciones
    try {
        $conexion = new PDO("mysql:host=$servidor;dbname=$basededatos;charset=utf8", $usuario, $contrasena); //Abrir la conexion con la BD
        $stmt = $conexion->prepare('CALL `sp_LoginWeb`(?)');
        $stmt->bindValue(1, $user, PDO::PARAM_STR);//Parametros
        $stmt->execute();
        
		$rows = $stmt->fetchAll();

        if(count($rows) > 0){//Si obtiene algo
            if (password_verify($pass, $rows[0][6])) {
                session_start();//Iniciar la sesión
                foreach($rows as $row){
                    $_SESSION['codAfiliado'] = $row[0];
                    $_SESSION['empresa'] = $row[1];
                    $_SESSION['porcentaje'] = $row[2];
                    $_SESSION['puntos'] = $row[3];
                    $_SESSION['nombre'] = $row[4];
                    $_SESSION['rol'] = $row[5];
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



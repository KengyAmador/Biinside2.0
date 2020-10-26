<?php
    include 'conexion.php';
    if(isset($_POST["codAfiliado"])){
        $codAfiliado = $_POST["codAfiliado"];
    }
    else $codAfiliado = "0";

///Funciones
    try {
        $conexion = new PDO("mysql:host=$servidor;dbname=$basededatos;charset=utf8", $usuario, $contrasena); //Abrir la conexion con la BD
        $stmt = $conexion->prepare('CALL `sp_validarLogin`(?)');
        $stmt->bindValue(1, $codAfiliado, PDO::PARAM_STR);//Parametros
        $stmt->execute();
        
		$rows = $stmt->fetchAll();

        if(count($rows) > 0){//Si obtiene algo
            session_start();//Iniciar la sesión
            foreach($rows as $row){
                $_SESSION['codAfiliado'] = $row[0];
                $_SESSION['empresa'] = $row[1];
                $_SESSION['porcentaje'] = $row[2];
                $_SESSION['puntos'] = $row[3];
            }
            echo json_encode($rows);
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



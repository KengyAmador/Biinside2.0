<?php include 'conexion.php';?>

<?php
    header('Content-type: application/json');
    
    if(isset($_POST["id"])){
        $id = $_POST["id"];
    }
    else $id = "";

    try {
        /*Aquí se actualiza la orden respectiva despues de hacer el pago en paypal, pasa de 2 a 0, para indicar que ya se pagó*/
        $conexion = new PDO("mysql:host=$servidor;dbname=$basededatos; charset=utf8", $usuario, $contrasena); //Abrir la conexion con la BD
        $consulta = $conexion->prepare('CALL `sp_ActualizarPaypalPromo`(?)'); //Hacer la consulta
    	$consulta->bindValue(1, $id, PDO::PARAM_STR);//Parametros
        $datosRegistrados = $consulta->execute(); //Habilitar la consulta
        
        if($datosRegistrados == 1){//Si lo registra
            echo 1;
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
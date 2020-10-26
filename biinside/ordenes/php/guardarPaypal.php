<?php include 'conexion.php';?>

<?php
    header('Content-type: application/json');
    
    if(isset($_POST["afiliado"])){
        $afiliado = $_POST["afiliado"];
    }
    else $afiliado = "";

    if(isset($_POST["cliente"])){
        $cliente = $_POST["cliente"];
    }
    else $cliente = "";
    
    if(isset($_POST["idOrden"])){
        $idOrden = $_POST["idOrden"];
    }
    else $idOrden = "";

    if(isset($_POST["paypalId"])){ //Id de la orden (orden de paypal/transaccion)
        $paypalId = $_POST["paypalId"];
    }
    else $paypalId = "";

    if(isset($_POST["creacion"])){
        $creacion = $_POST["creacion"];
    }
    else $creacion = "";

    if(isset($_POST["edicion"])){
        $edicion = $_POST["edicion"];
    }
    else $edicion = "";

    if(isset($_POST["intent"])){
        $intent = $_POST["intent"];
    }
    else $intent = "";

    if(isset($_POST["estado"])){
        $estado = $_POST["estado"];
    }
    else $estado = "";

    if(isset($_POST["idComprador"])){
        $idComprador = $_POST["idComprador"];
    }
    else $idComprador = "";

    if(isset($_POST["emailComprador"])){
        $emailComprador = $_POST["emailComprador"];
    }
    else $emailComprador = "";

    if(isset($_POST["paisComprador"])){
        $paisComprador = $_POST["paisComprador"];
    }
    else $paisComprador = "";

    if(isset($_POST["nombreComprador"])){
        $nombreComprador = $_POST["nombreComprador"];
    }
    else $nombreComprador = "";

    if(isset($_POST["undId"])){
        $undId = $_POST["undId"];
    }
    else $undId = "";

    if(isset($_POST["undValor"])){
        $undValor = $_POST["undValor"];
    }
    else $undValor = "";

    if(isset($_POST["undMoneda"])){
        $undMoneda = $_POST["undMoneda"];
    }
    else $undMoneda = "";

    if(isset($_POST["undEmail"])){
        $undEmail = $_POST["undEmail"];
    }
    else $undEmail = "";

    if(isset($_POST["undMerchant"])){
        $undMerchant = $_POST["undMerchant"];
    }
    else $undMerchant = "";

    if(isset($_POST["dirComprador"])){
        $dirComprador = $_POST["dirComprador"];
    }
    else $dirComprador = "";

    if(isset($_POST["dirDireccion"])){
        $dirDireccion = $_POST["dirDireccion"];
    }
    else $dirDireccion = "";

    if(isset($_POST["dirPostal"])){
        $dirPostal = $_POST["dirPostal"];
    }
    else $dirPostal = "";

    if(isset($_POST["dirPais"])){
        $dirPais = $_POST["dirPais"];
    }
    else $dirPais = "";

    if(isset($_POST["pagoEstado"])){
        $pagoEstado = $_POST["pagoEstado"];
    }
    else $pagoEstado = "";

    if(isset($_POST["pagoId"])){
        $pagoId = $_POST["pagoId"];
    }
    else $pagoId = "";

    if(isset($_POST["pagoCapture"])){
        $pagoCapture = $_POST["pagoCapture"];
    }
    else $pagoCapture = "";

    if(isset($_POST["pagoCreacion"])){
        $pagoCreacion = $_POST["pagoCreacion"];
    }
    else $pagoCreacion = "";

    if(isset($_POST["pagoEdicion"])){
        $pagoEdicion = $_POST["pagoEdicion"];
    }
    else $pagoEdicion = "";

    if(isset($_POST["pagoValor"])){
        $pagoValor = $_POST["pagoValor"];
    }
    else $pagoValor = "";

    if(isset($_POST["pagoMoneda"])){
        $pagoMoneda = $_POST["pagoMoneda"];
    }
    else $pagoMoneda = "";

    if(isset($_POST["tipo"])){
        $tipo = $_POST["tipo"];
    }
    else $tipo = "";
    

    try {
        /*Se guardan los datos de la orden en paypal*/
        $conexion = new PDO("mysql:host=$servidor;dbname=$basededatos; charset=utf8", $usuario, $contrasena); //Abrir la conexion con la BD
        $consulta = $conexion->prepare('CALL `sp_GuardarPaypal`(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)'); //Hacer la consulta
        $consulta->bindValue(1, $afiliado, PDO::PARAM_STR);//Parametros
        $consulta->bindValue(2, $cliente, PDO::PARAM_STR);//Parametros
        $consulta->bindValue(3, $idOrden, PDO::PARAM_STR);//Parametros
        $consulta->bindValue(4, $paypalId, PDO::PARAM_STR);//Parametros
        $consulta->bindValue(5, $creacion, PDO::PARAM_STR);//Parametros
        $consulta->bindValue(6, $edicion, PDO::PARAM_STR);//Parametros
        $consulta->bindValue(7, $intent, PDO::PARAM_STR);//Parametros
        $consulta->bindValue(8, $estado, PDO::PARAM_STR);//Parametros
        $consulta->bindValue(9, $idComprador, PDO::PARAM_STR);//Parametros
        $consulta->bindValue(10, $emailComprador, PDO::PARAM_STR);//Parametros
        $consulta->bindValue(11, $paisComprador, PDO::PARAM_STR);//Parametros
        $consulta->bindValue(12, $nombreComprador, PDO::PARAM_STR);//Parametros
        $consulta->bindValue(13, $undId, PDO::PARAM_STR);//Parametros
        $consulta->bindValue(14, $undValor, PDO::PARAM_STR);//Parametros
        $consulta->bindValue(15, $undMoneda, PDO::PARAM_STR);//Parametros
        $consulta->bindValue(16, $undEmail, PDO::PARAM_STR);//Parametros
        $consulta->bindValue(17, $undMerchant, PDO::PARAM_STR);//Parametros
        $consulta->bindValue(18, $dirComprador, PDO::PARAM_STR);//Parametros
        $consulta->bindValue(19, $dirDireccion, PDO::PARAM_STR);//Parametros
        $consulta->bindValue(20, $dirPostal, PDO::PARAM_STR);//Parametros
        $consulta->bindValue(21, $dirPais, PDO::PARAM_STR);//Parametros
        $consulta->bindValue(22, $pagoEstado, PDO::PARAM_STR);//Parametros
        $consulta->bindValue(23, $pagoId, PDO::PARAM_STR);//Parametros
        $consulta->bindValue(24, $pagoCapture, PDO::PARAM_STR);//Parametros
        $consulta->bindValue(25, $pagoCreacion, PDO::PARAM_STR);//Parametros
        $consulta->bindValue(26, $pagoEdicion, PDO::PARAM_STR);//Parametros
        $consulta->bindValue(27, $pagoValor, PDO::PARAM_STR);//Monto del pago
        $consulta->bindValue(28, $pagoMoneda, PDO::PARAM_STR);//Parametross
        $consulta->bindValue(29, $tipo, PDO::PARAM_STR);//Parametross

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
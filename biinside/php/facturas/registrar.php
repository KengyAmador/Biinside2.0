<?php include '../cred.php';?>

<?php
    header('Content-type: application/json');

    if(isset($_POST["afiliado"])){
            $afiliado = $_POST["afiliado"];
            if($afiliado === 'BI0009' || $afiliado === 'BI0010'){
                $afiliado = 'BI0008';
            }
    }
    else $afiliado = 0;

    if(isset($_POST["cliente"])){
            $cliente = $_POST["cliente"];
    }
    else $cliente = 0;

    if(isset($_POST["numero"])){
            $numero = $_POST["numero"];
    }
    else $numero = 0;

    if(isset($_POST["monto"])){
            $monto = $_POST["monto"];
    }
    else $monto = 0;

    if(isset($_POST["porcentaje"])){
            $porcentaje = $_POST["porcentaje"];
    }
    else $porcentaje = 0;

    if(isset($_POST["puntos"])){
            $puntos = $_POST["puntos"];
    }
    else $puntos = 0;

    try{

        $fecha = new DateTime;
        $fecha->setTimezone(new DateTimeZone('America/Costa_Rica'));
        $fechaActual = $fecha->format("Y-m-d H:i:s");

        $conexion = new PDO("mysql:host=" . Conecta::SERVIDOR.";dbname=".Conecta::BASEDATOS. '; charset=utf8;', Conecta::USUARIO, Conecta::CONTRASENA);
        $consulta = $conexion->prepare('CALL `sp_RegistrarFactura`(?,?,?,?,?,?)'); //Hacer la consulta
        $consulta->bindValue(1, $afiliado, PDO::PARAM_STR);//Parametros
        $consulta->bindValue(2, $cliente, PDO::PARAM_STR);//Parametros
        $consulta->bindValue(3, $numero, PDO::PARAM_STR);//Parametros
        $consulta->bindValue(4, $fechaActual, PDO::PARAM_STR);//Parametros
        $consulta->bindValue(5, $monto, PDO::PARAM_STR);//Parametros
        $consulta->bindValue(6, $porcentaje, PDO::PARAM_STR);//Parametros

        $datosRegistrados = $consulta->execute(); //Habilitar la consulta

        if($datosRegistrados == 1){//Si lo registra bien
            try{
                //Registrar los puntos x factura
                $consultd = $conexion->prepare('CALL `sp_InsertarPuntos`(?,?,?,?,?)'); //Hacer la consulta
                $consultd->bindValue(1, $afiliado, PDO::PARAM_STR);//Parametros
                $consultd->bindValue(2, $cliente, PDO::PARAM_STR);//Parametros
                $consultd->bindValue(3, $monto, PDO::PARAM_STR);//Parametros
                $consultd->bindValue(4, $porcentaje, PDO::PARAM_STR);//Parametros
                $consultd->bindValue(5, $puntos, PDO::PARAM_STR);//Parametros

                $datosRegist = $consultd->execute(); //Habilitar la consulta

                if($datosRegist == 1){//Si lo registra bien
                    echo 1;
                }
                else{ //Si no lo registra
                    echo 0;
                }
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }
        else{ //Si no lo registra
            echo 0;
        }
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }   
?> 

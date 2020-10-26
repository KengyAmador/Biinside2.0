<?php

include 'conexion.php';

//GENERA RAMDON PARA EL SUFIJO DE NOMBRE DE LA IMAGEN EN EL SERVIDOR

function generateRandomString($length = 4) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$valuerandomString = generateRandomString();

if(isset($_POST["arteselect"])){ //Validar el arte
    $idArte = $_POST["arteselect"];
}

$imagename= $_FILES["menuarte"]["name"]; //Tomar la imagen
$folder="/sistema/menu/artes/"; //Carpeta donde guardar
$urlImagen = $_SERVER['DOCUMENT_ROOT'].$folder.$valuerandomString.$_FILES["menuarte"]["name"]; //Url de imagen a guardar
$urlFinal = "http://3.16.186.99".$folder.$valuerandomString.$_FILES["menuarte"]["name"];



if(move_uploaded_file($_FILES["menuarte"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'].$folder.$valuerandomString.$_FILES["menuarte"]["name"])){//Si se pudo subir el archivo
    //Se guarda en la base de datos
     try {
      $conexion = new PDO("mysql:host=$servidor;dbname=$basededatos", $usuario, $contrasena); //Abrir la conexion con la BD
      $consulta = $conexion->prepare('CALL `sp_ActualizarArteMenus`(?,?)'); //Hacer la consulta
      $consulta->bindValue(1, $idArte, PDO::PARAM_STR);//Parametros
      $consulta->bindValue(2, $urlFinal, PDO::PARAM_STR);//Parametros
        
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
}
else{
    echo 3; //El 3 indica que no se pudo subir la imagen.
}
    
?> 




<?php

include 'conexion.php';

$imagename= $_FILES["menuarte"]["name"]; //Tomar la imagen
$folder="/sistema/menu/artes/"; //Carpeta donde guardar
$urlImagen = $_SERVER['DOCUMENT_ROOT'].$folder.$_FILES["menuarte"]["name"]; //Url de imagen a guardar
$urlFinal = "http://3.16.186.99".$folder.$_FILES["menuarte"]["name"];

if(isset($_POST["arteselect"])){ //Validar el arte
    $idArte = $_POST["arteselect"];
}

if(move_uploaded_file($_FILES["menuarte"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'].$folder.$_FILES["menuarte"]["name"])){//Si se pudo subir el archivo
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




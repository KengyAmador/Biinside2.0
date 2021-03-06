<?php include '../conexion.php';?>

<?php
    header('Content-type: application/json');
    
    if(isset($_POST["id"])){
        $id = $_POST["id"];
    }
    else $id = "";

	if(isset($_POST["titulo"])){
        $titulo = $_POST["titulo"];
    }
    else $titulo = "";

    if(isset($_POST["descbasica"])){
        $descbasica = $_POST["descbasica"];
    }
    else $descbasica = "";
	
	if(isset($_POST["descripcion"])){
        $descripcion = $_POST["descripcion"];
    }
    else $descripcion = "";

    if(isset($_POST["imagen"])){
        $imagen = $_POST["imagen"];
    }
    else $imagen = "";
	
	if(isset($_POST["orden"])){
        $orden = $_POST["orden"];
    }
    else $orden = "";
	
	if(isset($_POST["categoria"])){
        $categoria = $_POST["categoria"];
    }
    else $categoria = "";

    if(isset($_POST["sitioweb"])){
        $sitioweb = $_POST["sitioweb"];
    }
    else $sitioweb = "#";

    if(isset($_POST["facebook"])){
        $facebook = $_POST["facebook"];
    }
    else $facebook = "#";

    if(isset($_POST["instagram"])){
        $instagram = $_POST["instagram"];
    }
    else $instagram = "#";


    try {
      $conexion = new PDO("mysql:host=$servidor;dbname=$basededatos; charset=utf8", $usuario, $contrasena); //Abrir la conexion con la BD
      $consulta = $conexion->prepare('CALL `sp_EditarAsociado`(?,?,?,?,?,?,?,?,?,?)'); //Hacer la consulta
	  $consulta->bindValue(1, $id, PDO::PARAM_STR);//Parametros
	  $consulta->bindValue(2, $titulo, PDO::PARAM_STR);//Parametros
	  $consulta->bindValue(3, $descripcion, PDO::PARAM_STR);//Parametros
	  $consulta->bindValue(4, $imagen, PDO::PARAM_STR);//parametros
	  $consulta->bindValue(5, $orden, PDO::PARAM_STR);//parametros
	  $consulta->bindValue(6, $categoria, PDO::PARAM_STR);//parametros
      $consulta->bindValue(7, $descbasica, PDO::PARAM_STR);//parametros
      $consulta->bindValue(8, $sitioweb, PDO::PARAM_STR);//parametros
      $consulta->bindValue(9, $facebook, PDO::PARAM_STR);//parametros
      $consulta->bindValue(10, $instagram, PDO::PARAM_STR);//parametros
        
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
   
?> 
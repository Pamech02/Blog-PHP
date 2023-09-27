<?php

if(isset($_POST)){
    require_once 'includes/conexion.php';

    $nombre= $_POST['nombre'] ? mysqli_real_escape_string($db,$_POST['nombre']):false;

    $errores = [];

  //validar el nombre
  if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/",$nombre)){
    $nombre_valido=true;
  } else{
    $nombre_valido=false;
    $errores['nombre'] = 'el nombre no es valido';
  }

  if(count($errores)==0){
    $sql = "INSERT INTO categorias VALUES(null, '$nombre')";
    $guardar = mysqli_query($db, $sql);
  }
}

header("Location:index.php");
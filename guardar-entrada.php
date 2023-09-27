<?php

if(isset($_POST)){
    require_once 'includes/conexion.php';

    $titulo= $_POST['titulo'] ? mysqli_real_escape_string($db,$_POST['titulo']):false;
    $descripcion= $_POST['descripcion'] ? mysqli_real_escape_string($db,$_POST['descripcion']):false;
    $categoria= $_POST['titulo'] ? (int)$_POST['categoria']:false;
    $usuario= $_SESSION['usuario']['id'];

    $errores = [];

  //validar el nombre
  if(empty($titulo)){
    $errores['titulo'] = 'el nombre no es valido';
  }
  if(empty($descripcion)){
    $errores['descripcion'] = 'el titulo esta vacio';
  }
  if(empty($categoria)&& !is_numeric($categoria)){
    $errores['categoria'] = 'la categoria no es valida';
  }
  if (count($errores)==0) {
    if (isset($_GET['editar'])){
      $entrada_id = $_GET['editar'];

      $sql = "UPDATE entradas SET " .
      "titulo ='$titulo'," .
      "descripcion ='$descripcion'," .
      "categoria_id ='$categoria'" .
      "WHERE id =$entrada_id AND usuario_id=$usuario";
    }else{
      $sql = "INSERT INTO entradas VALUES(null, $usuario, $categoria,'$titulo', '$descripcion', curdate())";
    }
  
    $guardar = mysqli_query($db, $sql);
    header("Location:index.php");
  }else{
    $_SESSION['errores_entrada']=$errores;
    header("Location:crear-entrada.php");
  }

  
}


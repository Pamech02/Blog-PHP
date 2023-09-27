<?php 

if (isset($_POST)){

    require_once 'includes/conexion.php';

    if (!isset($_SESSION)) {
        session_start();
    }
    
    $nombre= $_POST['nombre'] ? mysqli_real_escape_string($db,$_POST['nombre']):false;
    $apellidos=$_POST['apellidos'] ? mysqli_real_escape_string($db,$_POST['apellidos']):false;
    $email=$_POST['email'] ? mysqli_real_escape_string($db,trim($_POST['email'])):false;
    $password=$_POST['password'] ? mysqli_real_escape_string($db,$_POST['password']):false;

    $errores = [];

  //validar el nombre
  if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/",$nombre)){
    $nombre_valido=true;
  } else{
    $nombre_valido=false;
    $errores['nombre'] = 'el nombre no es valido';
  }; 

  //validar los apellidos
  if(!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/",$apellidos)){
    $apellido_valido=true;
  } else{
    $apellido_valido=false;
    $errores['apellidos'] = 'los apellidos no son validos';
  }; 

  //validar el correo
  if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
    $email_valido=true;
  } else{
    $email_valido=false;
    $errores['email'] = 'el correo no es valido';
  }; 

  //validar la contra
  if(!empty($password)){
    $password_valido=true;
  } else{
    $password_valido=false;
    $errores['password'] = 'la password esta vacia';
  }; 

  $guardar_usuario = false;
  if (count($errores)==0){
    $guardar_usuario=true;

    $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);

    $sql= "INSERT INTO usuarios VALUES(null, '$nombre', '$apellidos', '$email', '$password_segura', CURDATE());";
    $guardar = mysqli_query($db, $sql);

    if ($guardar) {
        $_SESSION['completado'] = "El registro se completo con exito!";
    }else{
        $_SESSION['errores']['general']="Error al registrarse";
    }
  }else{
    $_SESSION['errores']=$errores;
  }
}
header('Location:index.php');
?>
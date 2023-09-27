<?php

if (isset($_POST)) {

    require_once 'includes/conexion.php';

    $nombre = $_POST['nombre'] ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    $apellidos = $_POST['apellidos'] ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
    $email = $_POST['email'] ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;

    $errores = [];

    //validar el nombre
    if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
        $nombre_valido = true;
    } else {
        $nombre_valido = false;
        $errores['nombre'] = 'el nombre no es valido';
    }
    ;

    //validar los apellidos
    if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)) {
        $apellido_valido = true;
    } else {
        $apellido_valido = false;
        $errores['apellidos'] = 'los apellidos no son validos';
    }
    ;

    //validar el correo
    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_valido = true;
    } else {
        $email_valido = false;
        $errores['email'] = 'el correo no es valido';
    }
    ;

    $guardar_usuario = false;
    if (count($errores) == 0) {
        $usuario = $_SESSION['usuario'];
        $guardar_usuario = true;

        $sql = "SELECT email FROM usuarios WHERE email='$email'";
        $isset_email = mysqli_query($db, $sql);
        $isset_user = mysqli_fetch_assoc($isset_email);

        if ($isset_user['id']==$usuario['id'] || empty($isset_user)) {


            
            $sql = "UPDATE usuarios SET " .
                "nombre ='$nombre'," .
                "apellidos ='$apellidos'," .
                "email ='$email'" .
                "WHERE id = " . $usuario['id'];

            $guardar = mysqli_query($db, $sql);

            if ($guardar) {
                $_SESSION['usuario']['nombre'] = $nombre;
                $_SESSION['usuario']['apellidos'] = $apellidos;
                $_SESSION['usuario']['email'] = $email;
                $_SESSION['completado'] = "La actualizacion se completo con exito!";
            } else {
                $_SESSION['errores']['general'] = "Error al actualizar";
            }
        } else {
            $_SESSION['errores']['general'] = "Este usuario ya existe";
        }
    } else {
        $_SESSION['errores'] = $errores;
    }
}
header('Location:datos.php');
?>
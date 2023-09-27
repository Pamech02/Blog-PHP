<?php
//iniciar la sesion y conexion a la db
require_once 'includes/conexion.php';

//recoger los datos del formulario

if (isset($_POST)) {
    //borrar error anterior
    if (isset($_SESSION['error_login'])) {
        session_unset();
    }

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    //comprobar las credenciales
    $sql = "SELECT * FROM USUARIOS WHERE email = '$email'";
    $login = mysqli_query($db, $sql);

    if ($login && mysqli_num_rows($login) == 1) {
        $usuario = mysqli_fetch_assoc($login);

        //comprobar password
        $verify = password_verify($password, $usuario['password']);

        //guardar los datos del login en una sesion
        if ($verify) {
            $_SESSION['usuario'] = $usuario;
        } else {
            $_SESSION['error_login'] = "Login incorrecto";
        }
    } else {
        $_SESSION['error_login'] = "Login incorrecto";
    }
}

header('Location:index.php');
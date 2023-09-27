<?php require_once 'conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiendita fr</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <header id="cabecera">
        <div id="logo">
            <a href="index.html">BIENVENIDO :) </a>
        </div>
        
        <nav id="menu">
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <?php $categorias = conseguirCategorias($db);
                      if (!empty($categorias)):
                      while($categoria = mysqli_fetch_assoc($categorias)):
                ?>
                    <li><a href="categoria.php?id=<?=$categoria['id']?>"><?=$categoria['nombre']?></a></li>
                <?php endwhile;
                    endif;
                ?>
                <li><a href="#">Sobre Nosotros</a></li>
                <li><a href="#">Contacto</a></li>
            </ul>
        </nav>

        <div class="clearfix"></div>

    </header>

    <div id="contenedor">
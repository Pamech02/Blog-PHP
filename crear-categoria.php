<?php require_once 'includes/redireccion.php'?>
<?php require_once 'includes/cabecera.php' ?>
<?php include_once 'includes/lateral.php' ?>

    <div id="principal">
    <h1>Crear Categoria</h1>
        <p>Crea una nueva categoria que pienses que hace falta en nuestra coleccion :)</p>
        <br>
        <form action="guardar-categoria.php" method="POST">

            <label for="nombre">Nombre de la categoria:</label>
            <input type="text" name="nombre">
            <input type="submit" value="Guardar">

        </form>
    </div>


<?php include_once 'includes/footer.php' ?>
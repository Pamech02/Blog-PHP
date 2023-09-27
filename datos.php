<?php require_once 'includes/redireccion.php'?>
<?php require_once 'includes/cabecera.php' ?>
<?php include_once 'includes/lateral.php' ?>
    <div id="principal">
        <h1>Datos de usuario:</h1>

        
        <?php if (isset($_SESSION['completado'])): ?>
            <div class="alerta alerta-exito">
                <?= $_SESSION['completado']; ?>
            </div>
        <?php elseif(isset($_SESSION['errores']['general'])): ?>
            <div class="alerta alerta-error">
                <?= $_SESSION['errores']['general']; ?>
            </div>
        <?php endif; ?>


        <form action="actualizar-datos.php" method="POST">
            <label for="nombre">Nombre</label>
            <input name="nombre" type="text" value="<?=$_SESSION['usuario']['nombre'];?>"/>
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; ?>

            <label for="apellidos">Apellidos</label>
            <input name="apellidos" type="text" value="<?=$_SESSION['usuario']['apellidos'];?>"/>
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : ''; ?>

            <label for="email">Correo</label>
            <input name="email" type="email" value="<?=$_SESSION['usuario']['email'];?>" />
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''; ?>

            <input type="submit" name="submit" value="Actualizar" />
        </form>
        <?php borrarErrores(); ?>

    </div>


<?php include_once 'includes/footer.php' ?>
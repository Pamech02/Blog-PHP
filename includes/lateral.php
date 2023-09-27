<aside id="sidebar">
<div id="buscador" class="bloque">
        <h3>Buscar</h3>
       
        <form action="buscar.php" method="POST">
            <label for="busqueda">Buscar</label>
            <input name="busqueda" type="text" />

            <input type="submit" value="Buscar" />
        </form>
    </div>
<?php if(isset($_SESSION['usuario'])):?>
    <div id="login" class="bloque">
        <h3>Bienvenido, <?=$_SESSION['usuario']['nombre'].''.$_SESSION['usuario']['apellidos'];?></h3>
        <a href="crear-entrada.php" class="boton boton-verde">Nueva entrada</a>
        <a href="crear-categoria.php" class="boton">Crear categoria</a>
        <a href="datos.php" class="boton boton-naranja">Mis datos</a>
        <a href="logout.php" class="boton boton-rojo">Cerrar sesion</a>
    </div>
<?php endif;?>

<?php if(!isset($_SESSION['usuario'])):?>
    <div id="login" class="bloque">
        <h3>Identificate</h3>
        <?php if (isset($_SESSION['error_login'])): ?>
            <div class="alerta alerta-error">
                <?= $_SESSION['error_login']; ?>
            </div>
            <?php endif;?>
        <form action="login.php" method="POST">
            <label for="email">Correo</label>
            <input name="email" type="email" />

            <label for="password">Contraseña</label>
            <input name="password" type="password" />

            <input type="submit" value="Ingresar" />
        </form>
    </div>

    <div id="registro" class="bloque">
        <h3>Registrate</h3>
        <?php if (isset($_SESSION['completado'])): ?>
            <div class="alerta alerta-exito">
                <?= $_SESSION['completado']; ?>
            </div>
        <?php elseif(isset($_SESSION['errores'])): ?>
            <div class="alerta alerta-error">
                <?= $_SESSION['errores']['general']; ?>
            </div>
        <?php endif; ?>
        <form action="registro.php" method="POST">
            <label for="nombre">Nombre</label>
            <input name="nombre" type="text" />
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; ?>

            <label for="apellidos">Apellidos</label>
            <input name="apellidos" type="text" />
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : ''; ?>

            <label for="email">Correo</label>
            <input name="email" type="email" />
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''; ?>

            <label for="password">Contraseña</label>
            <input name="password" type="password" />
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'password') : ''; ?>

            <input type="submit" name="submit" value="Registarse" />
        </form>
        <?php borrarErrores(); ?>
    </div>
    <?php endif;?>
</aside>
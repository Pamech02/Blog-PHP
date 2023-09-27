<?php require_once 'includes/redireccion.php'?>
<?php require_once 'includes/conexion.php' ?>
<?php require_once 'includes/helpers.php' ?>

<?php 
        $entrada_actual = conseguirUnicaEntrada($db,$_GET['id']);
        if (!isset($entrada_actual['id'])){
            header("Location:index.php");
        }
        ?>
<?php require_once 'includes/cabecera.php' ?>        
<?php include_once 'includes/lateral.php' ?>

<div id="principal">
    <h1>Edita esta entrada!</h1>
        <p>Editar entrada <?=$entrada_actual['titulo']?></p>
        <br>
        <form action="guardar-entrada.php?editar=<?=$entrada_actual['id']?>" method="POST">

            <label for="titulo">Titulo de la entrda:</label>
            <input type="text" name="titulo" value="<?=$entrada_actual['titulo']?>">
            <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'titulo') : ''; ?>

            <label for="descripcion">Descripcion:</label>
            <textarea name="descripcion"><?=$entrada_actual['descripcion']?></textarea>
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'descripcion') : ''; ?>

            <label for="categoria">Categoria:</label>
            <select name="categoria">
            <?php
             $categorias = conseguirCategorias($db);
             if (!empty($categorias)):
                    while($categoria = mysqli_fetch_assoc($categorias)):
                ?>
                   <option value="<?=$categoria['id']?>"
                   <?=($categoria['id'] == $entrada_actual['categoria_id']) ? 'selected="selected"': ""?>
                   >
                   <?=$categoria['nombre']?></option>
                <?php 
                endwhile; 
                endif  ?>
                   
            </select>
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'categoria') : ''; ?>

            <input type="submit" value="Guardar">

        </form>
        <?php borrarErrores();?>
    </div>

</div>

<?php include_once 'includes/footer.php' ?>

if (isset($_SESSION['usuario']) && isset($_GET['id'])){
    $entrada_id = $_GET['id'];
    $usuario_id = $_SESSION['usuario']['id'];

    $sql = "UPDATE FROM entradas WHERE usuario_id = $usuario_id AND id = $entrada_id";
    $editar = mysqli_query($db, $sql);
}

header("Location:index.php");

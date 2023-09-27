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
    
    <h1><?=$entrada_actual['titulo']?></h1>
    <a href="categoria.php?id=<?=$entrada_actual['categoria_id']?>">
    <h2><?=$entrada_actual['categoria']?></h2>
    </a>
    <p><?=$entrada_actual['descripcion']?></p>
<?php if(isset($_SESSION['usuario']) && $_SESSION['usuario']['id'] == $entrada_actual['usuario_id']):?>
    <br>
    <a href="editar_entrada.php?id=<?=$entrada_actual['id']?>" class="boton boton-verde">Editar entrada</a>
    <a href="borrar_entrada.php?id=<?=$entrada_actual['id']?>" class="boton boton-rojo">Borrar entrada</a>
</div>
<?php endif;?>

<?php include_once 'includes/footer.php' ?>
</body>

</html>
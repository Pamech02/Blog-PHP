<?php require_once 'includes/conexion.php' ?>
<?php require_once 'includes/helpers.php' ?>

<?php 
        $categoria_actual = conseguirUnicaCategoria($db, $_GET['id']);
        if (!isset($categoria_actual['id'])){
            header("Location:index.php");
        }
        ?>
<?php require_once 'includes/cabecera.php' ?>        
<?php include_once 'includes/lateral.php' ?>

<div id="principal">
    
    <h1>Entradas de <?=$categoria_actual['nombre']?></h1>
    <?php
         $entradas = conseguirEntradas($db,null, $_GET['id']);
         if (!empty($entradas)):
         while ($entrada = mysqli_fetch_assoc($entradas)):
    ?>

            <article class="entrada">
                <a href="entrada.php?id=<?=$entrada['id']?>">
                    <h2><?=$entrada['titulo']?></h2>
                    <span class="fecha">
                        <?=$entrada['categoria'].' '.$entrada['fecha']?>
                    </span>
                    <p><?=substr($entrada['descripcion'],0,300)."..."?></p>
                </a>
            </article>

    <?php
        endwhile;
        endif;
    ?>


    <div id="ver-todas">
        <a href="entradas.php">Ver todas las entradas</a>
    </div>
</div>

<?php include_once 'includes/footer.php' ?>
</body>

</html>
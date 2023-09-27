<?php 

        if (!isset($_POST['busqueda'])){
            header("Location:index.php");
        }
        ?>
<?php require_once 'includes/cabecera.php' ?>        
<?php include_once 'includes/lateral.php' ?>

<div id="principal">
    
    <h1>Resultados de "<?=$_POST['busqueda']?>"</h1>
    <?php
        $entradas = conseguirEntradas($db, null, null, $_POST['busqueda']);
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
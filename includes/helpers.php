<?php

function mostrarError($errores, $campo)
{
    $alerta = '';
    if (isset($errores[$campo]) && !empty($campo)) {
        $alerta = "<div class='alerta alerta-error'>" . $errores[$campo] . '</div>';
    }
    return $alerta;
}
function borrarErrores()
{
    $borrado = false;
    if (isset($_SESSION['errores'])) {
        $_SESSION['errores'] = null;
        $borrado = true;
    }
    if (isset($_SESSION['errores_entrada'])) {
        $_SESSION['errores_entrada'] = null;
        $borrado = true;
    }


    if (isset($_SESSION['completado'])) {
        $_SESSION['errores'] = null;
        $borrado = true;
    }

    return $borrado;

}

function conseguirCategorias($conexion){
    $sql="SELECT * FROM categorias";
    $categorias = mysqli_query($conexion, $sql);
    $result = [];

    if ($categorias && mysqli_num_rows($categorias)>=1) {
        $result = $categorias;
    }
    return $result;
}

function conseguirUnicaCategoria($conexion, $id){
    $sql="SELECT * FROM categorias WHERE id='$id';";
    $categorias = mysqli_query($conexion, $sql);
    $result = [];

    if ($categorias && mysqli_num_rows($categorias)>=1) {
        $result = mysqli_fetch_assoc($categorias);
    }
    return $result;
}

function conseguirUnicaEntrada($conexion, $id){
    $sql="SELECT e.*, c.nombre AS 'categoria' FROM entradas e INNER JOIN categorias c on e.categoria_id = c.id WHERE e.id = $id";
    $entrada = mysqli_query($conexion, $sql);
    $result = [];

    if ($entrada && mysqli_num_rows($entrada)>=1) {
        $result = mysqli_fetch_assoc($entrada);
    }
    return $result;
}
function conseguirEntradas($conexion, $limit = null, $categoria=null, $busqueda=null){
    $sql = "SELECT e.*, c.nombre AS 'categoria' FROM entradas e "."INNER JOIN categorias c ON e.categoria_id = c.id";
    
    if(!empty($categoria)){
        $sql .= " WHERE e.categoria_id = $categoria";
    }

    if(!empty($busqueda)){
        $sql .= " WHERE e.titulo LIKE '%$busqueda%'";
    }

    $sql .= " ORDER BY e.id DESC";
   
    if ($limit){
        $sql .= " LIMIT 5";
    }
    
    $entradas = mysqli_query($conexion, $sql);
    $result = [];

    if ($entradas && mysqli_num_rows($entradas)>=1){
        $result = $entradas;
    }
    return $result;
}



?>
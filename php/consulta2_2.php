<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();


    $fecha_creacion = strval($_POST['fecha']);
    $id_sugerido   = strval($_POST['id_sugerido']);

    $ides_detalle	= $_POST["ides_detalle"];   //array
    $cantidad_pedid = $_POST["pedidos"];        //array

    for ($i = 0; $i < count($ides_detalle); $i++) { 

        $consulta = mysqli_query($conexion, "UPDATE `detalle_sugerido` SET `pedido_sugerido` = '$cantidad_pedid[$i]' WHERE `id_detalle` = '$ides_detalle[$i]' AND `id_sugerido1` = '$id_sugerido'") or die ("Error al consultar: no se obtuvo la el la informacion de los productos");

    }

    mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
?>
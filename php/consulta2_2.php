<?php

    $conexion = conectar();


    $fecha_creacion = strval($_POST['fecha']);
    $id_sugerido   = strval($_POST['id_sugerido']);
    $fecha   = strval($_POST['fecha']);

    $ides_detalle	= $_POST["ides_detalle"];   //array
    $cantidad_pedid = $_POST["pedidos"];        //array

    for ($i = 0; $i < count($ides_detalle); $i++) { 

        $consulta = mysqli_query($conexion, "UPDATE `detalle_sugerido` SET `pedido_sugerido` = '$cantidad_pedid[$i]' 
        WHERE `id_detalle` = '$ides_detalle[$i]' AND `id_sugerido1` = '$id_sugerido'") or die ("Error al consultar: no se obtuvo la el la informacion de los productos");

    }
    $consulta = mysqli_query($conexion, "UPDATE `sugerido` SET `pedido_proxima_sugerido`='$fecha' 
    WHERE `id_sugerido` = '$id_sugerido'") or die ("Error al consultar: no se obtuvo la el la informacion de los productos");
    

    mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
?>
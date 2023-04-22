<?php

    $conexion = conectar();

    $nombre_usuario = strval($_POST['usuario']);
    $nombre_provedo = strval($_POST['proveedor']);
    $nombre_emplead = strval($_POST['empleado']);
    $ide_sugerido   = strval($_POST['id_sugerido']);
    $fecha_creacion = strval($_POST['fecha']);
    $ides			= $_POST["ides"];                   //array
    $precios        = $_POST["precios"];                //array
    $cantidad_pedid = $_POST["pedidos"];                //array


    $ides_productos = $ides;
    $tamanio_ = count($ides_productos); //obtenemos la cantidad exacta de productos

    for ($i = 0 ; $i < $tamanio_ ; $i++) {
        $consulta = mysqli_query($conexion, "UPDATE `producto` SET `precio_de_compra`= '$precios[$i]' WHERE `id_producto` = '$ides_productos[$i]' AND `estado` = 'activo'") or die ("Error al consultar: no se obtuvo la el la informacion de los productos");
    }
    
    $costo_total = 0;
    for($i = 0 ; $i < $tamanio_ ; $i++){
        $precio_total = abs($cantidad_pedid[$i]) * abs($precios[$i]);
        $costo_total += $precio_total;
        
        $consulta = mysqli_query($conexion, "UPDATE `detalle_sugerido` SET  `precio_sugerido` = '$precios[$i]',`pedido_sugerido` = '$cantidad_pedid[$i]',`precio_total_pedido` = '$precio_total' WHERE `id_sugerido1` = '$ide_sugerido' AND `id_producto2` = '$ides_productos[$i]' AND `estado` = 'activo'") or die ("Error al actualizar: no se obtuvo los datos de los productos en pedidos");
    }

    $consulta = mysqli_query($conexion, "UPDATE `sugerido` SET `total_global_pedido`='$costo_total',`pedido_proxima_sugerido`='$fecha_creacion',`nombre_empleado_provedor_sug`='$nombre_emplead' WHERE `id_sugerido` = '$ide_sugerido'  AND `estado` = 'activo'") or die ("Error al actualizar: no se obtuvo la el la informacion de los productos");

   
?>
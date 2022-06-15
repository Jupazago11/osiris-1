<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();

    mysqli_set_charset($conexion,"uft8");

    $nombre_usuario = strval($_POST['usuario']);
    $nombre_provedo = strval($_POST['proveedor']);
    $nombre_emplead = strval($_POST['empleado']);
    $ide_sugerido   = strval($_POST['id_sugerido']);
    $fecha_creacion = $fecha = date('Y-m-d', time());
    $ides			= $_POST["ides"];                   //array
    $cantidad_confi = $_POST["confirmados"];                //array


    $ides_productos = $ides;
    $precio_productos = array();

    foreach ($ides_productos as $valor) {
        $consulta = mysqli_query($conexion, "SELECT  `precio_producto` FROM `producto` WHERE `estado` = 'activo' AND `id_producto` = $valor") or die ("Error al consultar: no se obtuvo la el la informacion de los productos");

        while (($fila = mysqli_fetch_array($consulta))!=NULL) {
            array_push($precio_productos, $fila['precio_producto']);

        }
    }
    mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario

    $tamanio_ = count($ides_productos); //obtenemos la cantidad exacta de productos

/*
    
    $id_sugerido
    $ides_productos
    $cantidad_confi
    $precio_productos -> NULL
    $precio_total -> $cantidad_confi * $precio_productos
*/
    $costo_total = 0;
    for($i = 0 ; $i < $tamanio_ ; $i++){
        
        $precio_total = $cantidad_confi[$i] * $precio_productos[$i];
        $costo_total += $precio_total;
        
        $consulta = mysqli_query($conexion, "UPDATE `detalle_sugerido` SET `pedido_sugerido` = '$cantidad_confi[$i]',`precio_total_pedido` = '$precio_total' WHERE `id_sugerido1` = '$ide_sugerido' AND `id_producto2` = '$ides_productos[$i]'") or die ("Error al actualizar: no se obtuvo los datos de los productos en pedidos");
    }
    //mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario


    $consulta = mysqli_query($conexion, "UPDATE `sugerido` SET `total_global_pedido`='$costo_total',`pedido_proxima_sugerido`='$fecha_creacion',`nombre_empleado_provedor_sug`='$nombre_emplead' WHERE `id_sugerido` = '$ide_sugerido'") or die ("Error al actualizar: no se obtuvo la el la informacion de los productos");

    //mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
    
?>
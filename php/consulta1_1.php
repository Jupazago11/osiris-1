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
    $fecha_creacion = strval($_POST['fecha_creacion']);
    $ides			= $_POST["ides"];                   //array
    $cantidad_exist = $_POST["existencias"];              //array
    $cantidad_suger = $_POST["sugeridos"];              //array
    

    
    //Consulta a la base de datos para obtener el ide del usuario activo
    $consulta = mysqli_query($conexion, "SELECT `id_pers` FROM `personal` WHERE `user_pers`='$nombre_usuario'") or die ("Error al consultar: no se obtuvo la identificacion del usuario");

    while (($fila = mysqli_fetch_array($consulta))!=NULL) {
        $id_persona = $fila['id_pers'];
    }
    mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario

    
    //Crearemos un pedido sugerido
    $consulta = mysqli_query($conexion, "INSERT INTO `sugerido`(`id_pers2`, `fecha_sugerido`, `nombre_provedor_sugerido`, `estado`) VALUES ('$id_persona','$fecha_creacion','$nombre_provedo','activo')") or die ("Error al consultar: no se obtuvo la identificacion del usuario");

    mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
    

    //Consulta a la base de datos para obtener el ide del sugerido
    $consulta = mysqli_query($conexion, "SELECT `id_sugerido` FROM `sugerido` ORDER BY `id_sugerido` DESC LIMIT 1") or die ("Error al consultar: no se obtuvo la el id del sugerido");

    while (($fila = mysqli_fetch_array($consulta))!=NULL) {
        $id_sugerido = $fila['id_sugerido'];
    }
    mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario

    $ides_productos = $ides;
    $nombre_productos = array();
    $precio_productos = array();
    $existe_productos = array();


    foreach ($ides_productos as $valor) {
        $consulta = mysqli_query($conexion, "SELECT  `nombre_producto`, `precio_producto`, `existencias` FROM `producto` WHERE `estado` = 'activo' AND `id_producto` = $valor") or die ("Error al consultar: no se obtuvo la el la informacion de los productos");

        while (($fila = mysqli_fetch_array($consulta))!=NULL) {
            array_push($nombre_productos, $fila['nombre_producto']);
            array_push($precio_productos, $fila['precio_producto']);
            array_push($existe_productos, $fila['existencias']);
        }
    }
    mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario

    



    $tamanio_ = count($precio_productos); //obtenemos la cantidad exacta de productos

/*
    
    $id_sugerido
    $ides_productos
    $cantidad_suger
    $cantidad_exist
    Null
    $precio_productos
    $precio_total -> $cantidad_suger * $precio_productos
*/
    $costo_total = 0;
    for($i=0 ; $i < $tamanio_ ; $i++)
    {
        $precio_total = $cantidad_suger[$i] * $precio_productos[$i];
        //echo $precio_total."<br>";
        $costo_total += $precio_total;

        $consulta = mysqli_query($conexion, "INSERT INTO `detalle_sugerido`(`id_sugerido1`, `id_producto2`, `cantidad_sugerido`, `inventario_sugerido`, `pedido_sugerido`, `precio_sugerido`, `precio_total_sugerido`, `estado`) VALUES ('$id_sugerido','$ides_productos[$i]','$cantidad_suger[$i]','$cantidad_exist[$i]',NULL,'$precio_productos[$i]','$precio_total','activo')") or die ("Error al consultar: no se obtuvo la el la informacion de los productos");
        
    }
    mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario

    $consulta = mysqli_query($conexion, "UPDATE `sugerido` SET `total_global_sugerido`='$costo_total' WHERE `id_sugerido` = '$id_sugerido'") or die ("Error al consultar: no se obtuvo la el la informacion de los productos");
    //mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
    
?>
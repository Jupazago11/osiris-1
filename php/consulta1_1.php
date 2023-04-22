<?php
require("../php/conexion.php");
    $conexion = conectar();


    $nombre_usuario = strval($_POST['usuario']);
    $nombre_provedo = strval($_POST['proveedor']);
    $id_sugerido    = strval($_POST['id_sugerido']);

    date_default_timezone_set('America/Bogota');
    $fecha_creacion        = date('Y-m-d', time());

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
    $consulta = mysqli_query($conexion, "INSERT INTO `sugerido`(`id_pers2`, `nombre_provedor_sugerido`, `fecha_sugerido`, `estado`) 
    VALUES ('$id_persona', '$nombre_provedo', '$fecha_creacion', 'activo')") or die ("Error al consultar: no se obtuvo la identificacion del usuario");


    for ($i = 0; $i < count($ides); $i++) { 
        $consulta = mysqli_query($conexion, "INSERT INTO `detalle_sugerido`(`id_sugerido1`, `id_producto2`, `cantidad_sugerido`, `inventario_sugerido`,`estado`) 
        VALUES ('$id_sugerido','$id_producto','0','0','activo')") or die ("Error al consultar: no se obtuvo la identificacion del usuario");
    }

    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
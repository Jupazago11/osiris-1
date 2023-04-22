<?php
    require("../php/conexion.php");
    $conexion = conectar();

    $nombre_prove = strval($_POST['nombre']); //obtenemos el nombre del proveedor seleccionado

    $consulta = mysqli_query($conexion, "UPDATE `sugerido` 
    SET `estado` = 'inactivo' 
    WHERE `nombre_provedor_sugerido` = '$nombre_prove'") or die ("Error al consultar: no se obtuvo la identificacion del usuario");


    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
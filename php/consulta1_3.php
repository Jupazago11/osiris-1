<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();

    $nombre_prove = strval($_POST['nombre']); //obtenemos el nombre del proveedor seleccionado

    $consulta = mysqli_query($conexion, "UPDATE `sugerido` 
    SET `estado` = 'inactivo' 
    WHERE `nombre_provedor_sugerido` = '$nombre_prove'") or die ("Error al consultar: no se obtuvo la identificacion del usuario");


    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
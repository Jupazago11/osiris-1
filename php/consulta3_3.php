<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();

    $id_sugerido   = strval($_POST['id_sugerido']);
    $fecha   = strval($_POST['fecha']);

    $ides_detalle	= $_POST["ides_detalle"];   //array
    $confirmados    = $_POST["confirmados"];        //array
    $existencia    = $_POST["existencia"];        //array

    for ($i = 0; $i < count($ides_detalle); $i++) { 

        $consulta = mysqli_query($conexion, "UPDATE `detalle_sugerido` SET `inventario_sugerido`='$existencia[$i]', `pedido_recibido` = '$confirmados[$i]' WHERE `id_detalle` = '$ides_detalle[$i]' AND `id_sugerido1` = '$id_sugerido'") or die ("Error al consultar: no se obtuvo la el la informacion de los productos");

    }
    
    $consulta = mysqli_query($conexion, "UPDATE `sugerido` SET `pedido_proxima_sugerido`='$fecha' 
    WHERE `id_sugerido` = '$id_sugerido'") or die ("Error al consultar: no se obtuvo la el la informacion de los productos");

    mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
?>
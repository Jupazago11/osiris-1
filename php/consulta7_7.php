<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();


    $id_sugerido = strval($_POST['id_sugerido']);
    $ides			= $_POST["ides"];                   //array
    $cantidad_exist = $_POST["existencias"];            //array
    $cantidad_suger = $_POST["sugeridos"];              //array
    
    for($i = 0 ; $i < count($ides) ; $i++){

        $consulta = mysqli_query($conexion, "UPDATE `detalle_sugerido` SET `cantidad_sugerido`='$cantidad_suger[$i]',`inventario_sugerido`='$cantidad_exist[$i]' WHERE `id_detalle` = '$ides[$i]' AND `id_sugerido1` = '$id_sugerido'") or die ("Error al consultar: no se obtuvo la el la informacion de los productos");
        
    }

    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
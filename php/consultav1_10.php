<script type="text/javascript" src="../js/funciones.js"></script>
<?php
require("../php/conexion.php");
    $conexion = conectar();                     //Obtenemos la conexion

    $id_cuadre_caja_completa     = $_POST['id_cuadre_caja_completa'];
    
    //efectivo de caja en blanco
    $consulta = mysqli_query($conexion, "UPDATE `efectivo_en_caja` 
    SET `efectivo_en_caja`='0'
    WHERE `id_cuadre_caja_completo4`='$id_cuadre_caja_completa'") or die ("Error al update: efectivo en caja");

    //pago de caja en blanco y damos un valor nuevo
    $consulta = mysqli_query($conexion, "UPDATE `pagos_caja` 
    SET `estado`=''
    WHERE `id_cuadre_caja_completo2`='$id_cuadre_caja_completa'") or die ("Error al update: efectivo en caja");


    $consulta = mysqli_query($conexion, "INSERT INTO `pagos_caja`( `id_cuadre_caja_completo2`,`descripcion_caja`, `costo_pagos`, `estado`) 
    VALUES ('$id_cuadre_caja_completa',NULL,'0','activo')") or die ("Error al update: presupuesto");


    //cuadre de caja en blanco
   
    $consulta = mysqli_query($conexion, "UPDATE `cuadre_caja` 
    SET `costo_cuadre`='0'
    WHERE `id_cuadre_caja_completo1`='$id_cuadre_caja_completa'") or die ("Error al update: efectivo en caja");

    //venta diaria
    $consulta = mysqli_query($conexion, "UPDATE `venta_diaria` 
    SET `venta_diaria`='0'
    WHERE `id_cuadre_caja_completo3`='$id_cuadre_caja_completa'") or die ("Error al update: efectivo en caja");

    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
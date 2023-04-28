<script type="text/javascript" src="../js/funciones.js"></script>
<?php
require("../php/conexion.php");
    $conexion = conectar();                     //Obtenemos la conexion


    $venta_diaria       = str_replace(".","",$_POST['venta_diaria']);
    $id_cuadre_caja_completa     = $_POST['id_cuadre_caja_completa'];

    echo $venta_diaria;
    $consulta = mysqli_query($conexion, "UPDATE `venta_diaria` 
    SET `venta_diaria` = '$venta_diaria'
    WHERE `id_cuadre_caja_completo3` = '$id_cuadre_caja_completa'") or die ("Error al update: proveedores");
    
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
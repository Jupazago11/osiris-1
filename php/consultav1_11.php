<script type="text/javascript" src="../js/funciones.js"></script>
<?php
require("../php/conexion.php");
    $conexion = conectar();                     //Obtenemos la conexion


    $venta_diaria       = str_replace(".","",$_POST['venta_diaria']);
    echo $venta_diaria;
    $consulta = mysqli_query($conexion, "UPDATE `venta_diaria` 
    SET `venta_diaria` = '$venta_diaria'") or die ("Error al update: proveedores");
    
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
<script type="text/javascript" src="../js/funciones.js"></script>
<?php

    $conexion = conectar();                     //Obtenemos la conexion

    date_default_timezone_set('America/Bogota');
    $fecha        = date('Y-m-d', time());

    $consulta = mysqli_query($conexion, "INSERT INTO `cuenta_cobro`(`costo`, `fecha`, `dias`, `estado`) 
    VALUES (0,'$fecha',0,'activo')") or die ("Error al consultar: proveedores");

    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
<script type="text/javascript" src="../js/funciones.js"></script>
<?php

    $conexion = conectar();                     //Obtenemos la conexion

    date_default_timezone_set('America/Bogota');
    $hoy = date("Y-m-d H:i:s");

    $consulta = mysqli_query($conexion, "INSERT INTO `personal`(`fecha_nacimiento_pers`, `fecha_inicio_contrato_pers`, `fecha_ingreso`,`tipo_contrato_pers`, `cargo`,`tipo_usuario_pers`,`estado`) 
    VALUES ('$hoy','$hoy','$hoy', '12','3','3','activo')") or die ("Error al consultar: proveedores");

    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
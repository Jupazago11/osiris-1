<script type="text/javascript" src="../js/funciones.js"></script>
<?php
require("../php/conexion.php");
    $conexion = conectar();                     //Obtenemos la conexion

    date_default_timezone_set('America/Bogota');
    $hoy = date("Y-m-d H:i:s");

    $consulta = mysqli_query($conexion, "INSERT INTO `vehiculo`(`fecha_soat`, `fecha_tecn`, `estado`) 
    VALUES ('$hoy','$hoy','activo')") or die ("Error al consultar: proveedores");

    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
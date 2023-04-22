<script type="text/javascript" src="../js/funciones.js"></script>
<?php
require("../php/conexion.php");
    $conexion = conectar();                     //Obtenemos la conexion

    date_default_timezone_set('America/Bogota');
    $hoy = date("Y-m-d");

    //post id del vehiculo
    $id_vehiculo    = $_POST['id_vehiculo'];
    
    $consulta = mysqli_query($conexion, "INSERT INTO `observacion`( `id_vehiculo1`, `observacion`, `costo`, `fecha`, `estado`) 
    VALUES ('$id_vehiculo','','0', '$hoy','activo')") or die ("Error al consultar: observacion");

    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
<script type="text/javascript" src="../js/funciones.js"></script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion

    date_default_timezone_set('America/Bogota');
    $hoy = date("Y-m-d H:i:s");

    $consulta = mysqli_query($conexion, "INSERT INTO `personal`(`fecha_nacimiento_pers`, `fecha_inicio_contrato_pers`, `fecha_ingreso`, `cargo`,`tipo_usuario_pers`,`estado`) 
    VALUES ('$hoy','$hoy','$hoy','3','3','activo')") or die ("Error al consultar: proveedores");

    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
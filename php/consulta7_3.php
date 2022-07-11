<script type="text/javascript" src="../js/funciones.js"></script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion

    $consulta = mysqli_query($conexion, "INSERT INTO `proveedor`(`estado`) 
    VALUES ('activo')") or die ("Error al consultar: proveedores");

    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
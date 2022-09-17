<script type="text/javascript" src="../js/funciones.js"></script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion

    date_default_timezone_set('America/Bogota');
    $fecha        = date('Y-m-d', time());
    
    $id_pers = $_POST['id_pers'];

    $consulta = mysqli_query($conexion, "INSERT INTO `requerimiento`(`id_pers5`, `reque`, `costo`, `estado`, `fecha`) 
    VALUES ('$id_pers', NULL, '0', 'activo', '$fecha')") or die ("Error al consultar: proveedores");

    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
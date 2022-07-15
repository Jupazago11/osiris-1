<script type="text/javascript" src="../js/funciones.js"></script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion

    $id_presu1    = $_POST['id_presu1'];

    $consulta = mysqli_query($conexion, "INSERT INTO `pre_detalle` (`id_presu_de`, `id_presu1`, `nombre`, `costo`, `costo_gasto`, `estado`) 
    VALUES (NULL, '$id_presu1', NULL, NULL, NULL, 'activo')") or die ("Error al update: presupuesto");

    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
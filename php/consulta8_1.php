<script type="text/javascript" src="../js/funciones.js"></script>
<?php
    require("../php/conexion.php");
    $conexion = conectar();                     //Obtenemos la conexion

    $consulta = mysqli_query($conexion, "INSERT INTO `categoria`(`estado`) 
    VALUES ('activo')") or die ("Error al consultar: categorias");

    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
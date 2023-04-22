<script type="text/javascript" src="../js/funciones.js"></script>
<?php

    $conexion = conectar();                     //Obtenemos la conexion

    $consulta = mysqli_query($conexion, "INSERT INTO `cuadre_caja`( `descripcion_cuadre`, `costo_cuadre`, `estado`) 
    VALUES (NULL,'0','activo')") or die ("Error al update: presupuesto");

    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
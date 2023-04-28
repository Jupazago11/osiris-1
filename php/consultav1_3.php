<script type="text/javascript" src="../js/funciones.js"></script>
<?php
require("../php/conexion.php");
    $conexion = conectar();                     //Obtenemos la conexion

    $id_cuadre_caja_completa     = $_POST['id_cuadre_caja_completa'];

    $consulta = mysqli_query($conexion, "INSERT INTO `cuadre_caja`( `id_cuadre_caja_completo1`,`descripcion_cuadre`, `costo_cuadre`, `estado`) 
    VALUES ('$id_cuadre_caja_completa',NULL,'0','activo')") or die ("Error al update: presupuesto");

    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
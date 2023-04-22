<script type="text/javascript" src="../js/funciones.js"></script>
<?php
require("../php/conexion.php");
    $conexion = conectar();                     //Obtenemos la conexion

    $id_presu1    = $_POST['id_presu1'];
    $id_user = $_POST['id_user'];

    $consulta = mysqli_query($conexion, "INSERT INTO `pre_detalle`(`id_presu1`, `id_pers4`, `estado`) 
    VALUES ('$id_presu1', '$id_user', 'activo')") or die ("Error al update: presupuesto");

    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
<script type="text/javascript" src="../js/funciones.js"></script>
<?php

    $conexion = conectar();                     //Obtenemos la conexion


    $id_ven_dia     = $_POST['id_ven_dia'];
    $ventas_dias    = str_replace(".","",$_POST['ventas_dias']);



    for ($i = 0; $i < count($id_ven_dia); $i++) { 
        
        $consulta = mysqli_query($conexion, "UPDATE `ventas_diarias` 
        SET `ventas`='$ventas_dias[$i]' 
        WHERE `id_ven_dia`='$id_ven_dia[$i]'") or die ("Error al update: presupuesto");
        
        //echo $id_ven_dia[$i]."       ".$ventas_dias[$i]."<br>";
        
    }

    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
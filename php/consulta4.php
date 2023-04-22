<script type="text/javascript" src="../js/funciones.js"></script>
<?php

    $conexion = conectar();


    $consulta = mysqli_query($conexion, "SELECT * FROM `sugerido`
    WHERE `pedido_proxima_sugerido` >= CURDATE() AND `estado`='activo' 
    ORDER BY `pedido_proxima_sugerido` ASC") or die ("Error al consultar: existencia del proveedor");
    
    ?>
    <table class="tabla_sugerido" width="100%">
        <tr>
            <th>#</th>
            <th>Proveedor</th>
            <th>Fecha estipulada para el pedido</th>
            <th>Días restantes</th>
        </tr>
    <?PHP

    $fecha = date('Y-m-d', time());
    $contador = 0;
    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        ?>
        <tr>
        <?PHP
        $contador++;
            echo "<td>".$contador."</td>";
            echo "<td>".$fila['nombre_provedor_sugerido']."</td>";
            echo "<td>".$fila['pedido_proxima_sugerido']."</td>";


            $fecha1  = new DateTime($fecha);
            $fecha2 = new DateTime($fila['pedido_proxima_sugerido']);
            $intvl = $fecha1->diff($fecha2);

            echo "<td>".$intvl->days."</td>";
        ?>
        </tr>
        <?PHP
    }
    mysqli_free_result($consulta);
    ?>
        </table>
    <?PHP
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
    
?>
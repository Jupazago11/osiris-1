<script type="text/javascript" src="../js/funciones.js"></script>
<?php
require("../php/conexion.php");
    $conexion = conectar();                     //Obtenemos la conexion

    date_default_timezone_set('America/Bogota');

    $fecha_inicio_cxpagar   = $_POST['fecha_inicio_cxpagar'];
    $fecha_final_cxpagar    = date('Y-m-d',strtotime($_POST['fecha_final_cxpagar'].'+ 1 days'));

    
    //Consulta a la base de datos en la tabla provvedor
    $consulta = mysqli_query($conexion, "SELECT * FROM `cuenta_cobro` 
    WHERE `estado` = 'inactivo' 
    AND `fecha_pago` BETWEEN '$fecha_inicio_cxpagar' AND '$fecha_final_cxpagar'
    ORDER BY `fecha_pago` DESC") or die ("Error al consultar: proveedores");

    $costo_total = 0;
    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $costo_total += $fila['costo'];
    }
    mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
    if($costo_total == 0){
        mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
        echo "<script>document.getElementById('respuesta6_4').style.display='none'</script>";
        
    }else{
        //Consulta a la base de datos en la tabla provvedor
        $consulta = mysqli_query($conexion, "SELECT * FROM `cuenta_cobro` 
        WHERE `estado` = 'inactivo' 
        AND `fecha_pago` BETWEEN '$fecha_inicio_cxpagar' AND '$fecha_final_cxpagar'
        ORDER BY `fecha_pago` DESC") or die ("Error al consultar: proveedores");

        ?>


        <table class="tabla_sugerido" width="100%">
        <tr>
            <th>Nombre</th>
            <th>Factura</th>
            <th>Fecha de Registro</th>
            <th>Fecha de pago</th>
            <th>Valor</th>
            <th><a class="w3-bar-item w3-button w3-hover-red active" onclick="document.getElementById('respuesta6_4').style.display='none'">X</a></th>
        </tr>
        <tr>
        <?php
        $costo_total = 0;
        while (($fila = mysqli_fetch_array($consulta))!=NULL){
            // traemos los proveedores existentes en la base de datos
            echo "<td>".$fila['nombre']."</td>";
            echo "<td>".$fila['factura']."</td>";
            echo "<td>".$fila['fecha']."</td>";
                        
            echo "<td>".$fila['fecha_pago']."</td>";

            echo "<td colspan='2'>".number_format($fila['costo'], 0, ',', '.')."</td>";

            
            
            echo "</tr>";
            $costo_total += $fila['costo'];
            
        }
        echo "<tfoot><tr><td colspan='3'></td><td>Total</td><th>".number_format($costo_total, 0, ',', '.')."</th></tr></tfoot>";
        mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
        ?>
        </tr>
        </table>
    <?php
    }
    

    
    
    
    
    
    
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
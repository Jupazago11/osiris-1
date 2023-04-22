<?php
use Dompdf\Dompdf;
ob_start();


$conexion = conectar();

date_default_timezone_set('America/Bogota');
$fecha = date("Y-m-d H:i:s");

    


if(!empty($_GET['Nufactura'])){
    $Nufactura = $_GET['Nufactura'];


    

    $consulta = mysqli_query($conexion, "SELECT `name_cliente` 
    FROM `factura` 
    WHERE `id_facturacion` = '$Nufactura'") or die ("Error al consultar: no se obtuvo la identificacion del usuario");

    while (($fila = mysqli_fetch_array($consulta))!=NULL) {
        ?>
        <div style="text-align: center;text-transform: uppercase;font-size:0.8em">
            morales&nbsp;agudelo&nbsp;jhon&nbsp;alexis
            <br>
            nit:&nbsp;1040356433-0
            <br>
            responsable de iva
            <br>
            tel:&nbsp;312&nbsp;842&nbsp;4188
            <br>
            san luis,&nbsp;antioquia
            <br>
            <br>
            mercados&nbsp;la&nbsp;manzana
        </div>
        <div style="text-transform: uppercase;font-size:0.8em">
            <br>
            <br>
            cliente:&nbsp;&nbsp;&nbsp;<span><?php echo $fila['name_cliente'] ?></span>
            <br>
            <br>
        </div>
    <?php
    }

    $consulta = mysqli_query($conexion, "SELECT producto.cod_producto, producto.nombre_producto, detalle_factura.cantidad, detalle_factura.precio_detalle, factura.forma_pago, producto.iva, factura.fecha, personal.nombre_pers
    FROM `detalle_factura` 
    INNER JOIN factura ON detalle_factura.id_facturacion1 = factura.id_facturacion 
    INNER JOIN producto ON detalle_factura.id_producto1 = producto.id_producto
    INNER JOIN personal ON personal.id_pers = factura.id_pers1
    WHERE factura.id_facturacion = '$Nufactura' AND detalle_factura.estado != ''") or die ("Error al consultar: no se obtuvo la identificacion del usuario");


    ?>
    <div style="text-align: left; text-transform: uppercase;font-size:0.8em">
        <table style="border-collapse: collapse">
            <tr>
                <th width="15%">cod</th> 
                <th width="55%">descripcion</th> 
                <th width="15%">cant</th> 
                <th width="15%">total</th>  
            </tr>

            <?php
            $total      = 0;
            $total_iva  = 0;
            $unidades   = 0;
            $items      = 0;
            
            while (($fila = mysqli_fetch_array($consulta))!=NULL) {
                $items++;
                $unidades+=   $fila['cantidad'];
                $total +=     $fila['precio_detalle'];
                $forma_pago = $fila['forma_pago'];
                $total_iva += $fila['precio_detalle']/100*$fila['iva'];
                $fecha_expedicion = $fila['fecha'];
                $cajeroa    = $fila['nombre_pers'];
                ?>
                <tr>
                    <td colspan="4">---------------------------------------------------------------</td> 
                </tr>
                <tr>
                    <td width="15%"><?php echo $fila['cod_producto']; ?></td> 
                    <td width="55%"><?php echo $fila['nombre_producto']; ?></td> 
                    <td width="15%"><?php echo $fila['cantidad']; ?></td> 
                    <td width="15%"><?php echo number_format($fila['precio_detalle'], 0, ',', '.'); ?></td>  
                </tr>
                <tr>
                    <td width="15%"></td> 
                    <td width="55%"><?php echo ">>&nbsp;iva&nbsp;".$fila['iva']."%"; ?></td> 
                    <td width="15%"><?php echo number_format($fila['precio_detalle']/100*19, 0, ',', '.'); ?></td> 
                    <td width="15%"></td>  
                </tr>
                <?php
            }
            mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
            ?>
            <br>


            <tr>
                <td colspan="4">---------------------------------------------------------------</td> 
            </tr>
            <tr>
                <td width="85%" colspan="3">>>&nbsp;total&nbsp;de&nbsp;la&nbsp;factura</td> 
                <td width="15%"><?php echo number_format($total, 0, ',', '.'); ?></td>  
            </tr>
            <tr>
                <td width="85%" colspan="3">Forma&nbsp;de&nbsp;pago</td> 
                <td width="15%"><?php echo $forma_pago ?></td>  
            </tr>
            <br>

            <tr>
                <td colspan="4">---------------------------------------------------------------</td> 
            </tr>

            <tr>
                <td width="85%" colspan="3">total antes de impuestos</td> 
                <td width="15%"><?php echo number_format($total-$total_iva, 0, ',', '.'); ?></td>  
            </tr>
            <tr>
                <td width="85%" colspan="3">total&nbsp;iva >></td> 
                <td width="15%"><?php echo number_format($total_iva, 0, ',', '.'); ?></td>  
            </tr>
            <br>
        </table>

        <table style="border-collapse: collapse">
            <tr>
                <td colspan="4">---------------------------------------------------------------</td> 
            </tr>
            <tr>
                <td width="40%">Unidades:</td> 
                <td width="60%"><?php echo number_format($unidades, 0, ',', '.'); ?></td>  
            </tr>
            <tr>
                <td width="40%">Items:</td> 
                <td width="60%"><?php echo number_format($items, 0, ',', '.'); ?></td>  
            </tr>

            <tr>
                <td width="40%">expedicion:</td> 
                <td width="60%"><?php echo $fecha_expedicion ?></td>  
            </tr>
            <tr>
                <td width="40%">impresion:</td> 
                <td width="60%"><?php echo $fecha ?></td>  
            </tr>
            <tr>
                <td width="40%">cajero(a):</td> 
                <td width="60%"><?php echo $cajeroa ?></td>  
            </tr>
            <br>
            <tr>
                <td colspan="2">Domicilios</td>  
            </tr>
            <tr>
                <td>311&nbsp;338&nbsp;4443</td> 
                <td>312&nbsp;842&nbsp;4188</td> 
            </tr>
        </table>
    </div>
    <?php


    $html = ob_get_clean();
    //echo $html;

    require_once '../libreria/dompdf/autoload.inc.php';
    
    $dompdf = new Dompdf();


    $dompdf->loadHtml($html);      //contenido, puede ser "texto"
    $dompdf->setPaper("b7", "portrait");    //Papel

    $dompdf->render();

    $dompdf->stream("archivo.pdf", array("Attachment" => false)); //True lo descarga

}
else{

    echo "Error capturando el id";
}





?>
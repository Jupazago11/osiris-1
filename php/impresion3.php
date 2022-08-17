<?php
use Dompdf\Dompdf;
ob_start();

//Incluir el archivo que contiene las funciones del lenguaje PHP
require_once("../PHP/funciones.php");

if(existencia_de_la_conexion()){
    require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
}
$conexion = conectar();

date_default_timezone_set('America/Bogota');
$fecha = date("Y-m-d H:i:s");

    


if(!empty($_GET['Nucliente'])){
    $Nucliente = $_GET['Nucliente'];


    $consulta = mysqli_query($conexion, "SELECT `nombre_cliente`,`identificacion_cliente` 
    FROM `cliente` 
    WHERE `id_cliente` = '$Nucliente'") or die ("Error al consultar: no se obtuvo la identificacion del usuario");

    while (($fila = mysqli_fetch_array($consulta))!=NULL) {
        $nombre_cliente = $fila['nombre_cliente'];
        $identificacion_cliente = $fila['identificacion_cliente'];
    }

    mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario

    /////////////////////////////
    //  traemos las facturas del cliente

    $consulta = mysqli_query($conexion, "SELECT `id_facturacion` 
    FROM `factura` 
    WHERE estado = 'finalizada' AND `id_cliente3` = '$Nucliente' AND `forma_pago` = 'credito'") or die ("Error al consultar: no se obtuvo la identificacion del usuario");

    $facturas = array();

    while (($fila = mysqli_fetch_array($consulta))!=NULL) {
        array_push($facturas, $fila['id_facturacion']);
    }
    mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario

    $Total_factura = 0;

    for ($i=0; $i < count($facturas); $i++) { 
        $consulta = mysqli_query($conexion, "SELECT `precio_detalle` 
        FROM `detalle_factura` 
        WHERE `id_facturacion1` = '$facturas[$i]' AND `estado` = 'activo'") or die ("Error al consultar: no se obtuvo la identificacion del usuario");

        while (($fila = mysqli_fetch_array($consulta))!=NULL) {
            $Total_factura += $fila['precio_detalle'];
        }
        mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
    }

    /////////////////////////////
    //  traemos los abonos del cliente

    $consulta = mysqli_query($conexion, "SELECT `abono` 
    FROM `factura_abono` 
    WHERE `id_cliente1` = '$Nucliente'") or die ("Error al consultar: no se obtuvo la identificacion del usuario");

    $Total_abono = 0;
    while (($fila = mysqli_fetch_array($consulta))!=NULL) {
        $Total_abono += $fila['abono'];
    }
    mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario


    /////////////////////////////////////////////////////////////

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
            cliente:&nbsp;&nbsp;&nbsp;<span><?php echo $nombre_cliente ?></span>
            <br>
            Cedula:&nbsp;&nbsp;&nbsp;<span><?php echo $identificacion_cliente ?></span>
            <br>
        </div>

    <div style="text-align: left; text-transform: uppercase;font-size:0.8em">
        <table style="border-collapse: collapse">
            <br>
            <tr>
                <td colspan="4">---------------------------------------------------------------</td> 
            </tr>
            <tr>
                <td width="85%" colspan="3">>>&nbsp;Deuda&nbsp;A la fecha&nbsp;</td> 
                <td width="15%"><?php echo number_format($Total_factura-$Total_abono, 0, ',', '.'); ?></td>  
            </tr>
            <br>

            <tr>
                <td colspan="4">---------------------------------------------------------------</td> 
            </tr>
            <br>
        </table>

        <table style="border-collapse: collapse">
            <tr>
                <td width="40%">impresion:</td> 
                <td width="60%"><?php echo $fecha ?></td>  
            </tr>
            <br>
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
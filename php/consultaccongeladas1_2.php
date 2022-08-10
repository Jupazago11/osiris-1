<script type="text/javascript" src="../js/funciones.js"></script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion

    $id_facturacion = $_POST['Nfactura'];


    $consulta = mysqli_query($conexion, "SELECT `id_producto1`, producto.nombre_producto, proveedor.nombre_proveedor, producto.precio_producto, producto.precio_producto2, detalle_factura.cantidad 
    FROM `detalle_factura` 
    INNER JOIN producto ON producto.id_producto = detalle_factura.id_producto1 
    INNER JOIN proveedor ON proveedor.id_proveedor = producto.id_proveedor1 
    WHERE `id_facturacion1` = '$id_facturacion'") or die ("Error al consultar: datos de  producto");

    
    //Capturamos los datos
    while (($fila = mysqli_fetch_array($consulta))!=NULL) {
        ?>
        <script>multi2();</script>
        
        <table border="0" id="tablaprueba" width="100%"> 
        <tr>
        
            
                <td class="ides" style="display:none" name="ides[]"><input type="text" name="idess[]" value="<?php echo $fila['id_producto1'] ?>"/></td>
                <input type="hidden" name="precio_producto[]" value="<?php echo $fila['precio_producto'] ?>"/>
            <td width="25%" class="names"><?php echo ucwords($fila['nombre_producto']) ?></td>
            <td width="15%"><?php echo $fila['nombre_proveedor'] ?></td>
            <td width="15%" class="precios" name="precios[]"><span class="precio"><?php echo $fila['precio_producto'] ?></span></td>
            <td width="20%" name="cantidades[]"><input type="number" name="cantidad[]" class="cantidad" value="<?php echo $fila['cantidad'] ?>" min="0" onchange="multi2()"/></td>
            <td width="15%" class="total"><span class="total"><?php echo $fila['precio_producto']*$fila['cantidad'] ?></span></td>
            <td width="10%"><input type="button" class="borrar w3-tbn w3-red" value=" X "></input></td>
        
        

        </tr>
        </table>
        <?PHP
    }

?>

<script type="text/javascript" src="../js/funciones.js"></script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion

    $codigo_producto_v1_1 = $_POST['codigo_producto_v1_1'];


    $consulta = mysqli_query($conexion, "SELECT `id_producto`, `cod_producto`, `id_cat1`, `nombre_producto`, `precio_producto`, `precio_producto2`, `id_proveedor1`, producto.estado, proveedor.nombre_proveedor 
    FROM `producto`
    INNER JOIN proveedor ON proveedor.id_proveedor = producto.id_proveedor1
    WHERE `cod_producto` = '$codigo_producto_v1_1'") or die ("Error al consultar: datos de  producto");
    //Capturamos los datos
    while (($fila = mysqli_fetch_array($consulta))!=NULL) {
        ?>
        <script>multi2();</script>
        
        <table border="0" id="tablaprueba" width="100%"> 
        <tr>
        
            
            <td width="25%" class="ides" style="display:none" name="ides[]"><?php echo $fila['id_producto'] ?></td>
            <td width="25%" class="names"><?php echo ucwords($fila['nombre_producto']) ?></td>
            <td width="15%"><?php echo $fila['nombre_proveedor'] ?></td>
            <td width="15%" class="precios" name="precios[]"><span class="precio"><?php echo $fila['precio_producto'] ?></span></td>
            <td width="20%" name="cantidades[]"><input type="number" class="cantidad" value="1" min="0" onchange="multi2()"/></td>
            <td width="15%" class="total"><span class="total"><?php echo $fila['precio_producto'] ?></span></td>
            <td width="10%"><input type="button" class="borrar w3-tbn w3-red" value=" X "></input></td>
        
        

        </tr>
        </table>
        <?PHP
            break;
    }
?>

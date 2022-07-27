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
        ?></tr>
        <table > 
        <tbody id="tbodyform">
            
            <td class="ides" style="display:none" name="ides[]"><?php echo $fila['id_producto'] ?></td>
            <td class="names"><?php echo ucwords($fila['nombre_producto']) ?></td>
            <td><?php echo $fila['nombre_proveedor'] ?></td>
            <td class="precios" name="precios[]"><span class="precio"><?php echo $fila['precio_producto'] ?></span></td>
            <td name="cantidades[]"><input type="number" class="cantidad" value="1" min="1" onchange ="multi2()"/></td>
            <td class="total"><span class="total"><?php echo $fila['precio_producto'] ?></span></td>
            <td><input type="button" class="borrar" value=" X " style="background-color: #f44336;"></input></td>
        
        </tbody>
        </table>
        <?PHP
            break;
    }
?>

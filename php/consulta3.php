<script type="text/javascript" src="../js/funciones.js"></script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                      //Obtenemos la conexion
    mysqli_set_charset($conexion,"uft8");

    $nombre_usuario  = strval($_POST['usuario']);//obtenemos el nombre del proveedor seleccionado
    $nombre_empleado = strval($_POST['nombre_empleado_provedor']); //obtenemos el nombre del empleado
    $nombre_prove    = strval($_POST['provedor']);//obtenemos el nombre del proveedor seleccionado
    $fecha = date('Y-m-d', time());

    //Verificamos si el proveedor existe en los sugeridos
    $existe_proveedor = false;
                     
    //verificamos si existe algun registro de sugeridos para ese proveedor
    $consulta = mysqli_query($conexion, "SELECT `id_sugerido` FROM `sugerido` WHERE `estado` = 'activo' AND `nombre_provedor_sugerido` = '$nombre_prove'") or die ("Error al consultar: existencia del proveedor");
                        
    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $existe_proveedor = true;
        break;
    }
    mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario

    //Como si existe, continuamos
    if($existe_proveedor == true){
        ?>
        <br>
        <fieldset>
        <form id="form_crear_sugerido3" method="POST">
        <input type="hidden" name="usuario" value="<?php echo $nombre_usuario; ?>">
        <input type="hidden" name="proveedor" value="<?php echo $nombre_prove; ?>">
        <input type="hidden" name="empleado" value="<?php echo $nombre_empleado; ?>">
        Fecha de hoy
        <?php echo $fecha; ?>
        
        <legend>Confirmar pedido</legend>
            <table border="1" id="tabla_sugerido" width="100%">
                    <tr>
                        <th width="5%">Codigo</th>
                        <th>Descripción</th>
                        <th>Costo con IVA</th>
                        <th>Pedido</th>
                        <th>Confirmada</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                    <?php
                        //Consulta a la base de datos en la tabla producto
                        $consulta = mysqli_query($conexion, "SELECT `id_sugerido`, `fecha_sugerido` FROM `sugerido` WHERE `estado` = 'activo' AND `nombre_provedor_sugerido` = '$nombre_prove' ORDER BY `id_sugerido` DESC LIMIT 1") or die ("Error al consultar: datos de productos");
                        
                        while (($fila = mysqli_fetch_array($consulta))!=NULL){
                            //Obtenemos el id del ultimo sigerido del proveedor
                            $ide_sugerido = $fila['id_sugerido'];
                            ?>
                            <input type="hidden" name="id_sugerido" value="<?php echo $ide_sugerido; ?>">
                            <?php
                            $fecha_del_sugerido = $fila['fecha_sugerido'];
                            break;
                        }
                        mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario


                        //traemos los productos y datos asociados a dicho proveedor
                        $consulta = mysqli_query($conexion, "SELECT detalle_sugerido.id_detalle, detalle_sugerido.id_producto2, producto.nombre_producto, detalle_sugerido.cantidad_sugerido, detalle_sugerido.inventario_sugerido, detalle_sugerido.pedido_sugerido, detalle_sugerido.precio_sugerido, detalle_sugerido.precio_total_sugerido FROM `detalle_sugerido` INNER JOIN producto ON producto.id_producto = detalle_sugerido.`id_producto2` WHERE detalle_sugerido.id_sugerido1 = '$ide_sugerido' AND producto.`estado` = 'activo'  AND detalle_sugerido.`estado` = 'activo'") or die ("Error al consultar: datos de productos en sugeridos");

                        $contador = 0;

                        while (($fila = mysqli_fetch_array($consulta))!=NULL){
                            $contador++;
                            ?>
                            <tr>
                                <tbody>
                                <td><input type="text" name="ides[]" size="5" readonly class="sin_borde"value="<?php echo $fila['id_producto2'] ?>"/></td>
                                <td><?php echo ucwords($fila['nombre_producto']) ?></td>
                                <td class="precios"><span class="precio"><?php echo $fila['precio_sugerido'] ?></span></td>
                                <td><?php echo $fila['pedido_sugerido'] ?></td>
                                <td class="confirmados"><input  name="confirmados[]" type="number" value="0" min="0" class="confirmado" style="width: 100px"/></td>
                                <td><td>                  
                            <?php
                        }
                        mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
                    ?>
                        <tr>
                            <td colspan="7"></td>
                        </tr>
                    <tfoot>
                        <tr>
                            <td style="background-color: #04AA6D; color: white;">Cantidad</td>
                            <td><?php echo $contador; ?></td>
                            <td></td>
                            <td></td>
                            <td id="total_sugeridos"></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="background-color: #04AA6D; color: white;">Total Factura</td>
                            <td class="final"  id="factura_total"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tfoot>
                    </tbody>
                    </table>
                    <br><br>
                    

                    <br><br>
                    <button type="button" id="enviar3_3" class="w3-btn w3-teal" onclick="document.getElementById('respuesta3_3').style.display='block'">Registrar</button><br><br>
                    <input type="reset" value="Limpiar" class="w3-btn w3-teal" onclick="document.getElementById('respuesta3_3').style.display='none'">
                </fieldset>
            </form>
            <div id="respuesta3_3"></div>
            <script>
                //<input type="date" name="fecha"/>
                $('#enviar3_3').click(function(){
                    $.ajax({
                        url:'../php/consulta3_3.php',
                        type:'POST',
                        data: $('#form_crear_sugerido3').serialize(),
                        success: function(res){
                            $('#respuesta3_3').html(res);
                        },
                        error: function(res){
                            alert("Problemas al tratar de enviar el formulario");
                        }
                    });
                });
            </script>
        <?php
        mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
    }else{

    }

    

?>
<script type="text/javascript" src="../js/funciones.js"></script>
<?php

    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                      //Obtenemos la conexion

    date_default_timezone_set('America/Bogota');
    $fecha        = date('Y-m-d', time());

    $name_proveedor  = strval($_POST['name_proveedor']);//obtenemos el nombre del proveedor seleccionado

    //Verificamos si el proveedor existe en los sugeridos
    $existe_proveedor = false;
                     
    //verificamos si existe algun registro de sugeridos para ese proveedor
    $consulta = mysqli_query($conexion, "SELECT `id_sugerido` FROM `sugerido` WHERE `estado` = 'activo' AND `nombre_provedor_sugerido` = '$name_proveedor' AND `estado` = 'activo'") or die ("Error al consultar: existencia del proveedor");
                        
    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $existe_proveedor = true;
        break;
    }
    mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario

    //Como si existe, continuamos
    if($existe_proveedor == true && $name_proveedor != 'FruVer'){
        ?>
        <br>
        <fieldset>
        <form id="form_crear_sugerido2" method="POST">
        Fecha para el próximo pedido
        <input type="date" name="fecha"/>
        <legend>Crear Pedido</legend>
            <table border="1" id="tabla_sugerido" width="100%">
                    <tr>
                        <th width="5%">Codigo</th>
                        <th>Descripción</th>
                        <th>Costo con IVA</th>
                        <th>Sugerido</th>
                        <th>Pedido</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                    <?php
                        
                        
                        //Consulta a la base de datos en la tabla sugerido
                        $consulta = mysqli_query($conexion, "SELECT `id_sugerido` FROM `sugerido` WHERE `estado` = 'activo' AND `nombre_provedor_sugerido` = '$name_proveedor' ORDER BY `id_sugerido` DESC LIMIT 1") or die ("Error al consultar: datos de productos");
                        
                        while (($fila = mysqli_fetch_array($consulta))!=NULL){
                            //Obtenemos el id del ultimo sigerido del proveedor
                            $ide_sugerido = $fila['id_sugerido'];
                            ?>
                            <input type="hidden" name="id_sugerido" value="<?php echo $ide_sugerido; ?>">
                            <?php
                            break;
                        }
                        
                        mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario


                        //traemos los productos y datos asociados a dicho proveedor
                        $consulta = mysqli_query($conexion, "SELECT detalle_sugerido.id_detalle, detalle_sugerido.id_producto2, producto.nombre_producto, detalle_sugerido.cantidad_sugerido, detalle_sugerido.inventario_sugerido, detalle_sugerido.pedido_sugerido, detalle_sugerido.precio_sugerido 
                        FROM `detalle_sugerido` 
                        INNER JOIN producto ON producto.id_producto = detalle_sugerido.`id_producto2` 
                        WHERE detalle_sugerido.id_sugerido1 = '$ide_sugerido' AND producto.estado = 'activo' AND detalle_sugerido.estado = 'activo'") or die ("Error al consultar: datos de productos en sugeridos");

                        $contador = 0;

                        $total_parcial = 0;
                        $total_final = 0;
                        while (($fila = mysqli_fetch_array($consulta))!=NULL){
                            $contador++;
                            $total_parcial = $fila['precio_sugerido']*$fila['pedido_sugerido'];
                            $total_final +=  $total_parcial;
                            ?>
                            <tr>
                                <tbody>
                                <input  name="ides_detalle[]" type="hidden" value="<?php echo $fila['id_detalle'] ?>"/>
                                <td><?php echo $contador ?></td>
                                <td><?php echo ucwords($fila['nombre_producto']) ?></td>
                                <td><span class="precio"><?php echo $fila['precio_sugerido'] ?></span></td>
                                <td><?php echo $fila['cantidad_sugerido'] ?></td>
                                <td><input  name="pedidos[]" type="text" class="puntos" value="<?php echo $fila['pedido_sugerido'] ?>"/></td>
                                <td><?php echo $total_parcial ?><td>                  
                            <?php
                        }
                        mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
                    ?>
                        <tr>
                            <td colspan="7"></td>
                        </tr>
                    <tfoot>
                        <tr>
                            <td style="background-color: #04AA6D; color: white;">Total Factura</td>
                            <td><?php echo $total_final; ?></td>
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
                    <button type="button" id="enviar2_2" class="w3-btn w3-teal" onclick="document.getElementById('respuesta2_2').style.display='block'">Guardar</button><br><br>
                </fieldset>
            </form>
            <div id="respuesta2_2"></div>
            <script>
                //<input type="date" name="fecha"/>
                $('#enviar2_2').click(function(){
                    $.ajax({
                        url:'../php/consulta2_2.php',
                        type:'POST',
                        data: $('#form_crear_sugerido2').serialize(),
                        success: function(res){
                            Swal.fire(
                            '¡Muy bien!',
                            'Guardado Exitoso',
                            'success'
                            )
                            $('#enviar2').trigger('click');
                            $('#respuesta2_2').html(res);
                        },
                        error: function(res){
                            alert("Problemas al tratar de enviar el formulario");
                        }
                    });
                });
            </script>
        <?php
        mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
    }elseif($existe_proveedor == true && $nombre_prove == 'FruVer'){
        ?>
        <br>
        <fieldset>
        <form id="form_crear_sugerido2_3" method="POST">
        <input type="hidden" name="usuario" value="<?php echo $nombre_usuario; ?>">
        <input type="hidden" name="proveedor" value="<?php echo $nombre_prove; ?>">
        <input type="hidden" name="empleado" value="<?php echo $nombre_empleado; ?>">
        Fecha para el próximo pedido
        <input type="date" name="fecha"/>
        <legend>Crear Pedido</legend>
            <table border="1" id="tabla_sugerido" width="100%">
                    <tr>
                        <th width="5%">Codigo</th>
                        <th>Descripción</th>
                        <th>Costo de Compra</th>
                        <th>Sugerido</th>
                        <th>Pedido</th>
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
                                <td class="precios"><input type="number" name="precios[]" class="precio" value="<?php echo $fila['precio_sugerido'] ?>"/></td>
                                <td><?php echo $fila['cantidad_sugerido'] ?></td>
                                <td class="pedidos"><input  name="pedidos[]" type="number" value="0" min="0" class="pedido" style="width: 100px"/></td>
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
                    <button type="button" id="enviar2_3" class="w3-btn w3-teal" onclick="document.getElementById('respuesta2_3').style.display='block'">Registrar</button><br><br>
                    <input type="reset" value="Limpiar" class="w3-btn w3-teal" onclick="document.getElementById('respuesta2_3').style.display='none'">
                </fieldset>
            </form>
            <div id="respuesta2_3"></div>
            <script>
                //<input type="date" name="fecha"/>
                $('#enviar2_3').click(function(){
                    $.ajax({
                        url:'../php/consulta2_3.php',
                        type:'POST',
                        data: $('#form_crear_sugerido2_3').serialize(),
                        success: function(res){
                            $('#respuesta2_3').html(res);
                        },
                        error: function(res){
                            alert("Problemas al tratar de enviar el formulario");
                        }
                    });
                });
            </script>
        <?php
        mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
    }

    

?>
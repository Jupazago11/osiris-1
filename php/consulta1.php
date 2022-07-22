<script type="text/javascript" src="../js/funciones.js"></script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion


    $nombre_usuario = strval($_POST['usuario']);//obtenemos el nombre del proveedor seleccionado
    $nombre_prove = strval($_POST['nombre']); //obtenemos el nombre del proveedor seleccionado

    date_default_timezone_set('America/Bogota');
    $fecha = date('Y-m-d', time());

    //Verificamos si el proveedor existe
    $existe = false;


    //Consulta a la base de datos en la tabla proveedor
    $consulta = mysqli_query($conexion, "SELECT `id_sugerido` 
    FROM `sugerido` 
    WHERE `fecha_sugerido` = '$fecha' AND `nombre_provedor_sugerido` = '$nombre_prove'") or die ("Error al consultar: existencia del proveedor");
                        
    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $id_sugerido = $fila['id_sugerido'];
        $existe = true;
    }
    mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario

    $total_factura = 0;
    $total_parcial = 0;
    if($existe == false){
        ?>
        <br>
        
        <fieldset>
        <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('respuesta1').style.display='none'">X</a>
        <form id="form_crear_sugerido" method="POST">
        <input type="hidden" name="usuario" value="<?php echo $nombre_usuario; ?>">
        <input type="hidden" name="proveedor" value="<?php echo $nombre_prove; ?>">
        <input type="hidden" name="fecha_creacion" value="<?php echo $fecha; ?>">
        <legend>Crear Sugerido</legend>
            <table border="1" id="tabla_sugerido" width="100%">
                <tr>
                    <th width="5%">Codigo</th>
                    <th>Descripción</th>
                    <th>Costo con IVA</th>
                    <th>Toma Física</th>
                    <th>Sugerido</th>
                    <th>Total</th>
                    <th></th>
                </tr>
                <?php
                    
                    
                    //Consulta a la base de datos en la tabla producto
                    $consulta = mysqli_query($conexion, "SELECT `id_producto`, `nombre_producto`, `precio_de_compra` FROM `producto` INNER JOIN `proveedor` ON producto.id_proveedor1 = proveedor.id_proveedor WHERE producto.estado = 'activo' AND proveedor.nombre_proveedor = '$nombre_prove' ORDER BY `id_producto` ASC") or die ("Error al consultar: ver datos generar sugerido");
                    
                    $contador=0;
                    while (($fila = mysqli_fetch_array($consulta))!=NULL){
                        $contador++;
                        ?>
                        <tr>
                            <tbody>
                            <td><input type="text" name="ides[]" size="5" readonly class="sin_borde"value="<?php echo $fila['id_producto'] ?>"/></td>
                            <td><?php echo ucwords($fila['nombre_producto']) ?></td>
                            <td class="precios"><span class="precio"><?php echo $fila['precio_de_compra'] ?></span></td>
                            <td><input type="number" value="0" min="0" name="existencias[]" style="width: 100px"/></td>
                            <td class="cantidades"><input  name="sugeridos[]" type="number" value="0" min="0" class="cantidad" style="width: 100px"/></td>
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
                <button type="button" id="enviar1_1" class="w3-btn w3-teal" onclick="document.getElementById('respuesta1_1').style.display='block'">Registrar</button><br><br>
                <input type="reset" value="Limpiar" class="w3-btn w3-teal" onclick="document.getElementById('respuesta1_1').style.display='none'">
            </fieldset>
        </form>
        <div id="respuesta1_1">

                

            </div>

            <script>
                //<input type="date" name="fecha"/>
                $('#enviar1_1').click(function(){
                    $.ajax({
                        url:'../php/consulta1_1.php',
                        type:'POST',
                        data: $('#form_crear_sugerido').serialize(),
                        success: function(res){
                            $('#respuesta1_1').html(res);
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
        //Si ya existe un registro para ese día
        ?>
        <br>
        
        <fieldset>
        <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('respuesta1').style.display='none'">X</a>
        <form id="form_crear_sugerido_2" method="POST">
        <input type="hidden" name="usuario" value="<?php echo $nombre_usuario; ?>">
        <input type="hidden" name="proveedor" value="<?php echo $nombre_prove; ?>">
        <input type="hidden" name="fecha_creacion" value="<?php echo $fecha; ?>">
        <legend>Crear Sugerido</legend>
            <table border="1" id="tabla_sugerido" width="100%">
                <tr>
                    <th width="5%">Codigo</th>
                    <th>Descripción</th>
                    <th>Costo con IVA</th>
                    <th>Toma Física</th>
                    <th>Sugerido</th>
                    <th>Total</th>
                    <th></th>
                </tr>
                <?php
                //Consulta a la base de datos en la tabla producto
                $consulta = mysqli_query($conexion, "SELECT producto.id_producto, producto.nombre_producto, producto.precio_de_compra, detalle_sugerido.inventario_sugerido, detalle_sugerido.cantidad_sugerido
                FROM `detalle_sugerido` 
                INNER JOIN `producto` ON producto.id_producto = detalle_sugerido.id_producto2
                INNER JOIN `sugerido` ON sugerido.id_sugerido = detalle_sugerido.id_sugerido1
                WHERE sugerido.id_sugerido = '$id_sugerido';") or die ("Error al consultar: ver datos generar sugerido");
                    
                $contador=0;
                while (($fila = mysqli_fetch_array($consulta))!=NULL){
                    $contador++;
                    $total_parcial = $fila['cantidad_sugerido'] * $fila['precio_de_compra'];
                    $total_factura += $total_parcial;
                    ?>
                    <tr>
                        <tbody>
                        <td><input type="text" name="ides[]" size="5" readonly class="sin_borde"value="<?php echo $fila['id_producto'] ?>"/></td>
                        <td><?php echo ucwords($fila['nombre_producto']) ?></td>
                        <td class="precios"><span class="precio"><?php echo number_format($fila['precio_de_compra'], 0, ',', '.') ?></span></td>
                        <td><input type="text" class="puntos" name="existencias[]" style="width: 100px" value="<?php echo $fila['inventario_sugerido'] ?>"/></td>
                        <td class="cantidades"><input  name="sugeridos[]" type="text" class="cantidad" style="width: 100px" value="<?php echo $fila['cantidad_sugerido'] ?>" class="puntos"/></td>
                        <td><?php echo number_format($total_parcial, 0, ',', '.') ?><td>                  
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
                        <td class="final"><?php echo number_format($total_factura, 0, ',', '.') ?></td>
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

                <button type="button" id="enviar1_2" class="w3-btn w3-teal" onclick="document.getElementById('respuesta1_2').style.display='block'">Actualizar</button><br><br>
            </fieldset>

            <div id="respuesta1_2"></div>

            <script>
                //<input type="date" name="fecha"/>
                $('#enviar1_2').click(function(){
                    $.ajax({
                        url:'../php/consulta1_2.php',
                        type:'POST',
                        data: $('#form_crear_sugerido').serialize(),
                        success: function(res){
                            $('#respuesta1_2').html(res);
                        },
                        error: function(res){
                            alert("Problemas al tratar de enviar el formulario");
                        }
                    });
                });
            </script>

        </form>
            <?php
    }
?>
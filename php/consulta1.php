<script type="text/javascript" src="../js/funciones.js"></script>
<?php
    require("../php/conexion.php");
    $conexion = conectar();                     //Obtenemos la conexion


    $nombre_usuario = strval($_POST['usuario']);//obtenemos el nombre del proveedor seleccionado
    $nombre_prove = strval($_POST['nombre']); //obtenemos el nombre del proveedor seleccionado

    date_default_timezone_set('America/Bogota');
    $fecha = date('Y-m-d', time());

    //Verificamos si el proveedor existe
    $existe = false;

    //Consulta a la base de datos en la tabla proveedor
    $consulta = mysqli_query($conexion, "SELECT `id_proveedor` 
    FROM `proveedor` 
    WHERE `nombre_proveedor` = '$nombre_prove' AND `estado` = 'activo'") or die ("Error al consultar: existencia del proveedor");
                        
    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $id_prove = $fila['id_proveedor'];
    }
    mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario

    //Consulta a la base de datos en la tabla proveedor
    $consulta = mysqli_query($conexion, "SELECT `id_sugerido` 
    FROM `sugerido` 
    WHERE `nombre_provedor_sugerido` = '$nombre_prove' AND `estado` = 'activo'
    ORDER BY `id_sugerido` DESC LIMIT 1") or die ("Error al consultar: existencia del proveedor");
                        
    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $id_sugerido = $fila['id_sugerido'];
        $existe = true;
    }
    mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario

    $total_factura = 0;
    $total_parcial = 0;

    if($existe == false){
        //Consulta a la base de datos para obtener el ide del usuario activo
        $consulta = mysqli_query($conexion, "SELECT `id_pers` FROM `personal` WHERE `user_pers`='$nombre_usuario'") or die ("Error al consultar: no se obtuvo la identificacion del usuario");

        while (($fila = mysqli_fetch_array($consulta))!=NULL) {
            $id_persona = $fila['id_pers'];
        }
        mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario

        
        //Crearemos un sugerido
        $consulta = mysqli_query($conexion, "INSERT INTO `sugerido`(`id_pers2`, `nombre_provedor_sugerido`, `fecha_sugerido`, `estado`)
        VALUES ('$id_persona', '$nombre_prove', '$fecha', 'activo')") or die ("Error al consultar: no se obtuvo la identificacion del usuario");


        //ahora lo capturamos
        $consulta = mysqli_query($conexion, "SELECT `id_sugerido` 
        FROM `sugerido`
        WHERE `nombre_provedor_sugerido` = '$nombre_prove' AND `estado` = 'activo'") or die ("Error al consultar: existencia del proveedor");
                            
        while (($fila = mysqli_fetch_array($consulta))!=NULL){
            $id_sugerido = $fila['id_sugerido'];
            $existe = true;
        }
        mysqli_free_result($consulta);

        //obtenemos los productos del proveedor
        $consulta = mysqli_query($conexion, "SELECT `id_producto`,`precio_de_compra` FROM `producto` WHERE `estado` = 'activo' AND `id_proveedor1` = '$id_prove'") or die ("Error al consultar: no se obtuvo la identificacion del usuario");

        $id     = array();
        $precio = array();
        $conta  = 0;
        while(($fila = mysqli_fetch_array($consulta))!=NULL){
            $conta++;
            array_push($id ,     $fila['id_producto']);
            array_push($precio , $fila['precio_de_compra']);
        }
        mysqli_free_result($consulta);

        for ($i=0; $i < $conta; $i++) { 
            mysqli_query($conexion, "INSERT INTO `detalle_sugerido`(`id_sugerido1`, `id_producto2`, `cantidad_sugerido`, `inventario_sugerido`,`precio_sugerido`,`estado`)  
            VALUES ('$id_sugerido','$id[$i]','0','0','$precio[$i]','activo')") or die ("Error al consultar: no se obtuvo la identificacion del usuario");
        }
        unset($id);
        unset($precio);
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    if($existe == true){
        //Si ya existe un registro para ese día

        //primero verificamos que todos los productos del proveedor se encuentren en el array
        $productos = array();

        $consulta  = mysqli_query($conexion, "SELECT `nombre_producto` 
        FROM `producto` 
        WHERE `estado` = 'activo' AND `id_proveedor1` = '$id_prove'") or die ("Error al consultar: ver datos generar sugerido");

        while (($fila = mysqli_fetch_array($consulta))!=NULL){
            array_push($productos, $fila['nombre_producto']);

        }
        mysqli_free_result($consulta);
/*
        $consulta = mysqli_query($conexion, "SELECT producto.nombre_producto
        FROM `detalle_sugerido` 
        INNER JOIN `producto` ON producto.id_producto = detalle_sugerido.id_producto2
        INNER JOIN `sugerido` ON sugerido.id_sugerido = detalle_sugerido.id_sugerido1
        WHERE sugerido.id_sugerido = '$id_sugerido';");

        $productos2 = array();
        while (($fila = mysqli_fetch_array($consulta))!=NULL){
            array_push($productos2, $fila['nombre_producto']);
        }
        mysqli_free_result($consulta);
        for ($i=0; $i < count($productos); $i++) { 
            if(in_array($productos[$i], $productos2)){
                continue;
            }else{
                $consulta = mysqli_query($conexion, "INSERT INTO `detalle_sugerido`(`id_sugerido1`, `id_producto2`, `cantidad_sugerido`, `inventario_sugerido`,`precio_sugerido`,`estado`)  
                VALUES ('$id_sugerido','$ides[$i]','0','0','$precios[$i]','activo')");
            }
        }
        unset($productos);
        unset($productos2);
        unset($ides);
        unset($precios);
        */

        $consulta = mysqli_query($conexion, "SELECT detalle_sugerido.id_detalle, producto.nombre_producto, producto.precio_de_compra, detalle_sugerido.inventario_sugerido, detalle_sugerido.cantidad_sugerido
        FROM `detalle_sugerido` 
        INNER JOIN `producto` ON producto.id_producto = detalle_sugerido.id_producto2
        INNER JOIN `sugerido` ON sugerido.id_sugerido = detalle_sugerido.id_sugerido1
        WHERE sugerido.id_sugerido = '$id_sugerido';") or die ("Error al consultar: ver datos generar sugerido");

        $contador1 = 0;
        while (($fila = mysqli_fetch_array($consulta))!=NULL){
            $contador1++;
        }

        if($contador1 <= count($productos)){

            ?>
            <br>

            <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('respuesta1').style.display='none'">X</a>
            <form id="form_crear_sugerido_2" method="POST">
            <input type="hidden" name="usuario" value="<?php echo $nombre_usuario; ?>">
            <input type="hidden" name="proveedor" value="<?php echo $nombre_prove; ?>">
            <input type="hidden" name="fecha_creacion" value="<?php echo $fecha; ?>">
            <table class="tabla_sugerido" width="100%" style="width:50%;border: 1px solid black; border-collapse: collapse;margin-left: auto;  margin-right: auto;background-color:white">
                <tr>
                    <th width="5%">#</th>
                    <th>Descripción</th>
                    <th>Costo con IVA</th>
                    <th>Toma Física</th>
                    <th>Sugerido</th>
                    <th>Total</th>
    
                </tr>
                <tbody id="tbodyform3">
                <?php
                //Consulta a la base de datos en la tabla producto
                $consulta = mysqli_query($conexion, "SELECT detalle_sugerido.id_detalle, producto.nombre_producto, producto.precio_de_compra, detalle_sugerido.inventario_sugerido, detalle_sugerido.cantidad_sugerido
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
                        
                            <input type="hidden" name="id_sugerido" value="<?php echo $id_sugerido ?>"/>
                            <input type="hidden" name="ides[]" value="<?php echo $fila['id_detalle'] ?>"/>
                        <td><?php echo $contador ?></td>
                        <td><?php echo ucwords($fila['nombre_producto']) ?></td>
                        <td><?php echo number_format($fila['precio_de_compra'], 0, ',', '.') ?></td>
                        <td class="precios4_2" style="display:none"><?php echo $fila['precio_de_compra'] ?></td>
                        <td><input type="text" name="existencias[]" size="5" value="<?php echo $fila['inventario_sugerido'] ?>"/></td>
                        <td><input name="sugeridos[]" size="5" type="text" class="cantidad" onchange="multi4()" value="<?php echo $fila['cantidad_sugerido'] ?>"/></td>
                        <td class="total4"><?php echo number_format($total_parcial, 0, ',', '.') ?></td>     
                        <td class="total4_2" style="display:none"><?php echo $total_parcial ?></td>   

                    </tr>           
                    <?php
                }
                mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
    
                ?>
                </tbody>
                    <tr>
                        <td colspan="7"></td>
                    </tr>
                <tfoot>
                    <tr>
                        <td style="background-color: #04AA6D; color: white;" colspan="4">Total Factura</td>
                        <td><span id="total4_2"><?php echo number_format($total_factura, 0, ',', '.') ?></span></td>
                        <td><button type="button" id="enviar1_2" onclick="document.getElementById('respuesta1_2').style.display='block'"><img src="../iconos/guardar.png" width="30%" height="30%"></button></td>
                    </tr>
                </tfoot>
                
                </table>
    
    
                <div id="respuesta1_2"></div>
    
                <script>
                    //<input type="date" name="fecha"/>
                    $('#enviar1_2').click(function(){
                        $.ajax({
                            url:'../php/consulta1_2.php',
                            type:'POST',
                            data: $('#form_crear_sugerido_2').serialize(),
                            success: function(res){
                                Swal.fire(
                                '¡Muy bien!',
                                'Guardado Exitoso',
                                'success'
                                )
                                $('#enviar1').trigger('click');
                            },
                            error: function(res){
                                alert("Problemas al tratar de enviar el formulario");
                            }
                        });
                    });
                    
                </script>
    
            </form>
                <?php



        }else{
            ?>
            <script>
                document.getElementById('respuesta1').style.display='none';
                    
            </script>
            <?php
        }      
    }
?>
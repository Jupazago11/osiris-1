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
    WHERE `fecha_sugerido` = '$fecha' AND `nombre_provedor_sugerido` = '$nombre_prove' AND `estado` = 'activo'") or die ("Error al consultar: existencia del proveedor");
                        
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
        WHERE `fecha_sugerido` = '$fecha' AND `nombre_provedor_sugerido` = '$nombre_prove' AND `estado` = 'activo'") or die ("Error al consultar: existencia del proveedor");
                            
        while (($fila = mysqli_fetch_array($consulta))!=NULL){
            $id_sugerido = $fila['id_sugerido'];
            $existe = true;
        }
        mysqli_free_result($consulta);

        //obtenemos los productos del proveedor
        $consulta = mysqli_query($conexion, "SELECT `id_producto`,`precio_de_compra` FROM `producto` WHERE `estado` = 'activo' AND `id_proveedor1` = '$id_prove'") or die ("Error al consultar: no se obtuvo la identificacion del usuario");

        
        while(($fila = mysqli_fetch_array($consulta))!=NULL){
            $id = $fila['id_producto'];
            $precio = $fila['precio_de_compra'];

            mysqli_query($conexion, "INSERT INTO `detalle_sugerido`(`id_sugerido1`, `id_producto2`, `cantidad_sugerido`, `inventario_sugerido`,`precio_sugerido`,`estado`)  
            VALUES ('$id_sugerido','$id','0','0','$precio','activo')") or die ("Error al consultar: no se obtuvo la identificacion del usuario");
        }
        mysqli_free_result($consulta);

        echo "<script>$('#enviar1').trigger('click');</script>";
        mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    }else{
        //Si ya existe un registro para ese día

        //primero verificamos que todos los productos del proveedor se encuentren en el array
        $productos = array();
        $ides = array();
        $precios = array();
        $consulta = mysqli_query($conexion, "SELECT `nombre_producto`, `id_producto`, `precio_de_compra` 
        FROM `producto` 
        WHERE `estado` = 'activo' AND `id_proveedor1` = '$id_prove'") or die ("Error al consultar: ver datos generar sugerido");

        while (($fila = mysqli_fetch_array($consulta))!=NULL){
            array_push($productos, $fila['nombre_producto']);
            array_push($ides, $fila['id_producto']);
            array_push($precios, $fila['precio_de_compra']);
        }
        mysqli_free_result($consulta);

        $productos2 = array();
        $consulta = mysqli_query($conexion, "SELECT producto.nombre_producto
        FROM `detalle_sugerido` 
        INNER JOIN `producto` ON producto.id_producto = detalle_sugerido.id_producto2
        INNER JOIN `sugerido` ON sugerido.id_sugerido = detalle_sugerido.id_sugerido1
        WHERE sugerido.id_sugerido = '$id_sugerido';");

        while (($fila = mysqli_fetch_array($consulta))!=NULL){
            array_push($productos2, $fila['nombre_producto']);
        }
        mysqli_free_result($consulta);

        for ($i=0; $i < count($productos); $i++){ 

            if(in_array($productos[$i], $productos2) == false){
                $consulta = mysqli_query($conexion, "INSERT INTO `detalle_sugerido`(`id_sugerido1`, `id_producto2`, `cantidad_sugerido`, `inventario_sugerido`,`precio_sugerido`,`estado`)  
                VALUES ('$id_sugerido','$ides[$i]','0','0','$precios[$i]','activo')");
            }
        }
        ?>
        <br>

        <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('respuesta1').style.display='none'">X</a>
        <form id="form_crear_sugerido_p" method="POST">
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
                    <th><a class="w3-bar-item w3-button w3-hover-red active" onclick="document.getElementById('respuesta7_6').style.display='none'">X</a></th>
                </tr>
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
                        <tbody>
                            <input type="hidden" name="id_sugerido" value="<?php echo $id_sugerido ?>"/>
                            <input type="hidden" name="ides[]" value="<?php echo $fila['id_detalle'] ?>"/>
                        <td><?php echo $contador ?></td>
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
                        <td style="background-color: #04AA6D; color: white;" colspan="2">Total Factura</td>
                        <td><?php echo number_format($total_factura, 0, ',', '.') ?></td>
                        <td><button type="button" id="enviar7_7" class="w3-btn w3-teal" onclick="document.getElementById('respuesta7_7').style.display='block'">Guardar</button></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tfoot>
                </tbody>
                </table>


            <div id="respuesta7_7"></div>

            <script>
                $('#enviar7_7').click(function(){
                    $.ajax({
                        url:'../php/consulta7_7.php',
                        type:'POST',
                        data: $('#form_crear_sugerido_p').serialize(),
                        success: function(res){
                            Swal.fire(
                            '¡Muy bien!',
                            'Guardado Exitoso',
                            'success'
                            );
                            $('#enviar7_6').trigger('click');
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
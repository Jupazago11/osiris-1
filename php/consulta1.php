<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();
    mysqli_set_charset($conexion,"uft8");

    $nombre_usuario = strval($_POST['usuario']); //obtenemos el nombre del proveedor seleccionado
    $nombre_prove = strval($_POST['provedor']); //obtenemos el nombre del proveedor seleccionado
    $fecha = date('Y-m-d', time());
    ?>
    <br>
    <fieldset>
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
                </tr>
                <?php
                    if(existencia_de_la_conexion()){
                        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
                    }
                    $conexion = conectar();                     //Obtenemos la conexion
                    
                    //Consulta a la base de datos en la tabla producto
                    $consulta = mysqli_query($conexion, "SELECT `id_producto`, `nombre_producto`, `precio_producto`, `existencias` FROM `producto` INNER JOIN `proveedor` ON producto.id_proveedor1 = proveedor.id_proveedor WHERE producto.estado = 'activo' AND proveedor.nombre_proveedor = '$nombre_prove' ORDER BY `id_producto` ASC") or die ("Error al consultar: ver datos generar sugerido");
                    
                    $contador=0;
                    while (($fila = mysqli_fetch_array($consulta))!=NULL){
                        $contador++;
                        ?>
                        <tr>
                            <tbody id="tbodyform">
                            <td><input type="text" name="ides[]" size="5" readonly class="sin_borde"value="<?php echo $fila['id_producto'] ?>"/></td>
                            <td><?php echo ucwords($fila['nombre_producto']) ?></td>
                            <td class="precios"><?php echo $fila['precio_producto'] ?></td>
                            <td><input type="number" value="0" min="0" name="existencias[]" style="width: 100px"/></td>
                            <td><input type="number" value="0" min="0" name="sugeridos[]" style="width: 100px" class="sugeridos"/></td>                  
                         <?php
                    }
                    mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
                ?>
                    <tr>
                        <td colspan="5"></td>
                    </tr>
                <tfoot>
                    <tr>
                        <td style="background-color: #04AA6D; color: white;">Cantidad</td>
                        <td><?php echo $contador; ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="background-color: #04AA6D; color: white;">Total Factura</td>
                        <td class="final"><p id="factura_total"></p></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tfoot>
                </tbody>
                </table>
                <br><br>
                <input type="date" name="fecha"/>

                <br><br>
                <button type="button" id="enviar1_1" class="w3-btn w3-teal" onclick="document.getElementById('respuesta1_1').style.display='block'">Registrar</button><br><br>
                <input type="reset" value="Limpiar" class="w3-btn w3-teal" onclick="document.getElementById('respuesta1_1').style.display='none'">
            </fieldset>
        </form>
        <div id="respuesta1_1"></div>
        <script>
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

?>
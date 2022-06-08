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
    <legend>Crear Sugerido</legend>
        <table border="0" id="tabla_sugerido" width="100%">
                <tr align="left">
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Existencias</th>
                    <th>Sugerido</th>
                </tr>
                <?php
                    if(existencia_de_la_conexion()){
                        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
                    }
                    $conexion = conectar();                     //Obtenemos la conexion
                    
                    //Consulta a la base de datos en la tabla provvedor
                    $consulta = mysqli_query($conexion, "SELECT `id_producto`, `nombre_producto`, `precio_producto`, `existencias` FROM `producto` INNER JOIN `proveedor` ON producto.id_proveedor1 = proveedor.id_proveedor WHERE producto.estado = 'activo' AND proveedor.nombre_proveedor = '$nombre_prove' ORDER BY `id_producto` ASC") or die ("Error al consultar: ver datos generar sugerido");

                    while (($fila = mysqli_fetch_array($consulta))!=NULL){
                        ?>
                        <tr>
                            <tbody id="tbodyform">
                            <td><?php echo $fila['id_producto'] ?></td>
                            <td><?php echo ucwords($fila['nombre_producto']) ?></td>
                            <td><?php echo $fila['precio_producto'] ?></td>
                            <td><?php echo $fila['existencias'] ?></td>
                            <td><input type="number" value="0" min="0"/></td>                  
                         <?php
                    }
                    mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
                ?>
                    </tbody>
                    </table>
                    
                    <input type="date" name="f"/>
                <button type="button" id="Enviar" class="w3-btn w3-teal" onclick="document.getElementById('respuesta15').style.display='block'">Registrar</button><br><br>
                <input type="reset" value="Limpiar" class="w3-btn w3-teal" onclick="document.getElementById('respuesta15').style.display='none'">
            </fieldset>
        </form>
    <?php
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------

?>
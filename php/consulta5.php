<script type="text/javascript" src="../js/funciones.js"></script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();

    date_default_timezone_set('America/Bogota');
    $fecha = date('Y-m-d', time());

    $usuario         = strval($_POST['usuario']);//obtenemos el nombre del proveedor seleccionado
    $vehiculo        = $_POST['vehiculo'];
    $bandera         = false;

    //id del cliente
    $consulta = mysqli_query($conexion, "SELECT * FROM `vehiculo` WHERE `placa` = '$vehiculo'") or die ("Error al consultar: cliente");

    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        if($vehiculo == $fila['placa']){
            $bandera = true;
        }
    }
    mysqli_free_result($consulta);

    if($bandera == true){

    
        ?>
        <br>
        <form id="creacion_domicilio" method="POST">
        <input type="hidden" name="usuario" value="<?php echo $usuario; ?>">
        <input type="hidden" name="vehiculo" value="<?php echo $vehiculo; ?>">

        <table width="100%" border="1">
            <tr>
                <th>Cliente</th>
                <th>Ubicacion</th>
                <th>Destino</th>
                <th>Categoría</th>
                <th>Observación</th>
                <th>Opción</th>
            </tr>
            <tr>
                <td><input list="clientes" name="cliente" id="cliente"  required>
                <datalist id="clientes" onchange="traer_ubicacion()" required>
                <?php
                    //Consulta a la base de datos en la tabla para desplegar los clientes
                    $consulta = mysqli_query($conexion, "SELECT * FROM `cliente` WHERE `estado` = 'activo'");

                    while (($fila = mysqli_fetch_array($consulta))!=NULL){
                        // traemos los proveedores existentes en la base de datos
                        ?>
                        <option value="<?php echo $fila['nombre_cliente'] ?>">
                        <?php
                        

                    }
                    mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
                ?>
                </datalist></td>
                <td><input list="ubicaciones" name="ubicacion" id="ubicacion"  required>
                <datalist id="ubicaciones" onchange="traer_ubicacion()" required>
                <?php
                    
                    //Consulta a la base de datos en la tabla para desplegar los clientes
                    $consulta = mysqli_query($conexion, "SELECT * FROM `ubicacion` WHERE `estado` = 'activo'");

                    while (($fila = mysqli_fetch_array($consulta))!=NULL){
                        // traemos los proveedores existentes en la base de datos
                        ?>
                        <option value="<?php echo $fila['ubicacion'] ?>">
                        <?php
                        

                    }
                    mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
                ?>
                </datalist></td>


                <td><input type="text" name="destino" id="destino"  required>
                <td><input list="categorias" name="categoria" id="categoria"  required>
                <datalist id="categorias"  required>
                    <option value="normal">
                    <option value="Prioritario">
                </datalist></td>
                <td><input type="text" name="observacion"   required></td></td>
                <td><button type="button" id="enviar5_1" class="w3-btn w3-red" onclick="document.getElementById('respuesta5_1').style.display='block'">Agregar</button></td>
            </tr>
        </table>
        </form>
        
        <div id="respuesta5_1"></div>
            <script>
                $('#enviar5_1').click(function(){
                    $.ajax({
                        url:'../php/consulta5_1.php',
                        type:'POST',
                        data: $('#creacion_domicilio').serialize(),
                        success: function(res){
                            $('#respuesta5_1').html(res);
                        },
                        error: function(res){
                            alert("Problemas al tratar de enviar el formulario");
                        }
                    });
                });
            </script>
            </div>
    <?PHP


        //mysqli_free_result($consulta);
        ?>
            </table>
        <?PHP
        mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
    }else{
        ?>
        <br>
        <div class="alert warning">
            <span class="closebtn">&times;</span>  
            <strong>Información!</strong> No se encontró el Vehículo en la base de datos
        </div>
        <?php
    }
?>
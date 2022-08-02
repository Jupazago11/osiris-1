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
    $bandera         = array(false, false, false);

    //id del cliente
    $consulta = mysqli_query($conexion, "SELECT * FROM `vehiculo` 
    WHERE `placa` = '$vehiculo'") or die ("Error al consultar: cliente");

    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        if($vehiculo == $fila['placa']){
            $bandera[0] = true;
        }
    }
    mysqli_free_result($consulta);

    //Ahora consultaremos si el vehiculo ya tiene registrado el valore del kilometraje para ese día
    $consulta = mysqli_query($conexion, "SELECT `fecha` FROM `kilometraje`
    INNER JOIN vehiculo ON vehiculo.id_vehiculo = kilometraje.id_vehiculo3
    WHERE vehiculo.placa = '$vehiculo' AND `fecha`='$fecha'") or die ("Error al consultar: cliente");

    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $bandera[1] = true;
    }
    mysqli_free_result($consulta);

    if($bandera[0] == true && $bandera[1] == false){

        ?>
        <form id="ingresa_kilometraje" method="POST">
            Ingresa el kilometraje del vehículo
            <input type="text" name="vehiculo" value="<?php echo $vehiculo; ?>"/>
            <input type="text" name="kilometraje"/>
            <button type="button" id="enviard1_3" class="w3-btn w3-red" onclick="document.getElementById('respuesta5_1').style.display='block'">Continuar</button>
        </form>


        <?php
    }elseif($bandera[0] == true && $bandera[1] == true){
        $bandera[2] = true;
    }

    if($bandera[2] == true){

    
        ?>
        <br>
        <div class="container">
        <form id="creacion_domicilio" method="POST">
        <input type="hidden" name="usuario" value="<?php echo $usuario; ?>">
        <input type="hidden" name="vehiculo" value="<?php echo $vehiculo; ?>">
            <div class="row">
            <div class="col-25">
                <label for="fname">Cliente</label>
            </div>
            <div class="col-75">
                <input list="clientes" name="cliente" id="cliente"  required>
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
                </datalist>
            </div>
            </div>
            <div class="row">
            <div class="col-25">
                <label for="lname">Ubicación</label>
            </div>
            <div class="col-75">
                <input list="ubicaciones" name="ubicacion" id="ubicacion"  required>
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
                </datalist>
            </div>
            </div>
            <div class="row">
            <div class="col-25">
                <label for="country">Destino</label>
            </div>
            <div class="col-75">
                <input type="text" name="destino" id="destino"  required>
            </div>
            </div>
            <div class="row">
            <div class="col-25">
                <label for="country">Categoría</label>
            </div>
            <div class="col-75">
                <input list="categorias" name="categoria" id="categoria"  required>
                <datalist id="categorias"  required>
                    <option value="normal">
                    <option value="Prioritario">
                </datalist>
            </div>
            </div>
            <div class="row">
            <div class="col-25">
                <label for="country">Observación</label>
            </div>
            <div class="col-75">
                <input type="text" name="observacion"   required>
            </div>
            </div>
            <br>
            <br>
            <div class="row">
            <button type="button" id="enviar5_1" class="w3-btn w3-red" onclick="document.getElementById('respuesta5_1').style.display='block'">Agregar</button>
            </div>
            <br>
        </form>
        </div>
        
        <div id="respuesta5_1">
            Hola
        </div>
            <script>
                $('#enviar5_1').click(function(){
                    $.ajax({
                        url:'../php/consulta5_1.php',
                        type:'POST',
                        data: $('#creacion_domicilio').serialize(),
                        success: function(res){
                            $('#respuesta5_1').html(res);
                            //$('#enviar5').trigger('click');
                        },
                        error: function(res){
                            alert("Problemas al tratar de enviar el formulario");
                        }
                    });
                });

                $('#enviard1_3').click(function(){
                    $.ajax({
                        url:'../PHP/consultad1_2.php',
                        type:'POST',
                        data: $('#ingresa_kilometraje').serialize(),
                        success: function(res){
                            alert("xd");
                            $('#respuesta5_1').html(res);
                        },
                        error: function(res){
                            alert("Problemas al mostrar cuadre de caja");
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
    }
?>
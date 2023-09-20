<script type="text/javascript" src="../js/funciones.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>$.ajaxPrefilter(function( options, originalOptions, jqXHR ) {    options.async = true; });</script>
<?php
    require("../php/conexion.php");
    $conexion = conectar();

    date_default_timezone_set('America/Bogota');
    $fecha = date('Y-m-d', time());
    $hoy = date("H:i");

    //date('h:i'); //Fecha justo ahora


    //$vehiculo        = $_POST['vehiculo'];


    //Obtendremos la catnidad de registros existentes
    $consulta = mysqli_query($conexion, "SELECT COUNT(*) AS total
    FROM `domicilio`
    INNER JOIN vehiculo ON domicilio.id_vehiculo2 = vehiculo.id_vehiculo

    AND `fecha` = '$fecha'") or die ("Error al consultar: domicilios");

    $row = mysqli_fetch_array($consulta);
    $cantidad = $row['total'];
    //echo $cantidad;

    //Obtendremos los empleados que sean domiciliarios
    //tipo de acceso 4 es Domiciliario
    $id_domi        = array();
    $nombre_domi    = array();

    $consulta = mysqli_query($conexion, "SELECT `id_pers`,`nombre_pers` 
    FROM `personal` 
    WHERE `tipo_usuario_pers`= 4 
    ORDER BY `id_pers` ASC;") or die ("Error al consultar: domicilios");

    while (($fila = mysqli_fetch_array($consulta)) != NULL){
        array_push($id_domi, $fila['id_pers']);
        array_push($nombre_domi, $fila['nombre_pers']);
    }
    mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario

    //Obtendremos las placas de las motos
    //tipo de acceso 4 es Domiciliario
    $id_placa       = array();
    $nombre_placa    = array();

    $consulta = mysqli_query($conexion, "SELECT `id_vehiculo`,`placa` 
    FROM `vehiculo` 
    ORDER BY `id_vehiculo` ASC;") or die ("Error al consultar: vahiculo");

    while (($fila = mysqli_fetch_array($consulta)) != NULL){
        array_push($id_placa, $fila['id_vehiculo']);
        array_push($nombre_placa, $fila['placa']);
    }
    mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario


    if($cantidad > 0){
        $consulta = mysqli_query($conexion, "SELECT personal.user_pers,cliente.nombre_cliente, domicilio.observacion, domicilio.nivel_urgencia, domicilio.ubicacion, domicilio.destino, domicilio.estado, domicilio.tiempo_salida, domicilio.tiempo_llegada, domicilio.id_domi, domicilio.id_domiciliario, vehiculo.placa
        FROM `domicilio` 
        INNER JOIN `personal` ON domicilio.id_pers3 = personal.id_pers 
        INNER JOIN `cliente` ON domicilio.id_cliente2 = cliente.id_cliente  
        INNER JOIN `vehiculo` ON vehiculo.id_vehiculo = domicilio.id_vehiculo2 
        AND `fecha` = '$fecha'
        ORDER BY `id_domi` ASC") or die ("Error al consultar: domicilios");
        ?>
        <p id="reloj"></p>
        <form id="configuracion" method="POST">
        <table class="tabla_sugerido" style="width:800px;border: 1px solid black; border-collapse: collapse;margin-left: auto;  margin-right: auto;background-color:white">
        <tr>
            <th>#</th>
            <th>Personal</th>
            <th>Vehículo</th>
            <th>Domiciliario</th>
            <th colspan="3">Cliente</th>
            <th>Destino</th>
            <th>Salida</th>
            <th>LLegada</th>
            <th></th>
        </tr>
        <tbody id="tbodyform">
        
            <?php
            $contador = 1;
            
            //<span class="numeral"><?php echo $contador ? ></span>
            //<input type="number" class="numeral" value="<?php echo $contador ? >"></input>
            while (($fila = mysqli_fetch_array($consulta)) != NULL){
                ?>
                <tr>
                
                    <td><span class="numeral"><?php echo $contador ?></span></td> 
                    <td><?php echo $fila['user_pers']; ?></td>
                    <td><select onchange="$('#enviar5_8').trigger('click')" name="name_vehiculo_ver[]" id="name_vehiculo_ver">
                        <?php
                        for($i=0; $i<count($nombre_domi); $i++){
                            ?>
                            <option value="<?php echo $id_placa[$i]; ?>" <?php if($nombre_placa[$i] == $fila['placa']){ echo "selected";} ?>><?php echo $nombre_placa[$i]; ?></option>
                            <?php
                        }


                        ?>
                    </select>
                </td>
                    <td><select onchange="$('#enviar5_7').trigger('click')" name="name_domiciliario_ver[]" id="name_domiciliario_ver">
                        <?php
                        for($i=0; $i<count($nombre_domi); $i++){
                            ?>
                            <option value="<?php echo $id_domi[$i]; ?>" <?php if($id_domi[$i] == $fila['id_domiciliario']){ echo "selected";} ?>><?php echo $nombre_domi[$i]; ?></option>
                            <?php
                        }


                        ?>
                    </select></td>
                    


                    <td><?php echo $fila['nombre_cliente']; ?></td>
                    <td><div class="tooltip"><i class='fa fa-search' style='font-size:36px'></i>
                    <span class="tooltiptext"><?php echo $fila['observacion']; ?></span></div></td>
                    <?php
                    if($fila['nivel_urgencia'] == "Prioritario"){
                        ?>
                        <td><i class='fa fa-exclamation' style='font-size:36px;color:red'></i></td>
                        <?php
                    }else{
                        ?>
                        <td></td>
                        <?php
                    }
                    ?>
                    <td><?php echo $fila['ubicacion'].": ".$fila['destino']; ?></td>
                    <?php
                    if($fila['tiempo_salida'] == NULL){
                        ?>
                        <td>
                        <label class="switch">
                        <input type="checkbox" name="salidass[]" onclick="enviar_update()" value="<?php echo $fila['id_domi'] ?>">
                        <span class="slider"></span>
                        </label></td>
                        <?php
                    }else{
                        ?>
                        <td>
                        <label class="switch">
                        <input type="checkbox" checked disabled>
                        <span class="slider"></span>
                        </label>
                        <br>
                        <?php echo date("g:i:s a", strtotime($fila['tiempo_salida'])) ?>
                        </td>
                        <?php
                    }
                    ?>
                    <?php
                    if($fila['tiempo_llegada'] == NULL){
                        ?>
                        <td>
                        <label class="switch">
                        <input type="checkbox" name="llegadass[]" onclick="enviar_update2()" value="<?php echo $fila['id_domi'] ?>">
                        <span class="slider"></span>
                        </label></td>
                        <?php
                    }else{
                        ?>
                        <td>
                        <label class="switch">
                        <input type="checkbox" checked disabled>
                        <span class="slider"></span>
                        </label>
                        <br>
                        <?php echo date("g:i:s a", strtotime($fila['tiempo_llegada'])) ?></td>
                        <?php
                    }
                    ?>

                    <?php
                    if($fila['estado'] == "activo"){
                        ?>
                        <td><i class='fa fa-hourglass-half' style='font-size:36px;color:red'></i></td>
                        <?php
                    }elseif($fila['estado'] == "inactivo"){
                        ?>
                        <td><i class='fa fa-check' style='font-size:36px;color:green'></i>
                        <br>
                        <?php
                            $fecha1  = new DateTime($fila['tiempo_salida']);
                            $fecha2  = new DateTime($fila['tiempo_llegada']);
                            $intvl   = $fecha1->diff($fecha2);

                            if($intvl->h > 0){
                                echo $intvl->h." horas y ".$intvl->i." minutos";
                            }else{
                                echo "Minutos: ".$intvl->i;
                            }

                        ?>
                        </td>
                        <?php
                    }else{
                        ?>
                        <td><i class='fa fa-motorcycle' style='font-size:36px;color:blue'></td>
                        <?php
                    }
                    ?>

                </tr>
                
            <?php
            $contador++;
        }
        ?>
        
        </tbody>
        <?php
        mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
        ?>
        </table>
        <button type="button" id="enviar5_3" class="w3-btn w3-teal" style="visibility:hidden;"></button>
        <button type="button" id="enviar5_4" class="w3-btn w3-teal" style="visibility:hidden;"></button>
        <button type="button" id="enviar5_7" class="w3-btn w3-teal" style="visibility:hidden;"></button>
        <button type="button" id="enviar5_8" class="w3-btn w3-teal" style="visibility:hidden;"></button>
        </form>
        <div id="respuesta5_4"></div>
        <script>
            //Salida
            $('#enviar5_3').click(function(){
                $.ajax({
                    url:'../php/consulta5_3.php',
                    type:'POST',
                    data: $('#configuracion').serialize(),
                    success: function(res){
                        setTimeout(function(){ 
                            $('#enviar5_6').trigger('click');
                        }, 1000);
                    },
                    error: function(res){
                        alert("Problemas al tratar de enviar el formulario");
                    }
                });
            });
            //Llegada
            $('#enviar5_4').click(function(){
                $.ajax({
                    url:'../php/consulta5_4.php',
                    type:'POST',
                    data: $('#configuracion').serialize(),
                    success: function(res){
                        $('#respuesta5_4').html(res);
                        setTimeout(function(){ 

                            $('#enviar5_6').trigger('click');
                        }, 1000);
                    },
                    error: function(res){
                        alert("Problemas al tratar de enviar el formulario");
                    }
                });
            });

            //update domiciliario

            $('#enviar5_7').click(function(){
                $.ajax({
                    url:'../php/consulta5_7.php',
                    type:'POST',
                    data: $('#configuracion').serialize(),
                    success: function(res){
                        //$('#respuesta5_4').html(res);
                        $('#enviar5_6').trigger('click');
                    },
                    error: function(res){
                        alert("Problemas al tratar de enviar el formulario");
                    }
                });
            });
            //update vehiculo

            $('#enviar5_8').click(function(){
                $.ajax({
                    url:'../php/consulta5_8.php',
                    type:'POST',
                    data: $('#configuracion').serialize(),
                    success: function(res){
                        //$('#respuesta5_4').html(res);
                        $('#enviar5_6').trigger('click');
                    },
                    error: function(res){
                        alert("Problemas al tratar de enviar el formulario");
                    }
                });
            });
        </script>

        <?php
    }else{
        ?>
        <br>
        <div class="alert warning">
            <span class="closebtn">&times;</span>  
            <strong>Información!</strong> No existen registros asociados el día de hoy para el vehículo
        </div>
        <?php
    }
?>
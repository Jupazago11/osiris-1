<script type="text/javascript" src="../js/funciones.js"></script>
<?php
require("../php/conexion.php");
    $conexion = conectar();                     //Obtenemos la conexion

    date_default_timezone_set('America/Bogota');
    $fecha        = date('Y-m-d', time());



    $id_vehiculo = array();
    $placa = array();

    $consulta = mysqli_query($conexion, "SELECT * FROM `vehiculo` 
    WHERE `placa` != '' AND `estado` = 'activo'") or die ("Error al consultar: existencia del cargo");

    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        array_push($id_vehiculo, $fila['id_vehiculo']);
        array_push($placa, $fila['placa']);
    }
    mysqli_free_result($consulta);


    $consulta = mysqli_query($conexion, "SELECT `id_vehiculo1`
    FROM `observacion` 
    INNER JOIN vehiculo ON vehiculo.id_vehiculo = observacion.id_vehiculo1
    WHERE vehiculo.estado = 'activo'            
    ORDER BY observacion.id_obs ASC") or die ("Error al consultar: existencia del proveedor");

    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $fila['id_vehiculo1'];
    }
    mysqli_free_result($consulta);


    ?>
    <form id="actualizar_vehiculos2" method="POST">
        <table class="tabla_sugerido">
            <tr>
                <th colspan="6" style="text-align: center;"><h3>Información Vehicular</h3></th>
            <tr>
            <tr>
                <th>#</th>
                <th>Vehiculo</th>
                <th>Obervación</th>
                <th>Costo</th>
                <th>Fecha</th>
                <th></th>
            </tr>
            <tr>
                <?php
                $contador = 0;
                $consulta = mysqli_query($conexion, "SELECT `id_vehiculo`,`id_obs`, vehiculo.placa, vehiculo.id_vehiculo, `observacion`,`costo`,`fecha` 
                FROM `observacion` 
                INNER JOIN vehiculo ON vehiculo.id_vehiculo = observacion.id_vehiculo1
                WHERE observacion.estado = 'activo' AND vehiculo.placa != '' AND vehiculo.estado = 'activo'           
                ORDER BY observacion.id_obs ASC") or die ("Error al consultar: existencia del proveedor");

                while (($fila = mysqli_fetch_array($consulta))!=NULL){
                    $contador++;
                    ?>
                    <tr>
                        <input type="hidden" name="id_obs[]" value="<?php echo $fila['id_obs'] ?>"/>
                        <td><?php echo $contador ?></td>
                        <td>
                        <select name="id_vehiculo[]">
                            <?php
                            for ($i = 0; $i < count($id_vehiculo); $i++) { 
                                if($id_vehiculo[$i] == $fila['id_vehiculo']){
                                    ?>
                                        <option value="<?php echo $id_vehiculo[$i] ?>" selected><?php echo $placa[$i] ?></option>
                                    <?php
                                }else{
                                    ?>
                                        <option value="<?php echo $id_vehiculo[$i] ?>"><?php echo $placa[$i] ?></option>
                                    <?php
                                }
                                
                            }
                            ?>
                        </select>
                    </td>
                        <td><textarea name="observacion[]" rows="2" cols="50"><?php echo $fila['observacion'] ?></textarea></td>
                        <td><input type="text" name="costo[]" value="<?php echo number_format($fila['costo'], 0, ',', '.') ?>" class="puntos"/></td>
                        <td><input type="date" name="fecha[]" value="<?php echo $fila['fecha'] ?>"/></td>
                        <?php
                        if($fila['observacion'] == '' || $fila['observacion'] == NULL){
                            ?>
                            <td><input type="radio" name="eliminar[<?php echo $contador ?>]" value="activo" style="visibility:hidden;" checked>
                            <input type="radio" name="eliminar[<?php echo $contador ?>]" value="eliminar" id="eliminar[<?php echo $contador ?>]" onchange="$('#enviar10_5').trigger('click');">
                            <label class="w3-tbn w3-red btn-eliminar" for="eliminar[<?php echo $contador ?>]"><i class='fa fa-trash-o' style='font-size:16px;color:white'></i></label><br></td> 
                            <?php
                        }else{
                            ?>
                            <td><input type="radio" name="eliminar[<?php echo $contador ?>]" value="activo" style="visibility:hidden;" checked>
                            <input type="radio" name="eliminar[<?php echo $contador ?>]" value="eliminar" id="eliminar[<?php echo $contador ?>]" style="visibility:hidden;" onchange="$('#enviar10_5').trigger('click');"></td> 
                            <?php
                        }
                        ?>
                        
                <?php
                }
                mysqli_free_result($consulta);
                ?>
            </tr>
            <tr>
                <td></td>
                <td><button type="button" id="enviar10_6" class="w3-btn" style="background-color: transparent;"><i class="fa fa-plus-circle" style="font-size:24px;color:#305490"></i></button></td>
                <td></td>
                <td></td>
                <td><img src="../iconos/guardar.png" width="60px" height="60px" id="enviar10_5" onclick="document.getElementById('respuesta10_5').style.display='block'" class="btn_guardar"></td>
                <td></td>
            </tr>
        </table>
    </form>
    <div id="respuesta10_5" style="display:none;"></div>

<script>
$('#enviar10_5').click(function(){
    $.ajax({
        url:'../php/consulta10_5.php',
        type:'POST',
        data: $('#actualizar_vehiculos2').serialize(),
        success: function(res){
            Swal.fire(
            '¡Muy bien!',
            'Guardado Exitoso',
            'success'
            )
            $('#respuesta10_5').html(res);
            $('#enviar10_2').trigger('click');
        },
        error: function(res){
            alert("Problemas al tratar de enviar el formulario");
        }
    });
});
$('#enviar10_6').click(function(){
    $.ajax({
        url:'../php/consulta10_6.php',
        type:'POST',
        data: $('#actualizar_vehiculos2').serialize(),
        success: function(res){
            //$('#respuesta10_5').html(res);
            $('#enviar10_2').trigger('click');
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
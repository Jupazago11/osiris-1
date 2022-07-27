<script type="text/javascript" src="../js/funciones.js"></script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion

    date_default_timezone_set('America/Bogota');
    $fecha        = date('Y-m-d', time());



    $id_vehiculo = array();
    $placa = array();

    $consulta = mysqli_query($conexion, "SELECT * FROM `vehiculo` WHERE `estado` != ''") or die ("Error al consultar: existencia del cargo");

    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        array_push($id_vehiculo, $fila['id_vehiculo']);
        array_push($placa, $fila['placa']);
    }




    ?>
    <form id="actualizar_vehiculos" method="POST">
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
            $consulta = mysqli_query($conexion, "SELECT `id_vehiculo`,`id_obs`, vehiculo.placa, `observacion`,`costo`,`fecha` 
            FROM `observacion` 
            INNER JOIN vehiculo ON vehiculo.id_vehiculo = observacion.id_vehiculo1
            ORDER BY vehiculo.id_vehiculo ASC") or die ("Error al consultar: existencia del proveedor");

            while (($fila = mysqli_fetch_array($consulta))!=NULL){
                $contador++;
                ?>
                <tr>
                    <input type="hidden" name="id_obs[]" value="<?php echo $fila['id_obs'] ?>"/>
                    <td><?php echo $contador ?></td>
                    <td>
                        <?php
                    if($fila['placa'] != '' ){
                        echo "<input list='placas' name='placa[]' id='placa' value='".$fila['placa']."'>";
                    }else{
                        echo "<input list='placas' name='placa[]' id='placa'>";
                    }
                    ?>
                    <datalist id="placas">
                        <?php
                        for ($i = 0; $i < count($id_vehiculo); $i++) { 
                            ?>
                            <option value="<?php echo $placa[$i] ?>"></option>

                        <?php
                        }
                        ?>
                    </datalist>
                </td>
                    <td><textarea name="observacion[]" rows="2" cols="50"><?php echo $fila['observacion'] ?></textarea></td>
                    <td><input type="text" name="costo[]" value="<?php echo $fila['costo'] ?>"/></td>
                    <td><input type="date" name="fecha[]" value="<?php echo $fila['fecha'] ?>"/></td>
                    <?php
                    if($fila['id_vehiculo'] == '' || $fila['id_vehiculo'] == NULL){
                        ?>
                        <td class="w3-btn w3-red"><input type="radio" name="eliminar[<?php echo $contador ?>]" value="activo" style="visibility:hidden;" checked>
                        <input type="radio" name="eliminar[<?php echo $contador ?>]" value="eliminar" id="eliminar[<?php echo $contador ?>]" onchange="$('#enviar10_4').trigger('click');">
                        <label for="eliminar[<?php echo $contador ?>]">X</label><br></td> 
                        <?php
                    }else{
                        ?>
                        <td><input type="radio" name="eliminar[<?php echo $contador ?>]" value="activo" style="visibility:hidden;" checked>
                        <input type="radio" name="eliminar[<?php echo $contador ?>]" value="eliminar" id="eliminar[<?php echo $contador ?>]" style="visibility:hidden;" onchange="$('#enviar10_4').trigger('click');"></td> 
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
            <td><button type="button" id="enviar10_6" class="w3-btn"><i class="fa fa-plus-circle" style="font-size:24px;color:#305490"></i></button></td>
            <td></td>
            <td></td>
            <td><button type="button" id="enviar10_5" class="w3-btn" style="background-color: #478248;color:white;" onclick="document.getElementById('respuesta10_5').style.display='block'">Guardar <i class='fas fa-edit' style='font-size:24px;color:white'></button></td>
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
        data: $('#actualizar_vehiculos').serialize(),
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
        success: function(res){
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
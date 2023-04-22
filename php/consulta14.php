<?php
require("../php/conexion.php");
$conexion = conectar();                     //Obtenemos la conexion

$usuario = $_POST['usuario'];

date_default_timezone_set('America/Bogota');
$fecha_hoy        = date('Y-m-d', time());

//Capturaremos el id del ususario

$consulta = mysqli_query($conexion, "SELECT `id_pers` 
FROM `personal` 
WHERE `user_pers` = '$usuario'") or die ("Error al consultar: proveedores");

while (($fila = mysqli_fetch_array($consulta))!=NULL){
    $id_pers = $fila['id_pers'];
}
mysqli_free_result($consulta);
    
?>
<a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('cont2_8').style.display='none';">X</a>

<form id="form_nuevo_requerimiento">
    <input type="hidden" name="id_pers" value="<?php echo $id_pers ?>">
<table class="tabla_sugerido">
    <tr>
        <th>ID</th>
        <th>Personal</th>
        <th>Requerimiento</th>
        <th>Costo</th>
        <th>Fecha</th>
        <th>Días</th>
        <th>Estado</th>
        <th></th>
    </tr>
    <?php
    $consulta = mysqli_query($conexion, "SELECT `id_reque`, personal.nombre_pers, `reque`, `costo`, requerimiento.estado, `fecha`
    FROM `requerimiento`
    INNER JOIN personal ON personal.id_pers = requerimiento.id_pers5
    WHERE requerimiento.estado != ''") or die ("Error al consultar: proveedores");

    $contador = 0;
    $total_reque = 0;
    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $contador++;
        ?>
        <tr>
                <input type="hidden" name="id_reque[]" value="<?php echo $fila['id_reque'] ?>">
            <td><?php echo $fila['id_reque'] ?></td>
            <td><?php echo $fila['nombre_pers'] ?></td>
            <td><textarea name="reque[]" rows="3" cols="60" onchange="$('#enviar14_4').trigger('click');"><?php echo $fila['reque'] ?></textarea></td>
            <td><input type="text" name="costo[]" value="<?php echo number_format($fila['costo'], 0, ',', '.') ?>" class="puntos"/></td>
            <td><input type="date" name="fecha[]" value="<?php echo $fila['fecha'] ?>"/></td>
            
            <?php
            $fecha1  = new DateTime($fila['fecha']);
            $fecha2  = new DateTime($fecha_hoy);
            
            $intvl   = $fecha1->diff($fecha2);

            

            echo "<td style='text-align: center;'>".$intvl->days."</td>";


            ?>
            
            <td>
            
            <?php
            $total_reque += $fila['costo'];

            if($fila['estado'] == 'activo'){
                ?>
                <input type="radio" name="estado[<?php echo $contador ?>]" value="activo" checked> Activo<br>
                <input type="radio" name="estado[<?php echo $contador ?>]" value="proceso"> Proceso<br>
                <input type="radio" name="estado[<?php echo $contador ?>]" value="finalizado"> Finalizado
                <?php
            }elseif($fila['estado'] == 'proceso'){
                ?>
                <input type="radio" name="estado[<?php echo $contador ?>]" value="activo"> Activo<br>
                <input type="radio" name="estado[<?php echo $contador ?>]" value="proceso" checked> Proceso<br>
                <input type="radio" name="estado[<?php echo $contador ?>]" value="finalizado"> Finalizado
                <?php
            }elseif($fila['estado'] == 'finalizado'){
                ?>
                <input type="radio" name="estado[<?php echo $contador ?>]" value="activo"> Activo<br>
                <input type="radio" name="estado[<?php echo $contador ?>]" value="proceso"> Proceso<br>
                <input type="radio" name="estado[<?php echo $contador ?>]" value="finalizado" checked> Finalizado
                <?php
            }
            ?>
            </td>
            <?php
            //Eliminar
            if($fila['reque'] == '' || $fila['reque'] == NULL){
                ?>
                <td><input type="radio" name="eliminar[<?php echo $contador ?>]" value="activo" style="visibility:hidden;" checked>
                <input type="radio" name="eliminar[<?php echo $contador ?>]" value="eliminar" id="eliminarreque[<?php echo $contador ?>]" onchange="$('#enviar14_3').trigger('click');" style="visibility:hidden;">
                <label class="w3-tbn w3-red btn-eliminar" for="eliminarreque[<?php echo $contador ?>]"><i class='far fa-trash-alt' style='font-size:16px;color:white'></i></label><br></td>
                <?php
            }else{
                ?>
                <td><input type="radio" name="eliminar[<?php echo $contador ?>]" value="activo" style="visibility:hidden;" checked>
                <input type="radio" name="eliminar[<?php echo $contador ?>]" value="eliminar" id="eliminarreque[<?php echo $contador ?>]" style="visibility:hidden;" onchange="$('#enviar14_3').trigger('click');"></td> 
                <?php
            }
            ?>
            
            
        </tr>
        <?php

    }
    mysqli_free_result($consulta);
    ?>

        <tr>
            <td></td>
            <td><button type="button" id="enviar14_2" class="w3-btn" style="background-color:transparent"><i class="fa fa-plus-circle" style="font-size:24px;color:#305490"></i></button></td>
            <td></td>
            <td><?php echo number_format($total_reque, 0, ',', '.') ?></td>
            <td></td>
            <td></td>
            <td><img src="../iconos/guardar.png" width="60px" height="60px" class="btn_guardar" id="enviar14_3" class="w3-btn" onclick="document.getElementById('respuesta14_2').style.display='block'" class="btn_icono"></td>
            <td></td>
        </tr>
    <?php
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------

    ?>
    
</table>
</form>

<div id="respuesta14_2"></div>


<script>
    //Guardar
    $('#enviar14_3').click(function(){
        $.ajax({
            url:'../php/consulta14_1.php',
            type:'POST',
            data: $('#form_nuevo_requerimiento').serialize(),
            success: function(res){
                $('#respuesta14_2').html(res);
                $('#enviar14_1').trigger('click');
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });


    // Nuevo en blanco
    $('#enviar14_2').click(function(){
        $.ajax({
            url:'../php/consulta14_2.php',
            type:'POST',
            data: $('#form_nuevo_requerimiento').serialize(),
            success: function(res){
                $('#respuesta14_2').html(res);
                $('#enviar14_1').trigger('click');
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });
</script>
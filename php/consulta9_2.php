<script type="text/javascript" src="../js/funciones.js"></script>
<?php

    $conexion = conectar();                     //Obtenemos la conexion

    date_default_timezone_set('America/Bogota');
    $fecha        = date('Y-m-d', time());

    ?>
    <form id="actualizar_personal2" method="POST">
    <table class="tabla_sugerido">
        <tr>
            <th colspan="12" style="text-align: center;"><h3>Información Personal</h3></th>
        <tr>
        <tr>
            <th>#</th>
            <th>Identificación</th>
            <th>Nombre</th>
            <th>F. Nacimiento</th>
            <th>Edad</th>
            <th>F. Ingreso</th>
            <th>Cumpleaños</th>
            <th>EPS</th>
            <th>ARL</th>
            <th>Pensión</th>
            <th>Caja Comp.</th>
            <th></th>
        </tr>
        <tr>
            <?php
            $contador = 0;
            $consulta = mysqli_query($conexion, "SELECT * FROM `personal` 
            INNER JOIN `cargo` ON personal.cargo = cargo.id_cargo 
            WHERE personal.estado = 'activo' AND personal.tipo_usuario_pers != '5' AND personal.tipo_usuario_pers != '6'
            ORDER BY personal.id_pers ASC") or die ("Error al consultar: existencia del proveedor");

            while (($fila = mysqli_fetch_array($consulta))!=NULL){
                $contador++;
                ?>
                <tr>
                    <input type="hidden" name="id_pers[]" value="<?php echo $fila['id_pers'] ?>"/>
                    <td><?php echo $contador ?></td>
                    <td><input type="text" name="identificacion_pers[]" size="7" value="<?php echo $fila['identificacion_pers'] ?>"/></td>
                    <td><input type="text" name="nombre_pers[]" size="30" value="<?php echo $fila['nombre_pers'] ?>"/></td>
                    <td><input type="date" name="fecha_nacimiento_pers[]" value="<?php echo $fila['fecha_nacimiento_pers'] ?>" style="width:120px"/></td>

                    <?php
                    $fecha1  = new DateTime($fecha);
                    $fecha2  = new DateTime($fila['fecha_nacimiento_pers']);

                    $intvl   = $fecha1->diff($fecha2);
                    echo "<td style='background-color:green;border: 2px solid white;text-align: center;color:white;'>".$intvl->y."</td>";
                    ?>
                    

                    <td><input type="date" name="fecha_ingreso[]" value="<?php echo $fila['fecha_ingreso'] ?>" style="width:120px"/></td>
                    <?php
                    $fecha3 = new DateTime(date("d-m-Y",strtotime($fila['fecha_nacimiento_pers']." +".intval(($intvl->y)+1)." year")));

                    $intvl2   = $fecha1->diff($fecha3);
                    if($intvl2->d == 0 && $intvl2->m == 0){
                        echo "<td style='background-color:transparent;border: 2px solid white;text-align: center;color:white;'><img src='../iconos/pastel.png' width='40%' height='40%' class='btn_icono'></td>";
                    }else{
                        if($intvl2->m == 0){
                            echo "<td style='background-color:red;border: 2px solid white;text-align: center;color:white;'>".$intvl2->d." Días</td>";
                        }else{
                            echo "<td style='background-color:green;border: 2px solid white;text-align: center;color:white;'>".$intvl2->m." Meses con ".$intvl2->d." Días</td>";
                        }
                        
                        
                    }
                    ?>
                    <td><input type="text" name="eps[]" size="5" value="<?php echo $fila['eps'] ?>"/></td>
                    <td><input type="text" name="arl[]" size="5" value="<?php echo $fila['arl'] ?>"/></td>
                    <td><input type="text" name="pension[]" size="5" value="<?php echo $fila['pension'] ?>"/></td>
                    <td><input type="text" name="caja_compensacion[]" size="5" value="<?php echo $fila['caja_compensacion'] ?>"/></td>
                    <?php
                    if($fila['nombre_pers'] == '' || $fila['nombre_pers'] == NULL){
                        ?>
                        <td><input type="radio" name="eliminar[<?php echo $contador ?>]" value="activo" style="visibility:hidden;" checked>
                        <input type="radio" name="eliminar[<?php echo $contador ?>]" value="eliminar" id="eliminar[<?php echo $contador ?>]" onchange="$('#enviar9_5').trigger('click');" style="visibility:hidden;">
                        <label class="w3-tbn w3-red btn-eliminar" for="eliminar[<?php echo $contador ?>]"><i class='far fa-trash-alt' style='font-size:16px;color:white'></i></label><br></td> 
                        <?php
                    }else{
                        ?>
                        <td><input type="radio" name="eliminar[<?php echo $contador ?>]" value="activo" style="visibility:hidden;" checked>
                        <input type="radio" name="eliminar[<?php echo $contador ?>]" value="eliminar" id="eliminar[<?php echo $contador ?>]" style="visibility:hidden;" onchange="$('#enviar9_5').trigger('click');"></td> 
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
            <td><button type="button" id="enviar9_4_2" class="w3-btn" style="background-color: transparent;"><i class="fa fa-plus-circle" style="font-size:24px;color:#305490"></i></button></td>
            <td colspan="7"></td>
            <td></td>

            <td colspan="2"><img src="../iconos/guardar.png" width="60px" height="60px" id="enviar9_5"  class="btn_guardar" onclick="document.getElementById('respuesta9_5').style.display='block'"></td>
        </tr>
    </table>
    </form>
    <div id="respuesta9_5" style="display:none;"></div>

<script>
$('#enviar9_5').click(function(){
    $.ajax({
        url:'../php/consulta9_5.php',
        type:'POST',
        data: $('#actualizar_personal2').serialize(),
        success: function(res){
            /*Swal.fire(
            '¡Muy bien!',
            'Guardado Exitoso',
            'success'
            )*/
            $('#respuesta9_5').html(res);
            
            setTimeout(function(){ 
                
                $('#enviar9_2').trigger('click');
            }, 50);
            
        },
        error: function(res){
            alert("Problemas al tratar de enviar el formulario");
        }
    });
});

$('#enviar9_4_2').click(function(){
    $.ajax({
        url:'../php/consulta9_4.php',
        success: function(res){
            $('#enviar9_2').trigger('click');
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
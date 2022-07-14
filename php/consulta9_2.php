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

    ?>
    <form id="actualizar_personal2" method="POST">
    <table id="tabla_sugerido">
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
            <th>C. Compensasión</th>
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
                    <td><input type="text" name="identificacion_pers[]" size="10" value="<?php echo $fila['identificacion_pers'] ?>"/></td>
                    <td><input type="text" name="nombre_pers[]" value="<?php echo $fila['nombre_pers'] ?>"/></td>
                    <td><input type="date" name="fecha_nacimiento_pers[]" value="<?php echo $fila['fecha_nacimiento_pers'] ?>"/></td>

                    <?php
                    $fecha1  = new DateTime($fecha);
                    $fecha2  = new DateTime($fila['fecha_nacimiento_pers']);

                    $intvl   = $fecha1->diff($fecha2);
                    echo "<td style='background-color:green;border: 2px solid white;text-align: center;color:white;'>".$intvl->y."</td>";
                    ?>
                    

                    <td><input type="date" name="fecha_ingreso[]" value="<?php echo $fila['fecha_ingreso'] ?>"/></td>
                    <?php
                    $fecha3 = new DateTime(date("d-m-Y",strtotime($fila['fecha_nacimiento_pers']." +".intval(($intvl->y)+1)." year")));

                    $intvl2   = $fecha1->diff($fecha3);
                    if($intvl2->d == 0 && $intvl2->m == 0){
                        echo "<td style='background-color:pink;border: 2px solid white;text-align: center;color:white;'><i class='fa fa-birthday-cake' style='font-size:36px;color:red'></i></td>";
                    }else{
                        if($intvl2->m == 0){
                            echo "<td style='background-color:red;border: 2px solid white;text-align: center;color:white;'>".$intvl2->d." Días</td>";
                        }else{
                            echo "<td style='background-color:green;border: 2px solid white;text-align: center;color:white;'>".$intvl2->m." Meses con ".$intvl2->d." Días</td>";
                        }
                        
                        
                    }
                    ?>
                    <td><input type="text" name="eps[]" size="8" value="<?php echo $fila['eps'] ?>"/></td>
                    <td><input type="text" name="arl[]" size="8" value="<?php echo $fila['arl'] ?>"/></td>
                    <td><input type="text" name="pension[]" size="8" value="<?php echo $fila['pension'] ?>"/></td>
                    <td><input type="text" name="caja_compensacion[]" size="8" value="<?php echo $fila['caja_compensacion'] ?>"/></td>
                    <?php
                    if($fila['nombre_pers'] == '' || $fila['nombre_pers'] == NULL){
                        ?>
                        <td class="w3-btn w3-red"><input type="radio" name="eliminar[<?php echo $contador ?>]" value="activo" style="visibility:hidden;" checked>
                        <input type="radio" name="eliminar[<?php echo $contador ?>]" value="eliminar" id="eliminar[<?php echo $contador ?>]" onchange="$('#enviar9_5').trigger('click');">
                        <label for="eliminar[<?php echo $contador ?>]">X</label><br></td> 
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
            <td><button type="button" id="enviar9_4_2" class="w3-btn"><i class="fa fa-plus-circle" style="font-size:24px;color:#305490"></i></button></td>
            <td colspan="8"></td>
            <td><button type="button" id="enviar9_5" class="w3-btn" style="background-color: #478248;color:white;" onclick="document.getElementById('respuesta9_5').style.display='block'">Guardar <i class='fas fa-edit' style='font-size:24px;color:white'></button></td>
            <td></td>
            <td></td>
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
            Swal.fire(
            '¡Muy bien!',
            'Guardado Exitoso',
            'success'
            )
            $('#respuesta9_5').html(res);
            $('#enviar9_2').trigger('click');
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
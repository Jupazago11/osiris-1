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

    $id_cargo = array();
    $cargo = array();

    $consulta = mysqli_query($conexion, "SELECT * FROM `cargo` WHERE `estado` != '' AND `estado` != 'inactivo'") or die ("Error al consultar: existencia del cargo");

    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        array_push($id_cargo, $fila['id_cargo']);
        array_push($cargo, $fila['cargo']);
    }


    $tota_nomina = 0;
    ?>
    <form id="actualizar_personal" method="POST">
    <table class="tabla_sugerido">
        <tr>
            <th colspan="9" style="text-align: center;"><h3>Información Laboral</h3></th>
        <tr>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Cargo <i class="fa fa-plus" id="btn_cargo" onclick="document.getElementById('form_cargos').style.display='block'"></i></th>
            <th>Duración</th>
            <th>F. Inicio</th>
            <th>F. Terminación</th>
            <th>Salario</th>
            <th>Estado</th>
            <th></th>
        </tr>
        <tr>
            <?php
            $contador = 0;
            $consulta = mysqli_query($conexion, "SELECT `id_pers`, `nombre_pers`, `identificacion_pers`, `celular_pers`, `correo_pers`, `user_pers`, `pass_pers`, `tipo_usuario_pers`, `fecha_nacimiento_pers`, `fecha_inicio_contrato_pers`, `tipo_contrato_pers`, `fecha_ingreso`, personal.cargo, `salario_pers`, `eps`, `arl`, `caja_compensacion`, `pension`, personal.estado
            FROM `personal` 
            INNER JOIN `cargo` ON personal.cargo = cargo.id_cargo 
            WHERE personal.estado = 'activo' AND personal.tipo_usuario_pers != '5' AND personal.tipo_usuario_pers != '6'
            ORDER BY personal.id_pers ASC") or die ("Error al consultar: existencia del proveedor");

            while (($fila = mysqli_fetch_array($consulta))!=NULL){
                $contador++;
                ?>
                <tr>
                    <input type="hidden" name="id_pers[]" value="<?php echo $fila['id_pers'] ?>"/>
                    <td><?php echo $contador ?></td>
                    <td><input type="text" name="nombre_pers[]" size="30" onchange="$('#enviar9').trigger('click');" value="<?php echo ucwords($fila['nombre_pers']) ?>"/></td>
                    <td>

                    <select name="cargo[]">
                        <?php
                        for ($i = 0; $i < count($id_cargo); $i++) { 

                            if($fila['cargo'] == $id_cargo[$i]){
                                ?>
                                <option value="<?php echo $id_cargo[$i] ?>" selected><?php echo $cargo[$i] ?></option>
                                <?php
                            }else{
                                ?>
                                <option value="<?php echo $id_cargo[$i] ?>"><?php echo $cargo[$i] ?></option>
                                <?php
                            }
                            
                        }
                        ?>
                    </select>
                    </td>
                    <td><input type="text" name="tipo_contrato_pers[]" size="2" value="<?php echo $fila['tipo_contrato_pers'] ?>" onchange="$('#enviar9').trigger('click');"/> Meses</td>
                    <td><input type="date" name="fecha_inicio_contrato_pers[]" value="<?php echo $fila['fecha_inicio_contrato_pers'] ?>"/></td>
                    <?php

                    echo "<td>".date("d-m-Y",strtotime(date("d-m-Y",strtotime($fila['fecha_inicio_contrato_pers']." +".intval($fila['tipo_contrato_pers'])." month"))."- 1 days"))."</td>";
                    

                    $fecha_final = date("d-m-Y",strtotime($fila['fecha_inicio_contrato_pers']." +".intval($fila['tipo_contrato_pers'])." month"));
                    $fecha_final = date("d-m-Y",strtotime($fecha_final."- 1 days"));
                    ?>
                    <td><input type="text" name="salario_pers[]" size="8" value="<?php echo number_format($fila['salario_pers'], 0, ',', '.') ?>" class="puntos"/></td>
                    
                    <?php

                    //Suma de nomina
                    $tota_nomina += $fila['salario_pers'];

                    $fecha1  = new DateTime($fecha);
                    $fecha2  = new DateTime($fecha_final);

                    $intvl   = $fecha1->diff($fecha2);
                    if($fecha1 > $fecha2){
                        echo "<td style='background-color:red;border: 2px solid white;text-align: center;color:white;'> - ".$intvl->days." Días</td>";

                    }elseif($intvl->days < 30 && $intvl->days > 0){
                        
                        echo "<td style='background-color:red;border: 2px solid white;text-align: center;color:white;'>".$intvl->days." Días</td>";

                    }elseif($intvl->days >= 30 && $intvl->days < 60){
                        echo "<td style='background-color:yellow;border: 2px solid white;text-align: center;'>".$intvl->m." Mes y ".$intvl->d."</td>";

                    }elseif($intvl->days >= 60){
                        echo "<td style='background-color:green;border: 2px solid white;text-align: center;color:white;'>".$intvl->m." Meses y ".$intvl->d." días</td>";

                    }elseif($intvl->days == 0){
                        echo "<td style='background-color:white;border: 2px solid white;text-align: center;color:white;'>".$intvl->m."</td>";

                    }
                    if($fila['nombre_pers'] == ''){
                        ?>
                        <td><input type="radio" name="eliminar[<?php echo $contador ?>]" value="activo" style="visibility:hidden;" checked>
                        <input type="radio"  name="eliminar[<?php echo $contador ?>]" value="eliminar" id="eliminar[<?php echo $contador ?>]" onchange="$('#enviar9').trigger('click');">
                        <label class="w3-tbn w3-red btn-eliminar" for="eliminar[<?php echo $contador ?>]"><i class='far fa-trash-alt' style='font-size:16px;color:white'></i></label></td> 
                        <?php
                    }else{
                        ?>
                        <td><input type="radio" name="eliminar[<?php echo $contador ?>]" value="activo" style="visibility:hidden;" checked>
                        <input type="radio" name="eliminar[<?php echo $contador ?>]" value="eliminar" id="eliminar[<?php echo $contador ?>]" style="visibility:hidden;" onchange="$('#enviar9').trigger('click');"></td> 
                        <?php
                    }
            }
            mysqli_free_result($consulta);
            ?>
            
        </tr>
        <tr>
            <td></td>
            <td><button type="button" id="enviar9_4_1" class="w3-btn" style="background-color:transparent"><i class="fa fa-plus-circle" style="font-size:24px;color:#305490"></i></button></td>
            <td colspan="4"></td>
            <td><?php echo number_format($tota_nomina, 0, ',', '.') ?></td>
            <td><img src="../iconos/guardar.png" width="60px" height="60px" class="btn_guardar" id="enviar9"  onclick="document.getElementById('respuesta9').style.display='block'"></td>
            <td></td>
        </tr>
    </table>
    </form>
    <div id="respuesta9" style="display:none;"></div>


    
<form id="actualizar_cargos" method="POST">
    <div id="form_cargos" style="position:absolute; top:0;left:0;background:rgba(255, 255, 255, 0.4);;width:100%;height: 100%;display:none;">
    
    <table class="tabla_sugerido" style="width:50%;border: 1px solid black; border-collapse: collapse;margin-left: auto;  margin-right: auto;background-color:white" >
        <tr>
            <th>Nombre</th>
            <th>Estado</th>
            <th><a class="w3-bar-item w3-button w3-hover-red active" onclick="document.getElementById('form_cargos').style.display='none'">X</a></th>
        </tr>
    <?php
    $consulta = mysqli_query($conexion, "SELECT * FROM `cargo` WHERE `estado` != ''") or die ("Error al consultar: existencia del cargo");
    $contador=0;
    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $contador++;
    ?>
    
        <tr>
            <input type="hidden" name="id_cargo[]" value="<?php echo $fila['id_cargo'] ?>"/>
            <td><input type="text" name="cargo[]" value="<?php echo $fila['cargo'] ?>"/></td>
            <td>
                <?php
            if($fila['estado'] == "activo"){
                ?>
                <input type="radio" name="estado[<?php echo $contador ?>]" value="activo" checked>
                    Activo<br>
                <input type="radio" name="estado[<?php echo $contador ?>]" value="inactivo">
                    Inactivo<br></td> 
                <?php
            }elseif($fila['estado'] == "inactivo"){
                ?>
                <input type="radio" name="estado[<?php echo $contador ?>]" value="activo">
                    Activo<br>
                <input type="radio" name="estado[<?php echo $contador ?>]" value="inactivo" checked>
                    Inactivo<br></td> 
                <?php
            }
            ?></td>
            <?php
            if($fila['cargo'] == ''){
                ?>
                <td><input type="radio" name="eliminar[<?php echo $contador ?>]" value="activo" style="visibility:hidden;" checked>
                <input type="radio" name="eliminar[<?php echo $contador ?>]" value="eliminar" id="eliminar[<?php echo $contador ?>]" onchange="$('#enviar9_8').trigger('click');">
                <label class="w3-tbn w3-red btn-eliminar" for="eliminar[<?php echo $contador ?>]"><i class='far fa-trash-alt' style='font-size:16px;color:white'></i></label><br></td> 
                <?php
            }else{
                ?>
                <td><input type="radio" name="eliminar[<?php echo $contador ?>]" value="activo" style="visibility:hidden;" checked>
                <input type="radio" name="eliminar[<?php echo $contador ?>]" value="eliminar" id="eliminar[<?php echo $contador ?>]" style="visibility:hidden;" onchange="$('#enviar9_8').trigger('click');"></td> 
                <?php
            }
            ?>
        </tr>
    <?php
    }
    ?>
        <tr>
            <td><button type="button" id="enviar9_7" class="w3-btn" style="background-color: transparent;"><i class="fa fa-plus-circle" style="font-size:24px;color:#305490"></i></button></td>
            <td><img src="../iconos/guardar.png" width="60px" height="60px" id="enviar9_8" class="btn_guardar"></td>
            <td></td>
        </tr>

    </table>
</form>
    </div>
    <?php
    
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>

<script>
    $('#enviar9').click(function(){
        $.ajax({
            url:'../php/consulta9.php',
            type:'POST',
            data: $('#actualizar_personal').serialize(),
            success: function(res){
                /*Swal.fire(
                '¡Muy bien!',
                'Guardado Exitoso',
                'success'
                )*/
                $('#respuesta9').html(res);
                $('#enviar9_1').trigger('click');
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });
    $('#enviar9_4_1').click(function(){
        $.ajax({
            url:'../php/consulta9_4.php',
            success: function(res){
                $('#enviar9_1').trigger('click');
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });

    //nuevo puesto en blanco
    $('#enviar9_7').click(function(){
        $.ajax({
            url:'../php/consulta9_7.php',
            type:'POST',
            data: $('#actualizar_cargos').serialize(),
            success: function(res){
                $('#respuesta9').html(res);
                $('#enviar9_1').trigger('click');
                


                setTimeout(function(){ 
                    $('#btn_cargo').trigger('click');
                }, 50);

            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });
    $('#enviar9_8').click(function(){
        $.ajax({
            url:'../php/consulta9_8.php',
            type:'POST',
            data: $('#actualizar_cargos').serialize(),
            success: function(res){
                $('#respuesta9').html(res);
                $('#enviar9_1').trigger('click');

                setTimeout(function(){ 
                    $('#btn_cargo').trigger('click');
                }, 50);

            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });
    


</script>
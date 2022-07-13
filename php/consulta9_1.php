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

    $consulta = mysqli_query($conexion, "SELECT * FROM `cargo` WHERE `estado` != ''") or die ("Error al consultar: existencia del cargo");

    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        array_push($id_cargo, $fila['id_cargo']);
        array_push($cargo, $fila['cargo']);
    }
    ?>
    <form id="actualizar_personal" method="POST">
    <table id="tabla_sugerido">
        <tr>
            <th colspan="9" style="text-align: center;"><h3>Información Laboral</h3></th>
        <tr>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Cargo <i class="fa fa-plus" onclick="document.getElementById('form_cargos').style.display='block'"></i></th>
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
                    <td><input type="text" name="nombre_pers[]" value="<?php echo $fila['nombre_pers'] ?>"/></td>
                    <td>
                    <?php
                    if($fila['cargo'] != '' ){
                        echo "<input list='cargos' name='cargo[]' id='cargo' value='".$fila['id_cargo']."'>";
                    }else{
                        echo "<input list='cargos' name='cargo[]' id='cargo'>";
                    }
                    ?>
                    <datalist id="cargos">
                        <?php
                        for ($i = 0; $i < count($id_cargo); $i++) { 
                            ?>
                            <option value="<?php echo $id_cargo[$i] ?>"><?php echo $cargo[$i] ?></option>

                        <?php
                        }
                        ?>
                    </datalist>
                    </td>
                    <td><input type="text" name="tipo_contrato_pers[]" size="2" value="<?php echo $fila['tipo_contrato_pers'] ?>"/> Meses</td>
                    <td><input type="date" name="fecha_inicio_contrato_pers[]" value="<?php echo $fila['fecha_inicio_contrato_pers'] ?>"/></td>
                    <?php

                    echo "<td>".date("d-m-Y",strtotime($fila['fecha_inicio_contrato_pers']." +".intval($fila['tipo_contrato_pers'])." month"))."</td>";
                    $fecha_final = date("d-m-Y",strtotime($fila['fecha_inicio_contrato_pers']." +".intval($fila['tipo_contrato_pers'])." month"));
                    ?>
                    <td><input type="text" name="salario_pers[]" size="8" value="<?php echo $fila['salario_pers'] ?>"/></td>
                    
                    <?php

                    $fecha1  = new DateTime($fecha);
                    $fecha2  = new DateTime($fecha_final);

                    $intvl   = $fecha1->diff($fecha2);
                    if($fecha1 > $fecha2){
                        echo "<td style='background-color:red;border: 2px solid white;text-align: center;color:white;'> - ".$intvl->days."</td>";

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
                        <td class="w3-btn w3-red"><input type="radio" name="eliminar[<?php echo $contador ?>]" value="activo" style="visibility:hidden;" checked>
                        <input type="radio" name="eliminar[<?php echo $contador ?>]" value="eliminar" id="eliminar[<?php echo $contador ?>]" onchange="$('#enviar9').trigger('click');">
                        <label for="eliminar[<?php echo $contador ?>]">X</label><br></td> 
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
            <td><button type="button" id="enviar9_4_1" class="w3-btn"><i class="fa fa-plus-circle" style="font-size:24px;color:#305490"></i></button></td>
            <td colspan="5"></td>
            <td><button type="button" id="enviar9" class="w3-btn" style="background-color: #478248;color:white;" onclick="document.getElementById('respuesta9').style.display='block'">Guardar <i class='fas fa-edit' style='font-size:24px;color:white'></button></td>
            <td></td>
        </tr>
    </table>
    </form>
    <div id="respuesta9" style="display:none;"></div>

    <div id="form_cargos" style="display:none;">
    <table id="tabla_sugerido">
        <tr>
            <th>Nombre</th>
        </tr>
    <?php
    $consulta = mysqli_query($conexion, "SELECT * FROM `cargo` WHERE `estado` != ''") or die ("Error al consultar: existencia del cargo");
    
    while (($fila = mysqli_fetch_array($consulta))!=NULL){
    ?>
    
        <tr>
            <td><input type="text" name="nuevo_cargo" value="<?php echo $fila['cargo'] ?>"/></td>
        </tr>
    <?php
    }
    ?>
        <tr>
            <td><button type="button" id="enviar9_7" class="w3-btn"><i class="fa fa-plus-circle" style="font-size:24px;color:#305490"></i></button></td>
        </tr>

    </table>
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
                Swal.fire(
                '¡Muy bien!',
                'Guardado Exitoso',
                'success'
                )
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
    $('#enviar9_7').click(function(){
        $.ajax({
            url:'../php/consulta9_7.php',
            type:'POST',
            data: $('#actualizar_personal').serialize(),
            success: function(res){
                $('#enviar9').trigger('click');
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });

</script>
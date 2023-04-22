<?php

    $conexion = conectar();

  //resultados operativos///////////////////////

    $mes  = $_POST['mes'];
    $year = $_POST['year'];
    $user = $_POST['user'];
    $existe = false;

    $id_pre_detalle_cat = array();
    $cate_pre = array();
    
    //  id del usuario
    $consulta = mysqli_query($conexion, "SELECT `id_pers` 
    FROM `personal` 
    WHERE `user_pers` = '$user'") or die ("Error al update: presupuesto");

    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $id_user = $fila['id_pers'];
    }
    mysqli_free_result($consulta);


    // traer categorias
    $consulta = mysqli_query($conexion, "SELECT * FROM `pre_detalle_cat` 
    WHERE `estado` != '' OR `estado` != 'inactivo'") or die ("Error al consultar: existencia del cargo");

    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        array_push($id_pre_detalle_cat, $fila['id_pre_detalle_cat']);
        array_push($cate_pre, $fila['cate_pre']);
    }
    mysqli_free_result($consulta);


    //  obtener id del presupuesto

    $consulta = mysqli_query($conexion, "SELECT * FROM `presupuesto`  
    WHERE `mes`= '$mes' AND `year`= '$year'") or die ("Error al consultar: proveedores");
    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $existe[1] = true;
        $id_presu = $fila['id_presu'];
    }
    mysqli_free_result($consulta);

/////////////////////////////////////////////////////////////////////////////////////////////

    if($existe == true){
        $id_presu_de = array();
        $nombre = array();
        $costo1 = array();
        $descripcion = array();
        $nombre_pers = array();
        

        $consulta = mysqli_query($conexion, "SELECT `nombre`,`descripcion`,`costo`, personal.nombre_pers, pre_detalle.estado,`id_presu1`,`id_presu_de` FROM `pre_detalle` 
        INNER JOIN personal ON personal.id_pers = pre_detalle.id_pers4
        WHERE `id_presu1` = '$id_presu' AND pre_detalle.`estado` != ''") or die ("Error al consultar: proveedores");

        while (($fila = mysqli_fetch_array($consulta))!=NULL){
            $id_presu1 = $fila['id_presu1'];
            array_push($id_presu_de, $fila['id_presu_de']);
            array_push($nombre, $fila['nombre']);
            array_push($costo1, $fila['costo']);
            array_push($descripcion, $fila['descripcion']);
            array_push($nombre_pers, $fila['nombre_pers']);
        }
        mysqli_free_result($consulta);
        ?>
        <div id="form_presupuestos" style="position:absolute; top:0;left:0;background:rgba(255, 255, 255, 0.4);width:100%;height: 100%;display:none;">
        <form id="menu_presupuestos2" method="POST">
        <table class="tabla_sugerido" style="width:50%;border: 1px solid black; border-collapse: collapse;margin-left: auto;  margin-right: auto;background-color:white">
            <tr>
                <th colspan="4">Presupuesto</th>
                <th><a class="w3-bar-item w3-button w3-hover-red active" id="clic_cat" onclick="document.getElementById('form_presupuestos').style.display='none'">X</a></th>
            </tr>
            <tr style="background-color:#87CEEB;">
                <td>Categoría <i class="fa fa-plus" onclick="document.getElementById('form_cat').style.display='block'"></i></td>
                <td>Descripción</td>
                <td>Valor</td>
                <td>Usuario</td>
                <td></td>
            </tr>
            <tr>
            <?php
            $total_presupuesto = 0;
            for ($i = 0; $i < count($nombre); $i++) { 
                $contador = $i + 1;
 
                ?>
                <input type="hidden" name="id_presu_de[]" value="<?php echo $id_presu_de[$i] ?>"/>
                <input type="hidden" name="id_user" value="<?php echo $id_user ?>"/>
                <input type="hidden" name="id_presu1" value="<?php echo $id_presu1 ?>"/>
                <td>
            <?php
                if($nombre[$i] != '' ){
                    echo "<input list='nombres' name='nombre[]' id='nombre' value='".$nombre[$i]."'>";
                }else{
                    echo "<input list='nombres' name='nombre[]' id='nombre'>";
                }
                ?>
                <datalist id="nombres">
                    <?php
                    for ($j = 0; $j < count($id_pre_detalle_cat); $j++) { 
                        ?>
                        <option value="<?php echo $cate_pre[$j] ?>"></option>

                    <?php
                    }
                    ?>
                </datalist>
                </td>
                <td><input type="text" name="descripcion[]" size="10" value="<?php echo $descripcion[$i] ?>"/></td>
                <td><input type="text" name="costo1[]" size="10" value="<?php echo number_format($costo1[$i], 0, ',', '.') ?>" class="puntos"/></td>
                <td><?php echo $nombre_pers[$i] ?></td>
                
                <?php
                if($nombre[$i] == ''){
                    ?>
                    <td><input type="radio" name="eliminar[<?php echo $contador ?>]" value="activo" style="visibility:hidden;" checked>
                    <input type="radio" name="eliminar[<?php echo $contador ?>]" value="eliminar" id="eliminarpresu[<?php echo $contador ?>]" onchange="$('#enviar11_1').trigger('click');" style="visibility:hidden;">
                    <label class="w3-tbn w3-red btn-eliminar" for="eliminarpresu[<?php echo $contador ?>]"><i class='far fa-trash-alt' style='font-size:16px;color:white'></i></label><br></td>
                    <?php
                }else{
                    ?>
                    <td><input type="radio" name="eliminar[<?php echo $contador ?>]" value="activo" style="visibility:hidden;" checked>
                    <input type="radio" name="eliminar[<?php echo $contador ?>]" value="eliminar" id="eliminarpresu[<?php echo $contador ?>]" style="visibility:hidden;" onchange="$('#enviar11_1').trigger('click');"></td> 
                    <?php
                }
                $total_presupuesto += $costo1[$i];
            ?>
            </tr>
                <?php
            }
            
            ?>
            <tr style="background-color:#87CEEB;">
                <td></td>
                <td></td>
                <td><?php echo number_format($total_presupuesto, 0, ',', '.') ?></td>
                <td></td>
                <td></td>

            </tr>
            <tr>
                <td><button type="button" id="enviar11_2" class="w3-btn" style="background-color:transparent"><i class="fa fa-plus-circle" style="font-size:24px;color:#305490"></i></button></td>
                <td></td>
                <td></td>
                <td><img src="../iconos/guardar.png" width="60px" height="60px" class="btn_guardar" id="enviar11_1" class="w3-btn" onclick="document.getElementById('respuesta11_1').style.display='block'" class="btn_icono"></td>
                <td></td>

            </tr>
        </table>
        </form>
        </div>
        <?php
    }else{
        $consulta = mysqli_query($conexion, "INSERT INTO `presupuesto`(`mes`, `year`) 
        VALUES ('$mes','$year')") or die ("Error al update: presupuesto");

        $consulta = mysqli_query($conexion, "SELECT * FROM `presupuesto`  
        WHERE `mes`= '$mes' AND `year`= '$year'") or die ("Error al consultar: proveedores");

        while (($fila = mysqli_fetch_array($consulta))!=NULL){
            $id_presu = $fila['id_presu'];
        }
        mysqli_free_result($consulta);


        $consulta = mysqli_query($conexion, "INSERT INTO `pre_detalle` (`id_presu1`, `nombre`, `costo`, `costo_gasto`, `estado`, `id_pers4`) 
        VALUES ('$id_presu', NULL, NULL, NULL, 'activo', '$id_user')") or die ("Error al update: presupuesto");

        echo "<script>$('#enviar11').trigger('click');</script>";
    }   
    ?>
    <div id="respuesta11_1"></div>

    <form id="actualizar_cat" method="POST">
    <input type="hidden" name="id_user" value="<?php echo $id_user ?>"/>
    <div id="form_cat" style="position:absolute; top:0;left:0;background:rgba(255, 255, 255, 0.4);;width:100%;height: 100%;display:none;">
    
    <table class="tabla_sugerido" style="width:50%;border: 1px solid black; border-collapse: collapse;margin-left: auto;  margin-right: auto;background-color:white" >
        <tr>
            <th>Nombre</th>
            <th>Estado</th>
            <th><a class="w3-bar-item w3-button w3-hover-red active" onclick="document.getElementById('form_cat').style.display='none'">X</a></th>
        </tr>
    <?php
    $consulta = mysqli_query($conexion, "SELECT * FROM `pre_detalle_cat` WHERE `estado` != ''") or die ("Error al consultar: existencia del cargo");
    $contador=0;
    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $contador++;
    ?>
    
        <tr>
            <input type="hidden" name="id_pre_detalle_cat[]" value="<?php echo $fila['id_pre_detalle_cat'] ?>"/>
            <td><input type="text" name="cate_pre[]" value="<?php echo $fila['cate_pre'] ?>"/></td>
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
            if($fila['cate_pre'] == ''){
                ?>
                <td><input type="radio" name="eliminar[<?php echo $contador ?>]" value="activo" style="visibility:hidden;" checked>
                <input type="radio" name="eliminar[<?php echo $contador ?>]" value="eliminar" id="eliminarpresu[<?php echo $contador ?>]" onchange="$('#enviar11_4').trigger('click');" style="visibility:hidden;">
                <label class="w3-tbn w3-red btn-eliminar" for="eliminarpresu[<?php echo $contador ?>]"><i class='far fa-trash-alt' style='font-size:16px;color:white'></i></label><br></td> 
                <?php
            }else{
                ?>
                <td><input type="radio" name="eliminar[<?php echo $contador ?>]" value="activo" style="visibility:hidden;" checked>
                <input type="radio" name="eliminar[<?php echo $contador ?>]" value="eliminar" id="eliminarpresu[<?php echo $contador ?>]" style="visibility:hidden;" onchange="$('#enviar11_4').trigger('click');"></td> 
                <?php
            }
            ?>
        </tr>
    <?php
    }
    ?>
        <tr>
            <td><button type="button" id="enviar11_3" class="w3-btn" style="background-color: transparent;"><i class="fa fa-plus-circle" style="font-size:24px;color:#305490"></i></button></td>
            <td><img src="../iconos/guardar.png" width="60px" height="60px" class="btn_guardar" id="enviar11_4" class="w3-btn" onclick="document.getElementById('respuesta7_2').style.display='block'" class="btn_icono"></td>
            <td></td>
        </tr>

    </table>
    </form>
    </div>


    <?php
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
<script>
    $('#enviar11_1').click(function(){
        $.ajax({
            url:'../php/consulta11_1.php',
            type:'POST',
            data: $('#menu_presupuestos2').serialize(),
            success: function(res){
                Swal.fire(
                '¡Muy bien!',
                'Guardado Exitoso',
                'success'
                )
                //$('#respuesta11_1').html(res);
                $('#enviar11').trigger('click');
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });

    $('#enviar11_2').click(function(){
        $.ajax({
            url:'../php/consulta11_2.php',
            type:'POST',
            data: $('#menu_presupuestos2').serialize(),
            success: function(res){
                //$('#respuesta11_1').html(res);
                $('#enviar11').trigger('click');
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });
    $('#enviar11_3').click(function(){
        $.ajax({
            url:'../php/consulta11_3.php',
            type:'POST',
            data: $('#actualizar_cat').serialize(),
            success: function(res){
                $('#enviar11').trigger('click');
                document.getElementById('form_cat').style.display='block';
                $('#clic_cat').trigger('click');
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });
    $('#enviar11_4').click(function(){
        $.ajax({
            url:'../php/consulta11_4.php',
            type:'POST',
            data: $('#actualizar_cat').serialize(),
            success: function(res){
                Swal.fire(
                '¡Muy bien!',
                'Guardado Exitoso',
                'success'
                )
                $('#respuesta9').html(res);
                $('#enviar11').trigger('click');
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });

</script>
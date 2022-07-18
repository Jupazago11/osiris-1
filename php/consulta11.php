<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();

  //resultados operativos///////////////////////

    $mes  = $_POST['mes'];
    $year = $_POST['year'];
    $existe = false;

    


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
        $costo2 = array();
        

        $consulta = mysqli_query($conexion, "SELECT * FROM `pre_detalle` 
        WHERE `id_presu1` = '$id_presu' AND `estado` != ''") or die ("Error al consultar: proveedores");

        while (($fila = mysqli_fetch_array($consulta))!=NULL){
            $id_presu1 = $fila['id_presu1'];
            array_push($id_presu_de, $fila['id_presu_de']);
            array_push($nombre, $fila['nombre']);
            array_push($costo1, $fila['costo']);
            array_push($costo2, $fila['costo_gasto']);
        }
        mysqli_free_result($consulta);
        ?>
        <div id="form_presupuestos" style="position:absolute; top:0;left:0;background:rgba(255, 255, 255, 0.4);;width:100%;height: 100%;display:none;">
        <form id="menu_presupuestos2" method="POST">
        <table id="tabla_sugerido" style="width:50%;border: 1px solid black; border-collapse: collapse;margin-left: auto;  margin-right: auto;background-color:white">
            <tr>
                <th colspan="2">Presupuesto</th>
                <th></th>
                <th colspan="2">Gasto real</th>
                <th><a class="w3-bar-item w3-button w3-hover-red active" onclick="document.getElementById('form_presupuestos').style.display='none'">X</a></th>
            </tr>
            <tr style="background-color:#87CEEB;">
                <td>Descripción</td>
                <td>Valor</td>
                <td style="background-color:#87CEEB;"></td>
                <td>Descripción</td>
                <td>Valor</td>
                <td>Estado</td>
            </tr>
            <tr>
            <?php
            $total_presupuesto = 0;
            $total_costo = 0;
            for ($i=0; $i < count($nombre); $i++) { 
                $contador = $i + 1;

                
                ?>
                <input type="hidden" name="id_presu1" value="<?php echo $id_presu1 ?>"/>
                <input type="hidden" name="id_presu_de[]" value="<?php echo $id_presu_de[$i] ?>"/>
                <td><input type="text" name="nombre[]" size="10" value="<?php echo $nombre[$i] ?>"/></td>
                <td><input type="text" name="costo1[]" size="10" value="<?php echo number_format($costo1[$i], 0, ',', '.') ?>" class="puntos"/></td>
                <td></td>
                <td><?php echo $nombre[$i] ?></td>
                <td><input type="text" name="costo2[]" size="10" value="<?php echo number_format($costo2[$i], 0, ',', '.') ?>" class="puntos"/></td>
                <?php
                if($nombre[$i] == ''){
                    ?>
                    <td class="w3-btn w3-red"><input type="radio" name="eliminar[<?php echo $contador ?>]" value="activo" style="visibility:hidden;" checked>
                    <input type="radio" name="eliminar[<?php echo $contador ?>]" value="eliminar" id="eliminar[<?php echo $contador ?>]" onchange="$('#enviar11_1').trigger('click');">
                    <label for="eliminar[<?php echo $contador ?>]">X</label><br></td> 
                    <?php
                }else{
                    ?>
                    <td><input type="radio" name="eliminar[<?php echo $contador ?>]" value="activo" style="visibility:hidden;" checked>
                    <input type="radio" name="eliminar[<?php echo $contador ?>]" value="eliminar" id="eliminar[<?php echo $contador ?>]" style="visibility:hidden;" onchange="$('#enviar11_1').trigger('click');"></td> 
                    <?php
                }
                $total_presupuesto += $costo1[$i];
                $total_costo += $costo2[$i];
            ?>
            </tr>
                <?php
            }
            
            ?>
            <tr style="background-color:#87CEEB;">
                <td></td>
                <td><?php echo number_format($total_presupuesto, 0, ',', '.') ?></td>
                
                <td></td>
                <td></td>
                <td><?php echo number_format($total_costo, 0, ',', '.') ?></td>
                <td></td>
            </tr>
            <tr>
                <td><button type="button" id="enviar11_2" class="w3-btn"><i class="fa fa-plus-circle" style="font-size:24px;color:#305490"></i></button></td>
                <td colspan="3"></td>
                <td><button type="button" id="enviar11_1" class="w3-btn" style="background-color: #478248;color:white;" onclick="document.getElementById('respuesta11_1').style.display='block'">Guardar <i class='fas fa-edit' style='font-size:24px;color:white'></button></td>
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

        $consulta = mysqli_query($conexion, "INSERT INTO `pre_detalle` (`id_presu_de`, `id_presu1`, `nombre`, `costo`, `costo_gasto`, `estado`) 
        VALUES (NULL, '$id_presu', NULL, NULL, NULL, 'activo')") or die ("Error al update: presupuesto");

        echo "<script>$('#enviar11').trigger('click');</script>";
    }   
    ?>
    <div id="respuesta11_1"></div>
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

</script>
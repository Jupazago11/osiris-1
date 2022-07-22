<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();

  //resultados operativos///////////////////////

    $year = $_POST['year'];
    $existe = false;

    


    $consulta = mysqli_query($conexion, "SELECT * FROM `r_operativos` 
    WHERE `year`= '$year'") or die ("Error al consultar: proveedores");
    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $existe = true;
        $id_presu = $fila['id_ro'];
    }
    mysqli_free_result($consulta);

/////////////////////////////////////////////////////////////////////////////////////////////

    if($existe == true){
        $id_presu_de = array();
        $id_ro_de = array();
        $mes = array();
        $inventario = array();
        $ventas = array();
        $g_operacion = array();
        $margen = array();
        $dividendo = array();
        $cxpagar = array();
        $credito = array();
        $efectivo = array();
        $tarjeta = array();
        

        $consulta = mysqli_query($conexion, "SELECT * FROM `ro_detalles` 
        WHERE `id_ro1` = '$id_presu' ORDER BY `mes` ASC") or die ("Error al consultar: proveedores");

        while (($fila = mysqli_fetch_array($consulta))!=NULL){
            $id_ro1 = $fila['id_ro1'];
            array_push($id_ro_de, $fila['id_ro_de']);
            array_push($mes, $fila['mes']);
            array_push($inventario, $fila['inventario']);
            array_push($ventas, $fila['ventas']);
            array_push($g_operacion, $fila['g_operacion']);
            array_push($margen, $fila['margen']);
            array_push($dividendo, $fila['dividendo']);
            array_push($cxpagar, $fila['cxpagar']);
            array_push($credito, $fila['credito']);
            array_push($efectivo, $fila['efectivo']);
            array_push($tarjeta, $fila['tarjeta']);
        }
        mysqli_free_result($consulta);
        ?>
        <div id="form_ro" style="position:absolute; top:0;left:0;background:rgba(255, 255, 255, 0.4);width:100%;height: 100%;display:none;">
        <form id="menu_ro" method="POST">
        <table id="tabla_sugerido" style="width:50%;border: 1px solid black; border-collapse: collapse;overflow:auto;margin-left: auto;  margin-right: auto;background-color:white; font-size:14px">
            <tr>
                <th colspan="11"><?php echo $year ?></th>
                <th><a class="w3-bar-item w3-button w3-hover-red active" onclick="document.getElementById('form_ro').style.display='none'">X</a></th>
            </tr>
            <tr>
                <th>Mes</th>
                <th>Inventario</th>
                <th>Ventas</th>
                <th>G. Operación</th>
                <th>Margen</th>
                <th>U. Bruta</th>
                <th>U. Neta</th>
                <th>Dividendo</th>
                <th>Cxpagar</th>
                <th>Cartera</th>
                <th>Efectivo</th>
                <th>Tarjeta</th>
                
            </tr>
            <tr>
            <?php
            $total = array(0,0,0,0,0,0,0,0,0,0,0);
            $nmeses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
            $cant =  array(0,0,0,0,0,0,0,0,0,0,0);
            $canti=  array(0,0,0,0,0,0,0,0,0,0,0);
            for ($i = 0; $i < count($mes); $i++) { 
                $contador = $i + 1;


                ?>
                <input type="hidden" name="id_ro1" value="<?php echo $id_ro1 ?>"/>
                <input type="hidden" name="id_ro_de[]" value="<?php echo $id_ro_de[$i] ?>"/>
                <td><?php echo $nmeses[$i] ?></td>
                <td><input type="text" name="inventario[]" size="9" value="<?php echo number_format($inventario[$i], 0, ',', '.') ?>" class="puntos"/></td>
                <td><input type="text" name="ventas[]" size="9" value="<?php echo number_format($ventas[$i], 0, ',', '.') ?>" class="puntos"/></td>
                <td><input type="text" name="g_operacion[]" size="9" value="<?php echo number_format($g_operacion[$i], 0, ',', '.') ?>" class="puntos"/></td>
                <td><input type="text" name="margen[]" size="2" value="<?php echo $margen[$i] ?>"/></td>
                <td><?php echo number_format($ventas[$i]*$margen[$i]/100, 0, ',', '.') ?></td>
                <td><?php echo number_format(($ventas[$i]*$margen[$i]/100)-$g_operacion[$i], 0, ',', '.') ?></td>
                <td><input type="text" name="dividendo[]" size="9" value="<?php echo number_format($dividendo[$i], 0, ',', '.') ?>" class="puntos"/></td>
                <td><input type="text" name="cxpagar[]" size="9" value="<?php echo number_format($cxpagar[$i], 0, ',', '.') ?>" class="puntos"/></td>
                <td><input type="text" name="credito[]" size="9" value="<?php echo number_format($credito[$i], 0, ',', '.') ?>" class="puntos"/></td>
                <td><input type="text" name="efectivo[]" size="9" value="<?php echo number_format($efectivo[$i], 0, ',', '.') ?>" class="puntos"/></td>
                <td><input type="text" name="tarjeta[]" size="9" value="<?php echo number_format($tarjeta[$i], 0, ',', '.') ?>" class="puntos"/></td>
                <?php


                //prom de inv
                if($inventario[$i] != 0){
                    $cant[0]++;
                    $canti[0] += $inventario[$i];
                }

                //prom de g operacion
                if($g_operacion[$i] != 0){
                    $cant[2]++;
                    $canti[2] += $g_operacion[$i];
                }

                //prom de margen
                if($margen[$i] != 0){
                    $cant[3]++;
                    $canti[3] += $margen[$i];
                }
                //prom de cxpagar
                if($cxpagar[$i] != 0){
                    $cant[7]++;
                    $canti[7] += $cxpagar[$i];
                }
                //prom de cartera/credito
                if($credito[$i] != 0){
                    $cant[8]++;
                    $canti[8] += $credito[$i];
                }

                //totales
                //$total[0] = $total[0] + $inventario[$i];
                $total[1] = $total[1] + $ventas[$i];
                //$total[2] = $total[2] + $g_operacion[$i];
                //$total[3] = $total[3] + $margen[$i];

                $total[4] = $total[4] + $ventas[$i]*$margen[$i]/100;                    //Bruta
                $total[5] = $total[5] + ($ventas[$i]*$margen[$i]/100)-$g_operacion[$i]; //Neta

                $total[6] = $total[6] + $dividendo[$i];
                //$total[7] = $total[7] + $cxpagar[$i];
                //$total[8] = $total[8] + $credito[$i];
                $total[9] = $total[9] + $efectivo[$i];
                $total[10] = $total[10] + $tarjeta[$i];


            ?>
            </tr>
                <?php
            }
            if($cant[0] != 0){$total[0] = $canti[0] / $cant[0];}else{$total[0] = 0;}
            if($cant[2] != 0){$total[2] = $canti[2] / $cant[2];}else{$total[2] = 0;}
            if($cant[3] != 0){$total[3] = $canti[3] / $cant[3];}else{$total[3] = 0;}
            if($cant[7] != 0){$total[7] = $canti[7] / $cant[7];}else{$total[7] = 0;}
            if($cant[8] != 0){$total[8] = $canti[8] / $cant[8];}else{$total[8] = 0;}
            
            ?>
            <tr style="background-color:#87CEEB;">
                <td></td>
                <?php
                for ($i=0; $i < count($total); $i++) { 
                    ?>
                    <td><?php echo number_format($total[$i], 0, ',', '.') ?></td>
                    <?php
                }
                ?> 
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td colspan="9"></td>
                <td><button type="button" id="enviar12_1" class="w3-btn" style="background-color: #478248;color:white;" onclick="document.getElementById('respuesta12_1').style.display='block'">Guardar <i class='fas fa-edit' style='font-size:24px;color:white'></button></td>
            </tr>
        </table>
        </form>
        </div>
        <?php
    }else{
        $consulta = mysqli_query($conexion, "INSERT INTO `r_operativos`(`year`)
        VALUES ('$year')") or die ("Error al update: presupuesto");

        $consulta = mysqli_query($conexion, "SELECT * FROM `r_operativos`  
        WHERE `year`= '$year'") or die ("Error al consultar: proveedores");

        while (($fila = mysqli_fetch_array($consulta))!=NULL){
            $id_ro = $fila['id_ro'];
        }
        mysqli_free_result($consulta);
        // un registro por cada mes del año
        for ($i = 1; $i <= 12; $i++) { 
            $consulta = mysqli_query($conexion, "INSERT INTO `ro_detalles`(`id_ro1`, `mes`) 
            VALUES ('$id_ro','$i')") or die ("Error al update: presupuesto");
        }

        
        echo "<script>$('#enviar12').trigger('click');</script>";
    }   
    ?>
    <div id="respuesta12_1"></div>
    <?php
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
<script>
    $('#enviar12_1').click(function(){
        $.ajax({
            url:'../php/consulta12_1.php',
            type:'POST',
            data: $('#menu_ro').serialize(),
            success: function(res){
                Swal.fire(
                '¡Muy bien!',
                'Guardado Exitoso',
                'success'
                )
                //$('#respuesta12_1').html(res);
                $('#enviar12').trigger('click');
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });
</script>
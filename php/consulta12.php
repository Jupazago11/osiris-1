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
        $id_presu_de    = array();
        $id_ro_de       = array();
        $mes            = array();
        $inventario     = array();
        $ventas         = array();
        $g_operacion    = array();
        $margen         = array();
        $dividendo      = array();
        $cxpagar        = array();
        $credito        = array();
        $efectivo       = array();
        $tarjeta        = array();
        $inversion      = array();
        $comentario_inversion = array();
        

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
            array_push($inversion, $fila['inversion']);
            array_push($comentario_inversion, $fila['comentario_inversion']);
        }
        mysqli_free_result($consulta);
        ?>
        <div style="background-color:#dddddd">
        <form id="menu_ro">
        
            <input type="hidden" name="name_ro" id="name_ro"/>
            <input type="hidden" name="anio" value="<?php echo $id_presu ?>"/>
            <input type="hidden" name="mes_ro" id="mes_ro" value="<?php echo $id_presu ?>"/>

        <table class="tabla_sugerido" style="width:100%;border: 1px solid black; border-collapse: collapse;overflow:auto;margin-left: auto;  margin-right: auto; font-size:12.5px">
            <tr>
                <th colspan="12"><?php echo $year ?><th>
            </tr>
            <tr>
                <th>Mes</th>
                <th onclick="grafico_r_operativos('inventario');">Inventario</th>
                <th onclick="grafico_r_operativos('ventas');">Ventas</th>
                <th onclick="grafico_r_operativos('g_operacion');">G. Operación</th>
                <th onclick="grafico_r_operativos('margen');">Margen</th>
                <th>U. Bruta</th>
                <th>U. Neta</th>
                <th onclick="grafico_r_operativos('dividendo');">Dividendo</th>
                <th onclick="grafico_r_operativos('inversion');">Inversión</th>
                <th onclick="grafico_r_operativos('cxpagar');">Cxpagar</th>
                <th onclick="grafico_r_operativos('credito');">Cartera</th>
                <th onclick="grafico_r_operativos('efectivo');">Efectivo</th>
                <th onclick="grafico_r_operativos('tarjeta');">Tarjeta</th>
                
            </tr>
            <tr>
            <?php
            $categoria = array('Promedio','Suma','Suma','Promedio','Suma','Suma','Suma','Suma','Promedio','Promedio','Promedio','Promedio');
            $total = array(0,0,0,0,0,0,0,0,0,0,0,0);
            $nmeses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
            $cant =  array(0,0,0,0,0,0,0,0,0,0,0,0);
            $canti=  array(0,0,0,0,0,0,0,0,0,0,0,0);
            for ($i = 0; $i < count($mes); $i++) { 
                $contador = $i + 1;


                ?>
                <input type="hidden" name="id_ro1" value="<?php echo $id_ro1 ?>"/>
                
                <input type="hidden" name="id_ro_de[]" value="<?php echo $id_ro_de[$i] ?>"/>
               
                <td onclick="grafico_r_operativosxmes('<?php echo $nmeses[$i] ?>');"><?php echo $nmeses[$i] ?></td>
                
                <td><input type="text" name="inventario[]" size="9" value="<?php echo number_format($inventario[$i], 0, ',', '.') ?>" class="puntos" onchange="guardar_r_operativos()"/></td>
                
                <td><input type="text" name="ventas[]" size="9" value="<?php echo number_format($ventas[$i], 0, ',', '.') ?>" class="puntos" onchange="guardar_r_operativos()"/></td>
                
                <td><input type="text" name="g_operacion[]" size="9" value="<?php echo number_format($g_operacion[$i], 0, ',', '.') ?>" class="puntos" onchange="guardar_r_operativos()"/></td>
                
                <td><input type="text" name="margen[]" size="2" value="<?php echo $margen[$i] ?>" onchange="guardar_r_operativos()"/></td>
                
                <td><?php echo number_format($ventas[$i]*$margen[$i]/100, 0, ',', '.') ?></td>
                
                <td><?php echo number_format(($ventas[$i]*$margen[$i]/100)-$g_operacion[$i], 0, ',', '.') ?></td>
                
                <td><input type="text" name="dividendo[]" size="9" value="<?php echo number_format($dividendo[$i], 0, ',', '.') ?>" class="puntos" onchange="guardar_r_operativos()"/></td>

                <td><input type="text" name="inversion[]" size="9" value="<?php echo number_format($inversion[$i], 0, ',', '.') ?>" class="puntos" onchange="guardar_r_operativos()"/>
                <i class='fa fa-book comentario_inv'></i>

                <div class="texto"><textarea rows="2" cols="11" name="comentario_inversion[]" style="resize: vertical;" onchange="guardar_r_operativos()"><?php echo $comentario_inversion[$i] ?></textarea></div></td>






                
                <td><input type="text" name="cxpagar[]" size="9" value="<?php echo number_format($cxpagar[$i], 0, ',', '.') ?>" class="puntos" onchange="guardar_r_operativos()"/></td>
                
                <td><input type="text" name="credito[]" size="9" value="<?php echo number_format($credito[$i], 0, ',', '.') ?>" class="puntos" onchange="guardar_r_operativos()"/></td>
                
                <td><input type="text" name="efectivo[]" size="9" value="<?php echo number_format($efectivo[$i], 0, ',', '.') ?>" class="puntos" onchange="guardar_r_operativos()"/></td>

                <td><input type="text" name="tarjeta[]" size="9" value="<?php echo number_format($tarjeta[$i], 0, ',', '.') ?>" class="puntos" onchange="guardar_r_operativos()"/></td>

                
                <?php


                //prom de inv
                if($inventario[$i] != 0){
                    $cant[0]++;
                    $canti[0] += $inventario[$i];
                }

                //prom de g operacion
                /*if($g_operacion[$i] != 0){
                    $cant[2]++;
                    $canti[2] += $g_operacion[$i];
                }*/

                //prom de margen
                if($margen[$i] != 0){
                    $cant[3]++;
                    $canti[3] += $margen[$i];
                }

                //prom de inversion
                /*if($inversion[$i] != 0){
                    $cant[7]++;
                    $canti[7] += $inversion[$i];
                }*/

                //prom de cxpagar
                if($cxpagar[$i] != 0){
                    $cant[8]++;
                    $canti[8] += $cxpagar[$i];
                }
                //prom de cartera/credito
                if($credito[$i] != 0){
                    $cant[9]++;
                    $canti[9] += $credito[$i];
                }

                //prom de efectivo
                if($efectivo[$i] != 0){
                    $cant[10]++;
                    $canti[10] += $efectivo[$i];
                }


                //prom de tarjeta
                if($tarjeta[$i] != 0){
                    $cant[11]++;
                    $canti[11] += $tarjeta[$i];
                }


                

                //totales
                //$total[0] = $total[0] + $inventario[$i];
                $total[1] = $total[1] + $ventas[$i];
                $total[2] = $total[2] + $g_operacion[$i];
                //$total[3] = $total[3] + $margen[$i];

                $total[4] = $total[4] + $ventas[$i]*$margen[$i]/100;                    //Bruta
                $total[5] = $total[5] + ($ventas[$i]*$margen[$i]/100)-$g_operacion[$i]; //Neta

                $total[6] = $total[6] + $dividendo[$i];
                $total[7] = $total[7] + $inversion[$i];
                //$total[8] = $total[8] + $credito[$i];
                //$total[10] = $total[10] + $efectivo[$i];
                //$total[11] = $total[11] + $tarjeta[$i];


            ?>
            </tr>
                <?php
            }
            if($cant[0] != 0){$total[0] = $canti[0] / $cant[0];}else{$total[0] = 0;}
            //if($cant[2] != 0){$total[2] = $canti[2] / $cant[2];}else{$total[2] = 0;}
            if($cant[3] != 0){$total[3] = $canti[3] / $cant[3];}else{$total[3] = 0;}
            if($cant[8] != 0){$total[8] = $canti[8] / $cant[8];}else{$total[8] = 0;} //cxpagar
            if($cant[9] != 0){$total[9] = $canti[9] / $cant[9];}else{$total[9] = 0;} //credito
            //if($cant[7] != 0){$total[7] = $canti[7] / $cant[7];}else{$total[7] = 0;} //inversion
            if($cant[10] != 0){$total[10] = $canti[10] / $cant[10];}else{$total[10] = 0;}
            if($cant[11] != 0){$total[11] = $canti[11] / $cant[11];}else{$total[11] = 0;}
            
            ?>
            <tr style="background-color:#575656">
                <td></td>
                <?php
                for ($i=0; $i < count($total); $i++) {
                    if($i==3){
                        //margen
                        ?>

                        <td style="color:white;font-weight: bold;"><div class="tooltip"><?php echo number_format($total[$i], 2, ',', '.') ?>
                        <span class="tooltiptext"><?php echo $categoria[$i] ?></span></div></td>

                        <?php
                    }else{
                        ?>
                        <td style="color:white;font-weight: bold;"><div class="tooltip"><?php echo number_format($total[$i], 0, ',', '.') ?>
                        <span class="tooltiptext"><?php echo $categoria[$i] ?></span></div></td>
                        
                        <?php
                    }
                    
                }
                ?> 
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td colspan="9"></td>
                <td><img src="../iconos/guardar.png" width="60px" height="60px" class="btn_guardar" id="enviar12_1" class="w3-btn" onclick="document.getElementById('respuesta12_1').style.display='block'" class="btn_icono"></td>
                <td></td>
            </tr>
        </table>
        </form>
        <br>
        </div>
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

    <div class="ventana" id="div_canvas" style="background:rgba(0, 0, 0, 0.8);"></div>

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

    
function guardar_r_operativos() {

    $.ajax({
        url:'../php/consulta12_1.php',
        type:'POST',
        data: $('#menu_ro').serialize(),
        success: function(res){
            $('#enviar12').trigger('click');
        },
        error: function(res){
            alert("Problemas al tratar de enviar el formulario");
        }
    });
}
function grafico_r_operativos(valor) {
    document.getElementById("name_ro").setAttribute('value',valor);
    $.ajax({
        url:'../php/grafica1.php',
        type:'POST',
        data: $('#menu_ro').serialize(),
        success: function(res){
            $('#div_canvas').html(res);
            document.getElementById('div_canvas').style.display='block';
        },
        error: function(res){
            alert("Problemas al tratar de enviar el formulario");
        }
    });
}

function grafico_r_operativosxmes(valor) {
    document.getElementById("mes_ro").setAttribute('value',valor);

    $.ajax({
        url:'../php/grafica2.php',
        type:'POST',
        data: $('#menu_ro').serialize(),
        success: function(res){
            $('#div_canvas').html(res);
            document.getElementById('div_canvas').style.display='block';
        },
        error: function(res){
            alert("Problemas al tratar de enviar el formulario");
        }
    });
}

$(function(){
    $('.comentario_inv').click(function(e){
        e.preventDefault();
        $(this).closest('td').find(".texto").toggle();
    });
});


var elements = document.getElementsByClassName("comentario_inv");

for (var i = 0, len = elements.length; i < len; i++) {
  elements[i].click();
}
</script>

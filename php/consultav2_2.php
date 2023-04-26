<script type="text/javascript" src="../js/funciones.js"></script>
<?php
require("../php/conexion.php");
    $conexion = conectar();                     //Obtenemos la conexion
?>
<script>
    document.getElementById('xcont_4_2').style.display='block';
</script>



<?php 
    $id_cuadre_caja = array();
    $descripcion_cuadre = array();
    $costo_cuadre = array();


    $consulta = mysqli_query($conexion, "SELECT * FROM `cuadre_caja` 
    WHERE `estado` = 'activo'") or die ("Error al update: presupuesto");


    while (($fila = mysqli_fetch_array($consulta))!=NULL){

        array_push($id_cuadre_caja ,$fila['id_cuadre_caja']);
        array_push($descripcion_cuadre ,$fila['descripcion_cuadre']);
        array_push($costo_cuadre ,$fila['costo_cuadre']);

    }
    mysqli_free_result($consulta);



    $id_pagos_caja = array();
    $descripcion_caja = array();
    $costo_pagos = array();


    $consulta = mysqli_query($conexion, "SELECT * FROM `pagos_caja` 
    WHERE `estado` = 'activo'") or die ("Error al update: presupuesto");


    while (($fila = mysqli_fetch_array($consulta))!=NULL){

        array_push($id_pagos_caja ,$fila['id_pagos_caja']);
        array_push($descripcion_caja ,$fila['descripcion_caja']);
        array_push($costo_pagos ,$fila['costo_pagos']);
    }
    mysqli_free_result($consulta);

?>
<div class="columna1" style="width: 100%;">
<div class="columna2" style="width: 30%; background-color:red;">
    <form id="form_cuadre_de_caja2" method="POST">
    <table class="tabla_sugerido" id="tabla_cuadre_caja">

        <tr style="border-radius:20px;">
            <th colspan="3" style="background-color:#182c63;">CUADRE CAJA</th>
        </tr>

        <tr>
            <td style="background-color:#244d77;color:white">Descripción</td>
            <td style="background-color:#244d77;color:white">Valor</td>
            <td style="background-color:#244d77;color:white"></td>
        </tr>
        
        <tbody id="contenido-tabla">

        <?php
        $total_cuadre = 0;
        $total_pagos  = 0;

        $contador1 = 0;
        for ($i=0; $i < count($id_cuadre_caja); $i++) { 
            $contador1++;
            ?>
            <tr>
            <input type="hidden" name="id_cuadre_caja[]" size="10" value="<?php echo $id_cuadre_caja[$i] ?>"/>
            <td><input type="text" name="descripcion_cuadre[]" size="10" value="<?php echo $descripcion_cuadre[$i] ?>"/></td>
            <td><input type="text" name="costo_cuadre[]" class="puntos" size="8" value="<?php echo number_format($costo_cuadre[$i], 0, ',', '.') ?>"/></td>

            <?php
            $total_cuadre += $costo_cuadre[$i];

            if($descripcion_cuadre[$i] == ''){
                ?>
                <td><input type="radio" name="eliminar[<?php echo $contador1 ?>]" value="activo" style="visibility:hidden;" checked>
                <input type="radio" name="eliminar[<?php echo $contador1 ?>]" value="eliminar" id="eliminarcuadre[<?php echo $contador1 ?>]" onchange="$('#enviarv2_7').trigger('click');" style="visibility:hidden;">
                <label class="w3-tbn w3-red btn-eliminar" for="eliminarcuadre[<?php echo $contador1 ?>]"><i class='fa fa-trash-o' style='font-size:16px;color:white'></i></label><br></td> 
                <?php
            }else{
                ?>
                <td><input type="radio" name="eliminar[<?php echo $contador1 ?>]" value="activo" style="visibility:hidden;" checked>
                <input type="radio" name="eliminar[<?php echo $contador1 ?>]" value="eliminar" id="eliminarcuadre[<?php echo $contador1 ?>]" style="visibility:hidden;" onchange="$('#enviarv2_7').trigger('click');"></td> 
                <?php
            }

            ?>

            </tr>
            <?php
        }
        ?>

        <tr>
            <td><button type="button" id="enviarv2_3" class="w3-btn" style="background-color:transparent"><i class="fa fa-plus-circle" style="font-size:24px;color:#305490"></i></button></td>
            <td><span id="total_cuadre1"><?php echo number_format($total_cuadre, 0, ',', '.') ?></span></td>
            <td><button type="button" id="enviarv2_4" class="w3-btn" style="background-color: #478248;color:white;display:none">Guardar</button></td>
        </tr>

        
        </tbody>
    </table>
    </form>


</div>


<div class="columna2" style="width: 30%;">
    <form id="form_pagos_de_caja2" method="POST">
    <table class="tabla_sugerido" id="tabla_pagos_de_caja">
        <thead>
            <tr>
            <th colspan="3" style="background-color:green;">PAGOS DE CAJA</th>
        </tr>
        </thead>
        <tr>
            <td style="background-color:#244d77;color:white">Descripción</td>
            <td style="background-color:#244d77;color:white">Valor</td>
            <td style="background-color:#244d77;color:white"></td>
        </tr>
        <tbody id="contenido-tabla">
        <?php

        $contador2 = 0;
        for ($i=0; $i < count($id_pagos_caja); $i++) { 
            $contador2++;
            ?>
            <tr>
            <input type="hidden" name="id_pagos_caja[]" size="10" value="<?php echo $id_pagos_caja[$i] ?>"/>
            <td><input type="text" name="descripcion_caja[]" size="10" value="<?php echo $descripcion_caja[$i] ?>"/></td>
            <td><input type="text" name="costo_pagos[]" class="puntos" size="8" value="<?php echo number_format($costo_pagos[$i], 0, ',', '.') ?>"/></td>

            <?php
            $total_pagos += $costo_pagos[$i];

            if($descripcion_caja[$i] == ''){
                ?>
                <td><input type="radio" name="eliminar[<?php echo $contador2 ?>]" value="activo" style="visibility:hidden;" checked>
                <input type="radio" name="eliminar[<?php echo $contador2 ?>]" value="eliminar" id="eliminarpagoscaja[<?php echo $contador2 ?>]" onchange="$('#enviarv2_7').trigger('click');" style="visibility:hidden;">
                <label class="w3-tbn w3-red btn-eliminar" for="eliminarpagoscaja[<?php echo $contador2 ?>]"><i class='fa fa-trash-o' style='font-size:16px;color:white'></i></label><br></td> 
                <?php
            }else{
                ?>
                <td><input type="radio" name="eliminar[<?php echo $contador2 ?>]" value="activo" style="visibility:hidden;" checked>
                <input type="radio" name="eliminar[<?php echo $contador2 ?>]" value="eliminar" id="eliminarpagoscaja[<?php echo $contador2 ?>]" style="visibility:hidden;" onchange="$('#enviarv2_7').trigger('click');"></td> 
                <?php
            }
            ?>

            </tr>
            <?php
        }
        ?>
        </tr>
        <tfoot>
        <tr>
            <td><button type="button" id="enviarv2_5" class="w3-btn" style="background-color:transparent"><i class="fa fa-plus-circle" style="font-size:24px;color:#305490"></i></button</td>
            <td><span id="total_cuadre2"><?php echo number_format($total_pagos, 0, ',', '.') ?></span></td>
            <td><button type="button" id="enviarv2_6" class="w3-btn" style="background-color: #478248;color:white;display:none">Guardar</button></td>
        </tr>
        </tfoot>
        </tbody>
    </table>
    <button type="button" id="enviarv2_7" class="w3-btn" style="background-color: #478248;color:white;" >Guardar</button>

</form>
<br>
<span style="background-color:black;color:white;padding:5px;font-size:32px;margin:5px">Resultado<br></span>

<span style="color:red;padding:5px;font-size:32px"><?php echo number_format($total_pagos-$total_cuadre, 0, ',', '.') ?></span>

</div>



<div class="columna2" style="width: 30%;">
<form id="guardar_ventas_diarias2" method="POST">
<table class="tabla_sugerido">
    <thead>
    <tr>
        <th colspan="4" style="background-color:orange;">EFECTIVO EN CAJA </th>

    </tr>
    </thead>
    <tr>
        <td style="background-color:#244d77;width:20%;color:white">Nominación</td>
        <td style="background-color:#244d77;width:20%;color:white">Valor</td>
        <td style="background-color:#244d77;width:20%;color:white">Cantidad</td>
        <td style="background-color:#244d77;width:40%;color:white">Total</td>
    </tr>
    <tfoot>
    <tr>
        <td colspan="2">Total efectivo</td>
        <td><button type="button" id="limpiar">Limpiar</button></td>
        <td><span id="total_cuadre3">0</span></td>
    </tr>
    <tr>
        <td colspan="4"><button type="button" id="enviarv2_8" class="w3-btn" style="background-color: #478248;color:white">Registrar venta diaria</button></td>
    </tr>
    </tfoot>
    <tbody id="tbodyform2">
    <tr>
        <td>Moneda</td>
        <td class="precio">50</td>
        <td class="precio2" style="display:none">50</td>
        <td><input type="text" name="cantidad_monedas[]" class="cantidad" size="5" onchange="multi3()" value="0"/></td>
        <td class="total3">0</td>
        <td class="total3_2" style="display:none">0</td>
    </tr>
    <tr>
        <td>Moneda</td>
        <td class="precio">100</td>
        <td class="precio2" style="display:none">100</td>
        <td><input type="text" name="cantidad_monedas[]" class="cantidad" size="5" onchange="multi3()" value="0"/></td>
        <td class="total3">0</td>
        <td class="total3_2" style="display:none">0</td>
    </tr>
    <tr>
        <td>Moneda</td>
        <td class="precio">200</td>
        <td class="precio2" style="display:none">200</td>
        <td><input type="text" name="cantidad_monedas[]" class="cantidad" size="5" onchange="multi3()" value="0"/></td>
        <td class="total3">0</td>
        <td class="total3_2" style="display:none">0</td>
    </tr>
    <tr>
        <td>Moneda</td>
        <td class="precio">500</td>
        <td class="precio2" style="display:none">500</td>
        <td><input type="text" name="cantidad_monedas[]" class="cantidad" size="5" onchange="multi3()" value="0"/></td>
        <td class="total3">0</td>
        <td class="total3_2" style="display:none">0</td>
    </tr>
    <tr>
        <td>Moneda</td>
        <td class="precio">1,000</td>
        <td class="precio2" style="display:none">1000</td>
        <td><input type="text" name="cantidad_monedas[]" class="cantidad" size="5" onchange="multi3()" value="0"/></td>
        <td class="total3">0</td>
        <td class="total3_2" style="display:none">0</td>
    </tr>
    <tr>
        <td>Billete</td>
        <td class="precio">2.000</td>
        <td class="precio2" style="display:none">2000</td>
        <td><input type="text" name="cantidad_monedas[]" class="cantidad" size="5" onchange="multi3()" value="0"/></td>
        <td class="total3">0</td>
        <td class="total3_2" style="display:none">0</td>
    </tr>
    <tr>
        <td>Billete</td>
        <td class="precio">5.000</td>
        <td class="precio2" style="display:none">5000</td>
        <td><input type="text" name="cantidad_monedas[]" class="cantidad" size="5" onchange="multi3()" value="0"/></td>
        <td class="total3">0</td>
        <td class="total3_2" style="display:none">0</td>
    </tr>
    <tr>
        <td>Billete</td>
        <td class="precio">10.000</td>
        <td class="precio2" style="display:none">10000</td>
        <td><input type="text" name="cantidad_monedas[]" class="cantidad" size="5" onchange="multi3()" value="0"/></td>
        <td class="total3">0</td>
        <td class="total3_2" style="display:none">0</td>
    </tr>
    <tr>
        <td>Billete</td>
        <td class="precio">20.000</td>
        <td class="precio2" style="display:none">20000</td>
        <td><input type="text" name="cantidad_monedas[]" class="cantidad" size="5" onchange="multi3()" value="0"/></td>
        <td class="total3">0</td>
        <td class="total3_2" style="display:none">0</td>
    </tr>
    <tr>
        <td>Billete</td>
        <td class="precio">50.000</td>
        <td class="precio2" style="display:none">50000</td>
        <td><input type="text" name="cantidad_monedas[]" class="cantidad" size="5" onchange="multi3()" value="0"/></td>
        <td class="total3">0</td>
        <td class="total3_2" style="display:none">0</td>
    </tr>
    <tr>
        <td>Billete</td>
        <td class="precio">100.000</td>
        <td class="precio2" style="display:none">100000</td>
        <td><input type="text" name="cantidad_monedas[]" class="cantidad" size="5" onchange="multi3()" value="0"/></td>
        <td class="total3">0</td>
        <td class="total3_2" style="display:none">0</td>
    </tr>
    
    </tbody>
</table>
</form>
</div>
</div>
<div id="rrr2"></div>
<script>
    $('#enviarv2_3').click(function(){
        $.ajax({
            url:'../php/consultav1_3.php',
            success: function(res){
                $('#entrar_cajapequenia').trigger('click');
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });

    $('#enviarv2_4').click(function(){
        $.ajax({
            url:'../php/consultav1_4.php',
            type:'POST',
            data: $('#form_cuadre_de_caja2').serialize(),
            success: function(res){

                //$('#rrr').html(res);
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });

    $('#enviarv2_5').click(function(){
        $.ajax({
            url:'../php/consultav1_5.php',
            success: function(res){
                $('#entrar_cajapequenia').trigger('click');
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });
    $('#enviarv2_6').click(function(){
        $.ajax({
            url:'../php/consultav1_6.php',
            type:'POST',
            data: $('#form_pagos_de_caja2').serialize(),
            success: function(res){

                //$('#rrr').html(res);
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });
    
    $('#enviarv2_7').click(function(){
        $('#enviarv2_6').trigger('click');
        $('#enviarv2_4').trigger('click'); 
        $.ajax({
            success: function(res){
                $('#entrar_cajapequenia').trigger('click');
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });
    //ventas diarias
    $('#enviarv2_8').click(function(){
        $.ajax({
            url:'../php/consultav1_8.php',
            type:'POST',
            data: $('#guardar_ventas_diarias2').serialize(),
            success: function(res){
                $('#rrr2').html(res);
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });
    
    $('#limpiar2').click(function(){
        $.ajax({
            success: function(res){
                $('#Enviarv2_4').trigger('click');
                $('#Enviarv2_6').trigger('click');
                $('#Enviarv2_2').trigger('click');
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });
</script>
<?php
?>
<style>
    .tabla_sugerido {
        border-radius: 1em;
        color: black;
    }
    tfoot {
        border-radius:20px;
        display:block  
    }
    thead {
        border-radius:20px;
        display:block  
    }
    .columna2:hover {
        opacity: 1.0;
        }
</style>
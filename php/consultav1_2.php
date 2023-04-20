<script type="text/javascript" src="../js/funciones.js"></script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion
?>
<script>
    document.getElementById('xcont_4_1').style.display='none';
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
<div class="recuadro" style="left:0%; width:30%">
    <form id="form_cuadre_de_caja" method="POST">
    <table class="tabla_sugerido" id="tabla_cuadre_caja">
        <tr>
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
                <td class="w3-btn w3-red"><input type="radio" name="eliminar[<?php echo $contador1 ?>]" value="activo" style="visibility:hidden;" checked>
                <input type="radio" name="eliminar[<?php echo $contador1 ?>]" value="eliminar" id="eliminar[<?php echo $contador1 ?>]" onchange="$('#enviarv1_7').trigger('click');">
                <label for="eliminar[<?php echo $contador1 ?>]">X</label><br></td> 
                <?php
            }else{
                ?>
                <td><input type="radio" name="eliminar[<?php echo $contador1 ?>]" value="activo" style="visibility:hidden;" checked>
                <input type="radio" name="eliminar[<?php echo $contador1 ?>]" value="eliminar" id="eliminar[<?php echo $contador1 ?>]" style="visibility:hidden;" onchange="$('#enviarv1_7').trigger('click');"></td> 
                <?php
            }

            ?>

            </tr>
            <?php
        }
        ?>

        <tr>
            <td><button type="button" id="enviarv1_3" class="w3-btn" style="background-color:transparent"><i class="fa fa-plus-circle" style="font-size:24px;color:#305490"></i></button></td>
            <td><span id="total_cuadre1"><?php echo number_format($total_cuadre, 0, ',', '.') ?></span></td>
            <td><button type="button" id="enviarv1_4" class="w3-btn" style="background-color: #478248;color:white;display:none">Guardar</button></td>
        </tr>
        </tbody>
    </table>
    </form>


</div>


<div class="recuadro" style="left:33%; width:30%">
    <form id="form_pagos_de_caja" method="POST">
    <table class="tabla_sugerido" id="tabla_pagos_de_caja">
        <tr>
            <th colspan="3" style="background-color:green;">PAGOS DE CAJA</th>
        </tr>
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
                <td class="w3-btn w3-red"><input type="radio" name="eliminar[<?php echo $contador2 ?>]" value="activo" style="visibility:hidden;" checked>
                <input type="radio" name="eliminar[<?php echo $contador2 ?>]" value="eliminar" id="eliminar[<?php echo $contador2 ?>]" onchange="$('#enviarv1_7').trigger('click');">
                <label for="eliminar[<?php echo $contador2 ?>]">X</label><br></td> 
                <?php
            }else{
                ?>
                <td><input type="radio" name="eliminar[<?php echo $contador2 ?>]" value="activo" style="visibility:hidden;" checked>
                <input type="radio" name="eliminar[<?php echo $contador2 ?>]" value="eliminar" id="eliminar[<?php echo $contador2 ?>]" style="visibility:hidden;" onchange="$('#enviarv1_7').trigger('click');"></td> 
                <?php
            }
            ?>

            </tr>
            <?php
        }
        ?>
        </tr>
            <tr>
                <td><button type="button" id="enviarv1_5" class="w3-btn" style="background-color:transparent"><i class="fa fa-plus-circle" style="font-size:24px;color:#305490"></i></button</td>
                <td><span id="total_cuadre2"><?php echo number_format($total_pagos, 0, ',', '.') ?></span></td>
                <td><button type="button" id="enviarv1_6" class="w3-btn" style="background-color: #478248;color:white;display:none">Guardar</button></td>
            </tr>
        </tbody>
    </table>
    <button type="button" id="enviarv1_7" class="w3-btn" style="background-color: #478248;color:white;" onclick="$('#enviarv1_6').trigger('click');$('#enviarv1_4').trigger('click');">Guardar</button>

</form>
<br>
<span style="background-color:black;color:white;padding:5px;font-size:32px;margin:5px">Resultado<br></span>

<span style="color:red;padding:5px;font-size:32px"><?php echo number_format($total_pagos-$total_cuadre, 0, ',', '.') ?></span>

</div>



<div class="recuadro" style="left:66%;width:34%;">
<form id="guardar_ventas_diarias" method="POST">
<table class="tabla_sugerido">
    <tr>
        <th colspan="4" style="background-color:orange;">EFECTIVO EN CAJA <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('respuesta_cuadre_caja').style.display='none'; document.getElementById('xcont_4_1').style.display='block';$('#enviarv1_6').trigger('click');$('#enviarv1_4').trigger('click');">X</a></th>

    </tr>
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
    </tfoot>
    <tbody id="tbodyform2">
    <tr>
        <td>Moneda</td>
        <td class="precio">50</td>
        <td class="precio2" style="display:none">50</td>
        <td><input type="text" class="cantidad puntos" size="5" onchange="multi3()" value="0"/></td>
        <td class="total3">0</td>
        <td class="total3_2" style="display:none">0</td>
    </tr>
    <tr>
        <td>Moneda</td>
        <td class="precio">100</td>
        <td class="precio2" style="display:none">100</td>
        <td><input type="text" class="cantidad" size="5" onchange="multi3()" value="0"/></td>
        <td class="total3">0</td>
        <td class="total3_2" style="display:none">0</td>
    </tr>
    <tr>
        <td>Moneda</td>
        <td class="precio">200</td>
        <td class="precio2" style="display:none">200</td>
        <td><input type="text" class="cantidad" size="5" onchange="multi3()" value="0"/></td>
        <td class="total3">0</td>
        <td class="total3_2" style="display:none">0</td>
    </tr>
    <tr>
        <td>Moneda</td>
        <td class="precio">500</td>
        <td class="precio2" style="display:none">500</td>
        <td><input type="text" class="cantidad" size="5" onchange="multi3()" value="0"/></td>
        <td class="total3">0</td>
        <td class="total3_2" style="display:none">0</td>
    </tr>
    <tr>
        <td>Moneda</td>
        <td class="precio">1,000</td>
        <td class="precio2" style="display:none">1000</td>
        <td><input type="text" class="cantidad" size="5" onchange="multi3()" value="0"/></td>
        <td class="total3">0</td>
        <td class="total3_2" style="display:none">0</td>
    </tr>
    <tr>
        <td>Billete</td>
        <td class="precio">2.000</td>
        <td class="precio2" style="display:none">2000</td>
        <td><input type="text" class="cantidad" size="5" onchange="multi3()" value="0"/></td>
        <td class="total3">0</td>
        <td class="total3_2" style="display:none">0</td>
    </tr>
    <tr>
        <td>Billete</td>
        <td class="precio">5.000</td>
        <td class="precio2" style="display:none">5000</td>
        <td><input type="text" class="cantidad" size="5" onchange="multi3()" value="0"/></td>
        <td class="total3">0</td>
        <td class="total3_2" style="display:none">0</td>
    </tr>
    <tr>
        <td>Billete</td>
        <td class="precio">10.000</td>
        <td class="precio2" style="display:none">10000</td>
        <td><input type="text" class="cantidad" size="5" onchange="multi3()" value="0"/></td>
        <td class="total3">0</td>
        <td class="total3_2" style="display:none">0</td>
    </tr>
    <tr>
        <td>Billete</td>
        <td class="precio">20.000</td>
        <td class="precio2" style="display:none">20000</td>
        <td><input type="text" class="cantidad" size="5" onchange="multi3()" value="0"/></td>
        <td class="total3">0</td>
        <td class="total3_2" style="display:none">0</td>
    </tr>
    <tr>
        <td>Billete</td>
        <td class="precio">50.000</td>
        <td class="precio2" style="display:none">50000</td>
        <td><input type="text" class="cantidad" size="5" onchange="multi3()" value="0"/></td>
        <td class="total3">0</td>
        <td class="total3_2" style="display:none">0</td>
    </tr>
    <tr>
        <td>Billete</td>
        <td class="precio">100.000</td>
        <td class="precio2" style="display:none">100000</td>
        <td><input type="text" class="cantidad" size="5" onchange="multi3()" value="0"/></td>
        <td class="total3">0</td>
        <td class="total3_2" style="display:none">0</td>
    </tr>
    </tbody>
</table>
</form>
</div>
<div id="rrr"></div>
<script>
    $('#enviarv1_3').click(function(){
        $.ajax({
            url:'../php/consultav1_3.php',
            success: function(res){
                $('#Enviarv1_2').trigger('click');
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });

    $('#enviarv1_4').click(function(){
        $.ajax({
            url:'../php/consultav1_4.php',
            type:'POST',
            data: $('#form_cuadre_de_caja').serialize(),
            success: function(res){
                //$('#Enviarv1_2').trigger('click');
                //$('#rrr').html(res);
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });

    $('#enviarv1_5').click(function(){
        $.ajax({
            url:'../php/consultav1_5.php',
            success: function(res){
                $('#Enviarv1_2').trigger('click');
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });
    $('#enviarv1_6').click(function(){
        $.ajax({
            url:'../php/consultav1_6.php',
            type:'POST',
            data: $('#form_pagos_de_caja').serialize(),
            success: function(res){
                //$('#Enviarv1_2').trigger('click');
                //$('#rrr').html(res);
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });
    
    $('#enviarv1_7').click(function(){
        $.ajax({
            success: function(res){
                $('#Enviarv1_4').trigger('click');
                $('#Enviarv1_6').trigger('click');
                $('#Enviarv1_2').trigger('click');
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });
    
    $('#limpiar').click(function(){
        $.ajax({
            success: function(res){
                $('#Enviarv1_4').trigger('click');
                $('#Enviarv1_6').trigger('click');
                $('#Enviarv1_2').trigger('click');
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });
</script>
<?php
?>
<script type="text/javascript" src="../js/funciones.js"></script>
<?php
require("../php/conexion.php");
    $conexion = conectar();                     //Obtenemos la conexion
?>
<script>
    document.getElementById('xcont_4_2').style.display='block';
</script>



<?php 
    //Capturamos el usuario
    $usuario      = $_POST['usuario'];


    $consulta = mysqli_query($conexion, "SELECT `id_pers` 
    FROM `personal` 
    WHERE `user_pers` = '$usuario'") or die ("Error al update: presupuesto");


    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $id_usuario = $fila['id_pers'];
    }
    mysqli_free_result($consulta);


    //Ahora verificamos si existe una caja para ese usuario
    $consulta = mysqli_query($conexion, "SELECT `id_cuadre_caja_completo` 
    FROM `cuadre_de_caja_completo` 
    WHERE `id_pers6` = '$id_usuario'") or die ("Error al update: presupuesto");

    $encontrado_caja_completa = false;
    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $id_cuadre_caja_completo = $fila['id_cuadre_caja_completo'];
        $encontrado_caja_completa = true;
    }
    mysqli_free_result($consulta);

    ////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////
    //Si existe continuamos
    if($encontrado_caja_completa == true){

        $id_cuadre_caja = array();
        $descripcion_cuadre = array();
        $costo_cuadre = array();


        $consulta = mysqli_query($conexion, "SELECT * FROM `cuadre_caja` 
        WHERE `estado` = 'activo' AND `id_cuadre_caja_completo1` = '$id_cuadre_caja_completo'") or die ("Error al update: presupuesto");


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
        WHERE `estado` = 'activo' AND `id_cuadre_caja_completo2` = '$id_cuadre_caja_completo'") or die ("Error al update: presupuesto");


        while (($fila = mysqli_fetch_array($consulta))!=NULL){

            array_push($id_pagos_caja ,$fila['id_pagos_caja']);
            array_push($descripcion_caja ,$fila['descripcion_caja']);
            array_push($costo_pagos ,$fila['costo_pagos']);
        }
        mysqli_free_result($consulta);

        //EFECTIVO EN CAJA
        $dinero = array();
        $monedas = array();
        $nominacion = array();
        $total_monedas = 0;

        $consulta = mysqli_query($conexion, "SELECT `moneda`,`efectivo_en_caja`,`nominacion` 
        FROM `efectivo_en_caja`
        WHERE `id_cuadre_caja_completo4` = '$id_cuadre_caja_completo'
        ORDER BY `id_efectivo_en_caja` ASC") or die ("Error al update: presupuesto");


        while (($fila = mysqli_fetch_array($consulta))!=NULL){

            array_push($dinero ,$fila['efectivo_en_caja']);
            array_push($monedas ,$fila['moneda']);
            array_push($nominacion ,$fila['nominacion']);
        }
        mysqli_free_result($consulta);

        //venta diaria
        $consulta = mysqli_query($conexion, "SELECT *
        FROM `venta_diaria`
        WHERE `id_cuadre_caja_completo3` = '$id_cuadre_caja_completo'") or die ("Error al update: presupuesto");


        while (($fila = mysqli_fetch_array($consulta))!=NULL){

            $venta_diaria = $fila['venta_diaria'];
        }
        mysqli_free_result($consulta);


        ?>
        <div class="columna1" style="width: 100%; background-color: #dddddd;">
        <div class="columna2" style="width: 30%;">
            <form id="form_cuadre_de_caja2" method="POST">
            <input type="hidden" name="id_cuadre_caja_completa" value="<?php echo $id_cuadre_caja_completo ?>"/>
            <table class="tabla_sugeridos" id="tabla_cuadre_caja">
        
  
            
            <tr>
                <td colspan="3" style="font-weight: bold;text-align: center">CUADRE CAJA</td>
            </tr>

            <tr>
                <td style="background-color:#4d4c4c;color:white">Descripción</td>
                <td style="background-color:#4d4c4c;color:white">Valor</td>
                <td style="background-color:#4d4c4c;color:white"></td>
            </tr>
            
            
            <tbody id="contenido-tabla">

            <?php
            $total_cuadre = 0;
            $total_pagos  = 0;

            $contador1 = 0;
            for ($i=0; $i < count($id_cuadre_caja); $i++) { 
                // Ignoramos la venta diaria final

                $contador1++;
                ?>
                <tr>
                <input type="hidden" name="id_cuadre_caja[]" size="10" value="<?php echo $id_cuadre_caja[$i] ?>"/>
                <td><input type="text" name="descripcion_cuadre[]" size="10" value="<?php echo ucfirst($descripcion_cuadre[$i]) ?>" onchange="$('#enviarv2_7').trigger('click');"/></td>
                <td><input type="text" name="costo_cuadre[]" class="puntos" size="8" value="<?php echo number_format($costo_cuadre[$i], 0, ',', '.') ?>" onchange="$('#enviarv2_7').trigger('click');"/></td>

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
            
        
            </tbody>

                <tr>
                    <td><button type="button" id="enviarv2_3" class="w3-btn" style="background-color:transparent"><i class="fa fa-plus-circle" style="font-size:24px;color:#305490"></i></button></td>
                    <td><span id="total_cuadre1" class="w3-btn"style="background-color: #305490;color:white;width:100%;"><?php echo number_format($total_cuadre, 0, ',', '.') ?></span></td>
                    <td><button type="button" id="enviarv2_4" class="w3-btn" style="background-color: #478248;color:white;display:none">Guardar</button></td>
                </tr>

            </table>
            </form>
            <br>
            <a class='columna2' style="background-color: #4a4a4a; height:auto;text-align: center;width:100%">
            <img src="../iconos/domicilios.png" id="enviarv2_1" width="60px" height="60px" onclick="document.getElementById('respuestav2_1').style.display='block'" class="icon_caja">
            <br>
            Crear Domicilio</a>

            <br>
            <br>
            <br>
            <br>
            <br>
        <form id="form_pagos_de_caja3" method="POST">
        <input type="hidden" name="id_cuadre_caja_completa" value="<?php echo $id_cuadre_caja_completo ?>"/>
        <?php

        for ($i=0; $i < count($dinero); $i++) { 
            $total_monedas += $dinero[$i]*$monedas[$i];
        }

        for ($i=0; $i < count($id_pagos_caja); $i++) { 
            $total_pagos += $costo_pagos[$i];
        }

        ?>

        <div class="formContent2"><h2 class="active"> Resultado </h2></div>

        <div id="formContent"><?php echo number_format(($total_pagos+$total_monedas)-($total_cuadre+$venta_diaria), 0, ',', '.') ?></div>

        <div class="formContent2 formContent3">Venta diaria: <input type="text" class="puntos" name="venta_diaria" value="<?php echo number_format($venta_diaria, 0, ',', '.') ?>" onchange="$('#enviarv2_7').trigger('click');"/></div>

        <button type="button" id="enviarv2_10" class="w3-btn" style="background-color: #478248;color:white;display:none">Guardar</button>


        </form>

        </div>


        <div class="columna2" style="width: 30%;">
            <form id="form_pagos_de_caja2" method="POST">
            <input type="hidden" name="id_cuadre_caja_completa" value="<?php echo $id_cuadre_caja_completo ?>"/>
            <table class="tabla_sugeridos" id="tabla_pagos_de_caja">

                <tr>
                    <td colspan="3" style="font-weight: bold;text-align: center">PAGOS DE CAJA</td>
                </tr>

                <tr>
                    <td style="background-color:#4d4c4c;color:white">Descripción</td>
                    <td style="background-color:#4d4c4c;color:white">Valor</td>
                    <td style="background-color:#4d4c4c;color:white"></td>
                </tr>
                <tbody id="contenido-tabla">
                <?php
                $total_pagos = 0;
                $contador2 = 0;
                for ($i=0; $i < count($id_pagos_caja); $i++) { 
                    $contador2++;
                    ?>
                    <tr>
                    <input type="hidden" name="id_pagos_caja[]" size="18" value="<?php echo $id_pagos_caja[$i] ?>"/>
                    <td class="letm"><input type="text" name="descripcion_caja[]" size="18" value="<?php echo ucfirst($descripcion_caja[$i]) ?>" onchange="$('#enviarv2_7').trigger('click');"/></td>
                    <td><input type="text" name="costo_pagos[]" class="puntos" size="8" value="<?php echo number_format($costo_pagos[$i], 0, ',', '.') ?>" onchange="$('#enviarv2_7').trigger('click');"/></td>

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
                    <td><span id="total_cuadre2" class="w3-btn"style="background-color: #305490;color:white;width:100%;"><?php echo number_format($total_pagos, 0, ',', '.') ?></span></td>
                    <td><button type="button" id="enviarv2_6" class="w3-btn" style="background-color: #478248;color:white;display:none">Guardar</button></td>

                    


                </tr>
                </tfoot>
                </tbody>
            </table>
            <br>
            <button type="button" id="enviarv2_7" class="w3-btn" style="background-color: #305490;color:white;" >Guardar</button>
            </form>

        <br>



        </div>

        </form>



        <div class="columna2" style="width: 30%;">
        <form id="guardar_ventas_diarias2" method="POST">
        <input type="hidden" name="id_cuadre_caja_completa" value="<?php echo $id_cuadre_caja_completo ?>"/>
        <table class="tabla_sugeridos">

            <tr>
                <td colspan="4" style="font-weight: bold;text-align: center">EFECTIVO EN CAJA </td>

            </tr>

            <tr>
                <td style="background-color:#4d4c4c;width:20%;color:white">Nominación</td>
                <td style="background-color:#4d4c4c;width:20%;color:white">Valor</td>
                <td style="background-color:#4d4c4c;width:20%;color:white">Cantidad</td>
                <td style="background-color:#4d4c4c;width:40%;color:white">Total</td>
            </tr>
            <tbody id="tbodyform2">
            
            <?php
            
            $total_monedas = 0;
            for ($i=0; $i < count($dinero); $i++) { 

                ?>
                <tr>
                    <td><?php echo ucfirst($nominacion[$i]) ?></td>
                    <td class="precio"><?php echo number_format($monedas[$i], 0, ',', '.') ?></td>
                    <td class="precio2" style="display:none"><?php echo $monedas[$i] ?></td>
                    <td><input type="text" name="cantidad_monedas[]" class="cantidad" size="5" onchange="multi3(); $('#enviarv2_7').trigger('click');" value="<?php echo $dinero[$i] ?>"/></td>
                    <td class="total3"><?php echo number_format($dinero[$i]*$monedas[$i], 0, ',', '.') ?></td>
                    <td class="total3_2" style="display:none"><?php echo $dinero[$i]*$monedas[$i] ?></td>
                </tr>

                <?php
                $total_monedas += $dinero[$i]*$monedas[$i];
            }
            ?>
            
            <tr>
                
            <td colspan="4"><button type="button" class="w3-btn" style="background-color: #305490;color:white; width:100%;">Total efectivo: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<span id="total_cuadre3" style="font-size: 20px;font-weight: bold;"><?php echo number_format($total_monedas, 0, ',', '.') ?></span></button></td>
                
            </tr>
            <tr>
                <td colspan="2"><button type="button" id="enviarv2_8" class="w3-btn" style="background-color: #305490;color:white">Registrar venta diaria</button></td>
                <td colspan="2"><button class="w3-btn" style="background-color: #305490;color:white;width:100%;" type="button" id="limpiar">Limpiar</button></td>
            </tr>
            <button type="button" id="enviarv2_9" class="w3-btn" style="background-color: #478248;color:white;display:none">Guardar</button>
            </tbody>
        </table>
        </form>
        </div>
        </div>
        <div id="respuestav2_1" style="backgroung-color:white;overflow-y: scroll;position:absolute; top:0;left:0;background:rgba(255, 255, 255, 0.4);width:100%;height: 100%;display:none;"></div>
        <div id="rrr2"></div>
        <?PHP
    }else{
        //Procedemos a crear el cuadre de caja con valores en blanco
        $consulta = mysqli_query($conexion, "INSERT INTO `cuadre_de_caja_completo`(`id_pers6`) 
        VALUES ('$id_usuario')") or die ("Error al update: presupuesto");

        //Ya creado capturamos su ID
        $consulta = mysqli_query($conexion, "SELECT `id_cuadre_caja_completo` 
        FROM `cuadre_de_caja_completo` 
        WHERE `id_pers6` = '$id_usuario'") or die ("Error al update: presupuesto");

        while (($fila = mysqli_fetch_array($consulta))!=NULL){
            $id_cuadre_caja_completo = $fila['id_cuadre_caja_completo'];
        }
        mysqli_free_result($consulta);

        //Ahora crearemos sus componentes individuales
        //  CUADRE_CAJA
        $consulta = mysqli_query($conexion, "INSERT INTO `cuadre_caja`(`id_cuadre_caja_completo1`, `descripcion_cuadre`, `costo_cuadre`, `estado`) 
        VALUES ('$id_cuadre_caja_completo','Base','0','activo')") or die ("Error al update: presupuesto");

        //  PAGOS_CAJA
        $consulta = mysqli_query($conexion, "INSERT INTO `pagos_caja`(`id_cuadre_caja_completo2`, `descripcion_caja`, `costo_pagos`, `estado`) 
        VALUES ('$id_cuadre_caja_completo',NULL,'0','activo')") or die ("Error al update: presupuesto");

        //  EFECTIVO_EN_CAJA
        //Aqui vamos a crear un registro por cada nominacion
        $monedas = array(50,100,200,500,1000,1000,2000,5000,10000,20000,50000,100000);
        $nominacion = array("Moneda","Moneda","Moneda","Moneda","Moneda","Billete","Billete","Billete","Billete","Billete","Billete","Billete");

        for ($i=0; $i < count($monedas); $i++) { 

            $consulta = mysqli_query($conexion, "INSERT INTO `efectivo_en_caja`(`id_cuadre_caja_completo4`, `moneda`, `nominacion`, `efectivo_en_caja`) 
            VALUES ('$id_cuadre_caja_completo','$monedas[$i]','$nominacion[$i]','0')") or die ("Error al update: presupuesto");
        }
        
        //  VENTA_DIARIA
        $consulta = mysqli_query($conexion, "INSERT INTO `venta_diaria`(`id_cuadre_caja_completo3`, `venta_diaria`) 
        VALUES ('$id_cuadre_caja_completo','0')") or die ("Error al update: presupuesto");
        ?>
        <script>$('#entrar_cajapequenia').trigger('click');</script>

        <?php
    }
    ?>
<script>
    $('#enviarv2_3').click(function(){
        $('#enviarv2_7').trigger('click');
        $.ajax({
            url:'../php/consultav1_3.php',
            type:'POST',
            data: $('#form_cuadre_de_caja2').serialize(),
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
        $('#enviarv2_7').trigger('click');
        $.ajax({
            url:'../php/consultav1_5.php',
            type:'POST',
            data: $('#form_pagos_de_caja2').serialize(),
            success: function(res){
                //$('#rrr2').html(res);
                //$('#entrar_cajapequenia').trigger('click');
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

                //$('#rrr2').html(res);
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });
    
    $('#enviarv2_7').click(function(){
        $('#enviarv2_6').trigger('click');
        $('#enviarv2_4').trigger('click'); 
        $('#enviarv2_9').trigger('click');
        $('#enviarv2_10').trigger('click');
        $.ajax({
            success: function(res){
                //$('#rrr2').html(res);
                $('#entrar_cajapequenia').trigger('click');
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });
    //ventas diarias al calendario
    $('#enviarv2_8').click(function(){
        $.ajax({
            url:'../php/consultav1_8.php',
            type:'POST',
            data: $('#form_pagos_de_caja3').serialize(),
            success: function(res){
                $('#enviarv2_7').trigger('click');
                //$('#rrr2').html(res);
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });
    //Guardar cuadre de caja
    $('#enviarv2_9').click(function(){
        $.ajax({
            url:'../php/consultav1_9.php',
            type:'POST',
            data: $('#guardar_ventas_diarias2').serialize(),
            success: function(res){
                //$('#rrr2').html(res);
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });
    
    $('#limpiar').click(function(){
        $.ajax({
            url:'../php/consultav1_10.php',
            success: function(res){
                $('#entrar_cajapequenia').trigger('click');
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });

    //Domicilios
    $('#enviarv2_1').click(function(){
        document.getElementById('xcont_4_2').style.display='none';
        $.ajax({
            url:'../php/consultav2_1.php',
            type:'POST',
            data: $('#usuario_caja2').serialize(),
            success: function(res){
                $('#respuestav2_1').html(res);
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });
    $('#enviarv2_10').click(function(){
        $.ajax({
            url:'../php/consultav1_11.php',
            type:'POST',
            data: $('#form_pagos_de_caja3').serialize(),
            success: function(res){

                //$('#rrr').html(res);
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

.tabla_sugeridos {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  font-size: 15px;
  border-radius: 0em;
  width: 100%;
  overflow:auto;
  background-color: white;
}

    .tabla_sugeridos td, .tabla_sugeridos th {
  border: 0px solid #ddd;
  padding: 4px;
}

.tabla_sugeridos tr:nth-child(even){background-color: #f2f2f2;}

.tabla_sugeridos tr:hover {background-color: #ddd;}

.tabla_sugeridos th {

  padding-top: 8px;
  text-align: left;
  background-color: #575656;
  color: white;
}

    .tabla_sugeridos {
        border-radius: 1em;
        color: black;
    }
    .columna2:hover {
        opacity: 1.0;
    }
    h2 {
        text-align: center;
        font-size: 5px;
        font-weight: 500;
        text-transform: uppercase;
        display:inline-block;
        margin: 30px 6px 8px 6px; 
        color: #cccccc;
    }



/* STRUCTURE */

.wrapper {
  display: flex;
  align-items: center;
  flex-direction: column; 
  justify-content: center;
  width: 100%;
  min-height: 100%;
  padding: 5px;
}

#formContent {
  /*-webkit-border-radius: 0px 0px 10px 10px;*/
  background: #fff;
  color:black;
  width: 100%;
  font-size: 30px;
  max-width: 450px;
  position: relative;
  padding: 0px;
  -webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
  box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
  text-align: center;
}

.formContent2 {
  -webkit-border-radius: 10px 10px 0px 0px;
  background-color: #4d4c4c;
  color: white;
  font-size: 16px;
  padding: 0px;
  width: 100%;
  max-width: 450px;
  position: relative;
  padding: 5px;
  -webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
  box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
  text-align: center;
}


.formContent3 {
  -webkit-border-radius: 0px 0px 10px 10px;
}

#formFooter {
  background-color: #f6f6f6;
  border-top: 1px solid #dce8f1;
  padding: 25px;
  text-align: center;
  -webkit-border-radius: 0 0 10px 10px;
  border-radius: 0 0 10px 10px;
}



/* TABS */

h2.inactive {
  color: #cccccc;
}

h2.active {
  color: white;
  font-size: 1.8em;
}




input[type=button]:active, input[type=submit]:active, input[type=reset]:active  {
  -moz-transform: scale(0.95);
  -webkit-transform: scale(0.95);
  -o-transform: scale(0.95);
  -ms-transform: scale(0.95);
  transform: scale(0.95);
}

table {
        border-collapse: collapse;
        border-radius: 30px;
        border-style: hidden; /* hide standard table (collapsed) border */
        box-shadow: 0 0 0 1px #666; /* this draws the table border  */ 
    }

    td {
        border: 1px solid #ccc;
    }
</style>
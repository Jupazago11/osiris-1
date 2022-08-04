<script type="text/javascript" src="../js/funciones.js"></script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion

    $usuario    = $_POST['usuario'];


    $consulta = mysqli_query($conexion, "SELECT `nombre_pers` 
    FROM `personal` 
    WHERE `user_pers` = '$usuario'") or die ("Error al update: presupuesto");

    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $nombre_pers = $fila['nombre_pers'];
    }
    mysqli_free_result($consulta);
    ?>
    <form id="form_domicilios_d" method="POST" style="display:none">
        <input type="text" name="usuario" value="<?php echo $usuario; ?>">
    </form> 

    <div class="venta_header">
        <form id="form_caja_v1_1" method="POST">
            <table class="tabla_sugerido" id="tabla_v1_1" border="1">
                <tr>
                    <th width="25%">Nombre</th>
                    <th width="15%">Proveedor</th>
                    <th width="15%">Costo</th>
                    <th width="20%">Cantidad</th>
                    <th width="15%">Total producto </th>
                    <th width="10%"><img src="../iconos/opciones.png" onclick="ocultar_menu_venta();" width="50px" height="50px"></th>
                </tr>
            </table>
    </div>
    <div class="venta_superior">
            <table style="font-size: 18px">
                <tbody id="tbodyform">
                <tr id="respuestav1_1" name="total">

                </tr>
                </tbody>
            </table>
            <div id="precio_total_v1_1">
            </div>
        </form>

    </div>
        
    <div class="venta_inferior" style="">
        <form id="form_ventas_v1_1" method="POST">
            <table border="0" class="tabla_sugerido" style="box-shadow: 3px 3px 5px 3px #999;">
                <tr>
                    <td width="33%" style="border-top-color: #dddddd;"><input type="text" id="codigo_producto_v1_1" name="codigo_producto_v1_1"></td>
                    <td width="33%"><button type="button" id="Enviarv1_1" class="w3-btn w3-teal">Consultar</button></td>
                    <th width="33%">Total: <span id="final_v1_1">0</span></th>
                </tr>
                <tr style="background-color:#dddddd">
                    <td><?php echo ucwords($nombre_pers) ?></td>
                    <td></td>
                    <td><img src="../iconos/domicilios.png" id="Enviard1_1" width="60px" height="60px"          onclick="document.getElementById('respuesta_domicilio').style.display='block'">
                        <img src="../iconos/caja-registradora.png" id="Enviarv1_2" width="60px" height="60px" onclick="document.getElementById('respuesta_cuadre_caja').style.display='block'"></td>
                </tr>
                <tr></tr>
            </table>
            
        </form>
    </div>
    <div id="venta_menu">
        <img src="../iconos/add-contact.png" id="Enviarcc1_1" width="60px" height="60px" onclick="document.getElementById('respuesta_crear_cliente').style.display='block'">
        <img src="../iconos/printer.png"     width="60px" height="60px">
        <img src="../iconos/presupuesto.png" width="60px" height="60px">
        <img src="../iconos/trash-bin.png"   width="60px" height="60px">
        <img src="../iconos/presupuesto.png" width="60px" height="60px"><br>
        <img src="../iconos/presupuesto.png" width="60px" height="60px">
        <img src="../iconos/presupuesto.png" width="60px" height="60px">
        <img src="../iconos/presupuesto.png" width="60px" height="60px">
        <img src="../iconos/presupuesto.png" width="60px" height="60px">
        <img src="../iconos/presupuesto.png" width="60px" height="60px">
    </div>

    <div id="respuesta_cuadre_caja" class="ventana">
    
    </div>
    <div id="respuesta_domicilio" class="ventana" style="background-color:white">
    
    </div>
    <div id="respuesta_crear_cliente" class="ventana">
    
    </div>


    <script>
        $('#Enviarv1_1').click(function(){
            $.ajax({
                url:'../PHP/consultav1_1.php',
                type:'POST',
                data: $('#form_ventas_v1_1').serialize(),
                success: function(res){
                    $('#respuestav1_1').append(res);   //Append para agregar nuevo
                },
                error: function(res){
                    alert("Problemas al tratar de enviar el formulario productos en facturación");
                }
            });
        });
        $('#Enviarv1_2').click(function(){
            $.ajax({
                url:'../PHP/consultav1_2.php',
                success: function(res){
                    $('#respuesta_cuadre_caja').html(res);
                },
                error: function(res){
                    alert("Problemas al mostrar cuadre de caja");
                }
            });
        });
        $('#Enviard1_1').click(function(){
            $.ajax({
                url:'../PHP/consultad1_1.php',
                type:'POST',
                data: $('#form_domicilios_d').serialize(),
                success: function(res){
                    $('#respuesta_domicilio').html(res);
                },
                error: function(res){
                    alert("Problemas al mostrar cuadre de caja");
                }
            });
        });
        $('#Enviarcc1_1').click(function(){
            $.ajax({
                url:'../PHP/consultacc1_1.php',
                success: function(res){
                    $('#respuesta_crear_cliente').html(res);
                },
                error: function(res){
                    alert("Problemas al mostrar cuadre de caja");
                }
            });
        });
    </script>

    <?php

    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
<script type="text/javascript" src="../js/funciones.js"></script>
<?php
require("../php/conexion.php");
    $conexion = conectar();                     //Obtenemos la conexion

    $usuario    = $_POST['usuario'];

    date_default_timezone_set('America/Bogota');
    $hoy = date("Y-m-d H:i:s");


    $consulta = mysqli_query($conexion, "SELECT `nombre_pers`, `id_pers` 
    FROM `personal` 
    WHERE `user_pers` = '$usuario'") or die ("Error al update: presupuesto");

    while(($fila = mysqli_fetch_array($consulta))!=NULL){
        $nombre_pers = $fila['nombre_pers'];
        $id_pers     = $fila['id_pers'];
    }
    mysqli_free_result($consulta);


    //verificaremos si ya existe una factura
    $existe_registro = false;

    $consulta = mysqli_query($conexion, "SELECT `id_facturacion` 
    FROM `factura` 
    WHERE `id_pers1` = '$id_pers' AND `estado` = 'activo'") or die ("Error al update: presupuesto");

    while(($fila = mysqli_fetch_array($consulta))!=NULL){
        $existe_registro = true;
        $id_facturacion  = $fila['id_facturacion'];
    }
    mysqli_free_result($consulta);


    if($existe_registro == true){

        ?>
        <form id="form_domicilios_d" method="POST" style="display:none">
            <input type="text" name="usuario" value="<?php echo $usuario; ?>">
        </form> 

        <div class="venta_header">
            
            <table class="tabla_sugerido" id="tabla_v1_1" border="1">
                <tr>
                    <th width="15%">Código</th>
                    <th width="25%">Producto</th>
                    <th width="15%">Costo</th>
                    <th width="20%">Cantidad</th>
                    <th width="15%">Total producto </th>
                    <th width="10%"></th>
                </tr>
            </table>
        </div>
        <div class="venta_superior">
            <form id="form_caja_v1_1" method="POST">
                <input type="hidden" name="id_facturacion" id="Nfactura2" value="<?php echo $id_facturacion ?>"/>
                <input type="hidden" name="id_pers" id="id_pers" value="<?php echo $id_pers ?>"/>
                <input type="hidden" name="nombre" id="copia1"/>
                <input type="hidden" name="cedula" id="copia2"/>
                <input type="hidden" name="tipo_pago" id="tipo_pago" value="contado"/>
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
            <form id="form_ventas_v1_1">
                <table border="0" class="tabla_sugerido" style="box-shadow: 3px 3px 5px 3px #999;">
                    <tr>
                        <td width="33%" style="border-top-color: #dddddd;" colspan="4"><input type="text" id="codigo_producto_v1_1" name="codigo_producto_v1_1" placeholder="Código"/>&nbsp;<button type="button" id="Enviarv1_1" class="w3-btn w3-teal">Consultar</button></td>
                        <td width="33%" colspan="4">
                            <table style="padding:0px; border:0px;">
                                <tr>
                                   <td><input type="text" name="nombre" id="texto1" placeholder="Nombre..."/></td> 
                                   <td><input type="text" name="cedula" id="texto2" placeholder="Identificación"/></td> 
                                </tr>
                            </table>
                        </td>
                        <th width="33%" colspan="4">Total: <span id="final_v1_1">0</span>
                        <br>
                        Factura: 
                        <input type="text" name="Nfactura" id="Nfactura" value="<?php echo $id_facturacion ?>" readonly style="background: transparent;border: none;color:white"/>
                
                        </th>
                    </tr>
                    <tr style="background-color:#dddddd; height:20%;font-size:12px;font-weight: normal;">
                        <th>
                            <label for="metodo_de_pago">Método de pago:</label>
                            <select name="metodo_de_pago" id="metodo_de_pago"  onchange="mandar_texto()">
                                <option value="contado">Contado</option>
                                <option value="credito">Crédito</option>
                                <option value="tarjeta">Tarjeta</option>
                            </select>
                            <img id="laImagen" width="60px" height="60px" src="../iconos/contado.png"/>
                        </th>

                        <th style="text-align: center;color:white">
                            <img src="../iconos/cuenta.png"            id="Enviarfactura1_1"     width="60px" height="60px" class="icon_caja">
                            <br>
                            Facturar
                        </th>
                        <th style="text-align: center;color:white">
                            <img src="../iconos/cuentaobs.png"         id="Enviarfacturaobs1_1"  width="60px" height="60px" class="icon_caja">
                            <br>
                            Ver facturas
                        </th>

                        <th style="text-align: center;color:white">
                            <img src="../iconos/factura_congelar.png"  id="Enviarcongelarc1_1"   width="60px" height="60px" class="icon_caja">
                            <br>
                            Congelar
                        </th>

                        <th style="text-align: center;color:white">
                            <img src="../iconos/factura_congelar2.png" id="Enviarccongeladas1_1" width="60px" height="60px" class="icon_caja">
                            <br>
                            Ver congeladas
                        </th>

                        <th style="text-align: center;color:white">
                            <img src="../iconos/add-contact.png"       id="Enviarcc1_1"          width="60px" height="60px" class="icon_caja">
                            <br>
                            Nuevo Cliente
                        </th>

                        <th style="text-align: center;color:white">
                            <img src="../iconos/add-contact2.png"      id="Enviarabonar1_1"      width="60px" height="60px" class="icon_caja">
                            <br>
                            Consultar clientes
                        </th>

                        <th style="text-align: center;color:white">
                            <img src="../iconos/trash-bin.png" width="60px" height="60px" onclick="$('#enviarv1').trigger('click');" class="icon_caja">
                            <br>
                            Lmpiar caja
                        </th>

                        <th style="text-align: center;color:white">
                            
                            
                            

                            <img src="../iconos/domicilios.png" id="Enviard1_1" width="60px" height="60px" onclick="document.getElementById('respuesta_domicilio').style.display='block'" class="icon_caja">
                            <br>
                            Crear Domicilio
                        </th>

                        <th style="text-align: center;color:white">
                            <img src="../iconos/ventas.png" id="Enviarv1_2" width="60px" height="60px" onclick="document.getElementById('respuesta_cuadre_caja').style.display='block'" class="icon_caja">
                            <br>
                            Cuadre de caja
                        </th>
                        <th>

                            <button type="button" id="Enviarccongeladas1_2" style="display:none"></button>
                            <button type="button" id="Enviarfacturaobs1_2" style="display:none"></button>
                            <input type="hidden" name="Nufactura" id="Nufactura"/>

                            Cajero(a):<br> <?php echo ucwords($nombre_pers) ?>
                        
                        </th>
                    </tr>
                    <tr></tr>
                </table>
                
            </form>
        </div>
        <div id="venta_menu">
            
        </div>

        <div id="respuesta_cuadre_caja"     class="ventana"></div>
        <div id="respuesta_domicilio"       class="ventana"></div>
        <div id="respuesta_crear_cliente"   class="ventana"></div>
        <div id="respuesta_congelar"        class="ventana"></div>
        <div id="respuesta_congeladas"      class="ventana"></div>
        <div id="respuesta_facturar"        class="ventana"></div>
        <div id="respuesta_facturarobs"     class="ventana"></div>
        <div id="respuesta_abonar"          class="ventana"></div>
        <div id="respuesta_probador"        class="ventana"></div>

        <?php


    }else{

        $consulta = mysqli_query($conexion, "INSERT INTO `factura`(`id_pers1`, `fecha`, `estado`) 
        VALUES ('$id_pers', '$hoy','activo')") or die ("Error al update: presupuesto");
        ?>

        <script>
            $('#enviarv1').trigger('click');
        </script>

        <?php
    }
    ?>
    <script>
        metodo_de_pago.addEventListener("change",()=>{
            laImagen.setAttribute("src","../iconos/" + metodo_de_pago.selectedOptions[0].value + ".png")
        })

        $('#Enviarv1_1').click(function(){
            $.ajax({
                url:'../php/consultav1_1.php',
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

        //cuadre de caja
        $('#Enviarv1_2').click(function(){
            $.ajax({
                url:'../php/consultav1_2.php',
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
                url:'../php/consultad1_1.php',
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
            document.getElementById('respuesta_crear_cliente').style.display='block';
            $.ajax({
                url:'../php/consultacc1_1.php',
                success: function(res){
                    $('#respuesta_crear_cliente').html(res);
                },
                error: function(res){
                    alert("Problemas al mostrar cuadre de caja");
                }
            });
        });

        $('#Enviarcongelarc1_1').click(function(){
            $.ajax({
                url:'../php/consultacongelarc1_1.php',
                type:'POST',
                data: $('#form_caja_v1_1').serialize(),
                success: function(res){
                    document.getElementById('respuesta_congelar').style.display='block';
                    $('#respuesta_congelar').html(res);
                    $('#venta_menu').trigger('click');
                },
                error: function(res){
                    alert("Problemas al mostrar cuadre de caja");
                }
            });
        });

        //ver cuentas congeladas
        $('#Enviarccongeladas1_1').click(function(){
            $.ajax({
                url:'../php/consultaccongeladas1_1.php',
                success: function(res){
                    document.getElementById('respuesta_congeladas').style.display='block';
                    $('#respuesta_congeladas').html(res);
                    ocultar_menu_venta();
                },
                error: function(res){
                    alert("Problemas al mostrar cuadre de caja");
                }
            });
        });

        //traer productos de la cuenta congelada
        $('#Enviarccongeladas1_2').click(function(){
            $.ajax({
                url:'../php/consultaccongeladas1_2.php',
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

        $('#Enviarfactura1_1').click(function(){
            $.ajax({
                url:'../php/consultafactura1_1.php',
                type:'POST',
                data: $('#form_caja_v1_1').serialize(),
                success: function(res){
                    document.getElementById('respuesta_facturar').style.display='block';
                    $('#respuesta_facturar').html(res);
                    ocultar_menu_venta();
                },
                error: function(res){
                    alert("Problemas al tratar de enviar el formulario productos en facturación");
                }
            });
        });

        $('#Enviarfacturaobs1_1').click(function(){
            $.ajax({
                url:'../php/consultafacturaobs1_1.php',
                success: function(res){
                    document.getElementById('respuesta_facturarobs').style.display='block';
                    $('#respuesta_facturarobs').html(res);
                    ocultar_menu_venta();
                },
                error: function(res){
                    alert("Problemas al tratar de enviar el formulario productos en facturación");
                }
            });
        });

        $('#Enviarfacturaobs1_2').click(function(){
            $.ajax({
                url:'../php/impresion2.php',
                //url:'../php/probador_mensajes.php',
                type:'POST',
                data: $('#form_ventas_v1_1').serialize(),
                success: function(res){
                    //$('#respuesta_probador').html(res);
                    document.getElementById('respuesta_facturarobs').style.display='none';
                    document.getElementById('xcont_factuobs1_1').style.display='none';
                    document.getElementById('xcont_4_1').style.display='block';
                },
                error: function(res){
                    alert("Problemas al tratar de enviar el formulario productos en facturación");
                }
            });
        });

        $('#Enviarabonar1_1').click(function(){
            $.ajax({
                url:'../php/consultaabonar1_1.php',
                success: function(res){
                    document.getElementById('respuesta_abonar').style.display='block';
                    $('#respuesta_abonar').html(res);
                    ocultar_menu_venta();
                },
                error: function(res){
                    alert("Problemas al tratar de enviar el formulario productos en facturación");
                }
            });
        });

        document.getElementById('codigo_producto_v1_1')
        .addEventListener('keyup', function(event) {
            if (event.code === 'Enter'){
            $('#Enviarv1_1').trigger('click');

            var inputNombre = document.getElementById("codigo_producto_v1_1");
            inputNombre.value = "";
            }
        });
    </script>

    <?php

    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>

<script>
    document.getElementById("texto1").addEventListener('keyup', autoCompleteNew);
    document.getElementById("texto2").addEventListener('keyup', autoCompleteNew2);

    function autoCompleteNew(e) {            
        var value = $(this).val();         
        $("#copia1").val(value); 
    }
    function autoCompleteNew2(e) {            
        var value = $(this).val();         
        $("#copia2").val(value); 
    }

    function mandar_texto() {
        var x = document.getElementById("metodo_de_pago").value;
        document.getElementById("tipo_pago").value = x;
    }
</script>
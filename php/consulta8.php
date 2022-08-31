<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion

?>
<form id="menu_productos_nuevo" method="POST"> 
    <table class="tabla_sugerido">
        <tr>
            <th colspan="2">Datos Básicos</th>
            <th colspan="3">Información Tributaria</th>
        </tr>
        <tr>
            <td>Categoría</td>
            <td></th>
            <select id="categorias" name="categorias">
            <option value="0"></option>

            <?php
                //Consulta a la base de datos en la tabla provvedor
                $consulta = mysqli_query($conexion, "SELECT `id_cat`, `categorias` 
                FROM `categoria` 
                WHERE `estado` = 'activo' 
                ORDER BY `categorias` ASC") or die ("Error al consultar: proveedores");

                while (($fila = mysqli_fetch_array($consulta))!=NULL){
                    // traemos los proveedores existentes en la base de datos
                    ?>
                    <option value="<?php echo $fila['id_cat'] ?>"><?php echo $fila['categorias'] ?></option>;
                    <?php
                }
                mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
            ?>
            </select>
            <img src="../iconos/plus.png" id="plus_cat" width="35px" height="35px" onclick="document.getElementById('form_categorias_prod').style.display='block';document.getElementById('xcont2_2').style.display='none'">
            </td>
            <td>Tarifas de IVA</td>
            <td><input type="text" size="2" id="t_iva" name="t_iva" onkeyup="utilidades()"/>%</td>
            <td></td>
        </tr>
        <tr>
            <td>Proveedor</td>
            <td></th>
            <select id="proveedores" name="proveedores">
            <option value="0"></option>
            <?php
                if(existencia_de_la_conexion()){
                    require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
                }
                $conexion = conectar();                     //Obtenemos la conexion
                
                //Consulta a la base de datos en la tabla provvedor
                $consulta = mysqli_query($conexion, "SELECT `id_proveedor`, `nombre_proveedor` 
                FROM `proveedor` 
                WHERE `estado` = 'activo' 
                ORDER BY `nombre_proveedor` ASC") or die ("Error al consultar: proveedores");

                while (($fila = mysqli_fetch_array($consulta))!=NULL){
                    // traemos los proveedores existentes en la base de datos

                    ?>
                    <option value="<?php echo $fila['id_proveedor'] ?>"><?php echo $fila['nombre_proveedor'] ?></option>;
                    <?php
                }
                mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
            ?>
            </select></td>
            <td>Clasificación de IVA</td>
            <td><input type="radio" id="civa1" name="clasi_iva" value="gravado" checked>
                    <label for="civa1">Gravado</label>
                <input type="radio" id="civa2" name="clasi_iva" value="incluido">
                    <label for="civa2">Incluido</label>
                <input type="radio" id="civa3" name="clasi_iva" value="excluido">
                    <label for="civa3">Excluido</label><br></td>
            <td></td>
        </tr>
        <tr>
            <td>Descripción</td>
            <td><input type="text" name="descripcion"/></td>
            <td>Costo del producto</td>
            <td><input type="text" id="precio_de_compra" name="precio_de_compra" onkeyup="utilidades()"/></td>
            <td></td>
        </tr>
        <tr>
            <td>Referencia</td>
            <td><input type="text" name="referencia"/></td>
            <td>Costo + Impuesto</td>
            <td><span id="cost_impu"></span></td>
            <td></td>
        </tr>
        <tr>
            <td>Código de barra</td>
            <td><input type="text" name="codigo_barras"/></td>
            <td>Flete</td>
            <td><input type="text" id="flete" name="flete" value="0" onkeyup="utilidades()"/></td>
            <td></td>
        </tr>
        <tr>
            <td>Control Inventario</td>
            <td><input type="radio" id="c1" name="control_inventario" value="si" checked>
                    <label for="c1">Si</label><br>
                <input type="radio" id="c2" name="control_inventario" value="no">
                    <label for="c2">No</label><br></td>
            <td>Utilidad estimada</td>
            <td><span id=""></span>%</td>
            <td></td>
        </tr>
        <tr>
            <td>Decimales en cantidad</td>
            <td><input type="radio" id="d1" name="decimales_en_cantidad" value="si" checked>
                    <label for="d1">Si</label><br>
                <input type="radio" id="d2" name="decimales_en_cantidad" value="no">
                    <label for="d2">No</label><br></td>



            <td>Venta 1<br><input type="text" id="venta1" name="venta1" value="0" onkeyup="utilidades()"/></td>
            <td>Venta 2<br><input type="text" id="venta2" name="venta2" value="0" onkeyup="utilidades()"/></td>
            <td>Venta 3<br><input type="text" id="venta3" name="venta3" value="0" onkeyup="utilidades()"/></td>
        </tr>
        <tr>
            <td>Días rotación</td>
            <td><input type="number" name="dias_rotacion" min="0" value="0"/></td>
        </tr>
        <tr>
            <td>Activo</td>
            <td><input type="radio" id="r1" name="estado" value="activo" checked>
                    <label for="r1">Activo</label><br>
                <input type="radio" id="r2" name="estado" value="inactivo">
                    <label for="r2">Inactivo</label><br></td>
            <td>Utilidad: <span id="utilidad1"></span>%</td>
            <td>Utilidad: <span id="utilidad2"></span>%</td>
            <td>Utilidad: <span id="utilidad3"></span>%</td>
        </tr>
        <tr>
            <td><img src="../iconos/black.png" id="enviar_modif_produ" width="60px" height="60px"></td>
            <td><img src="../iconos/box.png" id="enviar_crear_produ" width="60px" height="60px"></td>
            <td><img src="../iconos/black.png" id="enviar_busca_produ" width="60px" height="60px"></td>
        </tr>
    </table>
</form>



<div id="form_categorias_prod" style="position:absolute; top:0;left:0;background:rgba(255, 255, 255, 0.4);;width:100%;height: 100%;display:none;">

    <form id="actualizar_categorias" method="POST">
    <table class="tabla_sugerido" style="width:50%;border: 1px solid black; border-collapse: collapse;margin-left: auto;  margin-right: auto;background-color:white" >
        <tr>
            <th>Nombre</th>
            <th>Estado</th>
            <th><a class="w3-bar-item w3-button w3-hover-red active" onclick="document.getElementById('form_categorias_prod').style.display='none';document.getElementById('xcont2_2').style.display='block'">X</a></th>
        </tr>
    <?php

    $consulta = mysqli_query($conexion, "SELECT `id_cat`, `categorias`, `estado` 
    FROM `categoria` 
    WHERE `estado` != ''") or die ("Error al consultar: existencia del cargo");

    $contador = 0;
    
    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $contador++;
    ?>
    
        <tr>
            <input type="hidden" name="id_cat[]" value="<?php echo $fila['id_cat'] ?>"/>
            <td><input type="text" name="categorias[]" value="<?php echo $fila['categorias'] ?>"/></td>
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
            if($fila['categorias'] == ''){
                ?>
                <td class="w3-btn w3-red"><input type="radio" name="eliminar[<?php echo $contador ?>]" value="activo" style="visibility:hidden;" checked>
                <input type="radio" name="eliminar[<?php echo $contador ?>]" value="eliminar" id="eliminar[<?php echo $contador ?>]" onchange="$('#enviar8_2').trigger('click');">
                <label for="eliminar[<?php echo $contador ?>]">X</label><br></td> 
                <?php
            }else{
                ?>
                <td><input type="radio" name="eliminar[<?php echo $contador ?>]" value="activo" style="visibility:hidden;" checked>
                <input type="radio" name="eliminar[<?php echo $contador ?>]" value="eliminar" id="eliminar[<?php echo $contador ?>]" style="visibility:hidden;" onchange="$('#enviar8_2').trigger('click');"></td> 
                <?php
            }
            ?>
        </tr>
    <?php
    }
    ?>
        <tr>
            <td><button type="button" id="enviar8_1" class="w3-btn"><i class="fa fa-plus-circle" style="font-size:24px;color:#305490"></i></button></td>
            <td><button type="button" id="enviar8_2" class="w3-btn" style="background-color: #478248;color:white;">Guardar <i class='fas fa-edit' style='font-size:24px;color:white'></button></td>
            <td></td>
        </tr>

    </table>
    </form>
</div>

<div id="respuesta8_1" style="display:none;" class="ventana"></div>

<script>
    //crear nueva categoria
    $('#enviar8_1').click(function(){
        $.ajax({
            url:'../php/consulta8_1.php',
            success: function(res){
                $('#respuesta8_1').html(res);
                $('#enviar8').trigger('click');
                $('#plus_cat').trigger('click');
                document.getElementById('xcont2_2').style.display='block';
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });

    // Guardar nueva catrgoria
    $('#enviar8_2').click(function(){
        $.ajax({
            url:'../php/consulta8_2.php',
            type:'POST',
            data: $('#actualizar_categorias').serialize(),
            success: function(res){
                $('#respuesta8_1').html(res);
                $('#enviar8').trigger('click');
                $('#plus_cat').trigger('click');
                document.getElementById('xcont2_2').style.display='block';
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });

    // Crear nuevo producto
    $('#enviar_crear_produ').click(function(){
        $.ajax({
            url:'../php/consulta8_3.php',
            type:'POST',
            data: $('#menu_productos_nuevo').serialize(),
            success: function(res){
                $('#respuesta8_1').html(res);
                $('#enviar8').trigger('click');
                //document.getElementById('respuesta8_1').style.display='block';
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });

    // Ver productos
    $('#enviar_busca_produ').click(function(){
        $.ajax({
            url:'../php/consulta8_4.php',
            success: function(res){
                $('#respuesta8_1').html(res);
                //$('#enviar8').trigger('click');
                document.getElementById('respuesta8_1').style.display='block';
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });
</script>
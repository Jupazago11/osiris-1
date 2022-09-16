<script type="text/javascript" src="../js/funciones.js"></script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion

    $nombre_usuario = strval($_POST['usuario']);//obtenemos el nombre del proveedor seleccionado


    //Consulta a la base de datos en la tabla proveedor
    $consulta = mysqli_query($conexion, "SELECT * FROM `proveedor` WHERE `estado` != ''") or die ("Error al consultar: existencia del proveedor");

?>
    
    <form id="actualizar_proveedores" method="POST">
    

    <table class="tabla_sugerido" id="myTable2" style="font-size:16px">
    <tr>
        <th>#</th>
        <th>Proveedor</th>
        <th>Dirección</th>
        <th>Contacto</th>
        <th>Nombre del Vendedor</th>
        <th>Teléfono</th>
        <th>Estado</th>
        <th></th>
    </tr>
    <?php


    $contador = 0;

    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $contador++;
        ?>
        <tr id="<?php echo $contador ?>">
            <td><?php echo $contador ?></td>
                <input type="hidden" name="id_proveedor[]" value="<?php echo $fila['id_proveedor'] ?>"/>
            <td class="row-data"><input type="text" name="nombres[]" size="15" value="<?php echo $fila['nombre_proveedor'] ?>"/></td>
            <td><input type="text" name="direcciones[]" size="15" value="<?php echo $fila['direccion_proveedor'] ?>"/></td>   
            <td><input type="text" name="contactos[]" size="15" value="<?php echo $fila['contacto_proveedor'] ?>"/></td>    
            <td><input type="text" name="vendedores[]" size="15" value="<?php echo $fila['nom_vendedor'] ?>"/></td>    
            <td><input type="text" name="telefonos[]" size="15" value="<?php echo $fila['telefono_vendedor'] ?>"/></td>  
             
            <td>
            <?php
            if($fila['estado'] == "activo"){
                ?>
                <input type="radio" name="estado[<?php echo $contador ?>]" value="activo" checked>
                    Activo
                <input type="radio" name="estado[<?php echo $contador ?>]" value="inactivo">
                    Inactivo<br></td> 
                <?php
            }elseif($fila['estado'] == "inactivo"){
                ?>
                <input type="radio" name="estado[<?php echo $contador ?>]" value="activo">
                    Activo
                <input type="radio" name="estado[<?php echo $contador ?>]" value="inactivo" checked>
                    Inactivo<br></td> 
                <?php
            }
            if($fila['nombre_proveedor'] == ''){
                ?>
                <td class="w3-btn w3-red"><input type="radio" name="eliminar[<?php echo $contador ?>]" value="activo" style="visibility:hidden;" checked>
                <input type="radio" name="eliminar[<?php echo $contador ?>]" value="eliminar" id="eliminar[<?php echo $contador ?>]" onchange="$('#enviar7_5').trigger('click');">
                <label for="eliminar[<?php echo $contador ?>]">X</label><br></td> 
                <?php
            }else{
                ?>
                <td><input type="radio" name="eliminar[<?php echo $contador ?>]" value="activo" style="visibility:hidden;" checked>
                <input type="radio" name="eliminar[<?php echo $contador ?>]" value="eliminar" id="eliminar[<?php echo $contador ?>]" style="visibility:hidden;" onchange="$('#enviar7_5').trigger('click');">
                <?php /* ?><input type="button"  value="Continuar" onclick="show2()"/><?php */ ?></td> 
                <?php
            }

            ?>
            </tr>
            <?php
    }
    mysqli_free_result($consulta);
    ?> 
    <tr>
        <td></td>
        <td><button type="button" id="enviar7_3" class="w3-btn" style="background-color: transparent;"><i class="fa fa-plus-circle" style="font-size:24px;color:#305490"></i></button></td>
        <td></td>
        
        <td colspan="3"></td>
        <td><img src="../iconos/guardar.png" width="60px" height="60px" class="btn_icono" id="enviar7_2" class="w3-btn" onclick="document.getElementById('respuesta7_2').style.display='block'" class="btn_icono"></td>
        <td></td>
    </tr>
    </table>

    
    <button type="button" id="enviar7_5" class="w3-btn w3-red"  style="visibility:hidden;" onclick="document.getElementById('respuesta7_2').style.display='block'">Ver Proveedores</button>
    </form>

    

    <div id="respuesta7_2"></div>
    <div id="respuesta7_6" style="position:absolute; top:0;left:0;background:rgba(255, 255, 255, 0.4);;width:100%;height: 100%;display:none;">

    


    </div>

    <script>
    $('#enviar7_2').click(function(){
        $.ajax({
            url:'../php/consulta7_2.php',
            type:'POST',
            data: $('#actualizar_proveedores').serialize(),
            success: function(res){
                Swal.fire(
                '¡Muy bien!',
                'Guardado Exitoso',
                'success'
                )
                $('#enviar7_1').trigger('click');
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });
    $('#enviar7_5').click(function(){
        $.ajax({
            url:'../php/consulta7_2.php',
            type:'POST',
            data: $('#actualizar_proveedores').serialize(),
            success: function(res){
                $('#enviar7_1').trigger('click');
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });
    $('#enviar7_3').click(function(){
        $.ajax({
            url:'../php/consulta7_3.php',
            success: function(res){
                $('#respuesta7_3').html(res);
                $('#enviar7_1').trigger('click');
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });
    $('#enviar7_6').click(function(){
        $.ajax({
            url:'../php/consulta7_6.php',
            type:'POST',
            data: $('#actualizar_proveedores2').serialize(),
            success: function(res){
                $('#respuesta7_6').html(res);
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });

    </script>
    <?php
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
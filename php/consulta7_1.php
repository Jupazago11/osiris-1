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
<input type="text" id="myInput2" onkeyup="myFunctionTabla2()" placeholder="Nombrel del proveedor.." title="Type in a name">
    <form id="actualizar_proveedores" method="POST">
    

    <table id="myTable2">
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
            <td class="row-data"><input type="text" name="nombres[]" size="10" value="<?php echo $fila['nombre_proveedor'] ?>"/></td>
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
                <input type="radio" name="eliminar[<?php echo $contador ?>]" value="eliminar" id="eliminar[<?php echo $contador ?>]" style="visibility:hidden;" onchange="$('#enviar7_5').trigger('click');"><input type="button"  value="Continuar" onclick="show2()"/></td> 
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
        <td><button type="button" id="enviar7_3" class="w3-btn"><i class="fa fa-plus-circle" style="font-size:24px;color:#305490"></i></button></td>
        <td></td>
        <td><button type="button" id="enviar7_2" class="w3-btn w3-green" onclick="document.getElementById('respuesta7_2').style.display='block'">Guardar <i class='fas fa-edit' style='font-size:24px;color:white'></td>
        <td colspan="5"></td>
    </tr>
    </table>
    <button type="button" id="enviar7_5" class="w3-btn w3-red"  style="visibility:hidden;" onclick="document.getElementById('respuesta7_2').style.display='block'">Ver Proveedores</button>
    </form>

    <br>
    <form id="actualizar_proveedores2" method="POST">
        <input type="hidden" name="nombre" id="prove_sugerido2"/>
        <input type="hidden" name="usuario" value="<?php echo $nombre_usuario ?>"/>
        <button type="button" id="enviar7_6" class="w3-btn w3-green" onclick="document.getElementById('respuesta7_6').style.display='block'">Continuar <i class='fas fa-edit' style='font-size:24px;color:white' style="visibility:hidden;"></i></button>
    </form>

    

    <div id="respuesta7_2"></div>
    <div id="respuesta7_6"></div>

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
    <style>

#myInput2 {
background-image: url('/css/searchicon.png');
background-position: 10px 10px;
background-repeat: no-repeat;
width: 90%;
font-size: 16px;
padding: 12px 20px 12px 40px;
border: 1px solid #ddd;
margin-bottom: 12px;
}

#myTable2 {
border-collapse: collapse;
width: 100%;
border: 1px solid #ddd;
font-size: 18px;
}

#myTable2 th, #myTable td {
text-align: left;
padding: 12px;
}

#myTable2 tr {
border-bottom: 1px solid #ddd;
}

#myTable2 tr.header, #myTable2 tr:hover {
background-color: #f1f1f1;
}
</style>

    <?php
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
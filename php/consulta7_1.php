<script type="text/javascript" src="../js/funciones.js"></script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion

    //Consulta a la base de datos en la tabla proveedor
    $consulta = mysqli_query($conexion, "SELECT * FROM `proveedor` WHERE `estado` != ''") or die ("Error al consultar: existencia del proveedor");

?>
    <form id="actualizar_proveedores" method="POST">
    <table id="tabla_sugerido" width="100%" style="display: block;overflow: auto;width: 100%;">
    <tr>
        <th>#</th>
        <th>Proveedor</th>
        <th>Dirección</th>
        <th>Contacto</th>
        <th>Nombre del Vendedor</th>
        <th>Teléfono</th>
        <th>Estado</th>
    </tr>
    <?php


    $contador = 0;

    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $contador++;
        ?>
        <tr>
            <tbody>
            <td><?php echo $contador ?></td>
            <td><input type="text" name="nombres[]" readonly value="<?php echo $fila['nombre_proveedor'] ?>"/></td>
            <td><input type="text" name="direcciones[]" value="<?php echo $fila['direccion_proveedor'] ?>"/></td>   
            <td><input type="text" name="contactos[]" value="<?php echo $fila['contacto_proveedor'] ?>"/></td>    
            <td><input type="text" name="vendedores[]" value="<?php echo $fila['nom_vendedor'] ?>"/></td>    
            <td><input type="text" name="telefonos[]" value="<?php echo $fila['telefono_vendedor'] ?>"/></td>    
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
            
    }
    ?> 
    <tr>
        <td colspan="3"></td>
        <td><button type="button" id="enviar7_2" class="w3-btn w3-green" onclick="document.getElementById('respuesta7_2').style.display='block'">Guardar <i class='fas fa-edit' style='font-size:24px;color:white'></td>
        <td colspan="3"></td>
    </tr>
    </table>
    </form>
    <br>

    <div id="respuesta7_2"></div>

    <script>
    $('#enviar7_2').click(function(){
        $.ajax({
            url:'../php/consulta7_2.php',
            type:'POST',
            data: $('#actualizar_proveedores').serialize(),
            success: function(res){
                $('#respuesta7_2').html(res);
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
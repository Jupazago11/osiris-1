<script type="text/javascript" src="../js/funciones.js"></script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion

    date_default_timezone_set('America/Bogota');
    $fecha        = date('Y-m-d', time());

    ?>
    <form id="actualizar_personal3" method="POST">
    <table class="tabla_sugerido">
        <tr>
            <th colspan="9" style="text-align: center;"><h3>Datos</h3></th>
        <tr>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Celular</th>
            <th>E-mail</th>
            <th>Nivel de acceso</th>
            <th>Usuario</th>
            <th>Contraseña</th>
            <th></th>
        </tr>
        <tr>
            <?php
            $contador = 0;
            $consulta = mysqli_query($conexion, "SELECT * FROM `personal` 
            INNER JOIN `cargo` ON personal.cargo = cargo.id_cargo 
            WHERE personal.estado = 'activo' AND personal.tipo_usuario_pers != '5' AND personal.tipo_usuario_pers != '6'
            ORDER BY personal.id_pers ASC") or die ("Error al consultar: existencia del proveedor");

            while (($fila = mysqli_fetch_array($consulta))!=NULL){
                $contador++;
                ?>
                <tr>
                    <input type="hidden" name="id_pers[]" value="<?php echo $fila['id_pers'] ?>"/>
                    <td><?php echo $contador ?></td>
                    <td><input type="text" name="nombre_pers[]" value="<?php echo $fila['nombre_pers'] ?>"/></td>
                    <td><input type="text" name="celular_pers[]" value="<?php echo $fila['celular_pers'] ?>"/></td>
                    <td><input type="text" name="correo_pers[]" value="<?php echo $fila['correo_pers'] ?>"/></td>
                    <td>
                    <?php
                    if($fila['tipo_usuario_pers'] != '' ){
                        echo "<input list='lvl_accs' name='lvl_acc[]' id='lvl_acc' value='".$fila['tipo_usuario_pers']."'>";
                    }else{
                        echo "<input list='lvl_accs' name='lvl_acc[]' id='lvl_acc'>";
                    }

                    ?>
                        <datalist id="lvl_accs">
                            <option value="1">Administrador</option>
                            <option value="2">Empleado entendido</option>
                            <option value="3">Empleado</option>
                            <option value="4">Domiciliario</option>
                        </datalist>
                    </td>
                    <td><input type="text" name="user_pers[]" size="8" value="<?php echo $fila['user_pers'] ?>"/></td>
                    <td><input type="text" name="pass_pers[]" size="8" value="<?php echo $fila['pass_pers'] ?>"/></td>
                    <?php
                    if($fila['nombre_pers'] == '' || $fila['nombre_pers'] == NULL){
                        ?>
                        <td class="w3-btn w3-red"><input type="radio" name="eliminar[<?php echo $contador ?>]" value="activo" style="visibility:hidden;" checked>
                        <input type="radio" name="eliminar[<?php echo $contador ?>]" value="eliminar" id="eliminar[<?php echo $contador ?>]" onchange="$('#enviar9_6').trigger('click');">
                        <label for="eliminar[<?php echo $contador ?>]">X</label><br></td> 
                        <?php
                    }else{
                        ?>
                        <td><input type="radio" name="eliminar[<?php echo $contador ?>]" value="activo" style="visibility:hidden;" checked>
                        <input type="radio" name="eliminar[<?php echo $contador ?>]" value="eliminar" id="eliminar[<?php echo $contador ?>]" style="visibility:hidden;" onchange="$('#enviar9_6').trigger('click');"></td> 
                        <?php
                    }
                    ?>
                    
            <?php
            }
            mysqli_free_result($consulta);
            ?>
        </tr>
        <tr>
            <td></td>
            <td><button type="button" id="enviar9_4_3" class="w3-btn" style="background-color: transparent;"><i class="fa fa-plus-circle" style="font-size:24px;color:#305490"></i></button></td>
            <td colspan="4"></td>
            <td><img src="../iconos/guardar.png" width="60px" height="60px" id="enviar9_6" onclick="document.getElementById('respuesta9_6').style.display='block'" class="btn_icono"></td>
            <td></td>
        </tr>
    </table>
    </form>
    <div id="respuesta9_6" style="display:none;"></div>

<script>
$('#enviar9_6').click(function(){
    $.ajax({
        url:'../php/consulta9_6.php',
        type:'POST',
        data: $('#actualizar_personal3').serialize(),
        success: function(res){
            Swal.fire(
            '¡Muy bien!',
            'Guardado Exitoso',
            'success'
            )
            $('#respuesta9_6').html(res);
            $('#enviar9_3').trigger('click');
        },
        error: function(res){
            alert("Problemas al tratar de enviar el formulario");
        }
    });
});
$('#enviar9_4_3').click(function(){
    $.ajax({
        url:'../php/consulta9_4.php',
        success: function(res){
            $('#enviar9_3').trigger('click');
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
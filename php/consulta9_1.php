<script type="text/javascript" src="../js/funciones.js"></script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion

    $consulta = mysqli_query($conexion, "SELECT * FROM `personal` 
    WHERE (`tipo_usuario_pers` = '1' OR `tipo_usuario_pers` = '2' OR `tipo_usuario_pers` = '3' OR `tipo_usuario_pers` = '4') AND `estado`!=''") or die ("Error al consultar: existencia del proveedor");



    ?>
    <form id="actualizar_personal" method="POST">
    <table id="tabla_sugerido" width="100%" style="display: block;overflow: auto;width: 100%;">
    
    <?php

    $contador = 0;
    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $contador++;
        
        ?>
        <input type="hidden" name="id_pers[]" value="<?php echo $fila['id_pers'] ?>"/>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Identificación</th>
            <th>Usuario</th>
            <th>Contraseña</th>
            <th>Nivel</th>
            <th>Fecha de nacimiento</th>
            <th>Inicio de contrato</th>
            <th>Tiempo</th>
            
        </tr>
        <tr>
            <tbody>
            <td><?php echo $contador ?></td>
            <td><input type="text" name="nombre_pers[]" value="<?php echo $fila['nombre_pers'] ?>"/></td>
            <td><input type="text" name="identificacion_pers[]" size="10" value="<?php echo $fila['identificacion_pers'] ?>"/></td>   
            <td><input type="text" name="user_pers[]" size="10" value="<?php echo $fila['user_pers'] ?>"/></td>    
            <td><input type="text" name="pass_pers[]" size="10" value="<?php echo $fila['pass_pers'] ?>"/></td>    
            <td><input type="text" name="tipo_usuario_pers[]" size="1" value="<?php echo $fila['tipo_usuario_pers'] ?>"/></td>    
            <td><input type="text" name="fecha_nacimiento_pers[]" size="10" value="<?php echo $fila['fecha_nacimiento_pers'] ?>"/></td>    
            <td><input type="text" name="fecha_inicio_contrato_pers[]" size="10" value="<?php echo $fila['fecha_inicio_contrato_pers'] ?>"/></td>    
            <td><input type="text" name="tipo_contrato_pers[]" size="1" value="<?php echo $fila['tipo_contrato_pers'] ?>"/> Meses</td>    
            
        </tr>
        <tr>
            <td></td>
            <th>Cargo</th>
            <th>Salario</th>
            <th>EPS</th>
            <th>ARL</th>
            <th></th>
            <th>Caja de compensación</th>
            <th>Pensión</th>
            <th>Estado</th>
        </tr>
        <tr>   
            <td></td> 
            <td><input type="text" name="cargo[]" value="<?php echo $fila['cargo'] ?>"/></td>    
            <td><input type="text" name="salario_pers[]" size="10" value="<?php echo $fila['salario_pers'] ?>"/></td>    
            <td><input type="text" name="eps[]" size="10" value="<?php echo $fila['eps'] ?>"/></td>    
            <td><input type="text" name="arl[]" size="10" value="<?php echo $fila['arl'] ?>"/></td> 
            <td></td>    
            <td><input type="text" name="caja_compensacion[]" size="10" value="<?php echo $fila['caja_compensacion'] ?>"/></td>    
            <td><input type="text" name="pension[]" size="10" value="<?php echo $fila['pension'] ?>"/></td>    
            <?php
            if($fila['estado'] == "activo"){
                ?>
                <td><input type="radio" name="estado[<?php echo $contador ?>]" value="activo" checked>
                    Activo<br>
                <input type="radio" name="estado[<?php echo $contador ?>]" value="inactivo">
                    Inactivo<br></td> 
                <?php
            }elseif($fila['estado'] == "inactivo"){
                ?>
                <td><input type="radio" name="estado[<?php echo $contador ?>]" value="activo">
                    Activo<br>
                <input type="radio" name="estado[<?php echo $contador ?>]" value="inactivo" checked>
                    Inactivo<br></td> 
                <?php
            }
    }
    ?>
    </tr>
    <tr>
        <td colspan="4"></td>
        <td><button type="button" id="enviar9_2" class="w3-btn" style="background-color: #478248;color:white" onclick="document.getElementById('respuesta9_2').style.display='block'">Guardar <i class='fas fa-edit' style='font-size:24px;color:white'></td>
        <td colspan="4"></td>
    </tr>
    </table>
    </form>
    <br>
    <div id="respuesta9_2"></div>
    <script>
    $('#enviar9_2').click(function(){
        $.ajax({
            url:'../php/consulta9_2.php',
            type:'POST',
            data: $('#actualizar_personal').serialize(),
            success: function(res){
                $('#respuesta9_2').html(res);
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
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

    <table id="tabla_sugerido">
        <tr>
            <th colspan="9" style="text-align: center;"><h3>Información Laboral</h3></th>
        <tr>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Cargo</th>
            <th>Duración</th>
            <th>F. Inicio</th>
            <th>F. Terminación</th>
            <th>Salario</th>
            <th>Estado</th>
            <th></th>
        </tr>
        <tr>
            <?php
            $contador = 0;
            $consulta = mysqli_query($conexion, "SELECT * FROM `personal` 
            INNER JOIN `cargo` ON personal.cargo = cargo.id_cargo 
            WHERE personal.estado = 'activo' AND personal.tipo_usuario_pers != '5' AND personal.tipo_usuario_pers != '6'") or die ("Error al consultar: existencia del proveedor");

            while (($fila = mysqli_fetch_array($consulta))!=NULL){
                $contador++;
                ?>
                <tr>
                    <td><?php echo $contador ?></td>
                    <td><input type="text" name="nombre_pers[]" value="<?php echo $fila['nombre_pers'] ?>"/></td>
                    <td><input type="text" name="cargo[]" value="<?php echo $fila['cargo'] ?>"/></td>
                    <td><input type="text" name="tipo_contrato_pers[]" size="2" value="<?php echo $fila['tipo_contrato_pers'] ?>"/> Meses</td>
                    <td><input type="date" name="fecha_inicio_contrato_pers[]" value="<?php echo $fila['fecha_inicio_contrato_pers'] ?>"/></td>
                    <?php

                    echo "<td>".date("d-m-Y",strtotime($fila['fecha_inicio_contrato_pers']." +".intval($fila['tipo_contrato_pers'])." month"))."</td>";
                    $fecha_final = date("d-m-Y",strtotime($fila['fecha_inicio_contrato_pers']." +".intval($fila['tipo_contrato_pers'])." month"));
                    ?>
                    <td><input type="text" name="salario_pers[]" size="8" value="<?php echo $fila['salario_pers'] ?>"/></td>
                    
                    <?php

                    $fecha1  = new DateTime($fecha);
                    $fecha2  = new DateTime($fecha_final);

                    $intvl   = $fecha1->diff($fecha2);
                    if($fecha1 > $fecha2){
                        echo "<td style='background-color:red;border: 2px solid white;text-align: center;color:white;'> - ".$intvl->days."</td>";

                    }elseif($intvl->days < 30 && $intvl->days > 0){
                        
                        echo "<td style='background-color:red;border: 2px solid white;text-align: center;color:white;'>".$intvl->days." Días</td>";

                    }elseif($intvl->days >= 30 && $intvl->days < 60){
                        echo "<td style='background-color:yellow;border: 2px solid white;text-align: center;'>".$intvl->m." Mes y ".$intvl->d."</td>";

                    }elseif($intvl->days >= 60){
                        echo "<td style='background-color:green;border: 2px solid white;text-align: center;color:white;'>".$intvl->m." Meses y ".$intvl->d." días</td>";

                    }elseif($intvl->days == 0){
                        echo "<td style='background-color:white;border: 2px solid white;text-align: center;color:white;'>".$intvl->m."</td>";

                    }
            }
            mysqli_free_result($consulta);
            ?>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </table>
    <?php
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
    <table id="tabla_sugerido">
        <tr>
            <th colspan="9" style="text-align: center;"><h3>Información Personal</h3></th>
        <tr>
        <tr>
            <th>#</th>
            <th>Identificación</th>
            <th>Nombre</th>
            <th>F. Nacimiento</th>
            <th>Edad</th>
            <th>F. Ingreso</th>
            <th>Cumpl</th>
            <th>EPS</th>
            <th>ARL</th>
            <th>Pensión</th>
            <th>C. Compensasión</th>
        </tr>
        <tr>
            <?php
            $contador = 0;
            $consulta = mysqli_query($conexion, "SELECT * FROM `personal` 
            INNER JOIN `cargo` ON personal.cargo = cargo.id_cargo 
            WHERE personal.estado = 'activo' AND personal.tipo_usuario_pers != '5' AND personal.tipo_usuario_pers != '6'") or die ("Error al consultar: existencia del proveedor");

            while (($fila = mysqli_fetch_array($consulta))!=NULL){
                $contador++;
                ?>
                <tr>
                    <td><?php echo $contador ?></td>
                    <td><input type="text" name="identificacion_pers[]" size="15" value="<?php echo $fila['identificacion_pers'] ?>"/></td>
                    <td><input type="text" name="nombre_pers[]" value="<?php echo $fila['nombre_pers'] ?>"/></td>
                    <td><input type="date" name="fecha_nacimiento_pers[]" value="<?php echo $fila['fecha_nacimiento_pers'] ?>"/></td>

                    <?php
                    $fecha1  = new DateTime($fecha);
                    $fecha2  = new DateTime($fila['fecha_nacimiento_pers']);

                    $intvl   = $fecha1->diff($fecha2);
                    echo "<td style='background-color:green;border: 2px solid white;text-align: center;color:white;'>".$intvl->y."</td>";
                    ?>


                    <td><input type="date" name="fecha_ingreso[]" value="<?php echo $fila['fecha_ingreso'] ?>"/></td>
                    <td></td>
                    <td><input type="text" name="[eps]" size="8" value="<?php echo $fila['eps'] ?>"/></td>
                    <td><input type="text" name="[arl]" size="8" value="<?php echo $fila['arl'] ?>"/></td>
                    <td><input type="text" name="[pension]" size="8" value="<?php echo $fila['pension'] ?>"/></td>
                    <td><input type="text" name="[caja_compensacion]" size="8" value="<?php echo $fila['caja_compensacion'] ?>"/></td>

                    
            <?php
            }
            mysqli_free_result($consulta);
            ?>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </table>
<?php

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
    <table id="tabla_sugerido">
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
        </tr>
        <tr>
            <?php
            $contador = 0;
            $consulta = mysqli_query($conexion, "SELECT * FROM `personal` 
            INNER JOIN `cargo` ON personal.cargo = cargo.id_cargo 
            WHERE personal.estado = 'activo' AND personal.tipo_usuario_pers != '5' AND personal.tipo_usuario_pers != '6'") or die ("Error al consultar: existencia del proveedor");

            while (($fila = mysqli_fetch_array($consulta))!=NULL){
                $contador++;
                ?>
                <tr>
                    <td><?php echo $contador ?></td>
                    <td><input type="text" name="nombre_pers[]" value="<?php echo $fila['nombre_pers'] ?>"/></td>
                    <td><input type="text" name="celular_pers[]" value="<?php echo $fila['celular_pers'] ?>"/></td>
                    <td><input type="text" name="correo_pers[]" value="<?php echo $fila['correo_pers'] ?>"/></td>
                    <td><input list="lvl_accs" name="lvl_acc" id="lvl_acc">
                        <datalist id="lvl_accs">
                            <option value="1">Administrador</option>
                            <option value="2">Empleado entendido</option>
                            <option value="3">Empleado</option>
                            <option value="4">Domiciliario</option>
                        </datalist></td>
                    <td><input type="text" name="user_pers[]" size="8" value="<?php echo $fila['user_pers'] ?>"/></td>
                    <td><input type="text" name="pass_pers[]" size="8" value="<?php echo $fila['pass_pers'] ?>"/></td>

                    
            <?php
            }
            mysqli_free_result($consulta);
            ?>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </table>
<?php





    
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
<script type="text/javascript" src="../js/funciones.js"></script>
<?php

    $conexion = conectar();                     //Obtenemos la conexion

    date_default_timezone_set('America/Bogota');

    $consulta = mysqli_query($conexion, "SELECT * FROM `personal` WHERE `tipo_usuario_pers` != '5' AND `tipo_usuario_pers` != '6' AND `estado` = 'activo'") or die ("Error al consultar: existencia del proveedor");

    ?>
        <table class="tabla_sugerido">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Identificación</th>
                <th>Usuario</th>
                <th>Contraseña</th>
                <th>Fecha de nacimiento</th>
                <th>Edad</th>
                <th>Inicio de contrato</th>
                <th>Días restantes</th>
            </tr>

    <?php
    $contador = 0;
    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $contador++;

        $fecha_nacimiento = new DateTime($fila['fecha_nacimiento_pers']);
        $hoy = new DateTime();
        $edad = $hoy->diff($fecha_nacimiento);

        $fecha_contrato = new DateTime($fila['fecha_inicio_contrato_pers']);
        $dias = $hoy->diff($fecha_contrato);

        

        ?>
        
            <tr>
                <td><?php echo  $contador ?></td>
                <td><?php echo  $fila['nombre_pers'] ?></td>
                <td><?php echo  $fila['identificacion_pers'] ?></td>
                <td><?php echo  $fila['user_pers'] ?></td>
                <td><?php echo  $fila['pass_pers'] ?></td>
                <td><?php echo  $fila['fecha_nacimiento_pers'] ?></td>
                <td><?php echo  $edad->y ?></td>
                <td><?php echo  $fila['fecha_inicio_contrato_pers'] ?></td>
                <td><?php echo  ($dias->m)-$fila['tipo_contrato_pers'] ?></td>
            </tr>
        




        <?php
    }
    ?>
    </table>
    <?php

    mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario

    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
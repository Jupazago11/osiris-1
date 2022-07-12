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
            WHERE personal.estado = 'activo' AND personal.tipo_usuario_pers != '5' AND personal.tipo_usuario_pers != '6'
            ORDER BY personal.id_pers ASC") or die ("Error al consultar: existencia del proveedor");

            while (($fila = mysqli_fetch_array($consulta))!=NULL){
                $contador++;
                ?>
                <tr>
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
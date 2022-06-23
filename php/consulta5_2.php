<script type="text/javascript" src="../js/funciones.js"></script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();

    date_default_timezone_set('America/Bogota');
    $fecha = date('Y-m-d', time());

    //date('h:i'); //Fecha justo ahora


    $vehiculo        = $_POST['vehiculo'];


    //Obtendremos la catnidad de registros existentes
    $consulta = mysqli_query($conexion, "SELECT COUNT(*) AS total
    FROM `domicilio`
    INNER JOIN vehiculo ON domicilio.id_vehiculo2 = vehiculo.id_vehiculo
    WHERE vehiculo.placa = '$vehiculo'
    AND `fecha` = '$fecha'") or die ("Error al consultar: domicilios");

    $row = mysqli_fetch_array($consulta);
    $cantidad = $row['total'];
    //echo $cantidad;


    if($cantidad > 0){
        $consulta = mysqli_query($conexion, "SELECT personal.user_pers,cliente.nombre_cliente, domicilio.observacion, domicilio.nivel_urgencia, domicilio.ubicacion, domicilio.destino, domicilio.estado 
        FROM `domicilio` 
        INNER JOIN `personal` ON domicilio.id_pers3 = personal.id_pers 
        INNER JOIN `cliente` ON domicilio.id_cliente2 = cliente.id_cliente  
        INNER JOIN `vehiculo` ON vehiculo.id_vehiculo = domicilio.id_vehiculo2 
        WHERE vehiculo.placa = '$vehiculo' 
        AND `fecha` = '$fecha'
        ORDER BY `id_domi` ASC") or die ("Error al consultar: domicilios");
        ?>
        <table id="tabla_sugerido">
        <tr>
            <th>Personal</th>
            <th colspan="3">Cliente</th>
            <th>Destino</th>
            <th>Salida</th>
            <th>LLegada</th>
            <th></th>
        </tr>
        <?php
        while (($fila = mysqli_fetch_array($consulta)) != NULL){
            ?>
            <tr>
                <td><?php echo $fila['user_pers']; ?></td>
                <td><?php echo $fila['nombre_cliente']; ?></td>
                <td><div class="tooltip"><i class='fas fa-search-location' style='font-size:36px'></i>
                <span class="tooltiptext"><?php echo $fila['observacion']; ?></span></div></td>
                <?php
                if($fila['nivel_urgencia'] == "Prioritario"){
                    ?>
                    <td><i class='fas fa-exclamation' style='font-size:36px;color:red'></i></td>
                    <?php
                }else{
                    ?>
                    <td></td>
                    <?php
                }
                ?>
                <td><?php echo $fila['ubicacion'].": ".$fila['destino']; ?></td>
                <td><input type="text" name="salidas[]"></input><button style="font-size:24px;border-radius:50%;" onclick="rellenar_formulario()"><i class="far fa-clock"></i></button></td>
                <td><input type="text" name="llegadas[]"></input><button style="font-size:24px;border-radius:50%;"><i class="far fa-clock"></i></button></td>
                <?php
                if($fila['estado'] == "activo"){
                    ?>
                    <td><i class='fas fa-hourglass-half' style='font-size:36px;color:red'></i></td>
                    <?php
                }else{
                    ?>
                    <td><i class='far fa-calendar-check' style='font-size:36px;color:green'></td>
                    <?php
                }
                ?>
            </tr>
            
            <?php
        }
        
        mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
        ?>
        </table>
        <?php
    }else{
        ?>
        <br>
        <div class="alert warning">
            <span class="closebtn">&times;</span>  
            <strong>Información!</strong> No existen registros asociados el día de hoy para el vehículo
        </div>
        <?php
    }
?>
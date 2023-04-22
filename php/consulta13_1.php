<?php

$conexion = conectar();                     //Obtenemos la conexion

date_default_timezone_set('America/Bogota');
$fecha   = date('Y-m-d', time());
//$hoy     = date("H:i:s", time());

?>
<a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('cont5_1').style.display='none';ocultarDivs0();">X</a>
<br>
<table class="tabla_sugerido">
    <tr>
        <th>Nombre</th>
        <th>Inicio</th>
        <th>Desayuno</th>
        <th>Regreso Desayuno</th>
        <th>Almuerzo</th>
        <th>Regreso Almuerzo</th>
        <th>Salida</th>
    </tr>
    <?php
    $consulta = mysqli_query($conexion, "SELECT `id_control`, personal.nombre_pers, `llegada`, `ir_desayuno`, `regre_desayuno`, `ir_almuerzo`, `regre_almuerzo`, `salida`, `fecha` 
    FROM `control` 
    INNER JOIN personal ON personal.id_pers = control.id_pers4
    WHERE `fecha` = '$fecha'") or die ("Error al consultar: proveedores");
    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        ?>
        <tr>
            <td><?php echo $fila['nombre_pers'] ?></td>
            <td><?php if($fila['llegada'] != ''){echo date("g:i:s a", strtotime($fila['llegada']));}else{echo "";} ?></td>
            <td><?php if($fila['ir_desayuno'] != ''){echo date("g:i:s a", strtotime($fila['ir_desayuno']));}else{echo "";} ?></td>
            <td><?php if($fila['regre_desayuno'] != ''){echo date("g:i:s a", strtotime($fila['regre_desayuno']));}else{echo "";} ?></td>
            <td><?php if($fila['ir_almuerzo'] != ''){echo date("g:i:s a", strtotime($fila['ir_almuerzo']));}else{echo "";} ?></td>
            <td><?php if($fila['regre_almuerzo'] != ''){echo date("g:i:s a", strtotime($fila['regre_almuerzo']));}else{echo "";} ?></td>
            <td><?php if($fila['salida'] != ''){echo date("g:i:s a", strtotime($fila['salida']));}else{echo "";} ?></td>
        </tr>
        <?php

    }
    mysqli_free_result($consulta);
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------

    ?>
    
</table>


<?php
<?php
//Incluir el archivo que contiene las funciones del lenguaje PHP
require_once("../PHP/funciones.php");

if(existencia_de_la_conexion()){
    require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
}
$conexion = conectar();                     //Obtenemos la conexion

date_default_timezone_set('America/Bogota');
$fecha   = date('Y-m-d', time());
//$hoy     = date("H:i:s", time());

?>
<a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('cont5_1').style.display='none';">X</a>
<table class="tabla_sugerido">
    <tr>
        <th>Nombre</th>
        <th>Llegada</th>
        <th>Desayuno</th>
        <th>Regreso Desayuno</th>
        <th>Aluerzo</th>
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
            <td><?php echo $fila['llegada'] ?></td>
            <td><?php echo $fila['ir_desayuno'] ?></td>
            <td><?php echo $fila['regre_desayuno'] ?></td>
            <td><?php echo $fila['ir_almuerzo'] ?></td>
            <td><?php echo $fila['regre_almuerzo'] ?></td>
            <td><?php echo $fila['salida'] ?></td>
        </tr>
        <?php

    }
    mysqli_free_result($consulta);
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------

    ?>
    
</table>


<?php
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
<a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('cont2_8').style.display='none';">X</a>
<table class="tabla_sugerido">
    <tr>
        <th>ID</th>
        <th>Personal</th>
        <th>Requerimiento</th>
        <th>Costo</th>
        <th>Fecha</th>
        <th>Estado</th>
        <th></th>
    </tr>
    <?php
    $consulta = mysqli_query($conexion, "SELECT `id_reque`, personal.nombre_pers, `reque`, `costo`, requerimiento.estado, `fecha`
    FROM `requerimiento`
    INNER JOIN personal ON personal.id_pers = requerimiento.id_pers5
    WHERE requerimiento.estado != ''") or die ("Error al consultar: proveedores");

    $contador = 0;

    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $contador++;
        ?>
        <tr>
            <td><?php echo $fila['id_reque'] ?></td>
            <td><?php echo $fila['nombre_pers'] ?></td>
            <td><textarea name="reque[]" rows="3" cols="60"><?php echo $fila['reque'] ?></textarea></td>
            <td><input type="text" name="costo[]" value="<?php echo number_format($fila['costo'], 0, ',', '.') ?>" class="puntos"/></td>
            <td><input type="date" name="fecha[]" value="<?php echo $fila['fecha'] ?>"/></td>
            <td>
            <?php
            if($nombre[$i] == ''){
                ?>
                <td class="w3-btn w3-red"><input type="radio" name="eliminar[<?php echo $contador ?>]" value="activo" style="visibility:hidden;" checked>
                <input type="radio" name="eliminar[<?php echo $contador ?>]" value="eliminar" id="eliminar[<?php echo $contador ?>]" onchange="$('#enviar6_2').trigger('click');">
                <label for="eliminar[<?php echo $contador ?>]">X</label><br></td> 
                <?php
            }else{
                ?>
                <td><input type="radio" name="eliminar[<?php echo $contador ?>]" value="activo" style="visibility:hidden;" checked>
                <input type="radio" name="eliminar[<?php echo $contador ?>]" value="eliminar" id="eliminar[<?php echo $contador ?>]" style="visibility:hidden;" onchange="$('#enviar6_2').trigger('click');"></td> 
                <?php
            }
            ?>
            </td>
            <td><?php echo $fila['estado'] ?></td>
        </tr>
        <?php

    }
    mysqli_free_result($consulta);
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------

    ?>
    
</table>


<?php
<script type="text/javascript" src="../js/funciones.js"></script>
<?php
    require("../php/conexion.php");
    $conexion = conectar();

    date_default_timezone_set('America/Bogota');
    $fecha = date('Y-m-d', time());

    // Desactivar toda notificación de error
    error_reporting(0);

    //date('h:i'); //Fecha justo ahora
    $name_vehiculo_ver              = $_POST['name_vehiculo_ver'];

    // Notificar todos los errores de PHP
    error_reporting(-1);

    $consulta = mysqli_query($conexion,"SELECT `id_domi`
    FROM `domicilio` 
    WHERE `fecha` = '$fecha'
    ORDER BY `id_domi`ASC") or die ("Error al consultar: domicilios");

    $id_domis = array();
    while (($fila = mysqli_fetch_array($consulta)) != NULL){
        array_push($id_domis, $fila['id_domi']);
    }
    mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario


    for($i = 0; $i < count($id_domis); $i++){

        $consulta = mysqli_query($conexion,"UPDATE `domicilio` 
        SET `id_vehiculo2`='$name_vehiculo_ver[$i]'
        WHERE `id_domi` = '$id_domis[$i]'") or die ("Error al consultar: domicilios");
    }

?>
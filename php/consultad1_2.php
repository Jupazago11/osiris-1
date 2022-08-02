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
/*
    $kilometraje         = $_POST['kilometraje'];//obtenemos el nombre del proveedor seleccionado
    $vehiculo            = $_POST['vehiculo'];

    //id del cliente
    $consulta = mysqli_query($conexion, "SELECT `id_vehiculo` FROM `vehiculo` WHERE `placa` = '$vehiculo'") or die ("Error al consultar: vehiculo");

    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $id_vehiculo = $fila['id_vehiculo'];
    }
    mysqli_free_result($consulta);

    $consulta = mysqli_query($conexion, "INSERT INTO `kilometraje`(`fecha`, `id_vehiculo3`, `kilometra`) 
    VALUES ('$fecha','$id_vehiculo','$kilometraje')") or die ("Error al consultar: kilometraje");
*/
    echo "xd";
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
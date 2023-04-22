<script type="text/javascript" src="../js/funciones.js"></script>
<?php
require("../php/conexion.php");
    $conexion = conectar();                     //Obtenemos la conexion

    date_default_timezone_set('America/Bogota');
    $hoy = date("Y-m-d H:i:s");

    $id_obs         = $_POST['id_obs'];
    $id_vehiculo    = $_POST['id_vehiculo'];
    $observacion    = $_POST['observacion'];
    $costo          = str_replace(".","",$_POST['costo']);
    $fecha          = $_POST['fecha'];
    $eliminar       = $_POST['eliminar'];

    for ($i=0; $i < count($id_obs); $i++) { 
        $j = $i + 1;
        $consulta = mysqli_query($conexion, "UPDATE `observacion` 
        SET `id_vehiculo1`='$id_vehiculo[$i]',`observacion`='$observacion[$i]',`costo`='$costo[$i]',`fecha`='$fecha[$i]' 
        WHERE `id_obs` = '$id_obs[$i]'") or die ("Error al consultar: proveedores");
        
        if($eliminar[$j] == 'eliminar' && count($id_obs) > 1){
            $consulta = mysqli_query($conexion, "UPDATE `observacion` 
            SET `estado`= '' 
            WHERE `id_obs` = '$id_obs[$i]'") or die ("Error al consultar: proveedores");
        }
    }

    

    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
<script type="text/javascript" src="../js/funciones.js"></script>
<?php

    $conexion = conectar();                     //Obtenemos la conexion

    
    $id_pers   = $_POST['id_pers'];

    $identificacion_pers   = $_POST['identificacion_pers'];
    $nombre_pers    = $_POST['nombre_pers'];
    $fecha_nacimiento_pers  = $_POST['fecha_nacimiento_pers'];
    $fecha_ingreso  = $_POST['fecha_ingreso'];
    $eps = $_POST['eps'];
    $arl    = $_POST['arl'];
    $pension = $_POST['pension'];
    $caja_compensacion = $_POST['caja_compensacion'];
    $eliminar = $_POST['eliminar'];
    
    for ($i = 0; $i < count($id_pers); $i++) { 

        $j = $i + 1; //ya que el arreglo de los estados en html del formulario anterior empieza en 1 y no en 0

        $consulta = mysqli_query($conexion, "UPDATE `personal` 
        SET `nombre_pers`='$nombre_pers[$i]', `identificacion_pers`='$identificacion_pers[$i]', `fecha_nacimiento_pers`='$fecha_nacimiento_pers[$i]', `fecha_ingreso`='$fecha_ingreso[$i]', `eps`='$eps[$i]', `arl`='$arl[$i]', `pension`='$pension[$i]', `caja_compensacion`='$caja_compensacion[$i]'
        WHERE `id_pers` = '$id_pers[$i]'") or die ("Error al update: proveedores");
        
        if($eliminar[$j] == 'eliminar' && count($eliminar) > 1){
            $consulta = mysqli_query($conexion, "UPDATE `personal` SET 
            `estado` = '' 
            WHERE `id_pers` = '$id_pers[$i]'") or die ("Error al update: proveedores");
        }
        
    }

    
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
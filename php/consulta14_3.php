<script type="text/javascript" src="../js/funciones.js"></script>
<?php

    $conexion = conectar();                     //Obtenemos la conexion


    $id_reque       = $_POST['id_reque'];
    $reque          = $_POST['reque'];
    $costo          = str_replace(".","",$_POST['costo']);
    $fecha          = $_POST['fecha'];
    $estado         = $_POST['estado'];
    $eliminar       = $_POST['eliminar'];
    
    for ($i = 0; $i < count($id_reque); $i++) { 

        $j = $i + 1; //ya que el arreglo de los estados en html del formulario anterior empieza en 1 y no en 0

        $consulta = mysqli_query($conexion, "UPDATE `requerimiento` SET `reque`='$reque[$i]',`costo`='$costo[$i]',`estado`='$estado[$j]',`fecha`='$fecha[$i]' 
        WHERE `id_reque` = '$id_reque[$i]'") or die ("Error al update: proveedores");
        
        if($eliminar[$j] == 'eliminar'){
            $consulta = mysqli_query($conexion, "UPDATE `requerimiento` SET 
            `estado` = '' 
            WHERE `id_reque` = '$id_reque[$i]'") or die ("Error al update: proveedores");
        }
        
    }
    
    
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>

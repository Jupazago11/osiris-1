<script type="text/javascript" src="../js/funciones.js"></script>
<?php

    $conexion = conectar();                     //Obtenemos la conexion


    $id_presu_de    = $_POST['id_presu_de'];
    $nombre         = $_POST['nombre'];
    $costo          = str_replace(".","",$_POST['costo1']);
    $descripcion    = $_POST['descripcion'];
    $eliminar       = $_POST['eliminar'];

    for ($i = 0; $i < count($id_presu_de); $i++) { 

        $j = $i + 1; //ya que el arreglo de los estados en html del formulario anterior empieza en 1 y no en 0

        $consulta = mysqli_query($conexion, "UPDATE `pre_detalle` 
        SET `nombre`='$nombre[$i]', `costo`='$costo[$i]', `descripcion`='$descripcion[$i]'
        WHERE `id_presu_de` = '$id_presu_de[$i]'") or die ("Error al update: presupuesto");
        
        if($eliminar[$j] == 'eliminar' && count($eliminar) > 1){
            $consulta = mysqli_query($conexion, "UPDATE `pre_detalle` 
            SET `estado` = '' 
            WHERE `id_presu_de` = '$id_presu_de[$i]'") or die ("Error al update: proveedores");
        }
        
    }

    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
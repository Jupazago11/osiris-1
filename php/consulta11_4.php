<script type="text/javascript" src="../js/funciones.js"></script>
<?php
require("../php/conexion.php");
    $conexion = conectar();                     //Obtenemos la conexion

    
    $id_pre_detalle_cat   = $_POST['id_pre_detalle_cat'];

    $cate_pre   = $_POST['cate_pre'];
    $estado    = $_POST['estado'];
    $eliminar  = $_POST['eliminar'];
    
    for ($i = 0; $i < count($id_pre_detalle_cat); $i++) { 

        $j = $i + 1; //ya que el arreglo de los estados en html del formulario anterior empieza en 1 y no en 0

        $consulta = mysqli_query($conexion, "UPDATE `pre_detalle_cat` SET `cate_pre`='$cate_pre[$i]', `estado`='$estado[$j]' 
        WHERE `id_pre_detalle_cat` = '$id_pre_detalle_cat[$i]'") or die ("Error al update: proveedores");
        
        if($eliminar[$j] == 'eliminar' && count($id_pre_detalle_cat) > 1){
            $consulta = mysqli_query($conexion, "UPDATE `pre_detalle_cat` SET 
            `estado` = '' 
            WHERE `id_pre_detalle_cat` = '$id_pre_detalle_cat[$i]'") or die ("Error al update: proveedores");
        }
        
    }

    
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
<script type="text/javascript" src="../js/funciones.js"></script>
<?php

    $conexion = conectar();                     //Obtenemos la conexion


    $id_cuadre_caja     = $_POST['id_cuadre_caja'];
    $descripcion_cuadre = $_POST['descripcion_cuadre'];
    $costo_cuadre       = str_replace(".","",$_POST['costo_cuadre']);
    $eliminar           = $_POST['eliminar'];

    for ($i = 0; $i < count($id_cuadre_caja); $i++) { 

        $j = $i + 1; //ya que el arreglo de los estados en html del formulario anterior empieza en 1 y no en 0
        if($costo_cuadre[$i] == ''){
            $costo_cuadre[$i] = '0';
        }
        $consulta = mysqli_query($conexion, "UPDATE `cuadre_caja` 
        SET `descripcion_cuadre`='$descripcion_cuadre[$i]', `costo_cuadre`='$costo_cuadre[$i]'
        WHERE `id_cuadre_caja` = '$id_cuadre_caja[$i]'") or die ("Error al update: presupuesto");
        
        if($eliminar[$j] == 'eliminar' && count($id_cuadre_caja) > 1){
            $consulta = mysqli_query($conexion, "UPDATE `cuadre_caja` 
            SET `estado` = '' 
            WHERE `id_cuadre_caja` = '$id_cuadre_caja[$i]'") or die ("Error al update: proveedores");
        }
    }

    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
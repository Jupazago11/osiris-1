<script type="text/javascript" src="../js/funciones.js"></script>
<?php

    $conexion = conectar();                     //Obtenemos la conexion


    $id_pagos_caja      = $_POST['id_pagos_caja'];
    $descripcion_caja   = $_POST['descripcion_caja'];
    $costo_pagos        = str_replace(".","",$_POST['costo_pagos']);
    $eliminar           = $_POST['eliminar'];
    
    for ($i = 0; $i < count($id_pagos_caja); $i++) { 

        $j = $i + 1; //ya que el arreglo de los estados en html del formulario anterior empieza en 1 y no en 0

        if($costo_pagos[$i] == ''){
            $costo_pagos[$i] = '0';
        }
        
        $consulta = mysqli_query($conexion, "UPDATE `pagos_caja` 
        SET `descripcion_caja`='$descripcion_caja[$i]', `costo_pagos`='$costo_pagos[$i]'
        WHERE `id_pagos_caja` = '$id_pagos_caja[$i]'") or die ("Error al update: presupuesto");
        
        if($eliminar[$j] == 'eliminar' && count($id_pagos_caja) > 1){
            $consulta = mysqli_query($conexion, "UPDATE `pagos_caja` 
            SET `estado` = '' 
            WHERE `id_pagos_caja` = '$id_pagos_caja[$i]'") or die ("Error al update: proveedores");
        }
    }

    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
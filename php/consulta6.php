<script type="text/javascript" src="../js/funciones.js"></script>
<?php
require("../php/conexion.php");
    $conexion = conectar();                     //Obtenemos la conexion


    $nombre_prove = strval($_POST['provedor']);
    $factura = strval($_POST['factura']);
    $dias = $_POST['dias'];
    $costo = strval($_POST['costo']);




    date_default_timezone_set('America/Bogota');
    $fecha_hoy        = date('Y-m-d', time());

    //Verificamos si el proveedor existe
    $existe_proveedor = false;

    //Consulta a la base de datos en la tabla proveedor
    $consulta = mysqli_query($conexion, "SELECT `nombre_proveedor` FROM `proveedor` WHERE `nombre_proveedor` = '$nombre_prove' AND `estado` = 'activo'") or die ("Error al consultar: existencia del proveedor");
                        
    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $existe_proveedor = true;

    }
    mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario


    if($existe_proveedor == true && $dias > 0){
        if(strlen($factura) == 0){
            $consulta = mysqli_query($conexion, "INSERT INTO `cuenta_cobro`(`nombre`, `costo`, `dias`, `fecha`,  `estado`) 
            VALUES ('$nombre_prove', '$costo', '$dias', '$fecha_hoy', 'activo')") or die ("Error al consultar: no se obtuvo la el la informacion de la cuenta de cobro");
        }else{
            $consulta = mysqli_query($conexion, "INSERT INTO `cuenta_cobro`(`nombre`, `costo`, `factura`, `dias`, `fecha`,  `estado`) 
            VALUES ('$nombre_prove', '$costo', '$factura', '$dias', '$fecha_hoy', 'activo')") or die ("Error al consultar: no se obtuvo la el la informacion de la cuenta de cobro");
        }

        ?>
        <br>
        <div class="alert info">
            <span class="closebtn">&times;</span>  
            <strong>Información!</strong> Agregado con éxito
        </div>
        <?php

    }elseif($dias <= 0){
        ?>
        <br>
        <div class="alert warning">
            <span class="closebtn">&times;</span>  
            <strong>Información!</strong> Debes ingresar días válidos
        </div>
        <?php
    }else{
        ?>
        <br>
        <div class="alert warning">
            <span class="closebtn">&times;</span>  
            <strong>Información!</strong> No existen proveedores registrados Activos con ese nombre
        </div>
        <?php
    }
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
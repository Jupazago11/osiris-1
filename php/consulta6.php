<script type="text/javascript" src="../js/funciones.js"></script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion


    $nombre_prove = strval($_POST['provedor']); //obtenemos el nombre del proveedor seleccionado
    $fecha       = strval($_POST['fecha']); //obtenemos el nombre del proveedor seleccionado
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

    if($existe_proveedor == true && $fecha > $fecha_hoy){
        
        $consulta = mysqli_query($conexion, "INSERT INTO `cuenta_cobro`(`nombre`, `fecha`, `estado`) VALUES ('$nombre_prove','$fecha','activo')") or die ("Error al consultar: no se obtuvo la el la informacion de los productos");

        ?>
        <br>
        <div class="alert info">
            <span class="closebtn">&times;</span>  
            <strong>Información!</strong> Agregado con éxito
        </div>
        <?php

    }elseif($fecha <= $fecha_hoy){
        ?>
        <br>
        <div class="alert warning">
            <span class="closebtn">&times;</span>  
            <strong>Información!</strong> Debes ingresar una fecha válida
        </div>
        <?php
    }else{
        ?>
        <br>
        <div class="alert warning">
            <span class="closebtn">&times;</span>  
            <strong>Información!</strong> No existen proveedores registrados con ese nombre
        </div>
        <?php
    }
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
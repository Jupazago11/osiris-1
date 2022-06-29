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
    $hoy = date("H:i");

    // Desactivar toda notificación de error
    error_reporting(0);

    //date('h:i'); //Fecha justo ahora
    $salidass        = $_POST['salidass'];

    // Notificar todos los errores de PHP
    error_reporting(-1);

    foreach ($salidass as $value) {
        if(count($salidass) > 0){
        
            $consulta = mysqli_query($conexion, "UPDATE `domicilio` SET `tiempo_salida`='$hoy', `estado`='proceso' WHERE `estado` = 'activo' AND `id_domi` = '$value'
            ORDER BY `id_domi` ASC") or die ("Error al consultar: domicilios");
    
        }
    }


    


?>
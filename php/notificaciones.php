<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<script>$.ajaxPrefilter(function( options, originalOptions, jqXHR ) {    options.async = true; });</script>
<script type="text/javascript" src="../js/funciones.js"></script>

<?php

function tiempo_contratos(){
    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion

    date_default_timezone_set('America/Bogota');
    $fecha        = date('Y-m-d', time());


    //Verificamos tiempo restante de contrato
    $consulta = mysqli_query($conexion, "SELECT `nombre_pers`,`fecha_inicio_contrato_pers`,`tipo_contrato_pers` 
    FROM `personal` 
    INNER JOIN `cargo` ON personal.cargo = cargo.id_cargo 
    WHERE personal.estado = 'activo' AND personal.tipo_usuario_pers != '5' AND personal.tipo_usuario_pers != '6'
    ORDER BY personal.id_pers ASC") or die ("Error al consultar: existencia del proveedor");

    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        
        $fecha_final = date("d-m-Y",strtotime($fila['fecha_inicio_contrato_pers']." +".intval($fila['tipo_contrato_pers'])." month"));

        $fecha_final = date("d-m-Y",strtotime($fecha_final."- 1 days"));
        
        $fecha1  = new DateTime($fecha);
        $fecha2  = new DateTime($fecha_final);

        $intvl   = $fecha1->diff($fecha2);
        if($fecha1 > $fecha2 || $intvl->days < 30 && $intvl->days > 0){
            echo $fila['nombre_pers']." Días de contrato - ".$intvl->days." Días";

        }
    }
    mysqli_free_result($consulta);
}

////////////////////////////////////////////////////////////////////////////////////////////
function tiempo_cumpleani(){
    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion

    date_default_timezone_set('America/Bogota');
    $fecha        = date('Y-m-d', time());


    //Verificamos tiempo restante de contrato
    $consulta = mysqli_query($conexion, "SELECT * FROM `personal` 
    INNER JOIN `cargo` ON personal.cargo = cargo.id_cargo 
    WHERE personal.estado = 'activo' AND personal.tipo_usuario_pers != '5' AND personal.tipo_usuario_pers != '6'
    ORDER BY personal.id_pers ASC") or die ("Error al consultar: existencia del proveedor");

    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        
        $fecha1 = new DateTime($fecha);
        $fecha2  = new DateTime($fila['fecha_nacimiento_pers']);

        $intvl   = $fecha1->diff($fecha2);

        $fecha3 = new DateTime(date("d-m-Y",strtotime($fila['fecha_nacimiento_pers']." +".intval(($intvl->y)+1)." year")));

        $intvl2 = $fecha1->diff($fecha3);

        if($intvl2->m == 0){
            echo $fila['nombre_pers']." ".$intvl2->d." Días para su cumpleaños";
        }
    
    }
    mysqli_free_result($consulta);
}

////////////////////////////////////////////////////////////////////////////////////////////
function tiempo_soat_tecn(){
    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion

    date_default_timezone_set('America/Bogota');
    $fecha        = date('Y-m-d', time());

    $consulta = mysqli_query($conexion, "SELECT * FROM `vehiculo` 
    WHERE estado != ''
    ORDER BY id_vehiculo ASC") or die ("Error al consultar: existencia del proveedor");

    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        
        $fecha1  = new DateTime($fecha);
        $fecha2 = new DateTime(date("Y-m-d",strtotime($fila['fecha_soat']." + 1 year")));

        $intvl   = $fecha1->diff($fecha2);
        if($intvl->m <=0 && $intvl->d >=0){
            echo $fila['tipo'].": ".$fila['placa']." vence SOAT en ".$intvl->d." días";
        }

        //Tecnicomecánica
        $fecha2 = new DateTime(date("Y-m-d",strtotime($fila['fecha_tecn']." + 1 year")));
        $intvl   = $fecha1->diff($fecha2);

        if($intvl->m <=0 && $intvl->d >=0){
            echo "<br>".$fila['tipo'].": ".$fila['placa']." vence Tecnicomecánica en ".$intvl->d." días";
        }
    
    }
    mysqli_free_result($consulta);
}

?>
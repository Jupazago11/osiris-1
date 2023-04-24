<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<script>$.ajaxPrefilter(function( options, originalOptions, jqXHR ) {    options.async = true; });</script>
<script type="text/javascript" src="../js/funciones.js"></script>

<?php
require("../php/conexion.php");
function tiempo_contratos(){
    $evaluar = false;

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
            $evaluar = true;
            ?>

            <tr onclick="ocultarDivs('cont2'); ocultarDivs2('cont2_3'); $('#enviar9_1').trigger('click');$('#img_noti').trigger('click');"><td><?php echo $fila['nombre_pers'] ?></td><td>Días de contrato</td><td><?php echo $intvl->days ?> Días</td></tr>
            <?php

        }
    }
    mysqli_free_result($consulta);
    return $evaluar;
}

////////////////////////////////////////////////////////////////////////////////////////////
function tiempo_cumpleani(){
    $evaluar = false;

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
            $evaluar = true;
            ?>

            <tr onclick="ocultarDivs('cont2'); ocultarDivs2('cont2_3'); $('#enviar9_2').trigger('click');$('#img_noti').trigger('click');"><td><?php echo $fila['nombre_pers'] ?></td><td>Cumpleaños en</td><td><?php echo $intvl2->d ?> Días</td></tr>

            <?php
        }
    
    }
    mysqli_free_result($consulta);
    return $evaluar;
}

////////////////////////////////////////////////////////////////////////////////////////////
function tiempo_soat_tecn(){
    $evaluar = false;


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
            $evaluar = true;
            ?>

            <tr onclick="ocultarDivs('cont2'); ocultarDivs2('cont2_5'); $('#enviar10_1').trigger('click');$('#img_noti').trigger('click');"><td><?php echo $fila['tipo'].": ".$fila['placa'] ?></td><td>Vence SOAT en</td><td><?php echo  $intvl->d ?> Días</td></tr>

            <?php 
        }

        //Tecnicomecánica
        $fecha2 = new DateTime(date("Y-m-d",strtotime($fila['fecha_tecn']." + 1 year")));
        $intvl   = $fecha1->diff($fecha2);

        if($intvl->m <=0 && $intvl->d >=0){
            $evaluar = true;
            ?>

            <tr onclick="ocultarDivs('cont2'); ocultarDivs2('cont2_5'); $('#enviar10_1').trigger('click');$('#img_noti').trigger('click');"><td><?php echo $fila['tipo'].": ".$fila['placa']?></td><td>Vence Tecnicomecánica en</td><td><?php echo $intvl->d ?> Días</td></tr>

            <?php
        }
    
    }
    mysqli_free_result($consulta);
    return $evaluar;
}

////////////////////////////////////////////////////////////////////////////////////////////
function tiempo_cuentaxpa(){
    $evaluar = false;


    $conexion = conectar();                     //Obtenemos la conexion

    date_default_timezone_set('America/Bogota');
    $fecha          = date('Y-m-d', time());

    $nombre         = array();
    $fechas_limite  = array();

    $consulta = mysqli_query($conexion, "SELECT * FROM `cuenta_cobro` 
    WHERE `estado` = 'activo' 
    ORDER BY `id_cuenta` ASC") or die ("Error al consultar: existencia del proveedor");

    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        array_push($nombre, $fila['nombre']);

        $fecha_limite = date("Y-m-d",strtotime($fila['fecha']." + ".$fila['dias']." days"));

        array_push($fechas_limite, $fecha_limite);
    
    }
    mysqli_free_result($consulta);

    for ($i = 0; $i < count($nombre); $i++) { 
        $fecha1  = new DateTime($fecha);
        $fecha2  = new DateTime($fechas_limite[$i]);
        
        $intvl   = $fecha1->diff($fecha2);

        if($fecha1 > $fecha2){
            $evaluar = true;
            ?>
            <tr onclick="ocultarDivs('cont2'); ocultarDivs2('cont2_7'); $('#enviar6_1').trigger('click');$('#img_noti').trigger('click');"><td><?php echo $nombre[$i] ?></td><td>Factura por pagar</td><td><?php echo "-".$intvl->d ?> Días</td></tr>

            <?php

        }elseif($intvl->days <= 7){
            $evaluar = true;
            ?>
            <tr onclick="ocultarDivs('cont2'); ocultarDivs2('cont2_7'); $('#enviar6_1').trigger('click');$('#img_noti').trigger('click');"><td><?php echo $nombre[$i] ?></td><td>Factura por pagar</td><td><?php echo $intvl->d ?> Días</td></tr>
            <?php
        }
    }
    return $evaluar;
}

?>
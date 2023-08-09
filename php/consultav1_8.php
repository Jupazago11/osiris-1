<script type="text/javascript" src="../js/funciones.js"></script>
<?php
require("../php/conexion.php");
    $conexion = conectar();                     //Obtenemos la conexion



    $id_cuadre_caja_completa     = $_POST['id_cuadre_caja_completa'];
    


        
    //Capturamos el ID del mes actual
    date_default_timezone_set('America/Bogota');
    $mes        = date('m', time());
    $year       = date('Y', time());
    $fecha_compl= date('Y-m-d', time());    //ejemplo 2023-04-28
    $existe     = false;

    $consulta = mysqli_query($conexion, "SELECT * FROM `fechas`  
    WHERE `mes`= '$mes' AND `year`= '$year'") or die ("Error al consultar: proveedores");
    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $existe[1] = true;
        $id_fecha = $fila['id_fecha'];
    }
    mysqli_free_result($consulta);



    if($existe == true){
        // Actualizaremos la fecha para el dia de hoy
        $consulta = mysqli_query($conexion, "UPDATE `cuadre_de_caja_completo` 
        SET `fecha`='$fecha_compl' 
        WHERE `id_cuadre_caja_completo` = '$id_cuadre_caja_completa'") or die ("Error al consultar: proveedores");



        //continuamos para obtener los datos
        $id_ven_dia = array();
        $ventas = array();

        //obtenemos todos los valores de todo el calendario
        $consulta = mysqli_query($conexion, "SELECT `id_ven_dia`, `ventas` 
        FROM `ventas_diarias` 
        WHERE `id_fecha1`='$id_fecha'
        ORDER BY `id_ven_dia` ASC") or die ("Error al consultar: proveedores");

        while (($fila = mysqli_fetch_array($consulta))!=NULL){
            array_push($id_ven_dia, $fila['id_ven_dia']);
            array_push($ventas, $fila['ventas']);
        }
        mysqli_free_result($consulta);

        $hoy    = date('d', time());

        //Sumamos los datos del dia de hoy

        $total_ventas_dia_suma = 0;

        $consulta = mysqli_query($conexion, "SELECT cuadre_de_caja_completo.id_cuadre_caja_completo, venta_diaria.venta_diaria, cuadre_de_caja_completo.fecha
        FROM `cuadre_de_caja_completo`
        INNER JOIN venta_diaria ON cuadre_de_caja_completo.id_cuadre_caja_completo = venta_diaria.id_cuadre_caja_completo3
        WHERE `fecha` = '$fecha_compl'") or die ("Error al consultar: proveedores");

        while (($fila = mysqli_fetch_array($consulta))!=NULL){
            $total_ventas_dia_suma += $fila['venta_diaria'];
        }
        mysqli_free_result($consulta);



        //Guardamos el valor el dis de hoy
        for ($i=0; $i < count($id_ven_dia); $i++) { 
            echo '<br>';
            //Cuando la fecha sea la del día de hoy
            if($i == ($hoy-1)){
                $consulta = mysqli_query($conexion, "UPDATE `ventas_diarias` 
                SET `ventas`='$total_ventas_dia_suma' 
                WHERE `id_ven_dia`='$id_ven_dia[$i]'") or die ("Error al update: presupuesto");
            }
        }

    }else{
        //Creamos un regsitro de presupuesto, ya que es de donde obtenemos la fecha
        $consulta = mysqli_query($conexion, "INSERT INTO `fechas`(`mes`, `year`) 
        VALUES ('$mes','$year')") or die ("Error al update: presupuesto");

        $consulta = mysqli_query($conexion, "SELECT * FROM `fechas`  
        WHERE `mes`= '$mes' AND `year`= '$year'") or die ("Error al consultar: proveedores");

        while (($fila = mysqli_fetch_array($consulta))!=NULL){
            $id_fecha = $fila['id_fecha'];
        }
        mysqli_free_result($consulta);


        //Ahora creamos los registros del mes y año de ventas diarias
        for ($i = 0; $i < $dias_meses[$mes-1]; $i++) { 
            
            $consulta = mysqli_query($conexion, "INSERT INTO `ventas_diarias`(`id_fecha1`, `ventas`) 
            VALUES ('$id_fecha', NULL)") or die ("Error al update: presupuesto");
            
        }


        //echo "<script>$('#enviarv1_8').trigger('click');</script>";
    }

    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
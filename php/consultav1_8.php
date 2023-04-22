<script type="text/javascript" src="../js/funciones.js"></script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion

    $monedas = array(
        50,
        100,
        200,
        500,
        1000,
        2000,
        5000,
        10000,
        20000,
        50000,
        100000
    );
    $cantidad_monedas      = $_POST['cantidad_monedas'];

    $total = 0;
    for ($i = 0; $i < count($cantidad_monedas); $i++) { 
        $total += $monedas[$i]*$cantidad_monedas[$i];
    }

        
    //Capturamos el ID del mes actual
    date_default_timezone_set('America/Bogota');
    $mes        = date('m', time());
    $year       = date('Y', time());
    $existe     = false;

    $consulta = mysqli_query($conexion, "SELECT * FROM `fechas`  
    WHERE `mes`= '$mes' AND `year`= '$year'") or die ("Error al consultar: proveedores");
    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $existe[1] = true;
        $id_fecha = $fila['id_fecha'];
    }
    mysqli_free_result($consulta);



    if($existe == true){

        $id_ven_dia = array();
        $ventas = array();


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

        for ($i=0; $i < count($id_ven_dia); $i++) { 
            echo '<br>';
            if($i == ($hoy-1)){
                $consulta = mysqli_query($conexion, "UPDATE `ventas_diarias` 
                SET `ventas`='$total' 
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
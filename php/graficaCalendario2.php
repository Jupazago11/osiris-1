<script type="text/javascript" src="../js/funciones.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('div_canvas2').style.display='none'">X</a>

<canvas id="myChart" style="position: absolute;background-color:white; top:10%; left:10%; max-width:80%; max-height:80%"></canvas>

<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion


    $nanio    = $_POST['nanio'];
                
    //Obtenemos la cantidad de registros para dicho anio
    $consulta = mysqli_query($conexion, "SELECT COUNT(*) AS total 
    FROM `fechas`
    WHERE `year` = '$nanio'") or die ("Error al consultar: proveedores");
    while (($fila = mysqli_fetch_array($consulta))!=NULL){ 
        $cantidad_registros = $fila['total'];
    }
    mysqli_free_result($consulta);

    //Obtenemos LOS id DE LOS MESES
    $meses = array();
    $id_meses = array();
    
    $consulta = mysqli_query($conexion, "SELECT `id_fecha`,`mes` 
    FROM `fechas` 
    WHERE `year` = '$nanio'
    ORDER BY `mes` ASC") or die ("Error al consultar: proveedores");
    while (($fila = mysqli_fetch_array($consulta))!=NULL){ 
        array_push($meses, $fila['mes']);
        array_push($id_meses, $fila['id_fecha']);
    }
    mysqli_free_result($consulta);

    $nmeses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

    $colores = array(
        "FF0000",
        "FFFF00",
        "00FF00",
        "00FFFF",
        "0000FF",
        "FF00FF",
        "000000",
        "2E4255",
        "A6076C",
        "F46B00",
        "A1A1A1",
        "9FF55B"
    );
         
    ?>
    <script>
        const labels = [
            <?php   
                for($i = 0; $i < $cantidad_registros; $i++){
                    echo "'".$nmeses[$meses[$i]-1]."',";
                }
            
            ?>


        
        ];
        const data = {
        labels: labels,
        datasets: [
            <?php
            $total_mes_array = array();

            for ($i=0; $i < $cantidad_registros; $i++) { 
                $consulta = mysqli_query($conexion, "SELECT `ventas` 
                FROM `ventas_diarias` 
                WHERE `id_fecha1`='$id_meses[$i]'
                ORDER BY `id_ven_dia` ASC") or die ("Error al consultar: proveedores");
                
                $total_mes = 0;
                while (($fila = mysqli_fetch_array($consulta))!=NULL){  
                    $total_mes += $fila['ventas'];
                }
                array_push($total_mes_array, $total_mes);
            }
            ?>
            {
                label: '<?php echo $nanio ?>',
                data: 
                [<?php for ($i=0; $i < $cantidad_registros; $i++) { echo $total_mes_array[$i] ?>, <?php } ?>],
                fill: false,
                borderColor: 'red',
                tension: 0.1,
            },

            
        ]
        };

        const config = {
            type: 'line',
            data: data,
        };

        const myChart = new Chart(
        document.getElementById('myChart'),
        config
        );
        
    </script>
    <?php
        
    mysqli_free_result($consulta);

    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
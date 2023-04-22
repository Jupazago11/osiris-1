<script type="text/javascript" src="../js/funciones.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('div_canvas2').style.display='none'">X</a>

<canvas id="myChart" style="position: absolute;background-color:white; top:10%; left:10%; max-width:80%; max-height:80%"></canvas>

<?php

    $conexion = conectar();                     //Obtenemos la conexion


    $mes    = $_POST['mes'];
    $ventas_dias    = $_POST['ventas_dias'];



    ?>
    <script>
        const labels = [
            <?php   
                for($i = 1; $i <=count($ventas_dias); $i++){
                    echo "'".$i."',";
                }
            
            ?>


        
        ];

        const data = {
        labels: labels,
        datasets: [{
            label: 'Mensual',
            data: 
            <?php
            

                $consulta = mysqli_query($conexion, "SELECT `ventas` 
                FROM `ventas_diarias`
                WHERE `id_fecha1` = '$mes' 
                ORDER BY `id_ven_dia` ASC") or die ("Error al consultar: proveedores");
            ?>
            [<?php while (($fila = mysqli_fetch_array($consulta))!=NULL){ echo $fila['ventas'] ?>, <?php } ?>],
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
        }]
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

    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
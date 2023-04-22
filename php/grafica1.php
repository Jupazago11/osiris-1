<script type="text/javascript" src="../js/funciones.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('div_canvas').style.display='none'">X</a>

<canvas id="myChart" style="position: absolute;background-color:white; top:10%; left:10%; max-width:80%; max-height:80%"></canvas>

<?php
require("../php/conexion.php");
    $conexion = conectar();                     //Obtenemos la conexion


    $valor = $_POST['name_ro'];
    $anio  = $_POST['anio'];


    ?>
    <script>
        const labels = [
        'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre',
        ];

        const data = {
        labels: labels,
        datasets: [{
            label: '<?php echo $valor ?>',
            data: 
            <?php
                $consulta = mysqli_query($conexion, "SELECT `$valor` FROM `ro_detalles` 
                WHERE `id_ro1` = '$anio' ORDER BY `mes` ASC") or die ("Error al consultar: proveedores");
            ?>
            [<?php while (($fila = mysqli_fetch_array($consulta))!=NULL){ echo $fila[$valor] ?>, <?php } ?>],
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.3
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
<script type="text/javascript" src="../js/funciones.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('div_canvas').style.display='none'">X</a>

<canvas id="myChart" style="position: absolute;background-color:rgb(221,221,221); top:10%; left:10%; max-width:80%; max-height:80%"></canvas>

<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion


    $valor = $_POST['mes_ro'];
    $anio  = $_POST['anio'];

    switch ($valor) {
        case 'Enero':
            $nmes = 1;
            break;

        case 'Febrero':
            $nmes = 2;
            break;

        case 'Marzo':
            $nmes = 3;
            break;

        case 'Abril':
            $nmes = 4;
            break;
        case 'Mayo':
            $nmes = 5;
            break;

        case 'Junio':
            $nmes = 6;
            break;

        case 'Julio':
            $nmes = 7;
            break;

        case 'Agosto':
            $nmes = 8;
            break;
        case 'Septiembre':
            $nmes = 9;
            break;

        case 'Octubre':
            $nmes = 10;
            break;

        case 'Noviembre':
            $nmes = 11;
            break;

        case 'Diciembre':
            $nmes = 12;
            break;
        
        default:
            # code...
            break;
    }


    ?>
    <script>
        const labels = [
        'Inventario', 'Ventas', 'G. Operación', 'Dividendo', 'Inversión','Cxpagar', 'Cartera', 'Efectivo', 'Tarjeta',
        ];

        const data = {
        labels: labels,
        datasets: [{
            label: '<?php echo $valor ?>',
            data: 
            <?php
                $consulta = mysqli_query($conexion, "SELECT `inventario`, `ventas`, `g_operacion`, `dividendo`, `cxpagar`, `credito`, `efectivo`, `tarjeta`, `inversion` 
                FROM `ro_detalles` 
                WHERE `id_ro1` = '$anio' AND `mes` = $nmes") or die ("Error al consultar: proveedores");
            ?>
            [<?php while (($fila = mysqli_fetch_array($consulta))!=NULL){ 
                echo $fila['inventario'] ?>, <?php  
                echo $fila['ventas'] ?>, <?php
                echo $fila['g_operacion'] ?>, <?php
                echo $fila['dividendo'] ?>, <?php
                echo $fila['inversion'] ?>, <?php
                echo $fila['cxpagar'] ?>, <?php
                echo $fila['credito'] ?>, <?php
                echo $fila['efectivo'] ?>, <?php
                echo $fila['tarjeta'] ?>, <?php
                }?>],
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1,
            backgroundColor: [
            'rgb(90, 190, 180)',
            'rgb(240, 220, 170)',
            'rgb(230, 130, 90)',
            'rgb(230, 40, 60)',
            'rgb(20, 40, 60)',
            'rgb(20, 110, 15)'
            ]
        }]
        };

        const config = {
            type: 'doughnut',
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
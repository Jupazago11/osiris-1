<script type="text/javascript" src="../js/funciones.js"></script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion

    date_default_timezone_set('America/Bogota');
    $fecha        = date('Y-m-d', time());

    //Verificamos si el proveedor existe
    $existe_proveedor = false;

    //Consulta a la base de datos en la tabla provvedor
    $consulta = mysqli_query($conexion, "SELECT * FROM `cuenta_cobro` WHERE `estado` = 'activo' ORDER BY`nombre` ASC") or die ("Error al consultar: proveedores");

    ?>

    <br>
    <table border="1" id="tabla_sugerido" width="100%">
    <tr>
        <th>Nombre del Proveedor</th>
        <th>Fecha Límite</th>
        <th>Días restantes</th>
        <th>Novedades</th>
    </tr>
    <tr>
    <form id="cuentas_por_pagar" method="POST">
        <?php
        while (($fila = mysqli_fetch_array($consulta))!=NULL){
            // traemos los proveedores existentes en la base de datos
            echo "<td>".$fila['nombre']."</td>";
            echo "<td>".$fila['fecha']."</td>";

            $fecha1  = new DateTime($fecha);
            $fecha2 = new DateTime($fila['fecha']);
            $intvl = $fecha1->diff($fecha2);

            if($fecha > $fila['fecha']){
                echo "<td>- ".$intvl->days."</td>";
                echo "<td><i class='fa fa-exclamation' style='font-size:36px;color:red'></i></td><tr>";
            }else{
                echo "<td>".$intvl->days."</td>";
                echo "<td></td><tr>";
            }
            
        }
        mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
        ?>
    </form>
    </tr>
    </table>
    <?php    
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
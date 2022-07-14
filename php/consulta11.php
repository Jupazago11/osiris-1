<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();

  //resultados operativos///////////////////////

    $mes  = $_POST['mes'];
    $year = $_POST['year'];
    $existe = array(false, false);

    $consulta = mysqli_query($conexion, "SELECT * FROM `gasto`  
    WHERE `mes`= '$mes' AND `year`= '$year'") or die ("Error al consultar: proveedores");
    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $existe[0] = true;
        $id_gasto = $fila['id_gasto'];
    }
    mysqli_free_result($consulta);


    $consulta = mysqli_query($conexion, "SELECT * FROM `presupuesto`  
    WHERE `mes`= '$mes' AND `year`= '$year'") or die ("Error al consultar: proveedores");
    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $existe[1] = true;
        $id_presu = $fila['id_presu'];
    }
    mysqli_free_result($consulta);

/////////////////////////////////////////////////////////////////////////////////////////////

    if($existe[0] == true && $existe[1] == true){

        ?>

        <table id="tabla_sugerido" style="width:25%">
            <tr>
                <th colspan="2">Presupuesto</th>
            </tr>
            <tr>
                <td>Descripción</td>
                <td>Valor</td>
            </tr>
            <tr>
            <?php
            $consulta = mysqli_query($conexion, "SELECT * FROM `gas_detalle` 
            WHERE `id_gasto1` = '$id_gasto'") or die ("Error al consultar: proveedores");
            while (($fila = mysqli_fetch_array($consulta))!=NULL){
                
                echo "<td>".$fila['nombre']."</td>";
                echo "<td>".$fila['costo']."</td>";
                echo "</tr>";
            }
            mysqli_free_result($consulta);?>
            <tr>
                <td></td>
                <td></td>
            </tr>
        </table>
        <table id="tabla_sugerido" style="width:25%">
            <tr>
                <th colspan="2">Gastos reales</th>
            </tr>
            <tr>
                <td>Descripción</td>
                <td>Valor</td>
            </tr>
            <tr>
            <?php
            $consulta = mysqli_query($conexion, "SELECT * FROM `pre_detalle` 
            WHERE `id_presu1` = '$id_presu'") or die ("Error al consultar: proveedores");

            while (($fila = mysqli_fetch_array($consulta))!=NULL){

                echo "<td>".$fila['nombre']."</td>";
                echo "<td>".$fila['costo']."</td>";
                echo "</tr>";
            }

            mysqli_free_result($consulta);?>
            <tr>
                <td></td>
                <td></td>
            </tr>
        </table>







        <?php
    }else{

    }
?>
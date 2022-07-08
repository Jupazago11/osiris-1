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

    $contador = 0;

    //Consulta a la base de datos en la tabla provvedor
    $consulta = mysqli_query($conexion, "SELECT * FROM `cuenta_cobro` 
    WHERE `estado` = 'activo' 
    ORDER BY `id_cuenta` ASC") or die ("Error al consultar: proveedores");

    ?>
    <form id="actualizar_cuentas_cobro" method="POST">
    <table border="1" id="tabla_sugerido" width="100%">
    <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Factura</th>
        <th>Fecha de Registro</th>
        <th>Días restantes</th>
        <th>Fecha límite</th>
        <th>Novedad</th>
        <th>Valor</th>
        <th></th>
    </tr>
    <tr>
        <?php
        $costo_total = 0;
        while (($fila = mysqli_fetch_array($consulta))!=NULL){
            $contador++;
            // traemos los proveedores existentes en la base de datos

            ?>
            <input type="hidden" name="id_cuenta[]" value="<?php echo $fila['id_cuenta'] ?>"/>
            <?php
            echo "<td>".$contador."</td>";
            echo "<td>".$fila['nombre']."</td>";
            echo "<td>".$fila['factura']."</td>";
            echo "<td>".$fila['fecha']."</td>";
                      

            $fecha_limite = date("Y-m-d",strtotime($fila['fecha']."+ ".$fila['dias']." days"));

            $fecha1  = new DateTime($fecha);
            $fecha2  = new DateTime($fecha_limite);
            
            $intvl   = $fecha1->diff($fecha2);


            echo "<td>".$intvl->days."</td>";
            echo "<td>".date("Y-m-d",strtotime($fila['fecha']."+ ".$fila['dias']." days"))."</td>";
            
            if($intvl->days < 7){
                echo "<td style='background-color:red;border: 2px solid white;'></td>";
            }elseif($intvl->days >= 7 && $intvl->days < 15){
                
                echo "<td style='background-color:yellow;border: 2px solid white;'></td>";
            }elseif($intvl->days >= 15){
                echo "<td style='background-color:green;border: 2px solid white;'></td>";
            }else{
                echo "<td style='background-color:black;border: 2px solid white;'></td>";
            }
            echo "<td>".number_format($fila['costo'], 0, ',', '.')."</td>";
            
            $costo_total += $fila['costo'];

            ?>
            <td><input type="radio" name="estado[<?php echo $contador ?>]" value="activo" style="visibility:hidden;" checked>
            <input type="radio" name="estado[<?php echo $contador ?>]" value="inactivo">
                Pagar<br></td> 
            <?php

            echo "</tr>";
        }
        echo "<tr><td colspan='6'></td><td>Total</td><th>".number_format($costo_total, 0, ',', '.')."</th>";
        ?>
        <td><button type="button" id="enviar6_2" class="w3-btn w3-green" onclick="document.getElementById('respuesta6_2').style.display='block'">Actualizar <i class='fas fa-edit' style='font-size:24px;color:white'></button></td></tr>
        <?php
        mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
        ?>
    </tr>
    </table>
    </form>
    <div id="respuesta6_2"></div>
    <script>
    $('#enviar6_2').click(function(){
        $.ajax({
            url:'../php/consulta6_2.php',
            type:'POST',
            data: $('#actualizar_cuentas_cobro').serialize(),
            success: function(res){
                //$('#respuesta6_2').html(res);
                $('#enviar6_1').trigger('click');
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });
    </script>
    <?php 
    
    
    //Consulta a la base de datos en la tabla provvedor
    $consulta = mysqli_query($conexion, "SELECT * FROM `cuenta_cobro` 
    WHERE `estado` = 'inactivo' 
    ORDER BY `fecha_pago` DESC") or die ("Error al consultar: proveedores");

    ?>

    <br>
    <table border="1" id="tabla_sugerido" width="100%">
    <tr>
        <th>Nombre</th>
        <th>Factura</th>
        <th>Fecha de Registro</th>
        <th>Fecha de pago</th>
        <th>Valor</th>
    </tr>
    <tr>
    <?php
    $costo_total = 0;
    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        // traemos los proveedores existentes en la base de datos
        echo "<td>".$fila['nombre']."</td>";
        echo "<td>".$fila['factura']."</td>";
        echo "<td>".$fila['fecha']."</td>";
                    
        echo "<td>".$fila['fecha_pago']."</td>";

        echo "<td>".number_format($fila['costo'], 0, ',', '.')."</td>";

        
        
        echo "</tr>";
        $costo_total += $fila['costo'];
        
    }
    echo "<tfoot><tr><td colspan='3'></td><td>Total</td><th>".number_format($costo_total, 0, ',', '.')."</th></tr></tfoot>";
    mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
    ?>
    </tr>
    </table>
    

    
    <?php
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
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

    ?>
    <form id="actualizar_vehiculos" method="POST">
    <table id="tabla_sugerido">
        <tr>
            <th colspan="11" style="text-align: center;"><h3>Información Vehicular</h3></th>
        <tr>
        <tr>
            <th>#</th>
            <th>Tipo</th>
            <th>PLaca</th>
            <th>SOAT</th>
            <th></th>
            <th>Tecnicomecánica</th>
            <th></th>
            <th>Kilometraje</th>
            <th>Estado</th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <?php
            $contador = 0;
            $consulta = mysqli_query($conexion, "SELECT * FROM `vehiculo` 
            WHERE estado != ''
            ORDER BY id_vehiculo ASC") or die ("Error al consultar: existencia del proveedor");

            while (($fila = mysqli_fetch_array($consulta))!=NULL){
                $contador++;
                ?>
                <tr>
                    <input type="hidden" name="id_vehiculo[]" value="<?php echo $fila['id_vehiculo'] ?>"/>
                    <td><?php echo $contador ?></td>
                    <td><input type="text" name="tipo[]" size="10" value="<?php echo $fila['tipo'] ?>"/></td>
                    <td><input type="text" name="placa[]" size="6" value="<?php echo $fila['placa'] ?>"/></td>
                    <td><input type="date" name="fecha_soat[]" value="<?php echo $fila['fecha_soat'] ?>"/></td>

                    <?php

                    $fecha1  = new DateTime($fecha);
                    $fecha2 = new DateTime(date("Y-m-d",strtotime($fila['fecha_soat']." + 1 year")));

                    $intvl   = $fecha1->diff($fecha2);
                    if($fecha1 == $fecha2){
                        echo "<td style='border: 2px solid white;text-align: center;color:black;'>".$intvl->y." Año</td>";
                    }elseif($intvl->d != 0){
                        if($intvl->m <=1 && $intvl->d >=0){
                            echo "<td style='background-color:red;border: 2px solid white;text-align: center;color:white;'>".$intvl->m." Meses con ".$intvl->d." días</td>";
                        }elseif($intvl->m >= 2 && $intvl->m <= 3){
                            echo "<td style='background-color:yellow;border: 2px solid white;text-align: center;color:black;'>".$intvl->m." Meses con ".$intvl->d." días</td>";
                        }elseif($intvl->m > 3 ){
                            echo "<td style='background-color:green;border: 2px solid white;text-align: center;color:white;'>".$intvl->m." Meses con ".$intvl->d." días</td>";
                        }else{
                            echo "<td style='background-color:green;border: 2px solid white;text-align: center;color:white;'>".$intvl->days." días</td>";
                        }
                    }elseif($intvl->m == 0 && $intvl->d == 0){
                        echo "<td style='background-color:green;border: 2px solid white;text-align: center;color:white;'>1 Año</td>";
                    }
                    
                    ?>
                    

                    <td><input type="date" name="fecha_tecn[]" value="<?php echo $fila['fecha_tecn'] ?>"/></td>
                    <?php

                    $fecha1  = new DateTime($fecha);
                    $fecha2 = new DateTime(date("Y-m-d",strtotime($fila['fecha_tecn']." + 1 year")));

                    $intvl   = $fecha1->diff($fecha2);

                    if($fecha1 == $fecha2){
                        echo "<td style='border: 2px solid white;text-align: center;color:black;'>".$intvl->y." Año</td>";
                    }elseif($intvl->d != 0){
                        if($intvl->m <=1 && $intvl->d >=0){
                            echo "<td style='background-color:red;border: 2px solid white;text-align: center;color:white;'>".$intvl->m." Meses con ".$intvl->d." días</td>";
                        }elseif($intvl->m >= 2 && $intvl->m <= 3){
                            echo "<td style='background-color:yellow;border: 2px solid white;text-align: center;color:black;'>".$intvl->m." Meses con ".$intvl->d." días</td>";
                        }elseif($intvl->m > 3 ){
                            echo "<td style='background-color:green;border: 2px solid white;text-align: center;color:white;'>".$intvl->m." Meses con ".$intvl->d." días</td>";
                        }else{
                            echo "<td style='background-color:green;border: 2px solid white;text-align: center;color:white;'>".$intvl->days." días</td>";
                        }
                    }elseif($intvl->m == 0 && $intvl->d == 0){
                        echo "<td style='background-color:green;border: 2px solid white;text-align: center;color:white;'>1 Año</td>";
                    }
                    ?>
                    <td><input type="text" name="kilometraje[]" size="8" value="<?php echo $fila['kilometraje'] ?>"/></td>
                    <td>
                    <?php

                    if($fila['estado'] == "activo"){
                        ?>
                        <input type="radio" name="estado[<?php echo $contador ?>]" value="activo" checked>
                            Activo<br>
                        <input type="radio" name="estado[<?php echo $contador ?>]" value="inactivo">
                            Inactivo<br></td> 
                        <?php
                    }elseif($fila['estado'] == "inactivo"){
                        ?>
                        <input type="radio" name="estado[<?php echo $contador ?>]" value="activo">
                            Activo<br>
                        <input type="radio" name="estado[<?php echo $contador ?>]" value="inactivo" checked>
                            Inactivo<br></td> 
                        <?php
                    }
                    ?>
                    <td>
                    <?php
                    if($fila['tipo'] == '' || $fila['tipo'] == NULL){
                        ?>
                        <td class="w3-btn w3-red"><input type="radio" name="eliminar[<?php echo $contador ?>]" value="activo" style="visibility:hidden;" checked>
                        <input type="radio" name="eliminar[<?php echo $contador ?>]" value="eliminar" id="eliminar[<?php echo $contador ?>]" onchange="$('#enviar10_4').trigger('click');">
                        <label for="eliminar[<?php echo $contador ?>]">X</label><br></td> 
                        <?php
                    }else{
                        ?>
                        <td><input type="radio" name="eliminar[<?php echo $contador ?>]" value="activo" style="visibility:hidden;" checked>
                        <input type="radio" name="eliminar[<?php echo $contador ?>]" value="eliminar" id="eliminar[<?php echo $contador ?>]" style="visibility:hidden;" onchange="$('#enviar10_4').trigger('click');"></td> 
                        <?php
                    }
                    ?>
                    
            <?php
            }
            mysqli_free_result($consulta);
            ?>
        </tr>
        <tr>
            <td></td>
            <td><button type="button" id="enviar10_3" class="w3-btn"><i class="fa fa-plus-circle" style="font-size:24px;color:#305490"></i></button></td>
            <td colspan="4"></td>
            <td></td>
            <td></td>
            <td><button type="button" id="enviar10_4" class="w3-btn" style="background-color: #478248;color:white;" onclick="document.getElementById('respuesta10_3').style.display='block'">Guardar <i class='fas fa-edit' style='font-size:24px;color:white'></button></td>
            <td></td>
            <td></td>
        </tr>
    </table>
    </form>
    <div id="respuesta10_3" style="display:none;"></div>

<script>
$('#enviar10_4').click(function(){
    $.ajax({
        url:'../php/consulta10_4.php',
        type:'POST',
        data: $('#actualizar_vehiculos').serialize(),
        success: function(res){
            Swal.fire(
            '¡Muy bien!',
            'Guardado Exitoso',
            'success'
            )
            $('#respuesta10_4').html(res);
            $('#enviar10_1').trigger('click');
        },
        error: function(res){
            alert("Problemas al tratar de enviar el formulario");
        }
    });
});
$('#enviar10_3').click(function(){
    $.ajax({
        url:'../php/consulta10_3.php',
        success: function(res){
            $('#enviar10_1').trigger('click');
        },
        error: function(res){
            alert("Problemas al tratar de enviar el formulario");
        }
    });
});
</script>
<?php
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
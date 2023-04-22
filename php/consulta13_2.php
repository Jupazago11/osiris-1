<?php
require("../php/conexion.php");
$conexion = conectar();                     //Obtenemos la conexion

date_default_timezone_set('America/Bogota');
$fecha   = date('Y-m-d', time());
//$hoy     = date("H:i:s", time());

$usuario = $_POST['usuario'];

//  obtenemos el id del empleado
$consulta = mysqli_query($conexion, "SELECT `id_pers` 
FROM `personal` 
WHERE `user_pers` = '$usuario'") or die ("Error al consultar: proveedores");
while (($fila = mysqli_fetch_array($consulta))!=NULL){
    $id_pers = $fila['id_pers'];
}

$existe_registro = false;


$consulta = mysqli_query($conexion, "SELECT * 
FROM `control` 
WHERE `id_pers4` = '$id_pers' AND `fecha` = '$fecha'") or die ("Error al consultar: proveedores");
while (($fila = mysqli_fetch_array($consulta))!=NULL){
    $existe_registro = true;
    $id_control = $fila['id_control'];

}
mysqli_free_result($consulta);


if($existe_registro == true){
    ?>
    <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('cont5_2').style.display='none';ocultarDivs0();">X</a>
    <form id="mandar_valor_control13_3" method="post">
        <input type="hidden" name="id_control" value="<?php echo $id_control ?>"/>

    <table class="tabla_sugerido" id="tabla_control" style="width:50%;border: 1px solid black; border-collapse: collapse;margin-left: auto;  margin-right: auto;background-color:white;
}">
        <?php

        $empieza = 0;
        $nombr = array('Llegada','Desayuno','Regreso Desayuno','Almuerzo','Regreso Almuerzo','Salida');
        $horas = array();

        $consulta = mysqli_query($conexion, "SELECT * 
        FROM `control` 
        WHERE `id_pers4` = '$id_pers' AND `fecha` = '$fecha'") or die ("Error al consultar: proveedores");
        while (($fila = mysqli_fetch_array($consulta))!=NULL){
            
            if($fila['llegada'] != ''){$empieza++;array_push($horas, $fila['llegada']);}
            if($fila['ir_desayuno'] != ''){$empieza++;array_push($horas, $fila['ir_desayuno']);}
            if($fila['regre_desayuno'] != ''){$empieza++;array_push($horas, $fila['regre_desayuno']);}
            if($fila['ir_almuerzo'] != ''){$empieza++;array_push($horas, $fila['ir_almuerzo']);}
            if($fila['regre_almuerzo'] != ''){$empieza++;array_push($horas, $fila['regre_almuerzo']);}
            if($fila['salida'] != ''){$empieza++;array_push($horas, $fila['salida']);} 

            if($empieza != 6){
                for ($i = 0; $i < $empieza; $i++) { 
                    ?>
                    <tr>
                        <th><?php echo $nombr[$i] ?></th>
                        <td><?php echo date("g:i:s a", strtotime($horas[$i])); ?></td>
                    </tr>
                    <?php
                }
                for ($i = $empieza; $i < count($nombr); $i++) { 
                    ?>
                    <tr>
                        <th><?php echo $nombr[$i] ?></th>
                        <td><img src="../iconos/proximo2.png" id="enviar13_3" width="40px" height="40px"></td>
                        <input type="hidden" name="valor" value="<?php echo $i ?>"/>
                    </tr> 
                    <?php
                    $flag = $i+1 ;
                    break;
                }
                for ($i = $flag; $i < count($nombr); $i++) { 
                    ?>
                    <tr>
                        <th><?php echo $nombr[$i] ?></th>
                        <td></td>
                    </tr> 
                    <?php
                }
            }else{
                for ($i = 0; $i < count($nombr); $i++) { 
                    ?>
                    <tr>
                        <th><?php echo $nombr[$i] ?></th>
                        <td><?php echo $horas[$i] ?></td>
                    </tr> 
                    <?php
                }
            }
            
            
            


        }
        mysqli_free_result($consulta);

        ?>
        </tr>
    </table>
    <form>

    <script>
        $('#enviar13_3').click(function(){
            $.ajax({
                url:'../php/consulta13_3.php',
                type:'POST',
                data: $('#mandar_valor_control13_3').serialize(),
                success: function(res){
                    $('#enviar13_2').trigger('click');
                },
                error: function(res){
                    alert("Problemas al tratar de enviar el formulario");
                }
            });
        });

    </script>

    <?php



}else{
    $consulta = mysqli_query($conexion, "INSERT INTO `control`(`id_pers4`, `fecha`) 
    VALUES ('$id_pers', '$fecha')") or die ("Error al consultar: proveedores");
    ?>

    <script>
        $('#enviar13_2').trigger('click');
    </script>

    <?php

    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
}



?>
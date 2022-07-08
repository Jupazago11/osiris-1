<script type="text/javascript" src="../js/funciones.js"></script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion

    $nombre_pers   = $_POST['nombre_pers'];
    $id_pers   = $_POST['id_pers'];
    $fecha_inicio_contrato_pers = $_POST['fecha_inicio_contrato_pers'];
    $identificacion_pers  = $_POST['identificacion_pers'];
    $tipo_contrato_pers  = $_POST['tipo_contrato_pers'];
    $fecha_nacimiento_pers  = $_POST['fecha_nacimiento_pers'];
    $salario_pers    = $_POST['salario_pers'];
    $eps    = $_POST['eps'];
    $user_pers    = $_POST['user_pers'];
    $arl    = $_POST['arl'];
    $pass_pers    = $_POST['pass_pers'];
    $caja_compensacion    = $_POST['caja_compensacion'];
    $tipo_usuario_pers    = $_POST['tipo_usuario_pers'];
    $pension    = $_POST['pension'];
    $cargo    = $_POST['cargo'];
    $estado    = $_POST['estado'];

    for ($i = 0; $i < count($nombre_pers); $i++) { 
        $j = $i + 1; //ya que el arreglo de los estados en html del formulario anterior empieza en 1 y no en 0

        $consulta = mysqli_query($conexion, "UPDATE `personal` SET `nombre_pers`='$nombre_pers[$i]',`identificacion_pers`='$identificacion_pers[$i]', `user_pers`='$user_pers[$i]', `pass_pers`='$pass_pers[$i]', `tipo_usuario_pers`='$tipo_usuario_pers[$i]', `fecha_nacimiento_pers`='$fecha_nacimiento_pers[$i]',`fecha_inicio_contrato_pers`='$fecha_inicio_contrato_pers[$i]',`tipo_contrato_pers`= '$tipo_contrato_pers[$i]', `cargo`='$cargo[$i]', `salario_pers`='$salario_pers[$i]', `eps`='$eps[$i]', `arl`='$arl[$i]', `caja_compensacion`='$caja_compensacion[$i]', `pension`='$pension[$i]',`estado`='$estado[$j]' 
        WHERE `tipo_usuario_pers` != '6' AND `tipo_usuario_pers` != '5' AND `id_pers`='$id_pers[$i]'") or die ("Error al update: proveedores");
    }

    ?>
    <br>
    <div class="alert info">
        <span class="closebtn">&times;</span>  
        <strong>Información!</strong> El personal han sido actualizados
    </div>
    <?php

    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
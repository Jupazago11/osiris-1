<script type="text/javascript" src="../js/funciones.js"></script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion

    $nombre   = strval($_POST['nombre']);
    $fecha_contrato = $_POST['fecha_contrato'];
    $identificacion  = $_POST['identificacion'];
    $contrato  = $_POST['contrato'];
    $fecha_nacimiento  = $_POST['fecha_nacimiento'];
    $salario    = $_POST['salario'];
    $eps    = strval($_POST['eps']);
    $user    = strval($_POST['user']);
    $arl    = $_POST['arl'];
    $pass    = strval($_POST['pass']);
    $caja    = $_POST['caja'];
    $lvl_acc    = $_POST['lvl_acc'];
    $pension    = $_POST['pension'];
    $cargo    = $_POST['cargo'];
    $encontrado = false;

    $consulta = mysqli_query($conexion, "SELECT `identificacion_pers` FROM `personal` WHERE `identificacion_pers` = '$identificacion'") or die ("Error al consultar: existencia del proveedor");

    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $encontrado = true;
    }
    mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario

    if($encontrado == false && strlen($user) > 3 && strlen($pass) > 3 && $lvl_acc > 0 && $lvl_acc < 6){

        $consulta = mysqli_query($conexion, "INSERT INTO `personal`(`nombre_pers`, `identificacion_pers`, `user_pers`, `pass_pers`, `tipo_usuario_pers`, `fecha_nacimiento_pers`, `fecha_inicio_contrato_pers`, `tipo_contrato_pers`, `cargo`, `salario_pers`, `eps`, `arl`, `caja_compensacion`, `pension`, `estado`) 
        VALUES ('$nombre', '$identificacion', '$user', '$pass', '$lvl_acc', '$fecha_nacimiento', '$fecha_contrato', '$contrato', '$cargo', '$salario', '$eps', '$arl', '$caja', '$pension', 'activo')") or die ("Error al update: proveedores");

        ?>
        <br>
        <div class="alert success">
            <span class="closebtn">&times;</span>  
            <strong>Información!</strong> Agregado con éxito
        </div>
        <?php
    }elseif($encontrado == true){
        ?>
        <br>
        <div class="alert info">
            <span class="closebtn">&times;</span>  
            <strong>Información!</strong> Ya existe un registro con esa misma Identificación
        </div>
        <?php
    }else{
        ?>
        <br>
        <div class="alert info">
            <span class="closebtn">&times;</span>  
            <strong>Información!</strong> Verifica los campos
        </div>
        <?php
    }

    

    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
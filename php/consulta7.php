<script type="text/javascript" src="../js/funciones.js"></script>
<?php
require("../php/conexion.php");
    $conexion = conectar();                     //Obtenemos la conexion

    $nombre   = strval($_POST['nombre']);
    $direccion = strval($_POST['direccion']);
    $contacto  = strval($_POST['contacto']);
    $nombrevendedor  = strval($_POST['nombrevendedor']);
    $telefono  = strval($_POST['telefono']); 



    $consulta = mysqli_query($conexion, "SELECT `nombre_proveedor` FROM `proveedor` WHERE `nombre_proveedor` = '$nombre'") or die ("Error al consultar: existencia del proveedor");

    $encontrado = false;
    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $encontrado = true;
    }
    mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario

    if(strlen($nombre) >= 3 && strlen($direccion) >= 6 && strlen($contacto) >= 6 && strlen($nombrevendedor) >= 3 && strlen($telefono) >= 6 && $encontrado != true){

        $consulta = mysqli_query($conexion, "INSERT INTO `personal`(`user_pers`, `pass_pers`, `tipo_usuario_pers`, `estado`) 
        VALUES ('$nombre', '$nombre', 5, 'activo')") or die ("Error al consultar: personal");

        $consulta = mysqli_query($conexion, "INSERT INTO `proveedor`(`nombre_proveedor`, `direccion_proveedor`, `contacto_proveedor`, `nom_vendedor`, `telefono_vendedor`, `estado`) 
        VALUES ('$nombre','$direccion','$contacto','$nombrevendedor','$telefono','activo')") or die ("Error al consultar: proveedor");
        ?>
        <br>
        <div class="alert info">
            <span class="closebtn">&times;</span>  
            <strong>Información!</strong> Creado con éxito
        </div>
        <?php
    }elseif(strlen($nombre) < 3 && strlen($direccion) < 6 && strlen($contacto) < 6 && strlen($nombrevendedor) < 3 && strlen($telefono) < 6){
        ?>
        <br>
        <div class="alert warning">
            <span class="closebtn">&times;</span>  
            <strong>Información!</strong> Los campos deben contener 6 caracteres como mínimo.
        </div>
        <?php
    }elseif($encontrado == true){
        ?>
        <br>
        <div class="alert warning">
            <span class="closebtn">&times;</span>  
            <strong>Información!</strong> Ya existe un proveedor con ese nombre.
        </div>
        <?php
    }
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
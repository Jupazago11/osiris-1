<?php
require("../php/conexion.php");
$conexion = conectar();

date_default_timezone_set('America/Bogota');
$fecha = date('Y-m-d', time());

$nombre_cliente             = $_POST['nombre_cliente'];
$identificacion_cliente     = $_POST['identificacion_cliente'];
$direccion_cliente          = $_POST['direccion_cliente'];
$ubicaciones                = $_POST['ubicaciones'];
$telefono_cliente           = $_POST['telefono_cliente'];


if(strlen($nombre_cliente) > 4 && strlen($identificacion_cliente) > 5){

    ///////////////////////////////////////
    //  Ahora verificamos que no exista una cedula existente

    $consulta = mysqli_query($conexion, "SELECT `identificacion_cliente` 
    FROM `cliente` 
    WHERE `identificacion_cliente` = '$identificacion_cliente' AND `estado` = 'activo'") or die ("Error al consultar: no se obtuvo la el la informacion de los productos");

    $existe = false;

    while (($fila = mysqli_fetch_array($consulta))!=NULL) {
        $existe = true;
    }
    mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario

    if($existe == true){
        ?>
        <script>
            Swal.fire({icon: 'error',title: 'Oops...',text: 'Ya existe un registro con esa identificación',})
        </script>
        <?php
    }else{
        $consulta = mysqli_query($conexion, "INSERT INTO `cliente`(`id_ubi1`, `nombre_cliente`, `identificacion_cliente`, `direccion_cliente`, `telefono_cliente`, `estado`) 
        VALUES ('$ubicaciones','$nombre_cliente','$identificacion_cliente','$direccion_cliente','$telefono_cliente ','activo')") or die ("Error al consultar: no se obtuvo la el la informacion de los productos");
        ?>
        <script>
            document.getElementById('respuesta_crear_cliente').style.display='none';
            document.getElementById('xcont_4_1').style.display='block';
            Swal.fire(
                '¡Muy bien!',
                'Cliente registrado exitosamente',
                'success'
                )
        </script>
        <?php
    }


    
}else{
    ?>
    <script>
        Swal.fire({icon: 'error',title: 'Oops...',text: 'Agrega un nombre e identificación válidos con más de 6 digitos',})
    </script>
    <?php
}

?>
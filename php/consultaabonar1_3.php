<script type="text/javascript" src="../js/funciones.js"></script>
<script>document.getElementById('xcont_factuabo1_1').style.display='none';</script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion



    $id_cliente             = $_POST['id_cliente'];
    $nombre_cliente         = $_POST['nombre_cliente'];
    $identificacion_cliente = $_POST['identificacion_cliente'];
    $direccion_cliente      = $_POST['direccion_cliente'];
    $id_ubi1                = $_POST['id_ubi1'];
    $telefono_cliente       = $_POST['telefono_cliente'];

    $consulta = mysqli_query($conexion, "UPDATE `cliente` 
    SET `id_ubi1`='$id_ubi1',`nombre_cliente`='$nombre_cliente',`identificacion_cliente`='$identificacion_cliente',`direccion_cliente`='$direccion_cliente',`telefono_cliente`='$telefono_cliente' 
    WHERE `id_cliente` = '$id_cliente'") or die ("Error al consultar: proveedores");

    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
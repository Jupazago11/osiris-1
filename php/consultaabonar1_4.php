<script type="text/javascript" src="../js/funciones.js"></script>
<script>document.getElementById('xcont_factuabo1_1').style.display='none';</script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion

    date_default_timezone_set('America/Bogota');
    $fecha = date('Y-m-d', time());

    $id_cliente             = $_POST['id_cliente'];
    $abono                  = str_replace(".","",$_POST['abono']);
    $metodo_de_pago2        = $_POST['metodo_de_pago2'];

    if($abono > 0){
        $consulta = mysqli_query($conexion, "INSERT INTO `factura_abono`(`abono`, `fecha_abono`, `id_cliente1`, `metodo_abono`) 
        VALUES ('$abono', '$fecha', '$id_cliente', '$metodo_de_pago2')") or die ("Error al consultar: proveedores");
    }
    

    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
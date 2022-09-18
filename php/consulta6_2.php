<script type="text/javascript" src="../js/funciones.js"></script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion


    $id_cuenta    = $_POST['id_cuenta'];
    $proveedor   = $_POST['proveedor'];
    $factura    = $_POST['factura'];
    $fecha    = $_POST['fecha'];
    $dias    = $_POST['dias'];
    $costo    = str_replace(".","",$_POST['costo']);;
    $estado    = $_POST['estado'];
    $eliminar = $_POST['eliminar'];

    date_default_timezone_set('America/Bogota');
    $hoy = date("Y-m-d H:i:s");

    
    for ($i = 0; $i < count($proveedor); $i++) { 

        $j = $i + 1; //ya que el arreglo de los estados en html del formulario anterior empieza en 1 y no en 0

        $consulta = mysqli_query($conexion, "UPDATE `cuenta_cobro` SET 
        `nombre`='$proveedor[$i]',`factura` = '$factura[$i]',`fecha`='$fecha[$i]',  `estado` = '$estado[$j]', `costo` = '$costo[$i]', `dias` = '$dias[$i]' 
        WHERE `id_cuenta` = '$id_cuenta[$i]'") or die ("Error al update: proveedores");

        if($estado[$j] == 'inactivo') {
            $consulta = mysqli_query($conexion, "UPDATE `cuenta_cobro` SET 
            `fecha_pago` = '$hoy' 
            WHERE `id_cuenta` = '$id_cuenta[$i]'") or die ("Error al update: proveedores");
        }elseif($eliminar[$j] == 'eliminar'){
            $consulta = mysqli_query($conexion, "UPDATE `cuenta_cobro` SET 
            `estado` = '' 
            WHERE `id_cuenta` = '$id_cuenta[$i]'") or die ("Error al update: proveedores");
        }
        
    }
    
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
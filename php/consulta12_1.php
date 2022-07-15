<script type="text/javascript" src="../js/funciones.js"></script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion

    $id_ro1         = $_POST['id_ro1'];
    $id_ro_de       = $_POST['id_ro_de'];
    $inventario     = $_POST['inventario'];
    $ventas         = $_POST['ventas'];
    $g_operacion    = $_POST['g_operacion'];
    $margen         = $_POST['margen'];
    $dividendo      = $_POST['dividendo'];
    $cxpagar        = $_POST['cxpagar'];
    $credito        = $_POST['credito'];
    $efectivo       = $_POST['efectivo'];
    $tarjeta        = $_POST['tarjeta'];

    for ($i = 0; $i < count($id_ro_de); $i++) { 

        $consulta = mysqli_query($conexion, "UPDATE `ro_detalles` SET `inventario`='$inventario[$i]', `ventas`='$ventas[$i]', `g_operacion`='$g_operacion[$i]',`margen`='$margen[$i]',`dividendo`='$dividendo[$i]',`cxpagar`='$cxpagar[$i]', `credito`='$credito[$i]',`efectivo`='$efectivo[$i]',`tarjeta`='$tarjeta[$i]' 
        WHERE `id_ro_de` = '$id_ro_de[$i]'") or die ("Error al update: presupuesto");
        
    }

    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
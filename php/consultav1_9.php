<script type="text/javascript" src="../js/funciones.js"></script>
<?php
require("../php/conexion.php");
    $conexion = conectar();                     //Obtenemos la conexion

    $id_cuadre_caja_completa     = $_POST['id_cuadre_caja_completa'];

    $id_efectivo_en_caja = array();
    
    $consulta = mysqli_query($conexion, "SELECT `id_efectivo_en_caja` 
    FROM `efectivo_en_caja`
    WHERE `id_cuadre_caja_completo4` = '$id_cuadre_caja_completa'
    ORDER BY `id_efectivo_en_caja` ASC") or die ("Error al update: presupuesto");


    while (($fila = mysqli_fetch_array($consulta))!=NULL){

        array_push($id_efectivo_en_caja ,$fila['id_efectivo_en_caja']);
    }
    mysqli_free_result($consulta);


    //Guardamos la cantidad que tenemos

    $efectivo_en_caja      = $_POST['cantidad_monedas'];
    
    for ($i = 0; $i < count($id_efectivo_en_caja); $i++) { 
        $consulta = mysqli_query($conexion, "UPDATE `efectivo_en_caja` 
        SET `efectivo_en_caja`='$efectivo_en_caja[$i]'
        WHERE `id_efectivo_en_caja` = '$id_efectivo_en_caja[$i]'
        AND `id_cuadre_caja_completo4` = '$id_cuadre_caja_completa'") or die ("Error al update: efectivo en caja");
        
    }

    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
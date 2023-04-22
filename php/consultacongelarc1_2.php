<script type="text/javascript" src="../js/funciones.js"></script>
<script>document.getElementById('xcont_4_1').style.display='none';</script>
<?php

    $conexion = conectar();                     //Obtenemos la conexion
    
    $id_facturacion  = $_POST['id_facturacion'];
    $name_refe       = $_POST['name_refe'];

    $consulta = mysqli_query($conexion, "UPDATE `factura` 
    SET `nombre_congelado` = '$name_refe' 
    WHERE `id_facturacion` = '$id_facturacion'") or die ("Error al consultar: datos de  producto");


?>
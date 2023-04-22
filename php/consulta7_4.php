<script type="text/javascript" src="../js/funciones.js"></script>
<script type="text/javascript" src="../js/funciones.js"></script>
<script src="sweetalert2.min.js"></script>
<?php

    $conexion = conectar();                     //Obtenemos la conexion

    $id_proveedor   = $_POST['id_proveedor'];
    $nombres   = $_POST['nombres'];
    $user = $_POST['user'];
    $pass  = $_POST['pass'];


    for ($i = 0; $i < count($id_proveedor); $i++) { 
        $consulta = mysqli_query($conexion, "UPDATE `proveedor` SET 
        `nombre_proveedor`='$nombres[$i]', `user`='$user[$i]', `pass`='$pass[$i]'
        WHERE `estado` != '' AND `id_proveedor` = '$id_proveedor[$i]'") or die ("Error al update: proveedores");
    }

    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
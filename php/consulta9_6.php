<script type="text/javascript" src="../js/funciones.js"></script>
<?php

    $conexion = conectar();                     //Obtenemos la conexion

    
    $id_pers   = $_POST['id_pers'];

    $nombre_pers    = $_POST['nombre_pers'];
    $celular_pers  = $_POST['celular_pers'];
    $correo_pers  = $_POST['correo_pers'];
    $tipo_usuario_pers = $_POST['lvl_acc'];
    $user_pers    = $_POST['user_pers'];
    $pass_pers = $_POST['pass_pers'];
    $eliminar = $_POST['eliminar'];
    
    for ($i = 0; $i < count($id_pers); $i++) { 

        $j = $i + 1; //ya que el arreglo de los estados en html del formulario anterior empieza en 1 y no en 0

        $consulta = mysqli_query($conexion, "UPDATE `personal` 
        SET `nombre_pers`='$nombre_pers[$i]', `celular_pers`='$celular_pers[$i]', `correo_pers`='$correo_pers[$i]', `tipo_usuario_pers`='$tipo_usuario_pers[$i]', `user_pers`='$user_pers[$i]', `pass_pers`='$pass_pers[$i]'
        WHERE `id_pers` = '$id_pers[$i]'") or die ("Error al update: proveedores");
        
        if($eliminar[$j] == 'eliminar' && count($eliminar) > 1){
            $consulta = mysqli_query($conexion, "UPDATE `personal` SET 
            `estado` = '' 
            WHERE `id_pers` = '$id_pers[$i]'") or die ("Error al update: proveedores");
        }
        
    }

    
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
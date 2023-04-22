<script type="text/javascript" src="../js/funciones.js"></script>
<?php
    
    $conexion = conectar();                     //Obtenemos la conexion

    
    $id_cat   = $_POST['id_cat'];

    $categorias   = $_POST['categorias'];
    $estado    = $_POST['estado'];
    $eliminar  = $_POST['eliminar'];
    
    for ($i = 0; $i < count($id_cat); $i++) { 

        $j = $i + 1; //ya que el arreglo de los estados en html del formulario anterior empieza en 1 y no en 0

        $consulta = mysqli_query($conexion, "UPDATE `categoria` SET `categorias`='$categorias[$i]', `estado` = '$estado[$j]' 
        WHERE `id_cat` = '$id_cat[$i]'") or die ("Error al update: proveedores");
        
        if($eliminar[$j] == 'eliminar' && count($eliminar) > 1){
            $consulta = mysqli_query($conexion, "UPDATE `categoria` SET 
            `estado` = '' 
            WHERE `id_cat` = '$id_cat[$i]'") or die ("Error al update: proveedores");
        }
        
    }

    
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
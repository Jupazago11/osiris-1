<script type="text/javascript" src="../js/funciones.js"></script>
<?php
require("../php/conexion.php");
    $conexion = conectar();                     //Obtenemos la conexion

    
    $id_vehiculo   = $_POST['id_vehiculo'];
    $tipo   = $_POST['tipo'];
    $placa    = $_POST['placa'];
    $fecha_soat  = $_POST['fecha_soat'];
    $fecha_tecn = $_POST['fecha_tecn'];
    $kilometraje    = $_POST['kilometraje'];
    $estado = $_POST['estado'];
    $eliminar = $_POST['eliminar'];

    for ($i = 0; $i < count($id_vehiculo); $i++) { 

        $j = $i + 1; //ya que el arreglo de los estados en html del formulario anterior empieza en 1 y no en 0

        $consulta = mysqli_query($conexion, "UPDATE `vehiculo` SET `tipo`='$tipo[$i]', `placa`='$placa[$i]', `fecha_soat`='$fecha_soat[$i]', `fecha_tecn`='$fecha_tecn[$i]', `kilometraje`='$kilometraje[$i]', `estado` ='$estado[$j]'
        WHERE `id_vehiculo` = '$id_vehiculo[$i]'") or die ("Error al update: vehiculos");
    
        if($eliminar[$j] == 'eliminar' && count($eliminar) > 0){
            $consulta = mysqli_query($conexion, "UPDATE `vehiculo` SET 
            `estado` = '' 
            WHERE `id_vehiculo` = '$id_vehiculo[$i]'") or die ("Error al update: vehiculos");
        }

        
    }

    
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
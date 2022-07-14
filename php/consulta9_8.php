<script type="text/javascript" src="../js/funciones.js"></script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion

    
    $id_cargo   = $_POST['id_cargo'];

    $cargo   = $_POST['cargo'];
    $estado    = $_POST['estado'];
    $eliminar  = $_POST['eliminar'];
    
    for ($i = 0; $i < count($id_cargo); $i++) { 

        $j = $i + 1; //ya que el arreglo de los estados en html del formulario anterior empieza en 1 y no en 0

        $consulta = mysqli_query($conexion, "UPDATE `cargo` SET`cargo`='$cargo[$i]', `estado`='$estado[$j]' 
        WHERE `id_cargo` = '$id_cargo[$i]'") or die ("Error al update: proveedores");
        
        if($eliminar[$j] == 'eliminar'){
            $consulta = mysqli_query($conexion, "UPDATE `cargo` SET 
            `estado` = '' 
            WHERE `id_cargo` = '$id_cargo[$i]'") or die ("Error al update: proveedores");
        }
        
    }

    
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
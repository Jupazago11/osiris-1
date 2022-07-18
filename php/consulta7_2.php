<script type="text/javascript" src="../js/funciones.js"></script>
<script type="text/javascript" src="../js/funciones.js"></script>
<script src="sweetalert2.min.js"></script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion

    $id_proveedor   = $_POST['id_proveedor'];
    $nombres   = $_POST['nombres'];
    $direcciones = $_POST['direcciones'];
    $contactos  = $_POST['contactos'];
    $vendedores  = $_POST['vendedores'];
    $telefonos  = $_POST['telefonos'];
    $estado    = $_POST['estado'];
    $eliminar    = $_POST['eliminar'];

    for ($i = 0; $i < count($id_proveedor); $i++) { 
        $j = $i + 1; //ya que el arreglo de los estados en html del formulario anterior empieza en 1 y no en 0

        $consulta = mysqli_query($conexion, "UPDATE `proveedor` SET 
        `nombre_proveedor`='$nombres[$i]', `direccion_proveedor`='$direcciones[$i]', `contacto_proveedor`='$contactos[$i]', `nom_vendedor`='$vendedores[$i]', `telefono_vendedor`='$telefonos[$i]',`estado`='$estado[$j]' 
        WHERE `estado` != '' AND `id_proveedor` = '$id_proveedor[$i]'") or die ("Error al update: proveedores");

        if($eliminar[$j] == 'eliminar' && count($eliminar) > 1){
            $consulta = mysqli_query($conexion, "UPDATE `proveedor` SET 
            `estado`='' 
            WHERE `id_proveedor` = '$id_proveedor[$i]'") or die ("Error al update: proveedores");
        }
    }

    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
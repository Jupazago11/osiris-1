<script type="text/javascript" src="../js/funciones.js"></script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion

    $nombre   = strval($_POST['nombre']);
    $direccion = strval($_POST['direccion']);
    $contacto  = strval($_POST['contacto']);
    $nombrevendedor  = strval($_POST['nombrevendedor']);
    $telefono  = strval($_POST['telefono']);
    $estado    = strval($_POST['estado']);  

    //strlen($ubicacion)
    if(strlen($nombre) >= 3 && strlen($direccion) >= 6 && strlen($contacto) >= 6 && strlen($nombrevendedor) >= 6 && strlen($telefono) >= 6){

        $consulta = mysqli_query($conexion, "INSERT INTO `proveedor`(`nombre_proveedor`, `direccion_proveedor`, `contacto_proveedor`, `nom_vendedor`, `telefono_vendedor`, `estado`) 
        VALUES ('$nombre','$direccion','$contacto','$nombrevendedor','$telefono','$estado')") or die ("Error al consultar: proveedor");
        ?>
        <br>
        <div class="alert info">
            <span class="closebtn">&times;</span>  
            <strong>Información!</strong> Creado con éxito
        </div>
        <?php
    }else{
        ?>
        <br>
        <div class="alert warning">
            <span class="closebtn">&times;</span>  
            <strong>Información!</strong> Los campos deben contener 6 caracteres como mínimo.
        </div>
        <?php
    }


    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
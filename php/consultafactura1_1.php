<script type="text/javascript" src="../js/funciones.js"></script>
<script>document.getElementById('xcont_4_1').style.display='none';</script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion

    $bandera = false;
    
    $id_facturacion  = $_POST['id_facturacion'];

    $consulta = mysqli_query($conexion, "SELECT `estado` 
    FROM `factura` 
    WHERE `id_facturacion` = '$id_facturacion'") or die ("Error al consultar: datos de  producto");

    while (($fila = mysqli_fetch_array($consulta))!=NULL) {
        if($fila['estado'] == "activo" || $fila['estado'] == "congelado"){
            $bandera = true;
        }
    }
    mysqli_free_result($consulta);

    if(!empty($_POST['idess']) && $bandera == true){
        //Si no se encuentran vacias
        $cantidad        = $_POST['cantidad'];
        $ides            = $_POST['idess'];
        $precio_producto = $_POST['precio_producto'];
        $id_facturacion  = $_POST['id_facturacion'];

        $consulta = mysqli_query($conexion, "SELECT * FROM `detalle_factura` 
        WHERE `id_facturacion1` = '4';") or die ("Error al consultar: datos de  producto");

        $tiene_detalles = false;
        while (($fila = mysqli_fetch_array($consulta))!=NULL) {
            $tiene_detalles = true;
        }
        mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario

        if($tiene_detalles == true){
            //desahbilitamos detalles si exiten
            $consulta = mysqli_query($conexion, "UPDATE `detalle_factura` SET `estado`= '' WHERE `id_facturacion1` = '$id_facturacion'") or die ("Error al consultar: datos de  producto");
        }
        

        //crear detalles nuevos
        
        for ($i = 0; $i < count($ides); $i++) { 
            $precio_detalle = $precio_producto[$i]*$cantidad[$i];
            $consulta = mysqli_query($conexion, "INSERT INTO `detalle_factura`(`id_facturacion1`, `id_producto1`, `cantidad`, `precio_detalle`, `estado`) 
            VALUES ('$id_facturacion','$ides[$i]','$cantidad[$i]','$precio_detalle','activo')") or die ("Error al consultar: datos de  producto");
        }

        $consulta = mysqli_query($conexion, "UPDATE `factura` 
        SET `estado` = 'finalizada' 
        WHERE `id_facturacion` = '$id_facturacion'") or die ("Error al consultar: datos de  producto");

        ?>

        <script>
            Swal.fire(
                '¡Muy bien!',
                'Factura Guardada',
                'success'
                )
            $('#enviarv1').trigger('click');
            document.getElementById('xcont_4_1').style.display='block';
        </script>
        
        <?php
    }elseif(empty($_POST['idess'])){
        //else vacio
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'No hay registro de productos',
            })
            document.getElementById('respuesta_facturar').style.display='none';
            document.getElementById('xcont_4_1').style.display='block';
        </script>
        <?php
    }

    
    

?>
    <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" id="xcont_conge1_1" onclick="document.getElementById('respuesta_congelar').style.display='none'; document.getElementById('xcont_4_1').style.display='block';">X</a>
<?php


?>

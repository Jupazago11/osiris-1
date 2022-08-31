<script type="text/javascript" src="../js/funciones.js"></script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion

    
    $categorias                 = $_POST['categorias'];
    $proveedores                = $_POST['proveedores'];
    $descripcion                = $_POST['descripcion'];
    $referencia                 = $_POST['referencia'];
    $codigo_barras              = $_POST['codigo_barras'];
    $control_inventario         = $_POST['control_inventario'];
    $decimales_en_cantidad      = $_POST['decimales_en_cantidad'];
    $dias_rotacion              = $_POST['dias_rotacion'];
    $estado                     = $_POST['estado'];


    $t_iva                      = $_POST['t_iva'];
    $clasi_iva                  = $_POST['clasi_iva'];
    $precio_de_compra           = $_POST['precio_de_compra'];
    $flete                      = $_POST['flete'];
    $venta1                     = $_POST['venta1'];
    $venta2                     = $_POST['venta2'];
    $venta3                     = $_POST['venta3'];

    
    
    // Se evalúa a true ya que $var está vacia
    if($categorias == 0) {
        ?>
        <script>
            Swal.fire({icon: 'error',title: 'Oops...',text: 'Ingresa una categoría válida',})
        </script>
        <?php

    }elseif($proveedores == 0){
        ?>
        <script>
            Swal.fire({icon: 'error',title: 'Oops...',text: 'Ingresa un proveedor válido',})
        </script>
        <?php
    }else{
        $consulta = mysqli_query($conexion, "INSERT INTO `producto`(`cod_producto`, `id_cat1`, `nombre_producto`, `descripcion`, `precio_producto`, `precio_producto2`, `precio_producto3`, `precio_de_compra`, `existencias`, `id_proveedor1`, `iva`, `control_inv`, `decimales_cant`, `dias_rotacion`, `class_iva`, `flete`, `estado`) 
        VALUES ('$codigo_barras', '$categorias', '$descripcion', '$referencia', '$venta1', '$venta2', '$venta3', '$precio_de_compra', '0', '$proveedores', '$t_iva', '$control_inventario', '$decimales_en_cantidad', '$dias_rotacion', '$clasi_iva', '$flete', '$estado')") or die ("Error al update: proveedores");
        ?>
        <script>
            Swal.fire(
            '¡Muy bien!',
            'Guardado Exitoso',
            'success'
            )
        </script>
        <?php
    }
    




    


    
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
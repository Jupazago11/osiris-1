<script type="text/javascript" src="../js/funciones.js"></script>
<script>document.getElementById('xcont_factuabo1_1').style.display='none';</script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion

    date_default_timezone_set('America/Bogota');
    $fecha = date('Y-m-d', time());

    $id_cliente             = $_POST['id_cliente'];
    $abono                  = str_replace(".","",$_POST['abono']);
    $metodo_de_pago2        = $_POST['metodo_de_pago2'];

    
    

    //  Verificamos que el abono no sea mayor a la deuda

    $consulta = mysqli_query($conexion, "SELECT `id_facturacion` 
    FROM `factura` 
    WHERE estado = 'finalizada' AND `id_cliente3` = '$id_cliente' AND `forma_pago` = 'credito'") or die ("Error al consultar: no se obtuvo la identificacion del usuario");

    $facturas = array();

    while (($fila = mysqli_fetch_array($consulta))!=NULL) {
        array_push($facturas, $fila['id_facturacion']);
    }
    mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario

    $Total_factura = 0;

    for ($i=0; $i < count($facturas); $i++) { 
        $consulta = mysqli_query($conexion, "SELECT `precio_detalle` 
        FROM `detalle_factura` 
        WHERE `id_facturacion1` = '$facturas[$i]' AND `estado` = 'activo'") or die ("Error al consultar: no se obtuvo la identificacion del usuario");

        while (($fila = mysqli_fetch_array($consulta))!=NULL) {
            $Total_factura += $fila['precio_detalle'];
        }
        mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
    }

    if($abono <= $Total_factura){
        if($abono > 0){
            //$consulta = mysqli_query($conexion, "INSERT INTO `factura_abono`(`abono`, `fecha_abono`, `id_cliente1`, `metodo_abono`) 
            //VALUES ('$abono', '$fecha', '$id_cliente', '$metodo_de_pago2')") or die ("Error al consultar: proveedores");
            ?>
            <script>
                Swal.fire(
                    '¡Muy bien!',
                    'Abono Exitoso',
                    'success'
                    );
                
                
            </script> 
            <?php
        }
        
    }elseif($abono > $Total_factura){
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'El abono el mayor a la deuda en crédito',
            });
        </script> 
        <?php
    }



    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
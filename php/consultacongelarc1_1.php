<script type="text/javascript" src="../js/funciones.js"></script>
<script>document.getElementById('xcont_4_1').style.display='none';</script>
<?php
require("../php/conexion.php");
    $conexion = conectar();                     //Obtenemos la conexion

    $bandera = false;
    
    $id_facturacion  = $_POST['id_facturacion'];

    $consulta = mysqli_query($conexion, "SELECT `estado` 
    FROM `factura` 
    WHERE `id_facturacion` = '$id_facturacion'") or die ("Error al consultar: datos de  producto");

    while (($fila = mysqli_fetch_array($consulta))!=NULL) {
        if($fila['estado'] == "activo"){
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

        

        for ($i = 0; $i < count($ides); $i++) { 
            $precio_detalle = $precio_producto[$i]*$cantidad[$i];
            $consulta = mysqli_query($conexion, "INSERT INTO `detalle_factura`(`id_facturacion1`, `id_producto1`, `cantidad`, `precio_detalle`, `estado`) 
            VALUES ('$id_facturacion','$ides[$i]','$cantidad[$i]','$precio_detalle','activo')") or die ("Error al consultar: datos de  producto");
        }

        $consulta = mysqli_query($conexion, "UPDATE `factura` 
        SET `estado` = 'congelado' 
        WHERE `id_facturacion` = '$id_facturacion'") or die ("Error al consultar: datos de  producto");

        ?>

        <br><br><br><br><br><br><br><br>
        <form id="mandar_nombre_refe" method="POST">
            <table class="tabla_sugerido" style="width:50%;border: 1px solid black; border-collapse: collapse;margin-left: auto;  margin-right: auto;background-color:white">
                <tr>
                    <th>Nombre de referencia</th>
                    <td><input type="text" name="name_refe"></input>&nbsp;&nbsp;&nbsp;<button type="button" class="w3-btn w3-teal" id="Enviar_nombre_refe">Guardar</button></td>
                    <input type="hidden" name="id_facturacion" value="<?php echo $id_facturacion ?>"></input>
                </tr>
            </table>
        </form>


        <script>
            //$('#enviarv1').trigger('click');
            //document.getElementById('xcont_4_1').style.display='block';
        </script>
        
        <?php
    }elseif(empty($_POST['idess'])){
        //else vacio
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'No se puede congelar una cuenta sin productos',
            })
            document.getElementById('respuesta_congelar').style.display='none';
            document.getElementById('xcont_4_1').style.display='block';
        </script>
        <?php
    }

    
    

?>
    <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" id="xcont_conge1_1" onclick="document.getElementById('respuesta_congelar').style.display='none'; document.getElementById('xcont_4_1').style.display='block';">X</a>
<?php


?>
<script>
    $('#Enviar_nombre_refe').click(function(){
        $.ajax({
            url:'../PHP/consultacongelarc1_2.php',
            type:'POST',
            data: $('#mandar_nombre_refe').serialize(),
            success: function(res){
                $('#enviarv1').trigger('click');
                document.getElementById('xcont_4_1').style.display='block';
            },
            error: function(res){
                alert("Problemas al mostrar cuadre de caja");
            }
        });
    });
</script>

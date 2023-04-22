<script type="text/javascript" src="../js/funciones.js"></script>
<script>document.getElementById('xcont_factuabo1_1').style.display='none';</script>
<?php
require("../php/conexion.php");
    $conexion = conectar();                     //Obtenemos la conexion

    

    $id_cliente             = $_POST['id'];

    $consulta = mysqli_query($conexion, "SELECT * 
    FROM `cliente` 
    WHERE `id_cliente` = '$id_cliente'") or die ("Error al consultar: proveedores");
    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $nombre_cliente = $fila['nombre_cliente'];
        $identificacion_cliente = $fila['identificacion_cliente'];
        $direccion_cliente = $fila['direccion_cliente'];
        $id_ubi1 = $fila['id_ubi1'];
        $telefono_cliente = $fila['telefono_cliente'];
    }
    
?>
    <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" id="xcont_factuabo1_2" onclick="document.getElementById('respuesta_abonar2').style.display='none'; document.getElementById('xcont_factuabo1_1').style.display='block';">X</a>

    <form id="formulario_de_abonos" method="post">

    <input type="hidden" name="id_cliente" value="<?php echo $id_cliente ?>"/>

    <table class="tabla_sugerido" id="myTable6" style="width:50%;border: 1px solid black; border-collapse: collapse;margin-left: auto;  margin-right: auto;background-color:white">
        <tr>
            <th>Nombre</th>
            <td><input type="text" name="nombre_cliente" value="<?php echo $nombre_cliente ?>" size="40"/></td>
            

        </tr>
        <tr>
            <th>Identificación</th>
            <td><input type="text" name="identificacion_cliente" value="<?php echo $identificacion_cliente ?>" size="40" readonly style="background: transparent;border: none;"/></td>
        </tr>
        <tr>
            <th>Dirección</th>
            <td><input type="text" name="direccion_cliente" value="<?php echo $direccion_cliente ?>" size="40"/></td>
            
        </tr>
        <tr>
            <th>Ubicación</th>
            <td><select name="id_ubi1">
                    
                <?php
                $array_id_ubi = array();
                $array_ubicacion = array();
                    //Consulta a la base de datos en la tabla provvedor
                    $consulta = mysqli_query($conexion, "SELECT * FROM `ubicacion` 
                    WHERE `estado` = 'activo'") or die ("Error al consultar: proveedores");

                    while (($fila = mysqli_fetch_array($consulta))!=NULL){
                        array_push($array_id_ubi,    $fila['id_ubi']);
                        array_push($array_ubicacion, $fila['ubicacion']);
                    }
                    
                    $consulta = mysqli_query($conexion, "SELECT `id_ubi1` 
                    FROM `cliente` 
                    WHERE `id_cliente` = '$id_cliente'") or die ("Error al consultar: proveedores");

                    while (($fila = mysqli_fetch_array($consulta))!=NULL){
                        $id_ubi_cliente = $fila['id_ubi1'];
                    }

                    for ($i=0; $i < count($array_id_ubi); $i++) { 
                        ?>
                            <option value="<?php echo $array_id_ubi[$i] ?>" <?php if($id_ubi_cliente == $array_id_ubi[$i]){echo "selected";} ?>><?php echo $array_ubicacion[$i] ?></option>
                        <?php 
                    }
                    
                    mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
                ?>

                    </select>
                </td>
        </tr>
        <tr>
            <th>Teléfono</th>
            <td><input type="text" name="telefono_cliente" value="<?php echo $telefono_cliente ?>" size="40"/></td>
        </tr>
        <tr>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <td><img src="../iconos/pago.png" width="50px" height="50px" onclick="document.getElementById('myTable7').style.display='block';">
            <?php 
                echo "<a href='../php/impresion3.php?Nucliente=$id_cliente?>' target='popup'><img src='../iconos/printer2.png' width='50px' height='50px' class='btn_abonados'></a>"?>

            <td style="text-align: right"><img src="../iconos/disquete.png" class="btn_guardar" width="50px" height="50px"></td>
        </tr>

    </table>
    </form>

    <form id="formu_abonar" method="post">
        <table class="tabla_sugerido" id="myTable7" style="width:50%;border: 1px solid black; border-collapse: collapse;margin-left: auto;  margin-right: auto;background-color:white; display:none">

            <input type="hidden" name="id_cliente" value="<?php echo $id_cliente ?>"/>

            <tr>
                <th style="width:40%;">Cantidad</th>
                <td style="width:60%;"><input type="text" name="abono" value="0" class="puntos"/>
                    <select name="metodo_de_pago2" id="metodo_de_pago2">
                        <option value="efectivo">Efectivo</option>
                        <option value="tarjeta">Tarjeta</option>
                    </select>
                    <img src="../iconos/dinero.png" class="btn_abonar" width="50px" height="50px" class="btn_abonar">
                </td>
            </tr>       
        </table>
    </form>

    <?php 
    echo "<a href='../php/impresion4.php?Nucliente=$id_cliente?>' target='popup' style='display:none;'><img src='../iconos/printer2.png' width='50px' height='50px' class='btn_abonados' id='ver_factus'></a>"?>


    <div id="respuesta_abonar2"          class="ventana"></div>

<script>
    $('#myTable6').on('click', '.btn_guardar', function(event) {
        $.ajax({
            url:'../PHP/consultaabonar1_3.php',
            type:'POST',
            data: $('#formulario_de_abonos').serialize(),
            success: function(res){
                Swal.fire(
                '¡Muy bien!',
                'Guardado Exitoso',
                'success'
                )
                $('#respuesta_abonar2').html(res);
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario abonar");
            }
        });
        document.getElementById('respuesta_abonar2').style.display='none';
        document.getElementById('xcont_factuabo1_1').style.display='block';
        $('#Enviarabonar1_1').trigger('click');
        
    });

    $('#myTable7').on('click', '.btn_abonar', function(event) {
        $.ajax({
            url:'../PHP/consultaabonar1_4.php',
            type:'POST',
            data: $('#formu_abonar').serialize(),
            success: function(res){      
                $('#ver_factus').trigger('click');        
                $('#respuesta_abonar2').html(res);  
                document.getElementById('respuesta_abonar2').style.display='none';
                document.getElementById('xcont_factuabo1_1').style.display='block';  
                
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario abonar");
            }
        });      
        
    });

</script>
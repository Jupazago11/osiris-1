<script type="text/javascript" src="../js/funciones.js"></script>
<script>document.getElementById('xcont_factuabo1_1').style.display='none';</script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
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
            <td><input type="text" name="identificacion_cliente" value="<?php echo $identificacion_cliente ?>" size="40"/></td>
        </tr>
        <tr>
            <th>Dirección</th>
            <td><input type="text" name="direccion_cliente" value="<?php echo $direccion_cliente ?>" size="40"/></td>
            
        </tr>
        <tr>
            <th>Ubicación</th>
            <td><select name="id_ubi1">
                    
                <?php
                    //Consulta a la base de datos en la tabla provvedor
                    $consulta = mysqli_query($conexion, "SELECT * FROM `ubicacion` 
                    WHERE `estado` = 'activo'") or die ("Error al consultar: proveedores");

                    while (($fila = mysqli_fetch_array($consulta))!=NULL){
                        // traemos los proveedores existentes en la base de datos
                        ?>
                        <option value="<?php echo $fila['id_ubi'] ?>"><?php echo $fila['ubicacion'] ?></option>
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
            <td><img src="../iconos/pago.png" class="btn_abonar" width="50px" height="50px">
            <img src="../iconos/printer2.png" class="btn_imprimir" width="50px" height="50px"></td>
            <td style="text-align: right"><img src="../iconos/disquete.png" class="btn_guardar" width="50px" height="50px"></td>
        </tr>

    </table>
    </form>
    <div id="respuesta_abonar2"          class="ventana"></div>

<script>
    $('#myTable6').on('click', '.btn_guardar', function(event) {
        $.ajax({
            url:'../PHP/consultaabonar1_3.php',
            type:'POST',
            data: $('#formulario_de_abonos').serialize(),
            success: function(res){
                document.getElementById('respuesta_abonar2').style.display='block';
                $('#respuesta_abonar2').html(res);
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario abonar");
            }
        });
    });
</script>
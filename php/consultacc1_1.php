<script type="text/javascript" src="../js/funciones.js"></script>
<script>document.getElementById('xcont_4_1').style.display='none';</script>
<?php

    $conexion = conectar();                     //Obtenemos la conexion

?>
<a class="w3-bar-item w3-button w3-red w3-hover-red active salir" id="xcont_d1_1" onclick="document.getElementById('respuesta_crear_cliente').style.display='none'; document.getElementById('xcont_4_1').style.display='block';">X</a>

<div>
    <br><br><br><br>
    <form id="registrar_cliente1" method="POST">
        <table class="tabla_sugerido"  style="width:50%;border: 1px solid black; border-collapse: collapse;margin-left: auto;  margin-right: auto;background-color:white">
    
            <tr>
                <th colspan="5" style="font-size:32px;" aling="center">Registrar nuevo cliente</th>
            </tr>
            <tr>
                <th>Nombre</th>
                <th>Identificación</th>
                <th>Dirección</th>
                <th>Ubicación</th>
                <th>Teléfono</th>
            </tr>
            <tr>
                <td><input type="text" name="nombre_cliente"/></td>
                <td><input type="text" name="identificacion_cliente"/></td>
                <td><input type="text" name="direccion_cliente"/></td>
                <td><select name="ubicaciones">
                    
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
                <td><input type="text" name="telefono_cliente"/></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><button type="button" id="enviarcc1_2" class="w3-btn w3-teal">Continuar</button></td>
                <td></td>
                <td></td>
            </tr>
            <input type="hidden" name="usuario" value="<?php echo $usuario; ?>">
            
    
        </table>
    </form>
</div>
<div id="respuestacc1_1">

</div>
<script>
    $('#enviarcc1_2').click(function(){
        $.ajax({
            url:'../PHP/consultacc1_2.php',
            type:'POST',
            data: $('#registrar_cliente1').serialize(),
            success: function(res){
                $('#respuestacc1_1').html(res);
                
            },
            error: function(res){
                alert("Problemas al mostrar cuadre de caja");
            }
        });
    });
</script>


<?php
?>
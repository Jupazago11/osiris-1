<script type="text/javascript" src="../js/funciones.js"></script>
<?php
require("../php/conexion.php");
    $conexion = conectar();                     //Obtenemos la conexion

    $usuario         = $_POST['usuario'];
?>


<div>
    <br><br><br>
    <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" id="xcont_4_3" onclick="document.getElementById('respuestav2_1').style.display='none';document.getElementById('xcont_4_2').style.display='block';">X</a>


    <form id="seleccion_vehiculoo3" method="POST">
    <table class="tabla_sugerido"  style="width:50%;border: 1px solid black; border-collapse: collapse;margin-left: auto;  margin-right: auto;background-color:white">
        <tr>
            <th colspan="3">Selecciona el vehículo</th>
        </tr>
        <tr>
            <input type="hidden" name="usuario" value="<?php echo $usuario; ?>">
            <td></td>
            <td><select name="vehiculo">

            <?php
                //Consulta a la base de datos en la tabla provvedor
                $consulta = mysqli_query($conexion, "SELECT * FROM `vehiculo` 
                WHERE `estado` = 'activo'") or die ("Error al consultar: proveedores");

                $contador = 0;
                while (($fila = mysqli_fetch_array($consulta))!=NULL){
                    // traemos los proveedores existentes en la base de datos
                    echo "<option value=".$fila['placa'].">".$fila['placa']."</option>";
                    $contador++;
                }
                mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario

                
            ?>
            </select></td>
            <td><button type="button" id="enviard2_2" class="w3-btn w3-teal" onclick="document.getElementById('respuestad2_2').style.display='block'">Continuar</button></td>
        </tr>
    </table>
    </form>
</div>
<?php
    if($contador == 1){
        ?>
        <script>

            setTimeout(function(){ 
                $('#enviard2_2').trigger('click');
            }, 50);
        </script>
        <?php
    }
?>

<div id="respuestad2_2">
    <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('respuestad2_2').style.display='none'; document.getElementById('xcont_d1_1').style.display='block';">X</a>
</div>

<script>
    document.getElementById('xcont_4_1').style.display='none';

    $('#enviard2_2').click(function(){
        $.ajax({
            url:'../php/consulta5.php',
            type:'POST',
            data: $('#seleccion_vehiculoo3').serialize(),
            success: function(res){
                $('#respuestad2_2').html(res);
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });

</script>
<?php
?>
<script type="text/javascript" src="../js/funciones.js"></script>
<?php
require("../php/conexion.php");
    $conexion = conectar();                     //Obtenemos la conexion

    $usuario         = $_POST['usuario'];
?>

<a class="w3-bar-item w3-button w3-red w3-hover-red active salir" id="xcont_4_3" onclick="document.getElementById('respuestav2_1').style.display='none';document.getElementById('xcont_4_2').style.display='block';">X</a>
<div style="display:none">
    <br><br><br>
    


    <form id="seleccion_vehiculover2" method="POST">
            <fieldset  style="width:800px;border: 1px solid black; border-collapse: collapse;margin-left: auto;  margin-right: auto;background-color:white"><legend>Selecciona el vehículo</legend>
            <select name="vehiculo" onchange="$('#enviard2_2').trigger('click'); $('#enviar5_6').trigger('click');">

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
            </select>

            <button type="button" id="enviar5_6" class="w3-btn w3-teal" onclick="document.getElementById('respuesta5_5').style.display='block';" style="display:none">Continuar</button>
            </fieldset>
        </form>
</div>


<div id="respuesta5_6"></div>

<script>
    document.getElementById('xcont_4_1').style.display='none';

    $('#enviar5_6').click(function(){
        $.ajax({
            url:'../php/consulta5_2.php',
            type:'POST',
            data: $('#seleccion_vehiculover2').serialize(),
            success: function(res){
                $('#respuesta5_6').html(res);
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });

</script>
<?php
?>
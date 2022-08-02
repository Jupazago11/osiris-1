<script type="text/javascript" src="../js/funciones.js"></script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion

    $usuario         = $_POST['usuario'];
?>
<a class="w3-bar-item w3-button w3-red w3-hover-red active salir" id="xcont_d1_1" onclick="document.getElementById('respuesta_domicilio').style.display='none'; document.getElementById('xcont_4_1').style.display='block';">X</a>

<div style="background-color:white">

    <form id="seleccion_vehiculoo2" method="POST">
        <input type="hidden" name="usuario" value="<?php echo $usuario; ?>">
        <fieldset><legend>Selecciona el vehículo:</legend>
        <input list="vehiculos" name="vehiculo" id="vehiculo">
        <datalist id="vehiculos">

        <?php
            //Consulta a la base de datos en la tabla provvedor
            $consulta = mysqli_query($conexion, "SELECT * FROM `vehiculo` WHERE `estado` = 'activo'") or die ("Error al consultar: proveedores");

            while (($fila = mysqli_fetch_array($consulta))!=NULL){
                // traemos los proveedores existentes en la base de datos
                echo "<option value=".$fila['placa']."></option>";
            }
            mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
        ?>
        </datalist>

        <button type="button" id="enviard1_2" class="w3-btn w3-teal" onclick="document.getElementById('respuestad1_2').style.display='block'">Continuar</button>
        </fieldset>
    </form>
</div>

<div id="respuestad1_2">
    <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('respuestad1_2').style.display='none'; document.getElementById('xcont_d1_1').style.display='block';">X</a>
</div>

<script>
    document.getElementById('xcont_4_1').style.display='none';

    $('#enviard1_2').click(function(){
        $.ajax({
            url:'../php/consulta5.php',
            type:'POST',
            data: $('#seleccion_vehiculoo2').serialize(),
            success: function(res){
                $('#respuestad1_2').html(res);
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });

    

</script>
<?php
?>
<script type="text/javascript" src="../js/funciones.js"></script>
<script>document.getElementById('xcont_4_1').style.display='none';</script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion

?>
    <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" id="xcont_factuabo1_1" onclick="document.getElementById('respuesta_abonar').style.display='none'; document.getElementById('xcont_4_1').style.display='block';">X</a>

    <table class="tabla_sugerido" id="myTable5" style="width:75%;border: 1px solid black; border-collapse: collapse;margin-left: auto;  margin-right: auto;background-color:white">
        <tr>
            <th></th>
            <th><input type="text" id="myInput5" onkeyup="myFunctionTabla5()" placeholder="Nombre.." title="Type in a name"></th>
            <th><input type="text" id="myInput6" onkeyup="myFunctionTabla6()" placeholder="Nombre.." title="Type in a name" size="6"></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Identificación</th>
            <th>Dirección</th>
            <th>Ubicación</th>
            <th></th>
            <th></th>
        </tr>

        <?php
        $consulta = mysqli_query($conexion, "SELECT `id_cliente`, ubicacion.ubicacion, `nombre_cliente`, `identificacion_cliente`, `direccion_cliente` 
        FROM `cliente` 
        INNER JOIN ubicacion ON ubicacion.id_ubi = cliente.id_ubi1;") or die ("Error al consultar: proveedores");

        $contador = 0;
        while (($fila = mysqli_fetch_array($consulta))!=NULL){
            $contador++;
            
            ?>
            <tr>
                <th><?php echo $contador ?></th>
                <td><?php echo $fila['nombre_cliente'] ?></td>
                <td><?php echo $fila['identificacion_cliente'] ?></td>
                <td><?php echo $fila['direccion_cliente'] ?></td>
                <td><?php echo $fila['ubicacion'] ?></td>
                <td><img src="../iconos/contado.png" width="40px" height="40px"></td>
                <td><img src="../iconos/calculadora.png" width="40px" height="40px"></td>
            </tr>
            <?php
        }
        mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
        ?>
    
    </table>
<?php


?>
<script>
    //era show3 pero no funcionó
$('#myTable4').on('click', '.btn_facturados', function(event) {

  var inputNombre = document.getElementById("Nufactura");
  inputNombre.value = $(this).parents('tr').find('td:nth-child(2)').text();

  $('#Enviarfacturaobs1_2').trigger('click');  
});
</script>
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
    <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" id="xcont_factuobs1_1" onclick="document.getElementById('respuesta_facturarobs').style.display='none'; document.getElementById('xcont_4_1').style.display='block';">X</a>

    <table class="tabla_sugerido" id="myTable4" style="width:75%;border: 1px solid black; border-collapse: collapse;margin-left: auto;  margin-right: auto;background-color:white">
        <tr>
            <th></th>
            <th></th>
            <th><input type="text" id="myInput4" onkeyup="myFunctionTabla4()" placeholder="Nombre.." title="Type in a name"></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <th>#</th>
            <th>Código</th>
            <th>Nombre cliente</th>
            <th>Fecha</th>
            <th>Forma de pago</th>
            <th>Cajero</th>
            <th></th>
        </tr>

        <?php
        $consulta = mysqli_query($conexion, "SELECT `id_facturacion`, `name_cliente`, `fecha`, `forma_pago`, personal.nombre_pers 
        FROM `factura` 
        INNER JOIN personal ON personal.id_pers = factura.id_pers1 
        WHERE factura.estado = 'finalizada'
        ORDER BY factura.id_facturacion DESC") or die ("Error al consultar: proveedores");

        $contador = 0;
        while (($fila = mysqli_fetch_array($consulta))!=NULL){
            $contador++;
            
            ?>
            <tr>
                <th><?php echo $contador ?></th>
                <td><?php echo $fila['id_facturacion'] ?></td>
                <td><?php echo $fila['name_cliente'] ?></td>
                <td><?php echo $fila['fecha'] ?></td>
                <td><?php echo $fila['forma_pago'] ?></td>
                <td><?php echo $fila['nombre_pers'] ?></td>
                <td><?php 
                $id = $fila['id_facturacion'];
                echo "<a href='../php/impresion2.php?Nufactura=$id?>' target='popup'><img src='../iconos/buscar.png' width='40px' height='40px' class='btn_facturados'></a>"?></td>
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
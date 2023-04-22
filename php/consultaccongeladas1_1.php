<script type="text/javascript" src="../js/funciones.js"></script>
<script>document.getElementById('xcont_4_1').style.display='none';</script>
<?php
require("../php/conexion.php");
    $conexion = conectar();                     //Obtenemos la conexion

?>
    <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" id="xcont_conge1_1" onclick="document.getElementById('respuesta_congeladas').style.display='none'; document.getElementById('xcont_4_1').style.display='block';">X</a>

    <table class="tabla_sugerido" id="myTable3" style="width:60%;border: 1px solid black; border-collapse: collapse;margin-left: auto;  margin-right: auto;background-color:white">
        <tr>
            <th colspan="6"><input type="text" id="myInput3" onkeyup="myFunctionTabla3()" placeholder="Nombre.." title="Type in a name"></th>
        </tr>
        <tr>
            <th>#</th>
            <th>Código</th>
            <th>Nombre</th>
            <th>Cajero</th>
            <th>Fecha</th>
            <th></th>
        </tr>

        <?php
        $consulta = mysqli_query($conexion, "SELECT `id_facturacion`,`fecha`, personal.nombre_pers, `nombre_congelado` 
        FROM `factura` 
        INNER JOIN personal ON personal.id_pers = factura.id_pers1
        WHERE factura.estado = 'congelado';") or die ("Error al consultar: proveedores");

        
        $ids_fact    = array();
        $fechas      = array();
        $nom_pers    = array();
        $nom_cong    = array();
        while (($fila = mysqli_fetch_array($consulta))!=NULL){
            
            array_push($ids_fact , $fila['id_facturacion']);
            array_push($fechas   , $fila['fecha']);
            array_push($nom_pers , $fila['nombre_pers']);
            array_push($nom_cong , $fila['nombre_congelado']);
            
        }
        mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario

        $contador = 0;
        for ($i=0; $i < count($ids_fact); $i++) { 
            $contador++;
            ?>
            <tr>
                <th><?php echo $contador ?></th>
                <td><?php echo $ids_fact[$i] ?></td>
                <td><?php echo $nom_cong[$i] ?></td>
                <td><?php echo $nom_pers[$i] ?></td>
                <td><?php echo $fechas[$i] ?></td>
                <td><input type="button" class="w3-btn w3-teal btn_congelados" value="Seleccionar"/></td>
            </tr>
            <?php
        }
        ?>
    
    </table>
    <form id="form_seleccionar_congelador" method='post'>
        <input type="hidden" name="id" id="nombre_sug"/>
    </form>
<?php


?>
<script>
    //era show3 pero no funcionó
$('#myTable3').on('click', '.btn_congelados', function(event) {
	//Primera fila 
	//console.log("Primera Fila  : " + $(this).parents('tr').find('td:first-child').text());

  var inputNombre = document.getElementById("nombre_sug");
  inputNombre.value = $(this).parents('tr').find('td:nth-child(2)').text();

  var inputNombre2 = document.getElementById("Nfactura");
  inputNombre2.value = $(this).parents('tr').find('td:nth-child(2)').text();

  var inputNombre3 = document.getElementById("Nfactura2");
  inputNombre3.value = $(this).parents('tr').find('td:nth-child(2)').text();

  document.getElementById('respuesta_congeladas').style.display='none';
  document.getElementById('xcont_conge1_1').style.display='none';
  document.getElementById('xcont_4_1').style.display='block';
  $('#Enviarccongeladas1_2').trigger('click');
	//todos las columnas de la fila  
  /*
  console.log("Columnas de la Fila");
	$.each($(this).parents('tr'), function(index, val) {
		console.log($(val).text());
	});
  */
  
});
</script>
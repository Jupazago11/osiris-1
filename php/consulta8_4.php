<script type="text/javascript" src="../js/funciones.js"></script>
<script>document.getElementById('xcont2_2').style.display='none';</script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion

?>
    <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" id="xcont_respuesta8_1" onclick="document.getElementById('respuesta8_1').style.display='none'; document.getElementById('xcont2_2').style.display='block';">X</a>

    <table class="tabla_sugerido" id="myTable3" style="width:60%;border: 1px solid black; border-collapse: collapse;margin-left: auto;  margin-right: auto;background-color:white">
        <tr>
            <th colspan="6"><input type="text" id="myInput3" onkeyup="myFunctionTabla3()" placeholder="Nombre.." title="Type in a name"></th>
        </tr>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Proveedor</th>
            <th>Estado</th>
            <th></th>
        </tr>

        <?php
        $consulta = mysqli_query($conexion, "SELECT `id_producto`, `nombre_producto`, proveedor.nombre_proveedor, producto.estado 
        FROM `producto` 
        INNER JOIN proveedor ON proveedor.id_proveedor = producto.id_proveedor1") or die ("Error al consultar: proveedores");

        
        $id_prod     = array();
        $nom_pro     = array();
        $nom_vee     = array();
        $estados     = array();

        while (($fila = mysqli_fetch_array($consulta))!=NULL){
            
            array_push($id_prod , $fila['id_producto']);
            array_push($nom_pro , $fila['nombre_producto']);
            array_push($nom_vee , $fila['nombre_proveedor']);
            array_push($estados  , $fila['nombre_proveedor']);
            
        }
        mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario

        $contador = 0;
        for ($i=0; $i < count($id_prod); $i++) { 
            $contador++;
            ?>
            <tr>
                <th><?php echo $contador ?></th>
                <td style="display:none"><?php echo $id_prod[$i] ?></td>
                <td><?php echo $nom_pro[$i] ?></td>
                <td><?php echo $nom_vee[$i] ?></td>
                <td><?php echo $estados[$i] ?></td>
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
<script>/*
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
  document.getElementById('xcont_respuesta8_1').style.display='none';
  document.getElementById('xcont_4_1').style.display='block';
  $('#Enviarccongeladas1_2').trigger('click');
	//todos las columnas de la fila  
  /*
  console.log("Columnas de la Fila");
	$.each($(this).parents('tr'), function(index, val) {
		console.log($(val).text());
	});
  
  
});*/
</script>
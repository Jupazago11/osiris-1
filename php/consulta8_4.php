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

    <table class="tabla_sugerido" id="myTable6" style="width:60%;border: 1px solid black; border-collapse: collapse;margin-left: auto;  margin-right: auto;background-color:white">
        <tr>
            <th colspan="2"><input type="text" id="myInput7" onkeyup="myFunctionTabla7()" placeholder="Nombre.." title="Type in a name"></th>
            <th colspan="4"><input type="text" id="myInput8" onkeyup="myFunctionTabla8()" placeholder="Proveedor.." title="Type in a name"></th>
        </tr>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Proveedor</th>
            <th>Estado</th>
            <th></th>
        </tr>

        <?php
        $consulta = mysqli_query($conexion, "SELECT `id_producto`, `cod_producto`, `id_cat1`, `nombre_producto`, `descripcion`, `precio_producto`, `precio_producto2`, `precio_producto3`, `precio_de_compra`, `existencias`, `id_proveedor1`, proveedor.nombre_proveedor, `iva`, `control_inv`, `decimales_cant`, `dias_rotacion`, `class_iva`, `flete`, producto.estado 
        FROM `producto`
        INNER JOIN proveedor ON proveedor.id_proveedor = producto.id_proveedor1") or die ("Error al consultar: proveedores");

///////////////////////////////////////////////////////////////////////////
        $contador = 0;
        while (($fila = mysqli_fetch_array($consulta))!=NULL){
            $contador++;
            ?>
            <tr>
                <th><?php echo $contador ?></th>
                <td style="display:none"><?php echo $fila['id_producto']; ?></td>
                <td><?php echo $fila['nombre_producto']; ?></td>
                <td><?php echo $fila['nombre_proveedor']; ?></td>
                <td><?php echo $fila['estado']; ?></td>

                <td style="display:none"><?php echo $fila['id_cat1']; ?></td>
                <td style="display:none"><?php echo $fila['id_proveedor1']; ?></td>
                <td style="display:none"><?php echo $fila['descripcion']; ?></td>
                <td style="display:none"><?php echo $fila['cod_producto']; ?></td>
                <td style="display:none"><?php echo $fila['control_inv']; ?></td>
                <td style="display:none"><?php echo $fila['decimales_cant']; ?></td>
                <td style="display:none"><?php echo $fila['dias_rotacion']; ?></td>
                <td style="display:none"><?php echo $fila['iva']; ?></td>
                <td style="display:none"><?php echo $fila['class_iva']; ?></td>
                <td style="display:none"><?php echo $fila['precio_de_compra']; ?></td>
                <td style="display:none"><?php echo $fila['flete']; ?></td>

                <td style="display:none"><?php echo $fila['precio_producto']; ?></td>
                <td style="display:none"><?php echo $fila['precio_producto2']; ?></td>
                <td style="display:none"><?php echo $fila['precio_producto3']; ?></td>

                <td><input type="button" class="w3-btn w3-teal btn_select_product" value="Seleccionar"/></td>
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
$('#myTable6').on('click', '.btn_select_product', function(event) {
	//Primera fila 
	//console.log("Primera Fila  : " + $(this).parents('tr').find('td:first-child').text());

  //var inputNombre = document.getElementById("nombre_sug");
  //inputNombre.value = $(this).parents('tr').find('td:nth-child(2)').text();

  //2 id
  //3 name
  //4 name prove
  //5 estado
  //console.log($(this).parents('tr').find('td:nth-child(5)').text());

  var inputNombre2 = document.getElementById("id_menu_pro");
  inputNombre2.value = $(this).parents('tr').find('td:nth-child(2)').text();

  var inputNombre2 = document.getElementById("nombre_menu_pro");
  inputNombre2.value = $(this).parents('tr').find('td:nth-child(3)').text();

  //var inputNombre2 = document.getElementById("id_menu_pro");
  //inputNombre2.value = $(this).parents('tr').find('td:nth-child(4)').text();

  $("#" + $(this).parents('tr').find('td:nth-child(5)').text()).prop("checked", true);


  

  const $select = document.querySelector('#categorias_menu_pro');
  $select.value = $(this).parents('tr').find('td:nth-child(6)').text();

  const $select2 = document.querySelector('#proveedores_menu_pro');
  $select2.value = $(this).parents('tr').find('td:nth-child(7)').text();

  var dato = document.getElementById("referencia_menu_pro");
  dato.value = $(this).parents('tr').find('td:nth-child(8)').text();

  dato = document.getElementById("cod_barras_menu_pro");
  dato.value = $(this).parents('tr').find('td:nth-child(9)').text();
  
  $("#" + $(this).parents('tr').find('td:nth-child(10)').text() + "control").prop("checked", true);

  $("#" + $(this).parents('tr').find('td:nth-child(11)').text() + "decimales").prop("checked", true);

  

  dato = document.getElementById("dias_rotacion_menu_pro");
  dato.value = $(this).parents('tr').find('td:nth-child(12)').text();

  dato = document.getElementById("t_iva_menu_pro");
  dato.value = $(this).parents('tr').find('td:nth-child(13)').text();

  $("#" + $(this).parents('tr').find('td:nth-child(14)').text()).prop("checked", true);

  dato = document.getElementById("precio_de_compra_menu_pro");
  dato.value = $(this).parents('tr').find('td:nth-child(15)').text();

  dato = document.getElementById("flete_menu_pro");
  dato.value = $(this).parents('tr').find('td:nth-child(16)').text();

  dato = document.getElementById("venta1_menu_pro");
  dato.value = $(this).parents('tr').find('td:nth-child(17)').text();

  dato = document.getElementById("venta2_menu_pro");
  dato.value = $(this).parents('tr').find('td:nth-child(18)').text();

  dato = document.getElementById("venta3_menu_pro");
  dato.value = $(this).parents('tr').find('td:nth-child(19)').text();

  utilidades()


  
  $('#xcont_respuesta8_1').trigger('click');
	//todos las columnas de la fila  
  /*
  console.log("Columnas de la Fila");
	$.each($(this).parents('tr'), function(index, val) {
		console.log($(val).text());
	});
  */
  
});
</script>
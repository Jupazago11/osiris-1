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
    <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" id="xcont_conge1_1" onclick="document.getElementById('respuesta_congeladas').style.display='none'; document.getElementById('xcont_4_1').style.display='block';">X</a>

    <input type="text" id="myInput3" onkeyup="myFunctionTabla3()" placeholder="Nombre.." title="Type in a name">

    <form name="form_seleccionar_" id="form_seleccionar_" method='post'>

    <table class="table_sugerido" id="myTable3" style="width:50%;border: 1px solid black; border-collapse: collapse;margin-left: auto;  margin-right: auto;background-color:white">
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Cajero</th>
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
                <td><?php echo $contador ?></td>
                <td><?php echo $ids_fact[$i] ?></td>
                <td><?php echo $nom_cong[$i] ?></td>
                <td><?php echo $nom_pers[$i] ?></td>
                <td><input type="button" class="w3-btn w3-teal btn_congelados" value="Seleccionar"/></td>
            </tr>
            <?php
        }
        ?>
    </form>
    </table>
    <input type="text" name="nombre" id="nombre_sug"/>
    
<?php


?>
<script>
    
</script>

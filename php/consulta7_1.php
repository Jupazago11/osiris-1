<script type="text/javascript" src="../js/funciones.js"></script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion

    //Consulta a la base de datos en la tabla proveedor
    $consulta = mysqli_query($conexion, "SELECT * FROM `proveedor` WHERE `estado` = 'activo' OR `estado` = 'inactivo'") or die ("Error al consultar: existencia del proveedor");

?>
    <form id="actualizar_proveedores" method="POST">
    <table border="1" id="tabla_sugerido" width="100%">
    <tr>
        <th>#</th>
        <th>Proveedor</th>
        <th>Dirección</th>
        <th>Contacto</th>
        <th>Nombre del Vendedor</th>
        <th>Teléfono</th>
        <th>Estado</th>
    </tr>
    <?php


    $contador = 0;

    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $contador++;

        $fila['nombre_proveedor'];
        $fila['direccion_proveedor'];
        $fila['contacto_proveedor'];
        $fila['nom_vendedor'];
        $fila['telefono_vendedor'];
        $fila['estado'];

        ?>
        <tr>
            <tbody>
            <td><?php echo $contador ?></td>
            <td><input type="text" name="ides[]" readonly value="<?php echo $fila['nombre_proveedor'] ?>"/></td>
            <td><input type="text" name="ides[]" value="<?php echo $fila['direccion_proveedor'] ?>"/></td>   
            <td><input type="text" name="ides[]" value="<?php echo $fila['contacto_proveedor'] ?>"/></td>    
            <td><input type="text" name="ides[]" value="<?php echo $fila['nom_vendedor'] ?>"/></td>    
            <td><input type="text" name="ides[]" value="<?php echo $fila['telefono_vendedor'] ?>"/></td>    
            <td>
            <?php
            if($fila['estado'] == "activo"){
                ?>
                <input type="radio" name="estado[<?php echo $contador ?>]" value="activo" checked>
                    Activo<br>
                <input type="radio" name="estado[<?php echo $contador ?>]" value="inactivo">
                    Inactivo<br></td> 
                <?php
            }elseif($fila['estado'] == "inactivo"){
                ?>
                <input type="radio" name="estado[<?php echo $contador ?>]" value="activo">
                    Activo<br>
                <input type="radio" name="estado[<?php echo $contador ?>]" value="inactivo" checked>
                    Inactivo<br></td> 
                <?php
            }
            
    }
    ?> 
    </form>
    <?php
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
<script type="text/javascript" src="../js/funciones.js"></script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion


    $nombre_prove = strval($_POST['provedor']); //obtenemos el nombre del proveedor seleccionado


    //Verificamos si el proveedor existe
    $existe_proveedor = false;

    //Consulta a la base de datos en la tabla proveedor
    $consulta = mysqli_query($conexion, "SELECT * FROM `proveedor` WHERE `nombre_proveedor` = '$nombre_prove'") or die ("Error al consultar: existencia del proveedor");
                        
    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $existe_proveedor = true;
        $direccion = $fila['direccion_proveedor'];
        $telefono = $fila['telefono_proveedor'];
        $estado = $fila['estado'];
    }

    if($existe_proveedor != true){
        //$consulta = mysqli_query($conexion, "INSERT INTO `proveedor`(`nombre_proveedor`, `direccion_proveedor`, `telefono_proveedor`, `estado`) VALUES ('','','','activo')") or die ("Error al consultar: existencia del proveedor");

    }else{
        mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario

        ?>
        <table id="tabla_sugerido">
        <tr>
            <th>Dirección<th>
            <th>Teléfono<th>
            <th>Estado</th>
            <th></th>
        </tr>
        <tr>
            <td><input type="text" name = "direccion" value="<?php echo $direccion ?>" /><td>
            <td><input type="text" name = "telefono" value="<?php echo $telefono ?>" /><td>
            <?php
            if($estado == "activo"){
                ?>
                <td><input type="radio" id="r1" name="estado" value="activo" checked>
                    <label for="r1">Activo</label><br>
                <input type="radio" id="r2" name="estado" value="inactivo">
                    <label for="r2">Inactivo</label><br></td>
                <?php
            }else{
                ?>
                <td><input type="radio" id="r1" name="estado" value="activo">
                    <label for="r1">Activo</label><br>
                <input type="radio" id="r2" name="estado" value="inactivo" checked>
                    <label for="r2">Inactivo</label><br></td>
                <?php
            }
            ?>
            <td>Ok<td>
        </tr>
        </table>
        <?php



    }
    /*

    if($existe_proveedor == true){
        

        ?>
        <br>
        <div class="alert info">
            <span class="closebtn">&times;</span>  
            <strong>Información!</strong> Agregado con éxito
        </div>
        <?php

    }elseif($existe_proveedor == true){
        ?>
        <br>
        <div class="alert warning">
            <span class="closebtn">&times;</span>  
            <strong>Información!</strong> Debes ingresar una fecha válida
        </div>
        <?php
    }*/
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
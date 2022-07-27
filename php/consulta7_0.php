<script type="text/javascript" src="../js/funciones.js"></script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion

    //Consulta a la base de datos en la tabla proveedor
    $consulta = mysqli_query($conexion, "SELECT * FROM `proveedor` WHERE `estado` != ''") or die ("Error al consultar: existencia del proveedor");

?>
    <form id="actualizar_proveedores2" method="POST">
    <table class="tabla_sugerido" width="100%">
    <tr>
        <th>#</th>
        <th>Proveedor</th>
        <th>Usuario</th>
        <th>Clave</th>

    </tr>
    <?php


    $contador = 0;

    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $contador++;
        ?>
        <tr>
            <tbody>
            <td><?php echo $contador ?></td>
                <input type="hidden" name="id_proveedor[]" value="<?php echo $fila['id_proveedor'] ?>"/>
            <td><input type="text" name="nombres[]" value="<?php echo $fila['nombre_proveedor'] ?>"/></td>
            <td><input type="text" name="user[]" value="<?php echo $fila['user'] ?>"/></td>   
            
            <td><input type="text" name="pass[]" value="<?php echo $fila['pass'] ?>"/></td>    
            
             

            <?php      
    }
    mysqli_free_result($consulta);
    ?> 
    <tr>
        <td></td>
        <td></td>
        <td><button type="button" id="enviar7_4" class="w3-btn w3-green" onclick="document.getElementById('respuesta7_4').style.display='block'">Guardar <i class='fas fa-edit' style='font-size:24px;color:white'></td>
        <td></td>
    </tr>
    </table>
    </form>
    <br>

    <div id="respuesta7_4"></div>

    <script>
    $('#enviar7_4').click(function(){
        $.ajax({
            url:'../php/consulta7_4.php',
            type:'POST',
            data: $('#actualizar_proveedores2').serialize(),
            success: function(res){
                Swal.fire(
                '¡Muy bien!',
                'Guardado Exitoso',
                'success'
                )
                $('#enviar7_0').trigger('click');
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });
    </script>

    <?php
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
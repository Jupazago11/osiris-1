<script type="text/javascript" src="../js/funciones.js"></script>
<?php

    $conexion = conectar();                     //Obtenemos la conexion

    //Consulta a la base de datos en la tabla proveedor
    $consulta = mysqli_query($conexion, "SELECT * FROM `proveedor` WHERE `estado` != ''") or die ("Error al consultar: existencia del proveedor");

?>
    <form id="actualizar_proveedores2" method="POST">
    <table class="tabla_sugerido" width="100%" style="font-size:16px">
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
        <td></td>
        <td><img src="../iconos/guardar.png" width="60px" height="60px" id="enviar7_4" onclick="document.getElementById('respuesta7_4').style.display='block'" class="btn_guardar btn_icono"></td>
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
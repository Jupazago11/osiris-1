<script type="text/javascript" src="../js/funciones.js"></script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion

    ?>
    <div>
        <form id="form_ventas_v1_1" method="POST">
            <legend>Caja 1</legend>
            <input type="text" id="codigo_producto_v1_1" name="codigo_producto_v1_1"><br><br>
            <button type="button" id="Enviarv1_1" class="w3-btn w3-teal">Consultar</button>
        </form>

    
        <form id="form_caja_v1_1" method="POST">
        <table class="tabla_sugerido" id="tabla_v1_1">
            <tr>
                <th>Header</th>
            </tr>

            <tbody id="tbodyform">
            <tr id="respuestav1_1" name="total">
                    
            </tr>
            </tbody>

            <tfoot>
            <tr>
                <td>Total</td>
                <td class="final_v1_1"></td>
            </tr>
            </tfoot>
        </table>
        <div id="precio_total_v1_1"></div>
        </form>

    </div>
    <script>
        $('#Enviarv1_1').click(function(){
                $.ajax({
                    url:'../PHP/consultav1_1.php',
                    type:'POST',
                    data: $('#form_ventas_v1_1').serialize(),
                    success: function(res){
                        $('#respuestav1_1').append(res);   //Append para agregar nuevo
                    },
                    error: function(res){
                        alert("Problemas al tratar de enviar el formulario productos en facturación");
                    }
                });
            });
    </script>

    <?php

    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
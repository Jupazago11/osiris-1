<script type="text/javascript" src="../js/funciones.js"></script>
<style>
* {
  box-sizing: border-box;
}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=submit] {
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
</style>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();

    date_default_timezone_set('America/Bogota');
    $fecha = date('Y-m-d', time());

    $usuario         = strval($_POST['usuario']);//obtenemos el nombre del proveedor seleccionado
    $vehiculo        = $_POST['vehiculo'];
    $bandera         = false;

    //id del cliente
    $consulta = mysqli_query($conexion, "SELECT * FROM `vehiculo` WHERE `placa` = '$vehiculo'") or die ("Error al consultar: cliente");

    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        if($vehiculo == $fila['placa']){
            $bandera = true;
        }
    }
    mysqli_free_result($consulta);

    if($bandera == true){

    
        ?>
        <br>
        <div class="container">
        <form id="creacion_domicilio" method="POST">
        <input type="hidden" name="usuario" value="<?php echo $usuario; ?>">
        <input type="hidden" name="vehiculo" value="<?php echo $vehiculo; ?>">
            <div class="row">
            <div class="col-25">
                <label for="fname">Cliente</label>
            </div>
            <div class="col-75">
                <input list="clientes" name="cliente" id="cliente"  required>
                <datalist id="clientes" onchange="traer_ubicacion()" required>
                <?php
                    //Consulta a la base de datos en la tabla para desplegar los clientes
                    $consulta = mysqli_query($conexion, "SELECT * FROM `cliente` WHERE `estado` = 'activo'");

                    while (($fila = mysqli_fetch_array($consulta))!=NULL){
                        // traemos los proveedores existentes en la base de datos
                        ?>
                        <option value="<?php echo $fila['nombre_cliente'] ?>">
                        <?php
                        

                    }
                    mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
                ?>
                </datalist>
            </div>
            </div>
            <div class="row">
            <div class="col-25">
                <label for="lname">Ubicación</label>
            </div>
            <div class="col-75">
                <input list="ubicaciones" name="ubicacion" id="ubicacion"  required>
                <datalist id="ubicaciones" onchange="traer_ubicacion()" required>
                <?php
                    
                    //Consulta a la base de datos en la tabla para desplegar los clientes
                    $consulta = mysqli_query($conexion, "SELECT * FROM `ubicacion` WHERE `estado` = 'activo'");

                    while (($fila = mysqli_fetch_array($consulta))!=NULL){
                        // traemos los proveedores existentes en la base de datos
                        ?>
                        <option value="<?php echo $fila['ubicacion'] ?>">
                        <?php
                        

                    }
                    mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
                ?>
                </datalist>
            </div>
            </div>
            <div class="row">
            <div class="col-25">
                <label for="country">Destino</label>
            </div>
            <div class="col-75">
                <input type="text" name="destino" id="destino"  required>
            </div>
            </div>
            <div class="row">
            <div class="col-25">
                <label for="country">Categoría</label>
            </div>
            <div class="col-75">
                <input list="categorias" name="categoria" id="categoria"  required>
                <datalist id="categorias"  required>
                    <option value="normal">
                    <option value="Prioritario">
                </datalist>
            </div>
            </div>
            <div class="row">
            <div class="col-25">
                <label for="country">Observación</label>
            </div>
            <div class="col-75">
                <input type="text" name="observacion"   required>
            </div>
            </div>
            <br>
            <br>
            <div class="row">
            <button type="button" id="enviar5_1" class="w3-btn w3-red" onclick="document.getElementById('respuesta5_1').style.display='block'">Agregar</button>
            </div>
            <br>
        </form>
        </div>
        
        <div id="respuesta5_1"></div>
            <script>
                $('#enviar5_1').click(function(){
                    $.ajax({
                        url:'../php/consulta5_1.php',
                        type:'POST',
                        data: $('#creacion_domicilio').serialize(),
                        success: function(res){
                            $('#respuesta5_1').html(res);
                        },
                        error: function(res){
                            alert("Problemas al tratar de enviar el formulario");
                        }
                    });
                });
            </script>
        </div>
    <?PHP


        //mysqli_free_result($consulta);
        ?>
            </table>
        <?PHP
        mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
    }else{
        ?>
        <br>
        <div class="alert warning">
            <span class="closebtn">&times;</span>  
            <strong>Información!</strong> No se encontró el Vehículo en la base de datos
        </div>
        <?php
    }
?>
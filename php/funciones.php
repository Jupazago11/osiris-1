<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<script>$.ajaxPrefilter(function( options, originalOptions, jqXHR ) {    options.async = true; });</script>
<script type="text/javascript" src="../js/funciones.js"></script>

<?php

    //Funcion que verifica si existeel archivo de conexion de la base de datos
    function existencia_de_la_conexion(){
        try {
            //Verificar si existe el archivo de conexion
            if(!file_exists('../PHP/conexion.php')){
                throw new Exception ('PHP: File  -conexion-  no existe',1);  //NO existe, captura excepcion
            }else{
                return true;
                //require_once("../PHP/conexion.php");                //SI Existe, continuar y realizar la conexion
            }
        
        } catch (Exception $excepcion) {
            //Captura de excepcion y su respectivo codigo
            echo 'Capture: ' .  $excepcion->getMessage(), "<br>";
            echo 'Código: ' . $excepcion->getCode(), "<br>";
        }
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function iniciar_sesion($usuario, $clave){
        
        if(existencia_de_la_conexion()){
            require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
        }
        $conexion = conectar();                     //Obtenemos la conexion
        
        //Consulta a la base de datos en la tabla login
        $consulta = mysqli_query($conexion, "SELECT `user_pers`, `pass_pers`, `tipo_usuario_pers` FROM `personal` WHERE `estado` ='activo'")
        or die ("Error al iniciar sesión: ");

        $encontrado = false;
        while (($fila = mysqli_fetch_array($consulta))!=NULL){

        //Comprobamos la existencia del usuario y contraseña del formulario en los resulatdos de la bases de datos
            if($usuario == $fila['user_pers'] && $clave == $fila['pass_pers']){
                //Existe en la base de datos y es conrrecto los datos
                $tipo_de_cuenta = $fila['tipo_usuario_pers']; //Obtenemos su tipo de cuenta
                echo $fila['user_pers'];
                $encontrado = true;
                mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
                mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
                break;
            }
        }
        if($encontrado==false){
            mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
            mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
            //Si no se encontró registro alguno, regresamos al index de inicio de sesión
            ?>
            <script type="text/javascript">
				window.history.back();
			</script>
            <?php
        }
        return $tipo_de_cuenta;
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Funcion que verifica si existeel archivo de conexion de la base de datos
    function crear_sugerido($usuario){
        $fecha = date('Y-m-d', time());
        echo "<br>";
        echo $fecha;
        echo "<br>";
        ?>
        <div class="">
        <form id="form_seleccionar_prove" method="POST">
            <fieldset>
            <legend>Crear Sugerido:</legend>
            <label for="provedor">Selecciona el proveedor</label>
            <input type="hidden" name="usuario" value="<?php echo $usuario; ?>">
            <input list="provedores" name="provedor" id="provedor"  required>
            <datalist id="provedores"  required>

            <?php
                if(existencia_de_la_conexion()){
                    require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
                }
                $conexion = conectar();                     //Obtenemos la conexion
                
                //Consulta a la base de datos en la tabla provvedor
                $consulta = mysqli_query($conexion, "SELECT `nombre_proveedor` FROM `proveedor` WHERE `estado` = 'activo' ORDER BY `nombre_proveedor` ASC") or die ("Error al consultar: proveedores");

                while (($fila = mysqli_fetch_array($consulta))!=NULL){
                    // traemos los proveedores existentes en la base de datos
                    echo "<option value=".$fila['nombre_proveedor']."></option>";
                }
                mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
            ?>
            </datalist>
            <br><br>
            <button type="button" id="enviar1" class="w3-btn w3-teal" onclick="document.getElementById('respuesta1').style.display='block'">Crear Sugerido</button><br><br>
            <input type="reset" value="Limpiar" class="w3-btn w3-teal" onclick="document.getElementById('respuesta1').style.display='none'">
            </fieldset>
        </form>
                
        <div id="respuesta1"></div>
        <script>
            $('#enviar1').click(function(){
                $.ajax({
                    url:'../php/consulta1.php',
                    type:'POST',
                    data: $('#form_seleccionar_prove').serialize(),
                    success: function(res){
                        $('#respuesta1').html(res);
                    },
                    error: function(res){
                        alert("Problemas al tratar de enviar el formulario");
                    }
                });
            });
        </script>
        </div>
    <?php
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Funcion que verifica si existeel archivo de conexion de la base de datos
    function crear_pedido($usuario){
        ?>
        <div>
        <form id="form_crear_pedido" method="POST">
            <fieldset>
            <label for="provedor">Selecciona el proveedor</label>
            <input type="hidden" name="usuario" value="<?php echo $usuario; ?>">
            <input list="provedores" name="provedor" id="provedor"  required>
            <datalist id="provedores"  required>

            <?php
                if(existencia_de_la_conexion()){
                    require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
                }
                $conexion = conectar();                     //Obtenemos la conexion
                
                //Consulta a la base de datos en la tabla provvedor
                $consulta = mysqli_query($conexion, "SELECT `nombre_proveedor` FROM `proveedor` WHERE `estado` = 'activo' ORDER BY `nombre_proveedor` ASC") or die ("Error al consultar: proveedores");

                while (($fila = mysqli_fetch_array($consulta))!=NULL){
                    // traemos los proveedores existentes en la base de datos
                    echo "<option value=".$fila['nombre_proveedor']."></option>";
                }
                mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
            ?>
            </datalist>
            <br><br>
            Ingresa tu nombre
            <input type="text" name="nombre_empleado_provedor" required></input>
            <br><br>
            <button type="button" id="enviar2" class="w3-btn w3-green" onclick="document.getElementById('respuesta2').style.display='block'">Crear Pedido</button><br><br>
            <input type="reset" value="Limpiar" class="w3-btn w3-green" onclick="document.getElementById('respuesta2').style.display='none'">
            </fieldset>
        </form>
                
        <div id="respuesta2"></div>
        <script>
            $('#enviar2').click(function(){
                $.ajax({
                    url:'../php/consulta2.php',
                    type:'POST',
                    data: $('#form_crear_pedido').serialize(),
                    success: function(res){
                        $('#respuesta2').html(res);
                    },
                    error: function(res){
                        alert("Problemas al tratar de enviar el formulario");
                    }
                });
            });
        </script>
        </div>
    <?php
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Funcion que verifica si existeel archivo de conexion de la base de datos
    function crear_pedido2($usuario){
        ?>
        <div>
        <form id="form_confirmar_pedido" method="POST">
            <fieldset>
            <label for="provedor">Selecciona el proveedor</label>
            <input type="hidden" name="usuario" value="<?php echo $usuario; ?>">
            <input list="provedores" name="provedor" id="provedor"  required>
            <datalist id="provedores"  required>

            <?php
                if(existencia_de_la_conexion()){
                    require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
                }
                $conexion = conectar();                     //Obtenemos la conexion
                
                //Consulta a la base de datos en la tabla provvedor
                $consulta = mysqli_query($conexion, "SELECT `nombre_proveedor` FROM `proveedor` WHERE `estado` = 'activo' ORDER BY `nombre_proveedor` ASC") or die ("Error al consultar: proveedores");

                while (($fila = mysqli_fetch_array($consulta))!=NULL){
                    // traemos los proveedores existentes en la base de datos
                    echo "<option value=".$fila['nombre_proveedor']."></option>";
                }
                mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
            ?>
            </datalist>
            <br><br>
            Ingresa tu nombre
            <input type="text" name="nombre_empleado_provedor" required></input>
            <br><br>
            <button type="button" id="enviar3" class="w3-btn w3-red" onclick="document.getElementById('respuesta3').style.display='block'">Pedido Final</button><br><br>
            <input type="reset" value="Limpiar" class="w3-btn w3-red" onclick="document.getElementById('respuesta3').style.display='none'">
            </fieldset>
        </form>
                
        <div id="respuesta3"></div>
        <script>
            $('#enviar3').click(function(){
                $.ajax({
                    url:'../php/consulta3.php',
                    type:'POST',
                    data: $('#form_confirmar_pedido').serialize(),
                    success: function(res){
                        $('#respuesta3').html(res);
                    },
                    error: function(res){
                        alert("Problemas al tratar de enviar el formulario");
                    }
                });
            });
        </script>
        </div>
    <?php
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////
//Funcion que verifica si existeel archivo de conexion de la base de datos
function ver_pedidos($usuario){
    ?>
    <div>
    <form id="ver_pedidos" method="POST">
        <fieldset>
        <button type="button" id="enviar4" class="w3-btn w3-red" onclick="document.getElementById('respuesta4').style.display='block'">Ver fechas <i class='far fa-calendar-alt'></i></button>
        <input type="reset" value="Limpiar" class="w3-btn w3-red" onclick="document.getElementById('respuesta4').style.display='none'">
        </fieldset>
    </form>
            
    <div id="respuesta4"></div>
    <script>
        $('#enviar4').click(function(){
            $.ajax({
                url:'../php/consulta4.php',
                type:'POST',
                data: $('#ver_pedidos').serialize(),
                success: function(res){
                    $('#respuesta4').html(res);
                },
                error: function(res){
                    alert("Problemas al tratar de enviar el formulario");
                }
            });
        });
    </script>
    </div>
<?php
}
///////////////////////////////////////////////////////////////////////////////////////////////////////

function control_domiciliario($usuario, $tipo_de_cuenta){

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion

    if($tipo_de_cuenta == 1 && $tipo_de_cuenta == 2){
        ?>
        <form id="seleccion_vehiculo" method="POST">
            <input type="hidden" name="usuario" value="<?php echo $usuario; ?>">
            <input type="hidden" name="tipo_de_cuenta" value="<?php echo $tipo_de_cuenta; ?>">
            <fieldset><legend>Selecciona el vehículo:</legend>
            <input list="vehiculos" name="vehiculo" id="vehiculo"  required>
            <datalist id="vehiculos"  required>

            <?php
                //Consulta a la base de datos en la tabla provvedor
                $consulta = mysqli_query($conexion, "SELECT * FROM `vehiculo` WHERE `estado` = 'activo'") or die ("Error al consultar: proveedores");

                while (($fila = mysqli_fetch_array($consulta))!=NULL){
                    // traemos los proveedores existentes en la base de datos
                    echo "<option value=".$fila['placa']."></option>";
                }
                mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
            ?>
            </datalist>

            <button type="button" id="enviar5" class="w3-btn w3-teal" onclick="document.getElementById('respuesta5').style.display='block'">Continuar</button>
            </fieldset>
        </form>

        <div id="respuesta5"></div>
        <script>
            $('#enviar5').click(function(){
                $.ajax({
                    url:'../php/consulta5.php',
                    type:'POST',
                    data: $('#seleccion_vehiculo').serialize(),
                    success: function(res){
                        $('#respuesta5').html(res);
                    },
                    error: function(res){
                        alert("Problemas al tratar de enviar el formulario");
                    }
                });
            });
        </script>
        </div>
        <?php

    }elseif($tipo_de_cuenta == 4){
        ?>
        <form id="seleccion_vehiculo" method="POST">
            <fieldset><legend>Selecciona el vehículo:</legend>
            <input list="vehiculos" name="vehiculo" id="vehiculo"  required>
            <datalist id="vehiculos"  required>
            <?php
                //Consulta a la base de datos en la tabla provvedor
                $consulta = mysqli_query($conexion, "SELECT * FROM `vehiculo` WHERE `estado` = 'activo'") or die ("Error al consultar: proveedores");

                while (($fila = mysqli_fetch_array($consulta))!=NULL){
                    // traemos los proveedores existentes en la base de datos
                    echo "<option value=".$fila['placa']."></option>";
                }
                mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
            ?>
            </datalist>

            <button type="button" id="enviar5_2" class="w3-btn w3-teal" onclick="document.getElementById('respuesta5_2').style.display='block'">Continuar</button>
            </fieldset>
        </form>

        <div id="respuesta5_2"></div>
        <script>
            $('#enviar5_2').click(function(){
                $.ajax({
                    url:'../php/consulta5_2.php',
                    type:'POST',
                    data: $('#seleccion_vehiculo').serialize(),
                    success: function(res){
                        $('#respuesta5_2').html(res);
                    },
                    error: function(res){
                        alert("Problemas al tratar de enviar el formulario");
                    }
                });
            });
        </script>
        </div>
        <?php
    }
}

?>
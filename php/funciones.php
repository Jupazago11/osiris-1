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

    if($tipo_de_cuenta == 1 || $tipo_de_cuenta == 2 || $tipo_de_cuenta == 3){
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

            <button type="button" id="enviar5_2" class="w3-btn w3-teal" onclick="document.getElementById('respuesta5_2').style.display='block'; var intervalo_time = setInterval(myTimer2, 60000); setInterval(myTimer2, 60000)">Continuar</button>
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

/////////////////////////////////////////////////////////////////////////////////////////
function cuentas_por_pagar($usuario){
    ?>
    <div>
    <table border="1" id="tabla_sugerido" width="100%">
    <tr>
        <th>Nombre del Proveedor</th>
        <th>Factura</th>
        <th>Días</th>
        <th>Costo</th>
        <th colspan="3">Selección</th>
    </tr>
    <tr>
    <form id="cuentas_por_pagar" method="POST">
        <td><input list="provedores" name="provedor" id="provedor"></td>
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
        <td><input type="text" name="factura"/></td>
        <td><input type="text" name="dias" size="5"/></td>
        <td><input type="number" name="costo"/></td>
        <td><button type="button" id="enviar6" class="w3-btn w3-red" onclick="document.getElementById('respuesta6').style.display='block'">Inscribir Cuenta</button></td>
        <td><button type="button" class="w3-btn w3-green" onclick="$('#enviar6_1').trigger('click')"><i class="fa fa-eye" style="font-size:24px;color:white"></button></td>
        <td><button type="button" class="w3-btn w3-green" onclick="document.getElementById('respuesta6_1').style.display='none'"><i class="fas fa-eye-slash" style="font-size:24px;color:white"></button></td>
        
        <input type="reset" id="limpiar6" value="Limpiar" class="w3-btn w3-teal"  style="visibility:hidden;"/>
    </form>
    </tr>
    </table>
    <div id="respuesta6"></div>
    <button type="button" id="enviar6_1" class="w3-btn w3-red"  style="visibility:hidden;" onclick="document.getElementById('respuesta6_1').style.display='block'">Inscribir Cuenta</button>
    
    <div id="respuesta6_1"></div>

    <script>
        $('#enviar6').click(function(){
            $.ajax({
                url:'../php/consulta6.php',
                type:'POST',
                data: $('#cuentas_por_pagar').serialize(),
                success: function(res){
                    $('#respuesta6').html(res);
                    $('#limpiar6').trigger('click');
                    $('#enviar6_1').trigger('click');
                },
                error: function(res){
                    alert("Problemas al tratar de enviar el formulario");
                }
            });
        });
        $('#enviar6_1').click(function(){
            $.ajax({
                url:'../php/consulta6_1.php',
                type:'POST',
                success: function(res){
                    $('#respuesta6_1').html(res);
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

/////////////////////////////////////////////////////////////////////////////////////////
function menu_proveedor($usuario){
    ?>
    <div>
    
    <form id="menu_proveedores" method="POST">
        <table id="tabla_sugerido">
            <tr>
                <th colspan="4">Crear un nuevo proveedor</th>
            </tr>
            <tr>
                <td>Nombre</td>
                <td><input type="text" name="nombre"/></td>
                <td>Dirección</td>
                <td><input type="text" name="direccion"/></td>
            </tr>
            <tr>
                <td>Contacto</td>
                <td><input type="text" name="contacto"/></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Nombre del vendedor</td>
                <td><input type="text" name="nombrevendedor"/></td>
                <td>Teléfono</td>
                <td><input type="text" name="telefono"/></td>
            </tr>
            <tr>
                <td colspan="4"><div class="alert warning">
                    <span class="closebtn">&times;</span>  
                    <strong>Información!</strong> El Usuario y Contraseña es el nombre del proveedor
                </div></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2"><button type="button" id="enviar7" class="w3-btn w3-green" onclick="document.getElementById('respuesta7').style.display='block'">Guardar<i class='fas fa-edit' style='font-size:24px;color:white'></i></button></td>
                <td><input type="reset" id="limpiar7" value="Limpiar" class="w3-btn w3-teal"  style="visibility:hidden;"/></td>
            </tr>
        </table>
    </form>
    
    <table id="tabla_sugerido">
        <tr>
            <td width="33%"><button type="button" id="enviar7_1" class="w3-btn w3-blue" onclick="document.getElementById('respuesta7_1').style.display='block'">Ver Proveedores<i class='fa fa-eye' style='font-size:24px;color:white'></i></button></td>
            <td width="33%"></td>
            <td width="33%"><button type="button" class="w3-btn w3-blue" onclick="document.getElementById('respuesta7_1').style.display='none'">Ocultar<i class='fa fa-eye-slash' style='font-size:24px;color:white'></i></button></td>
        </tr>
    </table>
    

    <div id="respuesta7"></div>
    <br>
    
    

    <div id="respuesta7_1"></div>

    <script>
        $('#enviar7').click(function(){
            $.ajax({
                url:'../php/consulta7.php',
                type:'POST',
                data: $('#menu_proveedores').serialize(),
                success: function(res){
                    $('#respuesta7').html(res);
                    $('#limpiar7').trigger('click');
                    $('#enviar7_1').trigger('click');
                },
                error: function(res){
                    alert("Problemas al tratar de enviar el formulario");
                }
            });
        });
        $('#enviar7_1').click(function(){
            $.ajax({
                url:'../php/consulta7_1.php',
                success: function(res){
                    $('#respuesta7_1').html(res);
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

////////////////////////////////////////////////////////////////////////////////////////////////
function menu_producto($usuario){
    ?>
    <div>
    <form id="menu_productos" method="POST"> 
    <table border="1" id="tabla_sugerido">
    <tr>
        <th colspan="2">Datos Básicos</th>
        <th colspan="3">Información Tributaria</th>
    </tr>
    <tr>
        <td>Categoría</td>
        <td><input list="categorias" name="categoria" id="categoria"></th>
        <datalist id="categorias"  required>

        <?php
            if(existencia_de_la_conexion()){
                require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
            }
            $conexion = conectar();                     //Obtenemos la conexion
            
            //Consulta a la base de datos en la tabla provvedor
            $consulta = mysqli_query($conexion, "SELECT `categorias` FROM `categoria` WHERE `estado` = 'activo' ORDER BY `categorias` ASC") or die ("Error al consultar: proveedores");

            while (($fila = mysqli_fetch_array($consulta))!=NULL){
                // traemos los proveedores existentes en la base de datos
                echo "<option value=".$fila['categorias']."></option>";
            }
            mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
        ?>
        </datalist></td>
        <td>Tarifas de IVA</td>
        <td><input type="text" id="t_iva" name=""/></td>
    </tr>
    <tr>
        <td>Proveedor</td>
        <td><input list="proveedores" name="proveedor" id="proveedor"></th>
        <datalist id="proveedores"  required>

        <?php
            if(existencia_de_la_conexion()){
                require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
            }
            $conexion = conectar();                     //Obtenemos la conexion
            
            //Consulta a la base de datos en la tabla provvedor
            $consulta = mysqli_query($conexion, "SELECT `nombre_proveedor` FROM `proveedor` WHERE `estado` = 'activo' ORDER BY `nombre_proveedor` ASC") or die ("Error al consultar: proveedores");

            while (($fila = mysqli_fetch_array($consulta))!=NULL){
                // traemos los proveedores existentes en la base de datos

                ?>
                <option value="<?php echo $fila['nombre_proveedor'] ?>"></option>";
                <?php
            }
            mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
        ?>
        </datalist></td>
        <td>Clasificación de IVA</td>
        <td><input type="radio" id="civa1" name="clasi_iva" value="gravado" checked>
                <label for="civa1">Gravado</label>
            <input type="radio" id="civa2" name="clasi_iva" value="incluido">
                <label for="civa2">Incluido</label>
            <input type="radio" id="civa3" name="clasi_iva" value="excluido">
                <label for="civa3">Excluido</label><br></td>
    </tr>
    <tr>
        <td>Descripción</td>
        <td><input type="text" name="descripcion"/></td>
        <td>Costo del producto</td>
        <td><input type="text" id="" name=""/></td>
    </tr>
    <tr>
        <td>Referencia</td>
        <td><input type="text" name="referencia"/></td>
        <td>Costo + Impuesto</td>
        <td><input type="text" id="" name=""/></td>
    </tr>
    <tr>
        <td>Código de barra</td>
        <td><input type="text" name="codigo_barras"/></td>
        <td>Flete</td>
        <td><input type="text" id="" name=""/></td>
    </tr>
    <tr>
        <td>Control Inventario</td>
        <td><input type="radio" id="c1" name="control_inventario" value="si" checked>
                <label for="c1">Si</label><br>
            <input type="radio" id="c2" name="control_inventario" value="no">
                <label for="c2">No</label><br></td>
        <td>Utilidad estimada</td>
        <td><input type="text" id="" name=""/></td>
    </tr>
    <tr>
        <td>Decimales en cantidad</td>
        <td><input type="radio" id="d1" name="decimales_en_cantidad" value="si" checked>
                <label for="d1">Si</label><br>
            <input type="radio" id="d2" name="decimales_en_cantidad" value="no">
                <label for="d2">No</label><br></td>



        <td>Precio Sugerido<br><input type="text" id="" name=""/></td>
        <td>Venta 2<br><input type="text" id="" name=""/></td>
        <td>Venta 3<br><input type="text" id="" name=""/></td>
    </tr>
    <tr>
        <td>Días rotación</td>
        <td><input type="number" name="codigo_barras" min="0" value="0"/></td>
    </tr>
    <tr>
        <td>Activo</td>
        <td><input type="radio" id="r1" name="estado" value="activo" checked>
                <label for="r1">Activo</label><br>
            <input type="radio" id="r2" name="estado" value="inactivo">
                <label for="r2">Inactivo</label><br></td>
        <td>Utilidad<br><input type="text" id="" name=""/></td>
        <td>Utilidad 2<br><input type="text" id="" name=""/></td>
        <td>Utilidad 3<br><input type="text" id="" name=""/></td>
    </tr>

    </form>
    </table>
    <button type="button" id="enviar8" class="w3-red" onclick="document.getElementById('respuesta8').style.display='block'"><i class='fas fa-edit' style='font-size:24px;color:white'></i></button>

    <div id="respuesta8"></div>
    

    <script>
        $('#enviar8').click(function(){
            $.ajax({
                url:'../php/consulta8.php',
                type:'POST',
                data: $('#menu_productos').serialize(),
                success: function(res){
                    $('#respuesta8').html(res);
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

/////////////////////////////////////////////////////////////////////////////////////////
function menu_personal($usuario){
    ?>

    <form id="menu_personals" method="POST"> 
        <table id="tabla_sugerido">
            <tr>
                <th colspan="2">Datos Personales</th>
                <th colspan="2">Información Laboral</th>
            </tr>
            <tr>
                <td>Nombre</td>
                <td><input type="text" name="nombre" class="w3-inputs"/></td>
                <td>Fecha de Inicio de contrato</td>
                <td><input type="date" name="fecha_contrato" class="w3-inputs"/></td>
            </tr>
            <tr>
                <td>Identificación</td>
                <td><input type="text" name="identificacion"/></td>
                <td>Duración del contrato</td>
                <td><input type="radio" id="r1" name="contrato" value="6" checked/>
                        <label for="r1">6 Meses</label><br>
                    <input type="radio" id="r2" name="contrato" value="12"/>
                        <label for="r2">1 Año</label><br></td>
            </tr>
            <tr>
                <td>Fecha de nacimiento</td>
                <td><input type="date" name="fecha_nacimiento"/></td>
                <td>Salario</td>
                <td><input type="text" name="salario"/></td>
            </tr>
            <tr>
                <th colspan="2">Datos de cuenta</th>
                <td>EPS</td>
                <td><input type="text" name="eps"/></td>
            </tr>
            <tr>
                <td>Usuario</td>
                <td><input type="text" name="user" class="w3-inputs"/></td>
                <td>ARL</td>
                <td><input type="text" name="arl"/></td>
            </tr>
            <tr>
                <td>Contraseña</td>
                <td><input type="text" name="pass"/></td>
                <td>Caja de compensasión</td>
                <td><input type="text" name="caja"/></td>
            </tr>
            <tr>
                <td>Nivel de acceso</td>
                <td><input type="number" name="lvl_acc" value="2" min="1" max="6"/></td>
                <td>Pensión</td>
                <td><input type="text" name="pension"/></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>Cargo</td>
                <td><input type="text" name="cargo"/></td>
            </tr>
            
            <tr>
                <td></td>
                <td colspan="2"></td>
                <td><input type="reset" id="limpiar9" value="Limpiar" style="visibility:hidden;"/></td>
            </tr>
    
        </table>
    </form>
    <div id="respuesta9"></div>
    <br>
    <table id="tabla_sugerido">
        <tr>
            <td width="33%"><button type="button" id="enviar9_1" class="w3-btn" style="background-color: #305490;color:white" onclick="document.getElementById('respuesta9_1').style.display='block'">Modificar información</button></td>
            <td width="33%"><button type="button" id="enviar9" class="w3-btn" style="background-color: #478248;color:white" onclick="document.getElementById('respuesta9').style.display='block'">Registrar</button></td>
            <td width="33%"><button type="button" class="w3-btn" style="background-color: #305490;color:white" onclick="document.getElementById('respuesta9_1').style.display='none'">Ocultar</button></td>
        </tr>
    </table>

    <div id="respuesta9_1"></div>

    <script>
        $('#enviar9').click(function(){
            $.ajax({
                url:'../php/consulta9.php',
                type:'POST',
                data: $('#menu_personals').serialize(),
                success: function(res){
                    $('#respuesta9').html(res);
                },
                error: function(res){
                    alert("Problemas al tratar de enviar el formulario");
                }
            });
        });
        $('#enviar9_1').click(function(){
            $.ajax({
                url:'../php/consulta9_1.php',
                success: function(res){
                    $('#respuesta9_1').html(res);
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
?>
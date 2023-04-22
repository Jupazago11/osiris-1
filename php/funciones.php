<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>$.ajaxPrefilter(function( options, originalOptions, jqXHR ) {    options.async = true; });</script>
<script type="text/javascript" src="../js/funciones.js"></script>

<?php

//Funcion que verifica si existeel archivo de conexion de la base de datos
function existencia_de_la_conexion(){
    try {
        //Verificar si existe el archivo de conexion
        if(!file_exists('../php/conexion.php')){
            throw new Exception ('PHP: File  -conexion-  no existe',1);  //NO existe, captura excepcion

        }else{
            require("../php/conexion.php");                //SI Existe, continuar y realizar la conexion
            return true;
        }
    
    } catch (Exception $excepcion) {
        //Captura de excepcion y su respectivo codigo
        echo 'Capture: ' .  $excepcion->getMessage(), "<br>";
        echo 'Código: ' . $excepcion->getCode(), "<br>";
    }
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////

function iniciar_sesion($usuario, $clave){
    existencia_de_la_conexion(); 

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
            echo "<div class='usuario' style='bakcground-color:#575656;color:white'>".$fila['user_pers'];
            $encontrado = true;
            mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
            //mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
            break;
        }
    }
    if($encontrado==false){
        mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
        //mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
        //Si no se encontró registro alguno, regresamos al index de inicio de sesión
        ?>
        <script type="text/javascript">
            window.history.back();
        </script>
        <?php
    }
    return $tipo_de_cuenta;
}

//////////////////////////////////////////////////////////////////////////////////////////////////
function iniciar_sesion2($usuario, $clave){
    
    if(existencia_de_la_conexion()){
        require_once("../php/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion
    
    //Consulta a la base de datos en la tabla login
    $consulta = mysqli_query($conexion, "SELECT `nombre_proveedor`, `user`, `pass`, `estado` FROM `proveedor` WHERE `estado` = 'activo'")
    or die ("Error al iniciar sesión: ");

    $encontrado = false;
    while (($fila = mysqli_fetch_array($consulta))!=NULL){

    //Comprobamos la existencia del usuario y contraseña del formulario en los resulatdos de la bases de datos
        if($usuario == $fila['user'] && $clave == $fila['pass']){
            //Existe en la base de datos y es conrrecto los datos
            $nombre_proveedor = $fila['nombre_proveedor']; //Obtenemos su tipo de cuenta
            echo "<div class='usuario'>".$fila['user'];
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
    return $nombre_proveedor;
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
function ver_notificaciones(){
    
    require_once("../php/notificaciones.php");   
    
    $eva = array(false, false, false, false);

    ?>
    <script>console.log("Entra vernoti");</script>
    <table class="tabla_sugerido">
        <tr>
            <th>Indicador</th>
            <th>Evento</th>
            <th>Tiempo</th>
        </tr>
    <?php
    
    $eva[0] = tiempo_contratos();
    $eva[1] = tiempo_cumpleani();
    $eva[2] = tiempo_soat_tecn();
    $eva[3] = tiempo_cuentaxpa();
    ?>
    </table> 
    <?php
    if($eva[0] == false && $eva[1] == false && $eva[2] == false && $eva[3] == false){
        ?>
        <script>
            var img_noti = document.getElementById("img_noti");
            img_noti.src = "../iconos/inactivo.png";
        </script>
        <?php
    }
}

////////////////////////////////////////////////////////////////////////////////////////////////////////
//Funcion que verifica si existeel archivo de conexion de la base de datos
function crear_sugerido($usuario){
    $conexion = conectar();                     //Obtenemos la conexion  
    
    ?>

    

    <form name="form_seleccionar_prove" id="form_seleccionar_prove" method='post'>

        <input type="hidden" name="nombre" id="prove_sugerido"/>
        <input type="hidden" name="usuario" value="<?php echo $usuario ?>"/>
        <table class="tabla_sugerido" id="myTable">
        <tr>
            <th>#</th>
            <th>Nombre <input type="text" id="myInput" onkeyup="myFunctionTabla()" title="Type in a name"></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>

        <?php

        $consulta = mysqli_query($conexion, "SELECT `id_proveedor`,`nombre_proveedor` 
        FROM `proveedor` 
        WHERE `estado` = 'activo'") or die ("Error al consultar: proveedores");

        
        $nombre_provee = array();
        while (($fila = mysqli_fetch_array($consulta))!=NULL){
            
            array_push($nombre_provee , $fila['nombre_proveedor']);
            
        }
        mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario

        $contador = 0;
        for ($i=0; $i < count($nombre_provee); $i++) { 
            $contador++;
            ?>
            <tr id="<?php echo $contador ?>">
                <td><?php echo $contador ?></td>
                <td class="row-data"><?php echo $nombre_provee[$i] ?></td>
                <td><input type="button" class="w3-btn w3-green" value="Nuevo" onclick="show1_3();" ><td>
                <td><input type="button" class="w3-btn w3-teal" value="Continuar" onclick="show1()"/></td>
            </tr>
            <?php
        }
        

        ?>
    </form>
    </table>

    <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('cont1_1').style.display='none'">X</a>
    <button type="button" id="enviar1" onclick="document.getElementById('respuesta1').style.display='block'" style="display: none;"></button>
    <button type="button" id="enviar1_3" style="display: none;"></button>
            
    <div id="respuesta1" class="ventana">


    </div>
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
        $('#enviar1_3').click(function(){
            $.ajax({
                url:'../php/consulta1_3.php',
                type:'POST',
                data: $('#form_seleccionar_prove').serialize(),
                success: function(res){
                    $('#enviar1').trigger('click');
                },
                error: function(res){
                    alert("Problemas al tratar de enviar el formulario");
                }
            });
        });
    </script>
<?php
}

////////////////////////////////////////////////////////////////////////////////////////////////////////
//Funcion que verifica si existeel archivo de conexion de la base de datos
function crear_pedido($name_proveedor){
    ?>
    <div>
    <form id="form_crear_pedido" method="POST">
        <input type="hidden" name="name_proveedor" value="<?php echo $name_proveedor; ?>">
        <button type="button" id="enviar2" class="w3-btn w3-green" onclick="document.getElementById('respuesta2').style.display='block';" style="display:none;">Crear Pedido</button><br><br>
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
function crear_pedido2($name_proveedor){
    ?>
    <div>
    <form id="form_confirmar_pedido" method="POST">
        <input type="hidden" name="name_proveedor" value="<?php echo $name_proveedor; ?>">
        <button type="button" id="enviar3" class="w3-btn w3-green" onclick="document.getElementById('respuesta3').style.display='block';" style="display:none;">Siguiente</button><br><br>
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
    <div id="respuesta4"></div>
    <form id="ver_pedidos" method="POST">
        <fieldset>
        <button type="button" id="enviar4" class="w3-btn w3-red" onclick="document.getElementById('respuesta4').style.display='block'">Ver fechas <i class='far fa-calendar-alt'></i></button>
        <input type="reset" value="Limpiar" class="w3-btn w3-red" onclick="document.getElementById('respuesta4').style.display='none'">
        </fieldset>
    </form>
    
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

    $conexion = conectar();                     //Obtenemos la conexion  
    ?>
    <?php
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
        <script>
                console.log("entra2");
            </script>
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

            <button type="button" id="enviar5_2" class="w3-btn w3-teal" onclick="document.getElementById('respuesta5_2').style.display='block';">Continuar</button>
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

///////////////////////////////////////////////////////////////////////////////////////////////////////
function control_domiciliario2($usuario, $tipo_de_cuenta){
    $conexion = conectar();                     //Obtenemos la conexion  
    ?>
    <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('cont3_2').style.display='none';">X</a>

        <form id="seleccion_vehiculover" method="POST">
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

            <button type="button" id="enviar5_5" class="w3-btn w3-teal" onclick="document.getElementById('respuesta5_5').style.display='block';">Continuar</button>
            </fieldset>
        </form>

        <div id="respuesta5_5"></div>
        <script>
            $('#enviar5_5').click(function(){
                $.ajax({
                    url:'../php/consulta5_5.php',
                    type:'POST',
                    data: $('#seleccion_vehiculover').serialize(),
                    success: function(res){
                        $('#respuesta5_5').html(res);
                        
                    },
                    error: function(res){
                        alert("Problemas al tratar de enviar el formulario");
                    }
                });
            });
        </script>
        </div>
        <?php








    ////////////////////////////////////////
    /*
    if(existencia_de_la_conexion()){
        require_once("../php/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion

    date_default_timezone_set('America/Bogota');
    $fecha = date('Y-m-d', time());


    $vehiculo        = "ABC-12A";

    $consulta = mysqli_query($conexion, "SELECT personal.user_pers,cliente.nombre_cliente, domicilio.observacion, domicilio.nivel_urgencia, domicilio.ubicacion, domicilio.destino, domicilio.estado, domicilio.tiempo_salida, domicilio.tiempo_llegada, domicilio.id_domi
    FROM `domicilio` 
    INNER JOIN `personal`   ON domicilio.id_pers3 = personal.id_pers 
    INNER JOIN `cliente`    ON domicilio.id_cliente2 = cliente.id_cliente  
    INNER JOIN `vehiculo`   ON vehiculo.id_vehiculo = domicilio.id_vehiculo2 
    WHERE vehiculo.placa = '$vehiculo' AND `fecha` = '$fecha'
    ORDER BY `id_domi` ASC") or die ("Error al consultar: domicilios");

    $existe_registro = false;
    while (($fila = mysqli_fetch_array($consulta)) != NULL){
        $existe_registro = true;
    }
    mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario

    if(($tipo_de_cuenta == 1 || $tipo_de_cuenta == 2 || $tipo_de_cuenta == 3) && $existe_registro == true){
        
        ?>
        <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('cont3_2').style.display='none';">X</a>

        <?php
        $consulta = mysqli_query($conexion, "SELECT personal.user_pers,cliente.nombre_cliente, domicilio.observacion, domicilio.nivel_urgencia, domicilio.ubicacion, domicilio.destino, domicilio.estado, domicilio.tiempo_salida, domicilio.tiempo_llegada, domicilio.id_domi
        FROM `domicilio` 
        INNER JOIN `personal` ON domicilio.id_pers3 = personal.id_pers 
        INNER JOIN `cliente` ON domicilio.id_cliente2 = cliente.id_cliente  
        INNER JOIN `vehiculo` ON vehiculo.id_vehiculo = domicilio.id_vehiculo2 
        WHERE vehiculo.placa = '$vehiculo' 
        AND `fecha` = '$fecha'
        ORDER BY `id_domi` ASC") or die ("Error al consultar: domicilios");
        ?>
        <form id="configuracion" method="POST">
        <table class="tabla_sugerido">
        <tr>
            <th>#</th>
            <th>Personal</th>
            <th colspan="3">Cliente</th>
            <th>Destino</th>
            <th>Salida</th>
            <th>LLegada</th>
            <th></th>
        </tr>
        <tbody id="tbodyform">
        
            <?php
            $contador = 1;
            
            //<span class="numeral"><?php echo $contador ? ></span>
            //<input type="number" class="numeral" value="<?php echo $contador ? >"></input>
            while (($fila = mysqli_fetch_array($consulta)) != NULL){
                ?>
                <tr>
                
                    <td><span class="numeral"><?php echo $contador ?></span></td> 
                    <td><?php echo $fila['user_pers']; ?></td>
                    <td><?php echo $fila['nombre_cliente']; ?></td>
                    <td><div class="tooltip"><i class='fa fa-search' style='font-size:36px'></i>
                    <span class="tooltiptext"><?php echo $fila['observacion']; ?></span></div></td>
                    <?php
                    if($fila['nivel_urgencia'] == "Prioritario"){
                        ?>
                        <td><i class='fa fa-exclamation' style='font-size:36px;color:red'></i></td>
                        <?php
                    }else{
                        ?>
                        <td></td>
                        <?php
                    }
                    ?>
                    <td><?php echo $fila['ubicacion'].": ".$fila['destino']; ?></td>
                    <?php
                    if($fila['tiempo_salida'] == NULL){
                        ?>
                        <td>
                        <label class="switch">
                        <input type="checkbox" name="salidass[]" onclick="enviar_update()" value="<?php echo $fila['id_domi'] ?>"  disabled>
                        <span class="slider"></span>
                        </label></td>
                        <?php
                    }else{
                        ?>
                        <td>
                        <label class="switch">
                        <input type="checkbox" checked disabled>
                        <span class="slider"></span>
                        </label>
                        <br>
                        <?php echo date("g:i:s a", strtotime($fila['tiempo_salida'])) ?>
                        </td>
                        <?php
                    }
                    ?>
                    <?php
                    if($fila['tiempo_llegada'] == NULL){
                        ?>
                        <td>
                        <label class="switch">
                        <input type="checkbox" name="llegadass[]" onclick="enviar_update2()" value="<?php echo $fila['id_domi'] ?>"  disabled>
                        <span class="slider"></span>
                        </label></td>
                        <?php
                    }else{
                        ?>
                        <td>
                        <label class="switch">
                        <input type="checkbox" checked disabled>
                        <span class="slider"></span>
                        </label>
                        <br>
                        <?php echo date("g:i:s a", strtotime($fila['tiempo_llegada'])) ?></td>
                        <?php
                    }
                    ?>

                    <?php
                    if($fila['estado'] == "activo"){
                        ?>
                        <td><i class='fa fa-hourglass-half' style='font-size:36px;color:red'></i></td>
                        <?php
                    }elseif($fila['estado'] == "inactivo"){
                        ?>
                        <td><i class='fa fa-check' style='font-size:36px;color:green'></i>
                        <br>
                        <?php
                            $fecha1  = new DateTime($fila['tiempo_salida']);
                            $fecha2  = new DateTime($fila['tiempo_llegada']);
                            $intvl   = $fecha1->diff($fecha2);

                            if($intvl->h > 0){
                                echo $intvl->h." horas y ".$intvl->i." minutos";
                            }else{
                                echo "Minutos: ".$intvl->i;
                            }

                        ?>
                        </td>
                        <?php
                    }else{
                        ?>
                        <td><i class='fa fa-motorcycle' style='font-size:36px;color:blue'></td>
                        <?php
                    }
                    ?>

                </tr>
                
            <?php
            $contador++;
        }
        ?>
        
        </tbody>
        <?php
        mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
        ?>
        </table>

        </div>
        <?php

    }elseif($existe_registro == false){
        ?>
        <script>
            document.getElementById('cont3_2').style.display='none';
        </script>

        <?php
    }*/
}

/////////////////////////////////////////////////////////////////////////////////////////
function cuentas_por_pagar($usuario){
    ?>
    <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('cont2_7').style.display='none';document.getElementById('cont2_6').style.display='none';">X</a>
    <button type="button" id="enviar6_1" class="w3-btn w3-red" style="display:none;">Inscribir Cuenta</button>
    
    <div id="respuesta6_1"></div>

    <script>
        document.getElementById('cont2_7').style.display='block';
        $('#enviar6_1').click(function(){
            document.getElementById('respuesta6_1').style.display='block';
            $.ajax({
                url:'../php/consulta6_1.php',
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
    <div id="respuesta7_0" style="display:none; backgroung-color:white;"></div>

    <br>
    <button type="button" id="enviar7_1" class="w3-btn btn_gris" onclick="document.getElementById('respuesta7_0').style.display='block'"> Información</button>
    <button type="button" id="enviar7_0" class="w3-btn btn_gris" onclick="document.getElementById('respuesta7_0').style.display='block'"> Acceso</button>
    
    <form id="mandar_user" method="POST">
        <input type="hidden" name="usuario" value="<?php echo $usuario ?>"/>
    </form>

    
    <script>
        $('#enviar7_0').click(function(){
            $.ajax({
                url:'../php/consulta7_0.php',
                success: function(res){

                    $('#respuesta7_0').html(res);
                },
                error: function(res){
                    alert("Problemas al tratar de enviar el formulario");
                }
            });
        });
        $('#enviar7_1').click(function(){
            $.ajax({
                url:'../php/consulta7_1.php',
                type:'POST',
                data: $('#mandar_user').serialize(),
                success: function(res){
                    $('#respuesta7_0').html(res);
                },
                error: function(res){
                    alert("Problemas al tratar de enviar el formulario");
                }
            });
        });
    </script>


<?php
}

////////////////////////////////////////////////////////////////////////////////////////////////
function menu_producto($usuario){
    ?>
    
    <button type="button" id="enviar8" class="w3-red" style="display:none;">Guardar</button>

    <div id="respuesta8"></div>
    

    <script>
        $('#enviar8').click(function(){
            $.ajax({
                url:'../php/consulta8.php',
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
    <div id="respuesta9_1" style="display:none; backgroung-color:white;"></div>

    <br>
    <button type="button" id="enviar9_1" class="w3-btn btn_gris" onclick="document.getElementById('respuesta9_1').style.display='block'"> Información Laboral</button>
    <button type="button" id="enviar9_2" class="w3-btn btn_gris" onclick="document.getElementById('respuesta9_1').style.display='block'"> Información Personal</button>
    <button type="button" id="enviar9_3" class="w3-btn btn_gris" onclick="document.getElementById('respuesta9_1').style.display='block'"> Datos</button>
    <script>
        $('#enviar9_1').click(function(){
            $.ajax({
                url:'../php/consulta9_1.php',
                success: function(res){
                    $('#respuesta9_1').html(res);
                    console.log("Sale");
                },
                error: function(res){
                    alert("Problemas al tratar de enviar el formulario");
                }
            });
        });
        $('#enviar9_2').click(function(){
            $.ajax({
                url:'../php/consulta9_2.php',
                success: function(res){
                    $('#respuesta9_1').html(res);
                },
                error: function(res){
                    alert("Problemas al tratar de enviar el formulario");
                }
            });
        });
        $('#enviar9_3').click(function(){
            $.ajax({
                url:'../php/consulta9_3.php',
                success: function(res){
                    $('#respuesta9_1').html(res);
                },
                error: function(res){
                    alert("Problemas al tratar de enviar el formulario");
                }
            });
        });
    </script>

<?php
}

/////////////////////////////////////////////////////////////////////////////////////////
function ver_presupuestos($usuario){
    date_default_timezone_set('America/Bogota');
    $fecha        = date('m', time());
    $anio         = date('Y', time());
    ?>
    <form id="menu_presupuestos" method="POST" class="form-inline" onkeydown="return event.key != 'Enter';">
    <input type="hidden" name="user" value="<?php echo $usuario ?>">
    <table class="tabla_sugerido">
        <tr>
            <th colspan="6">Selección</th>
        </tr>
        <tr>
            <td>Mes</td>
            <td>
                <select name="mes" id="mes">

                    <option value="1" <?php if($fecha=='01'){?>selected <?php } ?> >Enero</option>
                    <option value="2" <?php if($fecha=='02'){?>selected <?php } ?> >Febrero</option>
                    <option value="3" <?php if($fecha=='03'){?>selected <?php } ?> >Marzo</option>
                    <option value="4" <?php if($fecha=='04'){?>selected <?php } ?> >Abril</option>
                    <option value="5" <?php if($fecha=='05'){?>selected <?php } ?> >Mayo</option>
                    <option value="6" <?php if($fecha=='06'){?>selected <?php } ?> >Junio</option>
                    <option value="7" <?php if($fecha=='07'){?>selected <?php } ?> >Julio</option>
                    <option value="8" <?php if($fecha=='08'){?>selected <?php } ?> >Agosto</option>
                    <option value="9" <?php if($fecha=='09'){?>selected <?php } ?> >Septiembre</option>
                    <option value="10" <?php if($fecha=='10'){?>selected <?php } ?> >Octubre</option>
                    <option value="11" <?php if($fecha=='11'){?>selected <?php } ?> >Noviembre</option>
                    <option value="12" <?php if($fecha=='12'){?>selected <?php } ?> >Diciembre</option>
                </select>
            </td>
            <td>Año</td>
            <td><input type="text" name="year" value="<?php echo $anio ?>"></td>
            <td></td>
            <td><button type="button" id="enviar11" class="w3-btn" style="background-color: #478248;color:white;">Continuar <i class='fas fa-edit' style='font-size:24px;color:white'></button></td>
        </tr>
    </table>
    </form>
    <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('cont2_4').style.display='none'">X</a>
    <br>
    </div>
    <div id="respuesta11">
    <script>
        $('#enviar11').click(function(){
            $.ajax({
                url:'../php/consulta11.php',
                type:'POST',
                data: $('#menu_presupuestos').serialize(),
                success: function(res){
                    $('#respuesta11').html(res);
                    document.getElementById('form_presupuestos').style.display='block';
                },
                error: function(res){
                    alert("Problemas al tratar de enviar el formulario");
                }
            });
        });
    </script>
<?php
}
/////////////////////////////////////////////////////////////////////////////////////////
function menu_vehiculos($usuario){
    ?>
    <div id="respuesta10_1" style="display:none; backgroung-color:white;"></div>

    <button type="button" id="enviar10_1" class="w3-btn btn_gris"> Vehículos</button>
    <button type="button" id="enviar10_2" class="w3-btn btn_gris"> Generar reporte</button>

    <script>
        $('#enviar10_1').click(function(){
            document.getElementById('respuesta10_1').style.display='block';
            $.ajax({
                url:'../php/consulta10_1.php',
                success: function(res){
                    $('#respuesta10_1').html(res);
                },
                error: function(res){
                    alert("Problemas al tratar de enviar el formulario");
                }
            });
        });
        $('#enviar10_2').click(function(){
            document.getElementById('respuesta10_1').style.display='block';
            $.ajax({
                url:'../php/consulta10_2.php',
                success: function(res){
                    $('#respuesta10_1').html(res);
                },
                error: function(res){
                    alert("Problemas al tratar de enviar el formulario");
                }
            });
        });

    </script>

<?php
}

/////////////////////////////////////////////////////////////////////////////////////////
function resultados_operativos($usuario){
    $anio = date('Y', time());
    ?>
    <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('cont2_6').style.display='none'">X</a>
        <form id="menu_roo" onkeydown="return event.key != 'Enter';">
            <table class="tabla_sugerido">
                <tr>
                    <th colspan="6">Selección</th>
                </tr>
                <tr>
                    <td>Año</td>
                    <td><input type="number" name="year" value="<?php echo $anio ?>" onchange="$('#enviar12').trigger('click');"></td>
                    <td></td>
                    <td style="display:none"><button type="button" id="enviar12" class="w3-btn" style="background-color: #478248;color:white;">Continuar <i class='fas fa-edit' style='font-size:24px;color:white'></button></td>
                </tr>
            </table>
        </form>
    
    <div id="respuesta12">
    <script>
        $('#enviar12').click(function(){
            $.ajax({
                url:'../php/consulta12.php',
                type:'POST',
                data: $('#menu_roo').serialize(),
                success: function(res){
                    $('#respuesta12').html(res);
                    //$('#enviar12_1').trigger('click');
                    
                },
                error: function(res){
                    alert("Problemas al tratar de enviar el formulario");
                }
            });
        });
    </script>
<?php
}

/////////////////////////////////////////////////////////////////////////////////////////
function caja1($usuario){
    ?>
    <button type="button" id="enviarv1" class="w3-btn w3-red" onclick="document.getElementById('respuestav1').style.display='block'" style="display:none;"></button>

    <form id="usuario_caja1">
        <input type="hidden" name="usuario" value="<?php echo $usuario ?>"/>
    </form>

    <div id="respuestav1" style="display:none; backgroung-color:white;overflow-y: scroll">
    </div>

    <script>
        $('#enviarv1').click(function(){
            $.ajax({
                url:'../php/consultav1.php',
                type:'POST',
                data: $('#usuario_caja1').serialize(),
                success: function(res){
                    $('#respuestav1').html(res);
                },
                error: function(res){
                    alert("Problemas al tratar de enviar el formulario");
                }
            });
        });
    </script>
<?php
}

/////////////////////////////////////////////////////////////////////////////////////////
function ver_control(){
    ?>
    <button type="button" id="enviar13_1" class="w3-btn w3-red" onclick="document.getElementById('respuesta13_1').style.display='block'" style="display:none">xd</button>

    <div id="respuesta13_1" class="ventana"></div>
    
    <script>
        $('#enviar13_1').click(function(){
            $.ajax({
                url:'../php/consulta13_1.php',
                success: function(res){
                    $('#respuesta13_1').html(res);
                },
                error: function(res){
                    alert("Problemas al tratar de enviar el formulario");
                }
            });
        });

    </script>
    <?php
}

/////////////////////////////////////////////////////////////////////////////////////////
function registrar_control($usuario){
    ?>
    <button type="button" id="enviar13_2" class="w3-btn w3-red" onclick="document.getElementById('respuesta13_2').style.display='block'" style="display:none">xd</button>

    <form id="mandar_usuario_control13_2" method="post">
        <input type="hidden" name="usuario" value="<?php echo $usuario ?>"/>
    </form>


    <div id="respuesta13_2" class="ventana"></div>
    
    <script>
        $('#enviar13_2').click(function(){
            $.ajax({
                url:'../php/consulta13_2.php',
                type:'POST',
                data: $('#mandar_usuario_control13_2').serialize(),
                success: function(res){
                    $('#respuesta13_2').html(res);
                },
                error: function(res){
                    alert("Problemas al tratar de enviar el formulario");
                }
            });
        });

    </script>
    <?php
}

/////////////////////////////////////////////////////////////////////////////////////////
function ver_requerimientos($usuario){
    ?>
    <button type="button" id="enviar14_1" class="w3-btn w3-red" onclick="document.getElementById('respuesta13_2').style.display='block'" style="display:none"></button>

    <form id="ver_requerimiento" method="post">
        <input type="hidden" name="usuario" value="<?php echo $usuario ?>"/>
    </form>


    <div id="respuesta14_1"></div>
    
    <script>
        $('#enviar14_1').click(function(){
            $.ajax({
                url:'../php/consulta14.php',
                type:'POST',
                data: $('#ver_requerimiento').serialize(),
                success: function(res){
                    $('#respuesta14_1').html(res);
                },
                error: function(res){
                    alert("Problemas al tratar de enviar el formulario");
                }
            });
        });

    </script>
    <?php
}
/////////////////////////////////////////////////////////////////////////////////////////
function registro_diario_ventas($usuario){

    date_default_timezone_set('America/Bogota');
    $fecha        = date('m', time());
    $anio         = date('Y', time());

    ?>
    <button type="button" id="enviar15" class="w3-btn w3-red" onclick="document.getElementById('respuesta15').style.display='block'" style="display:none"></button>

    <form id="registro_diario_ventas" method="post">
        <input type="hidden" name="user" value="<?php echo $usuario ?>">
    <table class="tabla_sugerido">
        <tr>
            <th colspan="6">Selección</th>
        </tr>
        <tr>
            <td>Mes</td>
            <td>
                <select name="mes" onchange="$('#enviar15_1').trigger('click');">

                    <option value="1" <?php if($fecha=='01'){?>selected <?php } ?> >Enero</option>
                    <option value="2" <?php if($fecha=='02'){?>selected <?php } ?> >Febrero</option>
                    <option value="3" <?php if($fecha=='03'){?>selected <?php } ?> >Marzo</option>
                    <option value="4" <?php if($fecha=='04'){?>selected <?php } ?> >Abril</option>
                    <option value="5" <?php if($fecha=='05'){?>selected <?php } ?> >Mayo</option>
                    <option value="6" <?php if($fecha=='06'){?>selected <?php } ?> >Junio</option>
                    <option value="7" <?php if($fecha=='07'){?>selected <?php } ?> >Julio</option>
                    <option value="8" <?php if($fecha=='08'){?>selected <?php } ?> >Agosto</option>
                    <option value="9" <?php if($fecha=='09'){?>selected <?php } ?> >Septiembre</option>
                    <option value="10" <?php if($fecha=='10'){?>selected <?php } ?> >Octubre</option>
                    <option value="11" <?php if($fecha=='11'){?>selected <?php } ?> >Noviembre</option>
                    <option value="12" <?php if($fecha=='12'){?>selected <?php } ?> >Diciembre</option>
                </select>
            </td>
            <td>Año</td>
            <td>
            <select name="anio" onchange="$('#enviar15_1').trigger('click');">
                    <?php
                    for ($i=2020; $i <= $anio; $i++){
                        ?>
                        <option value="<?php echo $i ?>" <?php if($i==$anio){?>selected <?php } ?> ><?php echo $i ?></option>
                        <?php
                    }

                ?>
            </select>    
            </td>
            <td></td>
            <td><button type="button" id="enviar15_1" class="w3-btn" style="background-color: #478248;color:white;visibility:hidden">Continuar <i class='fas fa-edit' style='font-size:24px;color:white'></button></td>
        </tr>
    </table>
    </form>
    <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('cont2_9').style.display='none'">X</a>


    <div id="respuesta15"></div>
    
    <script>
        $('#enviar15_1').click(function(){
            $.ajax({
                url:'../php/consulta15.php',
                type:'POST',
                data: $('#registro_diario_ventas').serialize(),
                success: function(res){
                    $('#respuesta15').html(res);
                    
                },
                error: function(res){
                    alert("Problemas al tratar de enviar el formulario");
                }
            });
        });
        //$('#enviar15_1').trigger('click');
    </script>
    <?php
}
?>
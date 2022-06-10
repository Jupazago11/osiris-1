<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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
        <div>
        <form id="form_seleccionar_prove" method="POST">
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
                $consulta = mysqli_query($conexion, "SELECT `nombre_proveedor` FROM `proveedor` ORDER BY `nombre_proveedor` ASC") or die ("Error al consultar: proveedores");

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
?>
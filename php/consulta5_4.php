<script type="text/javascript" src="../js/funciones.js"></script>
<?php
    require("../php/conexion.php");
    $conexion = conectar();

    date_default_timezone_set('America/Bogota');
    $fecha = date('Y-m-d', time());
    $hoy = date("H:i:s");

    // Desactivar toda notificación de error
    error_reporting(0);

    //date('h:i'); //Fecha justo ahora
    $llegadass        = $_POST['llegadass'];

    

    
    foreach ($llegadass as $value) {
        if(count($llegadass) > 0){
            $consulta = mysqli_query($conexion, "SELECT `estado` FROM `domicilio` WHERE `id_domi` = '$value'") or die ("Error al consultar: domicilios");
            

            while (($fila = mysqli_fetch_array($consulta))!=NULL){
                $estado = $fila['estado'];
                mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
                if($estado == "proceso"){

                    $consulta = mysqli_query($conexion, "UPDATE `domicilio` SET `tiempo_llegada`='$hoy', `estado`='inactivo' WHERE `estado` = 'proceso' AND `id_domi` = '$value'
                    ORDER BY `id_domi` ASC") or die ("Error al consultar: domicilios");
                }elseif($fila['estado'] == "activo"){
                    
                    ?>
                    <br>
                    <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Primero debes iniciar el domicilio',
                    })
            </script>
                    <?php
                }
                break;
            }
        }
    }
    // Notificar todos los errores de PHP
    error_reporting(-1);

?>
<script type="text/javascript" src="../js/funciones.js"></script>
<?php
    
    $conexion = conectar();

    date_default_timezone_set('America/Bogota');
    $fecha = date('Y-m-d', time());

    $usuario         = strval($_POST['usuario']);//obtenemos el nombre del proveedor seleccionado
    $vehiculo        = $_POST['vehiculo'];
    $cliente         = strval($_POST['cliente']);
    $ubicacion       = strval($_POST['ubicacion']);
    $destino         = strval($_POST['destino']);
    $categor         = strval($_POST['categorias']);
    $observa         = strval($_POST['observacion']);
    $kilometraje     = strval($_POST['kilometraje']);



if($kilometraje > 0){
    //Registraremos su kilometraje
    //id del vehiculo

    $consulta = mysqli_query($conexion, "SELECT `id_vehiculo` FROM `vehiculo` WHERE `placa` = '$vehiculo'") or die ("Error al consultar: vehiculo");

    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $id_vehiculo = $fila['id_vehiculo'];
    }
    mysqli_free_result($consulta);


    //Ahora consultaremos si el vehiculo ya tiene registrado el valore del kilometraje para ese día
    $consulta = mysqli_query($conexion, "SELECT `fecha`,`kilometra` FROM `kilometraje`
    INNER JOIN vehiculo ON vehiculo.id_vehiculo = kilometraje.id_vehiculo3
    WHERE vehiculo.placa = '$vehiculo' AND `fecha`='$fecha'") or die ("Error al consultar: cliente");

    $encontrado = false;

    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $encontrado = true;
    }
    mysqli_free_result($consulta);

    if($encontrado == false){
        $consulta = mysqli_query($conexion, "INSERT INTO `kilometraje`(`fecha`, `id_vehiculo3`, `kilometra`) 
        VALUES ('$fecha','$id_vehiculo','$kilometraje')") or die ("Error al consultar: kilometraje");
    }


    



    /// Creación de domicilio

    $banderas = array(false, false, false);
    
    //id del usuario
    $consulta = mysqli_query($conexion, "SELECT * FROM `personal` WHERE `user_pers`='$usuario'") or die ("Error al consultar: personal");

    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $id_pers = $fila['id_pers'];
        $banderas[0] = true;
    }
    mysqli_free_result($consulta);


    //id del cliente
    $consulta = mysqli_query($conexion, "SELECT * FROM `cliente` WHERE `nombre_cliente` = '$cliente'") or die ("Error al consultar: cliente");


    while(($fila = mysqli_fetch_array($consulta)) != NULL){
        if($cliente == $fila['nombre_cliente']){
            $id_cliente = $fila['id_cliente'];
            $banderas[1] = true;
        }
        
    }
    

    if($banderas[1] == false){
        $consulta = mysqli_query($conexion, "INSERT INTO `cliente`(`nombre_cliente`, `estado`) VALUES ('$cliente','activo')") or die ("Error al consultar: no se obtuvo la el la informacion de los productos");

        $consulta = mysqli_query($conexion, "SELECT * FROM `cliente` WHERE `nombre_cliente` = '$cliente'") or die ("Error al consultar: cliente");

        while (($fila = mysqli_fetch_array($consulta)) != NULL){
            if($cliente == $fila['nombre_cliente']){
                $id_cliente = $fila['id_cliente'];
                $banderas[1] = true;
            } 
        }
    }
   
    mysqli_free_result($consulta);
    

    //id del vehiculo
    $consulta = mysqli_query($conexion, "SELECT * FROM `vehiculo` WHERE `placa` = '$vehiculo'") or die ("Error al consultar: proveedores");

    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $id_vehiculo = $fila['id_vehiculo'];
        $banderas[2] = true;
    }
    mysqli_free_result($consulta);

    if(($banderas[0] == true && $banderas[1] == true && $banderas[2] == true) && strlen($ubicacion) > 3 && strlen($destino) > 3){
        //Creamos el domicilio

        $consulta = mysqli_query($conexion, "INSERT INTO `domicilio`(`id_pers3`, `id_cliente2`, `id_vehiculo2`, `fecha`, `observacion`, `nivel_urgencia`, `ubicacion`, `destino`, `estado`) VALUES ('$id_pers','$id_cliente','$id_vehiculo','$fecha','$observa','$categor','$ubicacion','$destino','activo')") or die ("Error al consultar: no se obtuvo la el la informacion de los productos");
        ?>
        <script>
            document.getElementById('respuesta_domicilio').style.display='none';
            document.getElementById('xcont_4_1').style.display='block';
            Swal.fire(
                '¡Muy bien!',
                'Domicilio guardado exitosamente',
                'success'
                );
        </script>
        <?php


        //mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
    }else{
        //No cumple con las condiciones
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Agrega una Ubicación y un destino válido',
            })
        </script>
        <?php
        if($banderas[1] != true){
            ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Agrega el nombre del cliente registrado en la base de datos',
                })
            </script>
            <?php
        }
    }
}else{
    ?>
    <script>
        
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Debes agregar el kilometraje de la moto para el día de hoy',
        })
    </script>
    <?php
}
    
?>
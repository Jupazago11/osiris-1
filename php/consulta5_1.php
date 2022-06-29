<script type="text/javascript" src="../js/funciones.js"></script>
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
    $cliente         = strval($_POST['cliente']);
    $ubicacion       = strval($_POST['ubicacion']);
    $destino         = strval($_POST['destino']);
    $categor         = strval($_POST['categoria']);
    $observa         = strval($_POST['observacion']);


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
        <br>
        <div class="alert success">
            <span class="closebtn">&times;</span>  
            <strong>Muy bien!</strong> El domicilio ha sido agregado exitosamente
        </div>
        <?php


        //mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
    }else{
        //No cumple con las condiciones
        ?>
        <br>
        <div class="alert warning">
            <span class="closebtn">&times;</span>  
            <strong>Información!</strong> No se Completó correctamente los datos
        </div>
        <?php
        if($banderas[1] != true){
            ?>
            <div class="alert info">
                <span class="closebtn">&times;</span>  
                <strong>Sugerencia: </strong> Agrega el nombre del cliente registrado en la base de datos
            </div>
            <?php
        }
    }
    
?>
<script type="text/javascript" src="../js/funciones.js"></script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion

    
    $id_pers                    = $_POST['id_pers'];
    $nombre_pers                = $_POST['nombre_pers'];
    $cargo                      = $_POST['cargo'];
    $tipo_contrato_pers         = $_POST['tipo_contrato_pers'];
    $fecha_inicio_contrato_pers = $_POST['fecha_inicio_contrato_pers'];
    $salario_pers               = str_replace(".","",$_POST['salario_pers']);
    $eliminar                   = $_POST['eliminar'];


    $id_cargos = array();
    $cargos = array();

    $consulta = mysqli_query($conexion, "SELECT * FROM `cargo` 
    WHERE `estado` != ''") or die ("Error al update: proveedores");

    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        array_push($id_cargos, $fila['id_cargo']);
        array_push($cargos, $fila['cargo']);
    }

    
    for ($i = 0; $i < count($id_pers); $i++) { 

        $j = $i + 1; //ya que el arreglo de los estados en html del formulario anterior empieza en 1 y no en 0



        if (in_array($cargo[$i], $cargos)) {

            for ($k = 0; $k < count($id_cargos); $k++) { 
                if($cargos[$k] == $cargo[$i]){
                    $valor = $k;
                    break;
                }
            }

            $consulta = mysqli_query($conexion, "UPDATE `personal` 
            SET `nombre_pers`='$nombre_pers[$i]', `fecha_inicio_contrato_pers`='$fecha_inicio_contrato_pers[$i]', `tipo_contrato_pers`='$tipo_contrato_pers[$i]', `cargo`='$id_cargos[$k]', `salario_pers`='$salario_pers[$i]'
            WHERE `id_pers` = '$id_pers[$i]'") or die ("Error al update: proveedores");
        
            if($eliminar[$j] == 'eliminar'){
                $consulta = mysqli_query($conexion, "UPDATE `personal` SET 
                `estado` = '' 
                WHERE `id_pers` = '$id_pers[$i]'") or die ("Error al update: proveedores");
            }
        } 
        
    }

    
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>
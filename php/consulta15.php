<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();

  //resultados operativos///////////////////////

    $mes  = $_POST['mes'];
    $year = $_POST['anio'];
    $user = $_POST['user'];
    $existe = false;

    $id_pre_detalle_cat = array();
    $cate_pre = array();
    
    //  id del usuario
    $consulta = mysqli_query($conexion, "SELECT `id_pers` 
    FROM `personal` 
    WHERE `user_pers` = '$user'") or die ("Error al update: presupuesto");

    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $id_user = $fila['id_pers'];
    }
    mysqli_free_result($consulta);

?>
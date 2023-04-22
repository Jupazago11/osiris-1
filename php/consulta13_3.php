<?php
require("../php/conexion.php");
$conexion = conectar();                     //Obtenemos la conexion

date_default_timezone_set('America/Bogota');
//$fecha   = date('Y-m-d', time());
$hoy     = date("H:i:s", time());

$valor      = $_POST['valor'];
$id_control = $_POST['id_control'];


$nombres = array('llegada','ir_desayuno','regre_desayuno','ir_almuerzo','regre_almuerzo','salida');

//  obtenemos el id del empleado
$consulta = mysqli_query($conexion, "UPDATE `control` 
SET `$nombres[$valor]` = '$hoy' 
WHERE `id_control` = '$id_control'") or die ("Error al consultar: proveedores");




?>
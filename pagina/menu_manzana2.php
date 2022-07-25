<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Principal</title>
    <LINK REL=StyleSheet HREF="../css/estilos.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="header">
  <h1 class="w3-animate-top" style="font-size:0.8em;">Bienvenido</h1>
</div>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../php/funciones.php");
    //Desactivar Desactivar toda notificación de error
    //error_reporting(0);
    $usuario     =      $_POST['u'];
    $clave       =      $_POST['p'];

    $name_proveedor = iniciar_sesion2($usuario, $clave);
    // Notificar todos los errores de PHP
    error_reporting(-1);
?>
</div>
<div class="menu w3-animate-zoom">
    <a class='columna w3-red' onclick="ocultarDivs('cont1')"><img src="../iconos/pedidos.png" alt="" width="40%" height="40%"><br>Pedidos</a>
</div>
<div class="osiris"><div class="contenido">OSIRIS</div></div>

<?php //Desplegaremos los elementos para la sección de Pedidos ?>
    <div id="cont1" style="display:none;">
        <div class="w3-container" id="pedidos"  style="display:none;">
        <div class="osiris"><div class="contenido">Pedidos</div></div>
            <div class="menu" style="margin-top: 3%;">
            
            <a class="columna w3-blue" onclick="ocultarDivs1('cont1_2');$('#enviar2').trigger('click')"><img src="../iconos/existencias.png" alt="existencias" width="40%" height="40%"><br> Preventa</a>
            <a class="columna w3-green" onclick="ocultarDivs1('cont1_3');$('#enviar3').trigger('click')"><img src="../iconos/existencias.png" alt="existencias" width="40%" height="40%"><br> Autoventa</a>
            
            <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="ocultarDivs0()">X</a>
            
            </div>
            <div id="cont1_2" style="display:none;">
                <div class="w3-container">
                    <?php   crear_pedido($name_proveedor);     ?>
                    <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('cont1_2').style.display='none'">X</a>
                </div>
            </div>
            <div id="cont1_3" style="display:none;">
                <div class="w3-container">
                    <?php   crear_pedido2($name_proveedor);    ?>
                    <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('cont1_3').style.display='none'">X</a>
                </div>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript" src="../js/funciones.js"></script>
<script>
function ocultarDivs(no_oculta){
    document.getElementById("cont1").style.display='none';

    switch(no_oculta) {
        //Pedidos
        case "cont1":
            document.getElementById("cont1").style.display='block';
            document.getElementById("pedidos").style.display='block';
            //document.getElementById("cont1_1").style.display='none';
            document.getElementById("cont1_2").style.display='none';
            document.getElementById("cont1_3").style.display='none';
            //document.getElementById("cont1_4").style.display='none';
            //document.getElementById("cont1_5").style.display='none';
            break;
        default:
          // code block
            break;
    }
}
function ocultarDivs0(){
    document.getElementById("pedidos").style.display='none';
    document.getElementById("empresa").style.display='none';
    document.getElementById("control_domiciliario").style.display='none';

}
function ocultarDivs1(no_oculta){
    //document.getElementById("cont1_1").style.display='none';
    document.getElementById("cont1_2").style.display='none';
    document.getElementById("cont1_3").style.display='none';
    //document.getElementById("cont1_4").style.display='none';
    //document.getElementById("cont1_5").style.display='none';
    switch(no_oculta) {
        //Pedidos
        /*case "cont1_1":
            document.getElementById("cont1_1").style.display='block';
            break;*/
        case "cont1_2":
            document.getElementById("cont1_2").style.display='block';
            break;
        case "cont1_3":
            document.getElementById("cont1_3").style.display='block';
            break;
        /*case "cont1_4":
            document.getElementById("cont1_4").style.display='block';
            break;
        case "cont1_5":
            document.getElementById("cont1_5").style.display='block';
            break;*/
        default:
          // code block
            break;
    }
}
</script>
</html>
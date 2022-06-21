<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Principal</title>
    <script type="text/javascript" src="../js/funciones.js"></script>
    <LINK REL=StyleSheet HREF="../css/estilos.css">
</head>
<body>
<div class="header">
  <h2 class="w3-animate-top">Bienvenido</h2>
</div>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../php/funciones.php");
    //Desactivar Desactivar toda notificación de error
    //error_reporting(0);
    $usuario     =      $_POST['u'];
    $clave       =      $_POST['p'];

    $tipo_de_cuenta = iniciar_sesion($usuario, $clave);

    echo " - Nivel de centa ".$tipo_de_cuenta;
    // Notificar todos los errores de PHP
    error_reporting(-1);
    
    //funciones
    //crear_sugerido($usuario);
    //crear_pedido($usuario);
    //crear_pedido2($usuario);
?>
<div class="menu w3-animate-zoom">
    <a class="columna w3-bar-item w3-button w3-hover-green" onclick="ocultarDivs('cont1')">Pedidos</a>
    <a class="columna w3-bar-item w3-button w3-hover-teal" onclick="ocultarDivs('cont2')">Administrativo</a>
    <a class="columna w3-bar-item w3-button w3-hover-blue" onclick="ocultarDivs('cont3')">Control de Domicilios</a>
    <a class="columna w3-bar-item w3-button w3-hover-red" onclick="ocultarDivs('cont4')">Column</a>
</div>

<?php //Desplegaremos los elementos para la sección de Pedidos ?>
    <div id="cont1" style="display:none;">
        <div class="w3-container" id="pedidos"  style="display:none;">
            <a class="w3-bar-item w3-button w3-hover-red" onclick="ocultarDivs0()">_</a>
            <div class="menu"  style="background:rgb(196, 196, 196)">
                <a class="columna w3-bar-item w3-button w3-hover-green" onclick="ocultarDivs1('cont1_1')">Crea Sugerido</a>
                <a class="columna w3-bar-item w3-button w3-hover-teal" onclick="ocultarDivs1('cont1_2')">Crear Pedido</a>
                <a class="columna w3-bar-item w3-button w3-hover-blue" onclick="ocultarDivs1('cont1_3')">Confirmar Pedido</a>
                <a class="columna w3-bar-item w3-button w3-hover-red" onclick="ocultarDivs1('cont1_4')">Ver próximos pedidos</a>
            </div>

            <div id="cont1_1" style="display:none;">
                <div class="w3-container">
                    <?php   crear_sugerido($usuario);   ?>
                </div>
            </div>
            <div id="cont1_2" style="display:none;">
                <div class="w3-container">
                    <?php   crear_pedido($usuario);     ?>
                </div>
            </div>
            <div id="cont1_3" style="display:none;">
                <div class="w3-container">
                    <?php   crear_pedido2($usuario);    ?>
                </div>
            </div>
            <div id="cont1_4" style="display:none;">
                <div class="w3-container">
                    <?php   ver_pedidos($usuario);      ?>
                </div>
            </div>
        </div>
    </div>
    <div id="cont2" style="display:none;">
        <div class="w3-container" id="administrativo"  style="display:none;">
            <a class="w3-bar-item w3-button w3-hover-red" onclick="ocultarDivs0()">_</a>
            <div class="menu">
                <a class="columna w3-bar-item w3-button w3-hover-green" onclick="ocultarDivs2('cont2_1')">Crea Proveedor</a>
                <a class="columna w3-bar-item w3-button w3-hover-teal" onclick="ocultarDivs2('cont2_2')">Actualizar Proveedor</a>
                <a class="columna w3-bar-item w3-button w3-hover-blue" onclick="ocultarDivs2('cont2_3')">Crear Nueva Cuenta</a>
                <a class="columna w3-bar-item w3-button w3-hover-red" onclick="ocultarDivs2('cont2_4')">Modificar datos de Cuentas</a>
            </div>

            <div id="cont2_1" style="display:none;">
                <div class="w3-container">
                    <?php   //crear_sugerido($usuario);   ?>
                </div>
            </div>
            <div id="cont2_2" style="display:none;">
                <div class="w3-container">
                    <?php   //crear_pedido($usuario);     ?>
                </div>
            </div>
            <div id="cont2_3" style="display:none;">
                <div class="w3-container">
                    <?php   //crear_pedido2($usuario);    ?>
                </div>
            </div>
            <div id="cont2_4" style="display:none;">
                <div class="w3-container">
                    <?php   //ver_pedidos($usuario);      ?>
                </div>
            </div>
        </div>
    </div>
    
    <div id="cont3" style="display:none;">
        <div class="w3-container" id="control_domiciliario"  style="display:none;">
            <a class="w3-bar-item w3-button w3-hover-red" onclick="ocultarDivs0()">_</a>
            <div class="menu">
                <?php control_domiciliario($usuario, $tipo_de_cuenta); ?>
            </div>
        </div>
    </div>
    <div id="cont4" style="display:none;">
        <div class="w3-container" id="ventas"  style="display:none;">
            <a class="w3-bar-item w3-button w3-hover-red" onclick="ocultarDivs0()">_</a>
            <div class="menu">
                <a class="columna w3-bar-item w3-button w3-hover-green" onclick="ocultarDivs4('cont4_1')">Crea Proveedor</a>
                <a class="columna w3-bar-item w3-button w3-hover-teal" onclick="ocultarDivs4('cont4_2')">Crear Pedido</a>
                <a class="columna w3-bar-item w3-button w3-hover-blue" onclick="ocultarDivs4('cont4_3')">Confirmar Pedido</a>
                <a class="columna w3-bar-item w3-button w3-hover-red" onclick="ocultarDivs4('cont4_4')">Ver próximos pedidos</a>
            </div>

            <div id="cont4_1" style="display:none;">
                <div class="w3-container">
                    <?php   //crear_sugerido($usuario);   ?>
                </div>
            </div>
            <div id="cont4_2" style="display:none;">
                <div class="w3-container">
                    <?php   //crear_pedido($usuario);     ?>
                </div>
            </div>
            <div id="cont4_3" style="display:none;">
                <div class="w3-container">
                    <?php   //crear_pedido2($usuario);    ?>
                </div>
            </div>
            <div id="cont4_4" style="display:none;">
                <div class="w3-container">
                    <?php   //ver_pedidos($usuario);      ?>
                </div>
            </div>
        </div>
    </div>
<div class="footer w3-container w3-padding-16 w3-light-grey">
    <p>Powered by <u>Jupazago</u></p>
</div>
</body>
<script>
 
function multi() {

    var valores = document.getElementsByClassName('cantidad');

    document.getElementById("total_sugeridos").innerHTML = valores.length;
}

//setInterval('multi()',500);

function ocultarDivs(no_oculta){
    document.getElementById("cont1").style.display='none';
    document.getElementById("cont2").style.display='none';
    document.getElementById("cont3").style.display='none';
    document.getElementById("cont4").style.display='none';

    switch(no_oculta) {
        //Pedidos
        case "cont1":
            document.getElementById("cont1").style.display='block';
            document.getElementById("pedidos").style.display='block';
            document.getElementById("cont1_1").style.display='none';
            document.getElementById("cont1_2").style.display='none';
            document.getElementById("cont1_3").style.display='none';
            document.getElementById("cont1_4").style.display='none';
            break;
        case "cont2":
            document.getElementById("cont2").style.display='block';
            document.getElementById("administrativo").style.display='block';
            document.getElementById("cont2_1").style.display='none';
            document.getElementById("cont2_2").style.display='none';
            document.getElementById("cont2_3").style.display='none';
            document.getElementById("cont2_4").style.display='none';
            break;
        case "cont3":
            document.getElementById("cont3").style.display='block';
            document.getElementById("control_domiciliario").style.display='block';
            document.getElementById("cont3_1").style.display='none';
            document.getElementById("cont3_2").style.display='none';
            document.getElementById("cont3_3").style.display='none';
            document.getElementById("cont3_4").style.display='none';
            break;
        case "cont4":
            document.getElementById("cont4").style.display='block';
            break;
        default:
          // code block
            break;
    }
}
function ocultarDivs0(){
    document.getElementById("pedidos").style.display='none';
    document.getElementById("administrativo").style.display='none';
    document.getElementById("control_domiciliario").style.display='none';

}
function ocultarDivs1(no_oculta){
    document.getElementById("cont1_1").style.display='none';
    document.getElementById("cont1_2").style.display='none';
    document.getElementById("cont1_3").style.display='none';
    document.getElementById("cont1_4").style.display='none';
    switch(no_oculta) {
        //Pedidos
        case "cont1_1":
            document.getElementById("cont1_1").style.display='block';
            break;
        case "cont1_2":
            document.getElementById("cont1_2").style.display='block';
            break;
        case "cont1_3":
            document.getElementById("cont1_3").style.display='block';
            break;
        case "cont1_4":
            document.getElementById("cont1_4").style.display='block';
            break;
        default:
          // code block
            break;
    }
}
function ocultarDivs2(no_oculta){
    document.getElementById("cont2_1").style.display='none';
    document.getElementById("cont2_2").style.display='none';
    document.getElementById("cont2_3").style.display='none';
    document.getElementById("cont2_4").style.display='none';
    switch(no_oculta) {
        //Pedidos
        case "cont2_1":
            document.getElementById("cont2_1").style.display='block';
            break;
        case "cont2_2":
            document.getElementById("cont2_2").style.display='block';
            break;
        case "cont2_3":
            document.getElementById("cont2_3").style.display='block';
            break;
        case "cont2_4":
            document.getElementById("cont2_4").style.display='block';
            break;
        default:
          // code block
            break;
    }
}
function ocultarDivs3(no_oculta){
    document.getElementById("cont3_1").style.display='none';
    document.getElementById("cont3_2").style.display='none';
    document.getElementById("cont3_3").style.display='none';
    document.getElementById("cont3_4").style.display='none';
    switch(no_oculta) {
        //Pedidos
        case "cont3_1":
            document.getElementById("cont3_1").style.display='block';
            break;
        case "cont3_2":
            document.getElementById("cont3_2").style.display='block';
            break;
        case "cont3_3":
            document.getElementById("cont3_3").style.display='block';
            break;
        case "cont3_4":
            document.getElementById("cont3_4").style.display='block';
            break;
        default:
          // code block
            break;
    }
}

</script>
</html>
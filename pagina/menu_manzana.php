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
    <?php
    if($tipo_de_cuenta == 1 || $tipo_de_cuenta == 2){
        ?>
        <a class='columna w3-bar-item w3-button w3-green' onclick="ocultarDivs('cont1')">Pedidos</a>
        <a class='columna w3-bar-item w3-button w3-teal' onclick="ocultarDivs('cont2')">Empresa</a>
        <a class='columna w3-bar-item w3-button w3-blue' onclick="ocultarDivs('cont3')">Control de Domicilios <br><i class='fas fa-tasks' style='font-size:48px;color:white'></i></a>
        <a class='columna w3-bar-item w3-button w3-red' onclick="ocultarDivs('cont4')">Ventas</a>
        <?php
    }elseif($tipo_de_cuenta == 3){
        ?>
        <a class='columna w3-bar-item w3-button w3-green' onclick="ocultarDivs('cont1')">Pedidos</a>
        <a class='columna w3-bar-item w3-button w3-blue' onclick="ocultarDivs('cont3')">Control de Domicilios</a>
        <a class='columna w3-bar-item w3-button w3-red' onclick="ocultarDivs('cont4')">Ventas</a>
        <?php
    }elseif($tipo_de_cuenta == 4){
        ?>
        <a class='columna w3-bar-item w3-button w3-blue' onclick="ocultarDivs('cont3')">Control de Domicilios <br><i class='fas fa-tasks' style='font-size:48px;color:white'></i></a>
        <?php
    }
    ?>
</div>

<?php //Desplegaremos los elementos para la sección de Pedidos ?>
    <div id="cont1" style="display:none;">
        <div class="w3-container" id="pedidos"  style="display:none;">
            <div class="menu">
            <ul>
                <?php
                if($tipo_de_cuenta == 1 || $tipo_de_cuenta == 2 || $tipo_de_cuenta == 3){
                    ?>
                    <li><a class="w3-bar-item w3-button" onclick="ocultarDivs1('cont1_1')"><i class='fas fa-marker' style='font-size:16px;color:#9fa2a7'></i> Crea Sugerido</a></li>
                    <li><a class="w3-bar-item w3-button" onclick="ocultarDivs1('cont1_4')"><i class='fas fa-tasks' style='font-size:16px;color:#9fa2a7'></i> Ver próximos pedidos</a></li>
                    <?php
                    if($tipo_de_cuenta == 1){
                        ?>
                        <li><a class="w3-bar-item w3-button" onclick="ocultarDivs1('cont1_5'); $('#enviar6_1').trigger('click')"><i class='fas fa-comment-dollar' style='font-size:16px;color:#9fa2a7'></i> Inscribir / Ver cuentas por pagar</a></li>
                        <?php
                    }
                }elseif($tipo_de_cuenta == 5){
                    ?>
                    <li><a class="w3-bar-item w3-button" onclick="ocultarDivs1('cont1_2')"><i class='fas fa-marker' style='font-size:16px;color:#9fa2a7'></i> Crear Pedido</a></li>
                    <?php
                }
                elseif($tipo_de_cuenta == 6){
                    ?>
                    <li><a class="w3-bar-item w3-button" onclick="ocultarDivs1('cont1_3')"><i class='fas fa-marker' style='font-size:16px;color:#9fa2a7'></i> Confirmar Pedido</a></li>
                    <?php
                }
                ?>
                <li style="float:right"><a class="w3-bar-item w3-button w3-hover-red active" onclick="ocultarDivs0()">X</a></li>
            </ul>
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
            <div id="cont1_5" style="display:none;">
                <div class="w3-container">
                    <?php   cuentas_por_pagar($usuario);?>
                </div>
            </div>
        </div>
    </div>
    <div id="cont2" style="display:none;">
        <div class="w3-container" id="empresa"  style="display:none;">
            
            <div class="menu">
            <ul>
                <li><a class="w3-bar-item w3-button" onclick="ocultarDivs2('cont2_1'); $('#enviar7_1').trigger('click')"><i class='far fa-address-card' style='font-size:16px;color:#9fa2a7'></i> Proveedor</a></li>
                <li><a class="w3-bar-item w3-button" onclick="ocultarDivs2('cont2_2')"><i class='fas fa-box-open' style='font-size:16px;color:#9fa2a7'></i> Producto</a></li>
                <li><a class="w3-bar-item w3-button" onclick="ocultarDivs2('cont2_3')"><i class='fas fa-user-cog' style='font-size:16px;color:#9fa2a7'></i> Personal</a></li>
                <li><a class="w3-bar-item w3-button" onclick="ocultarDivs2('cont2_4')"><i class='fa fa-dollar' style='font-size:16px;color:#9fa2a7'></i> Presupuestos</a></li>
                <li><a class="w3-bar-item w3-button" onclick="ocultarDivs2('cont2_5')"><i class='fas fa-car-side' style='font-size:16px;color:#9fa2a7'></i> Vehículos</a></li>
                <li><a class="w3-bar-item w3-button" onclick="ocultarDivs2('cont2_6')"><i class='fa fa-dollar' style='font-size:16px;color:#9fa2a7'></i> Resultados Operativos</a></li>
                <li style="float:right"><a class="w3-bar-item w3-button w3-hover-red active" onclick="ocultarDivs0()">X</a></li>
            </ul>
            </div>
            <div id="cont2_1" style="display:none;">
                <div class="w3-container">
                    <?php   menu_proveedor($usuario);   ?>
                </div>
            </div>
            <div id="cont2_2" style="display:none;">
                <div class="w3-container">
                    <?php   menu_producto($usuario);     ?>
                </div>
            </div>
            <div id="cont2_3" style="display:none;">
                <div class="w3-container">
                    <?php   menu_personal($usuario);    ?>
                </div>
            </div>
            <div id="cont2_4" style="display:none;">
                <div class="w3-container">
                    <?php   ver_presupuestos($usuario);    ?>
                </div>
            </div>
            <div id="cont2_5" style="display:none;">
                <div class="w3-container">
                    <?php   menu_vehiculos($usuario);      ?>
                </div>
            </div>
            <div id="cont2_6" style="display:none;">
                <div class="w3-container">
                    <?php   resultados_operativos($usuario);      ?>
                </div>
            </div>
        </div>
    </div>
    
    <div id="cont3" style="display:none;">
        <div class="w3-container" id="control_domiciliario"  style="display:none;">
            <div class="menu">
            <ul>
                <?php
                if($tipo_de_cuenta == 1 || $tipo_de_cuenta == 2 || $tipo_de_cuenta == 3 || $tipo_de_cuenta == 4){
                    ?>
                    <li><a class="w3-bar-item w3-button" onclick="ocultarDivs3('cont3_1')">Domicilio</a></li>
                    <?php
                }
                ?>

                <li style="float:right"><a class="w3-bar-item w3-button w3-hover-red active" onclick="ocultarDivs0(); var intervalo_time = setInterval(myTimer2, 60000); setInterval(myTimer2, 60000);clearInterval(intervalo_time);">X</a></li>
            </ul>
            </div>
            <div id="cont3_1" style="display:none;">
                <div class="w3-container">
                    <?php   control_domiciliario($usuario, $tipo_de_cuenta);   ?>
                </div>
            </div>
            <div id="cont3_2" style="display:none;">
                <div class="w3-container">
                    <?php   //crear_pedido($usuario);     ?>
                </div>
            </div>
            <div id="cont3_3" style="display:none;">
                <div class="w3-container">
                    <?php   //crear_pedido2($usuario);    ?>
                </div>
            </div>
            <div id="cont3_4" style="display:none;">
                <div class="w3-container">
                    <?php   //ver_pedidos($usuario);      ?>
                </div>
            </div>

        </div>
    </div>
    <div id="cont4" style="display:none;">
        <div class="w3-container" id="ventas"  style="display:none;">
            <a class="w3-bar-item w3-button w3-hover-red" onclick="ocultarDivs0()">_</a>
            <div class="menu">
                <a class="columna w3-bar-item w3-button w3-hover-green" onclick="ocultarDivs4('cont4_1')">txt</a>
                <a class="columna w3-bar-item w3-button w3-hover-teal" onclick="ocultarDivs4('cont4_2')">txt</a>
                <a class="columna w3-bar-item w3-button w3-hover-blue" onclick="ocultarDivs4('cont4_3')">txt</a>
                <a class="columna w3-bar-item w3-button w3-hover-red" onclick="ocultarDivs4('cont4_4')">txt</a>
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

<script type="text/javascript" src="../js/funciones.js"></script>
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
            document.getElementById("cont1_5").style.display='none';
            break;
        case "cont2":
            document.getElementById("cont2").style.display='block';
            document.getElementById("empresa").style.display='block';
            document.getElementById("cont2_1").style.display='none';
            document.getElementById("cont2_2").style.display='none';
            document.getElementById("cont2_3").style.display='none';
            document.getElementById("cont2_4").style.display='none';
            document.getElementById("cont2_5").style.display='none';
            document.getElementById("cont2_6").style.display='none';
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
    document.getElementById("empresa").style.display='none';
    document.getElementById("control_domiciliario").style.display='none';

}
function ocultarDivs1(no_oculta){
    document.getElementById("cont1_1").style.display='none';
    document.getElementById("cont1_2").style.display='none';
    document.getElementById("cont1_3").style.display='none';
    document.getElementById("cont1_4").style.display='none';
    document.getElementById("cont1_5").style.display='none';
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
        case "cont1_5":
            document.getElementById("cont1_5").style.display='block';
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
    document.getElementById("cont2_5").style.display='none';
    document.getElementById("cont2_6").style.display='none';
    switch(no_oculta) {
        //empresa
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
        case "cont2_5":
            document.getElementById("cont2_5").style.display='block';
            break;
        case "cont2_6":
            document.getElementById("cont2_6").style.display='block';
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
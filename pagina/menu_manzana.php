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

    $tipo_de_cuenta = iniciar_sesion($usuario, $clave);

    echo " - Nivel de centa ".$tipo_de_cuenta."</div>";
    // Notificar todos los errores de PHP
    error_reporting(-1);
?>
<div class="menu w3-animate-zoom">
    <?php
    if($tipo_de_cuenta == 1 || $tipo_de_cuenta == 2){
        ?>
        <a class='columna w3-yellow' onclick="ocultarDivs('cont4')"><img src="../iconos/ventas.png" alt="ventas" width="40%" height="40%"><br>Caja</a>
        <a class='columna w3-red' onclick="ocultarDivs('cont1')"><img src="../iconos/pedidos.png" alt="" width="40%" height="40%"><br>Pedidos</a>
        <a class='columna w3-blue' onclick="ocultarDivs('cont2')"><img src="../iconos/empresa.png" alt="empresa" width="40%" height="40%"><br>Empresa</a>
        <a class='columna w3-green' onclick="ocultarDivs('cont3')"><img src="../iconos/domicilios.png" alt="domicilios" width="40%" height="40%"><br>Domicilios</a>
        <a class='columna w3-teal'><img src="../iconos/control.png" alt="control" width="40%" height="40%"><br>Control</a>
        
        <?php
    }elseif($tipo_de_cuenta == 3){
        ?>
        <a class='columna w3-green' onclick="ocultarDivs('cont1')">Pedidos</a>
        <a class='columna w3-blue' onclick="ocultarDivs('cont3')"><img src="../iconos/domicilios.png" alt="domicilios" width="40%" height="40%"><br>Domicilios</a>
        <a class='columna w3-red' onclick="ocultarDivs('cont4')">Caja</a>
        <?php
    }elseif($tipo_de_cuenta == 4){
        ?>
        <a class='columna w3-blue' onclick="ocultarDivs('cont3')">Domicilios <br><img src="../iconos/domicilios.png" alt="domicilios" width="40%" height="40%"></a>
        <?php
    }
    ?>
</div>
<div class="osiris"><div class="contenido">OSIRIS</div></div>

<?php //Desplegaremos los elementos para la sección de Pedidos ?>
    <div id="cont1" style="display:none;">
        <div class="w3-container" id="pedidos"  style="display:none;">
        <div class="osiris"><div class="contenido">Pedidos</div></div>
            <div class="menu" style="margin-top: 3%;">
            
                <?php
                if($tipo_de_cuenta == 1 || $tipo_de_cuenta == 2 || $tipo_de_cuenta == 3){
                    ?>
                    <a class="columna w3-red" onclick="ocultarDivs1('cont1_1')"><img src="../iconos/existencias.png" alt="existencias" width="40%" height="40%"><br>Crea Sugerido</a>
                    <a class="columna w3-green" onclick="ocultarDivs1('cont1_4')"><img src="../iconos/proximo.png" alt="proximo" width="40%" height="40%"><br>Ver próximos pedidos</a>
                    <?php
                    if($tipo_de_cuenta == 1){
                        ?>
                        <a class="columna w3-blue" onclick="ocultarDivs1('cont1_5'); $('#enviar6_1').trigger('click')"><img src="../iconos/pago.png" alt="pago" width="40%" height="40%"><br>cuentas por pagar</a>
                        <?php
                    }
                }elseif($tipo_de_cuenta == 5){
                    ?>
                    <a class="columna w3-red" onclick="ocultarDivs1('cont1_2')"><img src="../iconos/existencias.png" alt="existencias" width="40%" height="40%"><br>Crear Pedido</a>
                    <?php
                }
                elseif($tipo_de_cuenta == 6){
                    ?>
                    <a class="columna w3-red" onclick="ocultarDivs1('cont1_3')"><img src="../iconos/existencias.png" alt="existencias" width="40%" height="40%"><br> Pedido</a>
                    <?php
                }
                ?>
                <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="ocultarDivs0()">X</a>
            
            </div>

            <div id="cont1_1" style="display:none;">
                <div class="w3-container">
                    <?php   crear_sugerido($usuario);   ?>
                    
                </div>
            </div>
            <div id="cont1_2" style="display:none;">
                <div class="w3-container">
                    <?php   crear_pedido($usuario);     ?>
                    <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('cont1_2').style.display='none'">X</a>
                </div>
            </div>
            <div id="cont1_3" style="display:none;">
                <div class="w3-container">
                    <?php   crear_pedido2($usuario);    ?>
                    <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('cont1_3').style.display='none'">X</a>
                </div>
            </div>
            <div id="cont1_4" style="display:none;">
                <div class="w3-container">
                    <?php   ver_pedidos($usuario);      ?>
                    <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('cont1_4').style.display='none'">X</a>
                </div>
            </div>
            <div id="cont1_5" style="display:none;">
                <div class="w3-container">
                    <?php   cuentas_por_pagar($usuario);?>
                    <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('cont1_5').style.display='none'">X</a>
                </div>
            </div>
        </div>
    </div>
    <div id="cont2" style="display:none;">
    
        <div class="w3-container" id="empresa"  style="display:none;">
        <div class="osiris"><div class="contenido">Empresa</div></div>
            <div class="menu" style="margin-top: 3%;">
            
            <a class="columna w3-red" onclick="ocultarDivs2('cont2_1');; $('#enviar7_1').trigger('click')"><img src="../iconos/proveedor.png" width="40%" height="40%"><br>Proveedor</a>
            <a class="columna w3-blue" onclick="ocultarDivs2('cont2_2')"><img src="../iconos/producto.png" width="40%" height="40%"><br>Producto</a>
            <a class="columna w3-green" onclick="ocultarDivs2('cont2_3'); $('#enviar9_1').trigger('click')"><img src="../iconos/personal.png" width="40%" height="40%"><br>Personal</a>
            <a class="columna w3-teal" onclick="ocultarDivs2('cont2_4')"><img src="../iconos/presupuesto.png" width="40%" height="40%"><br>Presupuestos</a>
            <a class="columna w3-blue" onclick="ocultarDivs2('cont2_5')"><img src="../iconos/vehiculos.png" width="40%" height="40%"><br>Vehículos</a>
            <a class="columna w3-green" onclick="ocultarDivs2('cont2_6')"><img src="../iconos/indicador.png" width="40%" height="40%"><br>Resultados Operativos</a>
            <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="ocultarDivs0()">X</a>

            </div>
            <div id="cont2_1" style="display:none;">
                <div class="w3-container">
                    <?php   menu_proveedor($usuario);   ?>

                    <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('cont2_1').style.display='none'">X</a>
                </div>
            </div>
            <div id="cont2_2" style="display:none;">
                <div class="w3-container">
                    <?php   menu_producto($usuario);     ?>
                    <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('cont2_2').style.display='none'">X</a>
                </div>
            </div>
            <div id="cont2_3" style="display:none;">
                <div class="w3-container">
                    <?php   menu_personal($usuario);    ?>
                    <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('cont2_3').style.display='none'">X</a>
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
                    <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('cont2_5').style.display='none'">X</a>
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
        <div class="osiris"><div class="contenido">Domicilios</div></div>

            <div class="menu">
                <?php
                if($tipo_de_cuenta == 1 || $tipo_de_cuenta == 2 || $tipo_de_cuenta == 3 || $tipo_de_cuenta == 4){
                    ?>
                    <a class="columna w3-blue" onclick="ocultarDivs3('cont3_1')"><img src="../iconos/entrega.png" width="40%" height="40%"><br>Domicilio</a>
                    <?php
                }
                ?>

                <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="ocultarDivs0(); var intervalo_time = setInterval(myTimer2, 60000); setInterval(myTimer2, 60000);clearInterval(intervalo_time);">X</a>

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
                    <?php   crear_sugerido($usuario);   ?>
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
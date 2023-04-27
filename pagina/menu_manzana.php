<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Principal</title>
    <link rel=stylesheet href="../css/estilos.css">
    <link rel="shortcut icon" href="favicon.png">
    <script
        src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous">
    </script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
</head>
<body>
    <div style="background-color: #9b0000;position: absolute;top: 0px; right: 5px; padding: 10px;border-radius: 0px 0px 15px 15px;color:white" onclick="window.location.href = 'http://mercadoslamanzana.com/osiris/pagina/sesion_manzana.php'">Cerrar sesión</div>
    <div class="header" id="header">
    <h1 class="w3-animate-top" style="font-size:0.8em">Bienvenido</h1>
    </div>
<?php

    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require("../php/funciones.php");
    //Desactivar Desactivar toda notificación de error
    //error_reporting(0);
    $acceso = array(
        "",
        "Administrador",
        "Auxiliar Administrativo",
        "Empleado",
        "Domiciliario",
        "Provedor",
        "Provedor"
    );
    
    if(empty($_POST['u'])){
        echo "<script>window.history.back();</script>";
    }
    
    $usuario     =      $_POST['u'];
    $clave       =      $_POST['p'];

    $tipo_de_cuenta = iniciar_sesion($usuario, $clave);

    echo " - ".$acceso[$tipo_de_cuenta]."</div>";
    // Notificar todos los errores de PHP
    error_reporting(-1);
?>



<div id="venta_noti">

</div>

<div class="menu w3-animate-zoom" id="menu_princi">
    <?php
    if($tipo_de_cuenta == 1){
        ?>
        <div class="columna1">

            <!--<a class='columna2' style="background-color: #4a4a4a;" onclick="ocultarDivs('cont4');$('#entrar_caja').trigger('click');"><img src="../iconos/ventas.png" alt="ventas" width="50%" height="50%"><br>Caja</a> -->
            <a class='columna2' style="background-color: #4a4a4a;" onclick="ocultarDivs('cont4');$('#entrar_cajapequenia').trigger('click');"><img src="../iconos/ventas.png" alt="ventas" width="50%" height="50%"><br>Caja</a>
            <a class='columna2' style="background-color: #ff0000;" onclick="ocultarDivs('cont1');ocultarDivs1('cont1_1')"><img src="../iconos/pedidos.png" alt="" width="50%" height="50%"><br>Toma Pedidos</a>

            <a class='columna2' style="background-color: #22AB09;" onclick="ocultarDivs('cont3');ocultarDivs3('cont3_2')"><img src="../iconos/domicilios.png" alt="domicilios" width="50%" height="50%"><br>Domicilios</a>
            <a class='columna2' style="background-color: #0969AB;" onclick="ocultarDivs('cont5');ocultarDivs5('cont5_1');$('#enviar13_1').trigger('click')"><img src="../iconos/control.png" alt="control" width="50%" height="50%"><br>Control</a>
        </div> 

        <div class="columna1">
            <a class='columna2' style="background-color: #09AB83;padding-top:21%;padding-bottom:21%;" onclick="ocultarDivs('cont2');"><img src="../iconos/equipo.png" alt="empresa" width="50%" height="50%"><br>Empresa</a>

            <a class='columna2' style="padding-top:30%;padding-bottom:21%;width:15%;" onclick="ocultar_notificaciones();"><img src="../iconos/activo.png" id="img_noti" width="60px" height="60px" class="notificaciones"></a>

        </div>
        <?php
    }elseif($tipo_de_cuenta == 2){
        ?>
        <div class="columna1">

            <a class='columna2' style="background-color: #4a4a4a;" onclick="ocultarDivs('cont4');$('#entrar_cajapequenia').trigger('click');"><img src="../iconos/ventas.png" alt="ventas" width="50%" height="50%"><br>Caja</a>
            <a class='columna2' style="background-color: #ff0000;" onclick="ocultarDivs('cont1');ocultarDivs1('cont1_1')"><img src="../iconos/pedidos.png" alt="" width="50%" height="50%"><br>Toma Pedidos</a>

            <a class='columna2' style="background-color: #22AB09;" onclick="ocultarDivs('cont3');ocultarDivs3('cont3_2')"><img src="../iconos/domicilios.png" alt="domicilios" width="50%" height="50%"><br>Domicilios</a>
            <a class='columna2' style="background-color: #0969AB;" onclick="ocultarDivs('cont5');ocultarDivs5('cont5_2');$('#enviar13_2').trigger('click')"><img src="../iconos/control.png" alt="control" width="50%" height="50%"><br>Control</a>
        </div> 

        <div class="columna1">
            <a class='columna2' style="background-color: #09AB83;padding-top:21%;padding-bottom:21%;" onclick="ocultarDivs('cont2');"><img src="../iconos/equipo.png" alt="empresa" width="50%" height="50%"><br>Empresa</a>

            <a class='columna2' style="padding-top:30%;padding-bottom:21%;width:15%;" onclick="ocultar_notificaciones();"><img src="../iconos/activo.png" id="img_noti" width="60px" height="60px" class="notificaciones"></a>

        </div>
        <?php
    }elseif($tipo_de_cuenta == 3){
        ?>

        <a class='columna' style="background-color: #ff0000;" onclick="ocultarDivs('cont1');ocultarDivs1('cont1_1')"><img src="../iconos/pedidos.png" alt="" width="50%" height="50%"><br>Toma Pedidos</a>
        <a class='columna' style="background-color: #22AB09;" onclick="ocultarDivs('cont3');ocultarDivs3('cont3_2')"><img src="../iconos/domicilios.png" alt="domicilios" width="50%" height="50%"><br>Domicilios</a>
        <a class='columna' style="background-color: #4a4a4a;" onclick="ocultarDivs('cont4');$('#entrar_cajapequenia').trigger('click');"><img src="../iconos/ventas.png" alt="ventas" width="50%" height="50%"><br>Caja</a>
        <a class='columna' style="background-color: #0969AB" onclick="ocultarDivs('cont5');ocultarDivs5('cont5_2');$('#enviar13_2').trigger('click')"><img src="../iconos/control.png" alt="control" width="50%" height="50%"><br>Control</a>
        <?php
    }elseif($tipo_de_cuenta == 4){
        ?>
        <div class="columna1">
            <a class='columna2' style="background-color: #22AB09" onclick="ocultarDivs('cont3');ocultarDivs3('cont3_1')"><img src="../iconos/domicilios.png" alt="domicilios" width="50%" height="50%"><br>Domicilios</a>
            <a class='columna2' style="background-color: #0969AB" onclick="ocultarDivs('cont5');ocultarDivs5('cont5_2');$('#enviar13_2').trigger('click')"><img src="../iconos/control.png" alt="control" width="50%" height="50%"><br>Control</a>
        </div>
        <?php
    }
    elseif($tipo_de_cuenta == 5){
        ?>
        <a class='columna' onclick="ocultarDivs('cont1')"><img src="../iconos/pedidos.png" alt="" width="40%" height="40%"><br>Pedidos</a>
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
                    <a class="columna" style="background-color: #AB0909" onclick="ocultarDivs1('cont1_1')"><img src="../iconos/existencias.png" alt="existencias" width="50%" height="50%"><br>Crea Sugerido</a>
                    <a class="columna" style="background-color: #C11818" onclick="ocultarDivs1('cont1_4');$('#enviar4').trigger('click')"><img src="../iconos/proximo.png" alt="proximo" width="50%" height="50%"><br>Ver próximos pedidos</a>
                    <?php

                }elseif($tipo_de_cuenta == 5){
                    ?>
                    <a class="columna" style="background-color: #AB0909" onclick="ocultarDivs1('cont1_2')"><img src="../iconos/existencias.png" alt="existencias" width="50%" height="50%"><br>Crear Pedido</a>
                    <?php
                }
                elseif($tipo_de_cuenta == 6){
                    ?>
                    <a class="columna" style="background-color: #AB0909" onclick="ocultarDivs1('cont1_3')"><img src="../iconos/existencias.png" alt="existencias" width="50%" height="50%"><br> Pedido</a>
                    <?php
                }
                ?>
                <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="ocultarDivs0()">X</a>
            
            </div>

            <div id="cont1_1" style="display:none;">
                <div class="w3-container">
                    <?php   crear_sugerido($usuario);   ?>

                    <a class="columna w3-red" onclick="ocultarDivs1('cont1_1');"><img src="../iconos/existencias.png" alt="existencias" width="30%" height="30%"><br>Crea Sugerido</a>
                    <a class="columna w3-green" onclick="ocultarDivs1('cont1_4');$('#enviar4').trigger('click');"><img src="../iconos/proximo.png" alt="proximo" width="30%" height="30%"><br>Ver próximos pedidos</a>
                    
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
                    Crear pedido
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
                    <?php   //cuentas_por_pagar($usuario);?>
                    <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('cont1_5').style.display='none'">X</a>
                </div>
            </div>

        </div>
    </div>

    <div id="cont2">
        <div class="w3-container" id="empresa"  style="display:none; height: 100%;">
            <div class="menu" style="margin-top: 3%;">
            
                <a class="columna" style="background-color: #09AB83;" onclick="ocultarDivs2('cont2_1'); $('#enviar7_1').trigger('click')"><img src="../iconos/proveedor.png" width="50%" height="50%"><br>Proveedor</a>
                <a class="columna" style="background-color: #09AB83;" onclick="ocultarDivs2('cont2_2'); $('#enviar8').trigger('click')"><img src="../iconos/producto.png" width="50%" height="50%"><br>Producto</a>
                <a class="columna" style="background-color: #09AB83;<?php if($tipo_de_cuenta != 1){ echo "display:none;";} ?>" onclick="ocultarDivs2('cont2_3'); $('#enviar9_1').trigger('click')"><img src="../iconos/personal.png" width="50%" height="50%"><br>Personal</a>
                <a class="columna" style="background-color: #09AB83;" onclick="ocultarDivs2('cont2_4'); $('#enviar11').trigger('click')"><img src="../iconos/presupuesto.png" width="50%" height="50%"><br>Presupuestos</a>
                <a class="columna" style="background-color: #09AB83;" onclick="ocultarDivs2('cont2_5'); $('#enviar10_1').trigger('click')"><img src="../iconos/vehiculos.png" width="50%" height="50%"><br>Vehículos</a>
                <a class="columna" style="background-color: #09AB83;<?php if($tipo_de_cuenta != 1){ echo "display:none;";} ?>" onclick="ocultarDivs2('cont2_6'); $('#enviar12').trigger('click')"><img src="../iconos/indicador.png" width="50%" height="50%"><br>Resultados Operativos</a>
                <a class="columna" style="background-color: #09AB83;" onclick="ocultarDivs2('cont2_7'); $('#enviar6_1').trigger('click');"><img src="../iconos/pago.png" width="50%" height="50%"><br>Cuentas por pagar</a>
                <a class="columna" style="background-color: #09AB83;" onclick="ocultarDivs2('cont2_8'); $('#enviar14_1').trigger('click')"><img src="../iconos/requerimiento.png" width="50%" height="50%"><br>Requerimientos</a>
                <a class="columna" style="background-color: #09AB83;<?php if($tipo_de_cuenta != 1){ echo "display:none;";} ?>" onclick="ocultarDivs2('cont2_9'); $('#enviar15').trigger('click')"><img src="../iconos/grafico-de-barras.png" width="50%" height="50%"><br>Ventas diarias</a>

                <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="ocultarDivs0();">X</a>

            </div>
            <div id="cont2_1" style="display:none;">
                <div class="w3-container">
                    <?php   menu_proveedor($usuario);   ?>

                    <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('cont2_1').style.display='none';">X</a>
                </div>
            </div>
            <div id="cont2_2" style="display:none;">
                <div class="w3-container">
                    <?php   menu_producto($usuario);     ?>
                    <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('cont2_2').style.display='none'" id="xcont2_2">X</a>
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
                    <?php   resultados_operativos($usuario);  ?>
                    
                </div>
            </div>
            <div id="cont2_7" style="display:none;">
                <div class="w3-container">
                    <?php   cuentas_por_pagar($usuario);      ?>
                    
                </div>
            </div>
            <div id="cont2_8" style="display:none;">
                <div class="w3-container">
                    <?php   ver_requerimientos($usuario);    ?>
                    
                </div>
            </div>
            <div id="cont2_9" style="display:none;">
                <div class="w3-container">
                    <?php   registro_diario_ventas($usuario);    ?>
                    
                </div>
            </div>
        </div>
    </div>

    <div id="cont3" style="display:none;">
        <div class="w3-container" id="control_domiciliario"  style="display:none;">
        <div class="osiris"><div class="contenido">Domicilios</div></div>

            <div class="menu">
                <?php
                if($tipo_de_cuenta == 1 || $tipo_de_cuenta == 2 || $tipo_de_cuenta == 3){
                    ?>
                    <a class="columna" style="background-color: #22AB09;" onclick="ocultarDivs3('cont3_2')"><img src="../iconos/proximo.png" width="50%" height="50%"><br>Ver Domicilios</a>
                    <?php
                }elseif($tipo_de_cuenta == 4){
                    ?>
                    <a class="columna" style="background-color: #22AB09;" onclick="ocultarDivs3('cont3_1')"><img src="../iconos/entrega.png" width="50%" height="50%"><br>Domicilio</a>
                    <?php
                }
                ?>

                <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="ocultarDivs0();">X</a>

            </div>

            <div id="cont3_1" style="display:none;">
                <div class="w3-container">
                    <?php   control_domiciliario($usuario, $tipo_de_cuenta);   ?>
                </div>
                <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('cont3_1').style.display='none';ocultarDivs0();">X</a>
            </div>

            <div id="cont3_2" style="display:none;">
                <div class="w3-container">
                    <?php   control_domiciliario2($usuario, $tipo_de_cuenta);     ?>
                </div>
                <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('cont3_2').style.display='none';ocultarDivs0();">X</a>
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
            <div class="menu">
                <a class="columna w3-teal"  onclick="ocultarDivs4('cont4_1'); $('#enviarv1').trigger('click')" id="entrar_caja">Caja 1</a>
                <a class="columna w3-green" onclick="ocultarDivs4('cont4_2'); $('#enviarv2').trigger('click'); $('#enviarv2_2').trigger('click')" id="entrar_cajapequenia">Caja 2</a>
                <a class="columna w3-blue"  onclick="ocultarDivs4('cont4_3'); $('#enviarv3').trigger('click')">Caja 3</a>
                <a class="columna w3-red"   onclick="ocultarDivs4('cont4_4'); $('#enviarv4').trigger('click')">Caja 4</a>
                <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="ocultarDivs0();">X</a>
            </div>

            <div id="cont4_1" style="display:none;">
                <div class="w3-container">
                    <?php   caja1($usuario);   ?>
                    <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" id="xcont_4_1" onclick="document.getElementById('cont4_1').style.display='none';ocultarDivs0();">X</a>
                </div>
            </div>
            <div id="cont4_2" style="display:none;">
                <div class="w3-container">
                    <?php   caja_pequenia($usuario);     ?>
                    <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" id="xcont_4_2" onclick="document.getElementById('cont4_2').style.display='none';ocultarDivs0();">X</a>
                </div>
            </div>
            <div id="cont4_3" style="display:none;">
                <div class="w3-container">
                    <?php   //crear_pedido2($usuario);    ?>
                    <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('cont4_3').style.display='none'">X</a>
                </div>
            </div>
            <div id="cont4_4" style="display:none;">
                <div class="w3-container">
                    <?php   //ver_pedidos($usuario);      ?>
                    <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('cont4_4').style.display='none'">X</a>
                </div>
            </div>
        </div>
    </div>

    <div id="cont5" style="display:none;">
        <div class="w3-container" id="control"  style="display:none;">
        <div class="osiris"><div class="contenido">Control</div></div>

            <div class="menu">
                <?php
                if($tipo_de_cuenta == 1){
                    ?>
                    <a class="columna" style="background-color:#0969AB;color:white" onclick="ocultarDivs5('cont5_1');$('#enviar13_1').trigger('click')"><img src="../iconos/controlobs.png" width="40%" height="40%"><br>Ver control</a>
                    
                    <?php
                }else{
                    ?>
                    <a class="columna" style="background-color:#0969AB;color:white" onclick="ocultarDivs5('cont5_2');$('#enviar13_2').trigger('click')"><img src="../iconos/opciones.png" width="40%" height="40%"><br>Control</a>
                    
                    <?php
                }
                ?>

                <a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="ocultarDivs0();">X</a>

            </div>
            <div id="cont5_1" style="display:none;">
                <div class="w3-container">
                    <?php   ver_control();   ?>
                </div>
            </div>
            <div id="cont5_2" style="display:none;">
                <div class="w3-container">
                    <?php   registrar_control($usuario);     ?>
                </div>
            </div>
        </div>
    </div>


<script>

    function multi() {

var valores = document.getElementsByClassName('cantidad');
document.getElementById("total_sugeridos").innerHTML = valores.length;
}

//setInterval('multi()',500);

function ocultarDivs(no_oculta){
document.getElementById("header").style.display='none';
document.getElementById("venta_noti").style.display='none';
document.getElementById("menu_princi").style.display='none';

document.getElementById("cont1").style.display='none';
document.getElementById("cont2").style.display='none';
document.getElementById("cont3").style.display='none';
document.getElementById("cont4").style.display='none';
document.getElementById("cont5").style.display='none';

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
        document.getElementById("cont2_7").style.display='none';
        document.getElementById("cont2_8").style.display='none';
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
        document.getElementById("ventas").style.display='block';
        document.getElementById("cont4_1").style.display='none';
        document.getElementById("cont4_2").style.display='none';
        document.getElementById("cont4_3").style.display='none';
        document.getElementById("cont4_4").style.display='none';
        break;
    case "cont5":
        document.getElementById("cont5").style.display='block';
        document.getElementById("control").style.display='block';
        document.getElementById("cont5_1").style.display='none';
        document.getElementById("cont5_2").style.display='none';
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
    document.getElementById("ventas").style.display='none';
    document.getElementById("control").style.display='none';
    document.getElementById("header").style.display='block';
    document.getElementById("venta_noti").style.display='none';
    document.getElementById("menu_princi").style.display='block';

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
document.getElementById("cont2_7").style.display='none';
document.getElementById("cont2_8").style.display='none';
document.getElementById("cont2_9").style.display='none';
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
    case "cont2_7":
        document.getElementById("cont2_6").style.display='block';
        document.getElementById("cont2_7").style.display='block';
        break;
    case "cont2_8":
        document.getElementById("cont2_8").style.display='block';
        break;
    case "cont2_9":
        document.getElementById("cont2_9").style.display='block';
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

function ocultarDivs4(no_oculta){
document.getElementById("cont4_1").style.display='none';
document.getElementById("cont4_2").style.display='none';
document.getElementById("cont4_3").style.display='none';
document.getElementById("cont4_4").style.display='none';
switch(no_oculta) {
    //Pedidos
    case "cont4_1":
        document.getElementById("cont4_1").style.display='block';
        break;
    case "cont4_2":
        document.getElementById("cont4_2").style.display='block';
        break;
    case "cont4_3":
        document.getElementById("cont4_3").style.display='block';
        break;
    case "cont4_4":
        document.getElementById("cont4_4").style.display='block';
        break;
    default:
      // code block
        break;
}
}

function ocultarDivs5(no_oculta){
document.getElementById("cont5_1").style.display='none';
document.getElementById("cont5_2").style.display='none';
switch(no_oculta) {
    //Pedidos
    case "cont5_1":
        document.getElementById("cont5_1").style.display='block';
        break;
    case "cont5_2":
        document.getElementById("cont5_2").style.display='block';
        break;
    default:
      // code block
        break;
}
}



$('#img_noti').click(function(){

    $.ajax({
        url:'../php/consultanoti_1_1.php',
        success: function(res){
            $('#venta_noti').html(res);
        },
        error: function(res){
            alert("Problemas al tratar de mostrar notificaciones");
        }
    });
});

$('#tbodyform')
.on('input', '.cantidad', function() {

var $input = $(this), // input.cantidad
    cantidad = parseInt($input.val(), 10), // valor de input.cantidad
    $tr = $input.closest('tr'), // fila del input.cantidad
    precio = parseInt($tr.find('.precio').text(), 10), // valor del span.precio
    $total = $tr.find('.total'); // elemento span.total

$total.text(precio * cantidad); // reseteamos el valor del span.total
});

function multi2() {
var data = [];

$("td.total").each(function(){
    data.push(parseFloat($(this).text()));
});


var suma = data.reduce(function(a,b){ return a+b; },0);


$('#final_v1_1').html(new Intl.NumberFormat('de-DE').format(suma));
}

function multi3() {
var data = [];

$("td.total3_2").each(function(){
    data.push(parseFloat($(this).text()));
});


var suma = data.reduce(function(a,b){ return a+b; },0);


$('#total_cuadre3').html(new Intl.NumberFormat('de-DE').format(suma));
}

function multi4() {
var data = [];

$("td.total4_2").each(function(){
    data.push(parseFloat($(this).text()));
});


var suma = data.reduce(function(a,b){ return a+b; },0);


$('#total4_2').html(new Intl.NumberFormat('de-DE').format(suma));
}





</script>
</body>
</html>

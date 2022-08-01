<script type="text/javascript" src="../js/funciones.js"></script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();                     //Obtenemos la conexion
?>
<a class="w3-bar-item w3-button w3-red w3-hover-red active salir" onclick="document.getElementById('respuesta_cuadre_caja').style.display='none'">X</a>

<div class="recuadro" style="left:0%; width:30%">
    <table class="tabla_sugerido" id="tabla_cuadre_caja">
        <tr>
            <th colspan="3" style="background-color:green;">PAGOS DE CAJA</th>
        </tr>
        <tr>
            <td style="background-color:teal;">Descripción</td>
            <td style="background-color:teal;">Valor</td>
            <td style="background-color:teal;"></td>
        </tr>
        <tbody id="contenido-tabla">
        <tr>
            <td><input type="text" size="10"/></td>
            <td><input type="text" class="puntos cantidad1" size="8"/></td>
            <td><input type="button" class="borrar2 w3-tbn w3-red" value=" X "></input></td>
        </tr>
        </tbody>
    </table>

    <button type="button" onclick="agregarFila1()">Agregar Fila</button>

</div>
<div class="recuadro" style="left:0%;top:90%; width:30%;height:10%">
    <table class="tabla_sugerido">
        <tfoot>
        <tr>
            <td>Total</td>
            <td><span id="total_cuadre1">0</span></td>
        </tr>
        </tfoot>
    </table>

</div>

<div class="recuadro" style="left:33%; width:30%">
    <table class="tabla_sugerido" id="tabla_pagos_de_caja">
        <tr>
            <th colspan="3" style="background-color:green;">PAGOS DE CAJA</th>
        </tr>
        <tr>
            <td style="background-color:teal;">Descripción</td>
            <td style="background-color:teal;">Valor</td>
            <td style="background-color:teal;"></td>
        </tr>
        <tbody id="contenido-tabla">
        <tr>
            <td><input type="text" size="10"/></td>
            <td><input type="text" class="puntos cantidad" size="8"/></td>
            <td><input type="button" class="borrar2 w3-tbn w3-red" value=" X "></input></td>
        </tr>
        </tbody>
    </table>

    <button type="button" onclick="agregarFila()">Agregar Fila</button>

</div>
<div class="recuadro" style="left:33%;top:90%; width:30%;height:10%">
    <table class="tabla_sugerido">
        <tfoot>
        <tr>
            <td>Total</td>
            <td><span id="total_cuadre2">0</span></td>
        </tr>
        </tfoot>
    </table>

</div>


<div class="recuadro" style="left:66%;width:34%;">
<table class="tabla_sugerido">
    <tr>
        <th colspan="4" style="background-color:orange;">EFECTIVO EN CAJA</th>

    </tr>
    <tr>
        <td style="background-color:teal;">Nominación</td>
        <td style="background-color:teal;">Valor</td>
        <td style="background-color:teal;">Cantidad</td>
        <td style="background-color:teal;">Total</td>
    </tr>
    <tfoot>
    <tr>
        <td colspan="3">Total efectivo</td>
        <td><span id="total_cuadre3">0</span></td>
    </tr>
    </tfoot>
    <tbody id="tbodyform2">
    <tr>
        <td>Moneda</td>
        <td><span class="precio">50<span></td>
        <td><input type="text" class="cantidad puntos" size="5" onchange="multi3()"/></td>
        <td class="total3">0</td>
    </tr>
    <tr>
        <td>Moneda</td>
        <td class="precio">100</td>
        <td><input type="text" class="cantidad" size="5" onchange="multi3()"/></td>
        <td class="total3">0</td>
    </tr>
    <tr>
        <td>Moneda</td>
        <td class="precio">200</td>
        <td><input type="text" class="cantidad" size="5" onchange="multi3()"/></td>
        <td class="total3">0</td>
    </tr>
    <tr>
        <td>Moneda</td>
        <td class="precio">500</td>
        <td><input type="text" class="cantidad" size="5" onchange="multi3()"/></td>
        <td class="total3">0</td>
    </tr>
    <tr>
        <td>Moneda</td>
        <td class="precio">1000</td>
        <td><input type="text" class="cantidad" size="5" onchange="multi3()"/></td>
        <td class="total3">0</td>
    </tr>
    <tr>
        <td>Billete</td>
        <td class="precio">2000</td>
        <td><input type="text" class="cantidad" size="5" onchange="multi3()"/></td>
        <td class="total3">0</td>
    </tr>
    <tr>
        <td>Billete</td>
        <td class="precio">5000</td>
        <td><input type="text" class="cantidad" size="5" onchange="multi3()"/></td>
        <td class="total3">0</td>
    </tr>
    <tr>
        <td>Billete</td>
        <td class="precio">10000</td>
        <td><input type="text" class="cantidad" size="5" onchange="multi3()"/></td>
        <td class="total3">0</td>
    </tr>
    <tr>
        <td>Billete</td>
        <td class="precio">20000</td>
        <td><input type="text" class="cantidad" size="5" onchange="multi3()"/></td>
        <td class="total3">0</td>
    </tr>
    <tr>
        <td>Billete</td>
        <td class="precio">50000</td>
        <td><input type="text" class="cantidad" size="5" onchange="multi3()"/></td>
        <td class="total3">0</td>
    </tr>
    <tr>
        <td>Billete</td>
        <td class="precio">100000</td>
        <td><input type="text" class="cantidad" size="5" onchange="multi3()"/></td>
        <td class="total3">0</td>
    </tr>
    </tbody>
</table>
</div>
<?php
?>
src="http://code.jquery.com/jquery-2.1.4.min.js";

function obtener_detalles_pedidos() {

    var sugeridos = []

    $("td.sugeridos").each(function(){
        sugeridos.push(parseInt($(this).text()));
    });
    ///////////////////////
    var precios = []

    $("td.precios").each(function(){
        precios.push(parseInt($(this).text()));
    });
    ///////////////////////
    var total = 0;

    for (var i = 0; i < precios.length; i++) {
        total += precios[i] + sugeridos[i];
    }
    console.log(total);
    document.getElementById('factura_total').innerHTML = total;
    

}

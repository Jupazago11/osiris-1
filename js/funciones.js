src="http://code.jquery.com/jquery-2.1.4.min.js";


var close = document.getElementsByClassName("closebtn");
var i;

for (i = 0; i < close.length; i++) {
  close[i].onclick = function(){
    var div = this.parentElement;
    div.style.opacity = "0";
    setTimeout(function(){ div.style.display = "none"; }, 600);
  }
}



//setInterval(myTimer, 1000);


function myTimer() {
  const date = new Date();
  document.getElementById("reloj").innerHTML = date.toLocaleTimeString();
}

function myTimer2() {
  const date = new Date();
  //$('#enviar5_2').trigger('click');
}

function enviar_update() {
  $('#enviar5_3').trigger('click');
}

function enviar_update2() {
  $('#enviar5_4').trigger('click');
}

$('input.puntos').keyup(function(event) {

  // skip for arrow keys
  if(event.which >= 37 && event.which <= 40){
    event.preventDefault();
  }

  $(this).val(function(index, value) {
    return value
      .replace(/\D/g, "")
      .replace(/([0-9])([0-9]{0})$/, '$1$2')  
      .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".")
    ;
  });
});

function myFunctionTabla() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
/*
function myFunctionTabla2() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput2");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable2");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
*/

function myFunctionTabla3() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput3");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable3");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
function myFunctionTabla4() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput4");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable4");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
function myFunctionTabla5() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput5");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable5");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
function myFunctionTabla6() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput6");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable5");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

function show1() {
  var rowId = event.target.parentNode.parentNode.id;
  //this gives id of tr whose button was clicked
  var data = document.getElementById(rowId).querySelectorAll(".row-data"); 
  /*returns array of all elements with 
  "row-data" class within the row with given id*/

  var name = data[0].innerHTML;

  var inputNombre = document.getElementById("prove_sugerido");
  inputNombre.value = name;
  document.getElementById('respuesta1').style.display='none';
  $('#enviar1').trigger('click');
}
function show1_3() {
  var rowId = event.target.parentNode.parentNode.id;
  //this gives id of tr whose button was clicked
  var data = document.getElementById(rowId).querySelectorAll(".row-data"); 
  /*returns array of all elements with 
  "row-data" class within the row with given id*/

  var name = data[0].innerHTML;
  

  var inputNombre = document.getElementById("prove_sugerido");
  inputNombre.value = name;
  $('#enviar1_3').trigger('click');
}

function show2() {
  var rowId = event.target.parentNode.parentNode.id;
  //this gives id of tr whose button was clicked
  var data = document.getElementById(rowId).querySelectorAll(".row-data"); 
  /*returns array of all elements with 
  "row-data" class within the row with given id*/

  var name = data[0].innerHTML;

  var inputNombre = document.getElementById("prove_sugerido2");
  inputNombre.value = name;
  $('#enviar7_6').trigger('click');

}



$(function () {
  $(document).on('click', '.borrar', function (event) {
    multi2();
    event.preventDefault();
    $(this).closest('tr').remove();
  });
});

$(function () {
  $(document).on('click', '.borrar2', function (event) {
    multi2();
    event.preventDefault();
    $(this).closest('tr').remove();
  });
});

$(function () {
  $(document).on('click', '.borrar1', function (event) {
    multi2();
    event.preventDefault();
    $(this).closest('tr').remove();
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

function ocultar_menu_venta() {
  var x = document.getElementById("venta_menu");
  if (x.style.display === "block") {
      x.style.display = "none";
  } else {
      x.style.display = "block";
  }
}

//Efectivo en caja, cuadre de caja
$('#tbodyform2')
.on('input', '.cantidad', function() {
    
  var $input = $(this), // input.cantidad
    cantidad = parseInt($input.val(), 10), // valor de input.cantidad
    $tr = $input.closest('tr'), // fila del input.cantidad
    precio = parseFloat($tr.find('.precio2').text(), 10), // valor del span.precio
    $total = $tr.find('.total3'), // elemento span.total
    $total2 = $tr.find('.total3_2');

  $total.text((precio * cantidad).toLocaleString('es-MX')); // reseteamos el valor del span.total
  $total2.text(precio * cantidad); // reseteamos el valor del span.total
});



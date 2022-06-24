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
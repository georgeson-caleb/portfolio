function showMessage() {
   alert("Clicked!");
}

function changeDivColor() {
   var color = document.getElementById("color").value;
   document.getElementById("div1").style.backgroundColor = (color != "") ? color : "white";
}

function changeDivColorJQuery() {
   var color = document.getElementById("color").value;
   $('#div1').css('background-color', (color != "") ? color : "white");
}

function toggleDiv() {
   $("#div3").fadeToggle();
}
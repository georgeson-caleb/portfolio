function playBell() {
   document.getElementById("bell").play();
}

function drawCircle() {
   var canvas = document.getElementById("canvas");
   var context = canvas.getContext("2d");
   context.beginPath();
   context.arc(150, 100, 45, 0, 2 * Math.PI);
   context.stroke();
}

function drawRectangle() {
   var canvas = document.getElementById("canvas");
   var context = canvas.getContext("2d");
   context.beginPath();
   context.rect(50, 50, 100, 50);
   context.stroke();
}
function outputMessage(message) {
   document.getElementById("output").innerHTML = message;
}

function processTouch(event) {
   outputMessage("You are touching the screen!");
}

function moveTouch() {
   outputMessage("You are moving your finger");
   changeColor();
}

function endTouch() {
   outputMessage("You stopped touching the screen.");
}

function mouseOn() {
   outputMessage("The mouse is over the box.");
   changeColor();
}

function mouseOff() {
   outputMessage("The mouse left.");
   changeColor();
}

function loadPageFunction() {
   var color = localStorage.getItem("color");
   var background = localStorage.getItem("background");
   document.getElementById("events").style.backgroundColor = (color != null) ? color : "blue";
   document.body.style.backgroundColor = (background != null) ? background : "white";
}

function saveColors() {
   var color = document.getElementById("events").style.backgroundColor;
   var background = document.body.style.backgroundColor;
   localStorage.setItem("color", color);
   localStorage.setItem("background", background);
}

function changeColor() {
   document.getElementById("events").style.backgroundColor = getRandomColor();
}

function changeBackgroundColor() {
   var color = document.getElementById("events").style.backgroundColor;
   document.body.style.backgroundColor = color;
}

function startAnimation() {
   outputMessage("Animation started");
   document.getElementById("animation").classList = "animate";
}

function removeAnimation() {
   outputMessage("Animation ended")
   document.getElementById("animation").classList = "";
}
//Found on StackOverflow
//https://stackoverflow.com/questions/1484506/random-color-generator
function getRandomColor() {
   var letters = '0123456789ABCDEF';
   var color = '#';
   for (var i = 0; i < 6; i++) {
     color += letters[Math.floor(Math.random() * 16)];
   }
   return color;
}


function multiplyWithFor() {
   var number = getNumber();
   for (var i = 0; i < 20; i++) {
      number *= 2;
   }
   displayNumber(number);
}

function multiplyWithWhile() {
   var number = getNumber();
   while(number < 100) {
      number *= 2;
   }
   displayNumber(number);
}

function multiplyWithDoWhile() {
   var number = getNumber();
   do {
      number *= 2;
   } while (number < 150);
   displayNumber(number);
}

function getNumber() {
   return document.getElementById("number").value;
}

function displayNumber(number) {
   var node = document.createElement("P");
   var textNode = document.createTextNode(number);
   node.appendChild(textNode);
   document.getElementById("answerBox").appendChild(node);
}
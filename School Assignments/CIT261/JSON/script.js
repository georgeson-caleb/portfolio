var parsedObject;

class Object {
   name;
   shape;
   color;
   things;
}

function stringifyObject() {
   var object = new Object();
   object.name = document.getElementById("name").value;
   object.shape = document.getElementById("shapes").value;
   object.color = document.getElementById("color").value;
   object.things = new Array();

   if (document.getElementById("checkbox1").checked) {
      object.things.push(document.getElementById("checkbox1").value);
   }
   if (document.getElementById("checkbox2").checked) {
      object.things.push(document.getElementById("checkbox2").value);
   }
   if (document.getElementById("checkbox3").checked) {
      object.things.push(document.getElementById("checkbox3").value);
   }
   if (document.getElementById("checkbox4").checked) {
      object.things.push(document.getElementById("checkbox4").value);
   }
   
   parsedObject = JSON.stringify(object);
   document.getElementById("stringified").innerHTML = parsedObject;
   document.getElementById("parseButton").style.visibility = "visible";
}

function parseObject() {
   var object = JSON.parse(parsedObject);
   var displayString = "Name: " + object.name + "<br>Shape: " +
                        object.shape + "<br>Color: " + object.color +
                        "<br>Things:";
   for (var i = 0; i < object.things.length; i++) {
      displayString += " " + object.things[i];
   }
   document.getElementById("parsed").innerHTML = displayString;
}
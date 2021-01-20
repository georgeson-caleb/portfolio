var data;
class Thing {
   name;
   color;
   size;
}

function storeData(key, data) {
   localStorage.setItem(key, data);
}

function retrieveData() {
   var key = document.getElementById("key").value;
   if (localStorage.getItem(key) != null) {
      showData(localStorage.getItem(key));
   } else {
      showNoKeyError();
   }
}

function getData() {
   data = new Thing();
   data.name = document.getElementById("name").value;
   data.color = document.getElementById("color").value;
   data.size = document.getElementById("size").value;
   var dataString = JSON.stringify(data);
   storeData(data.name, dataString);
}

function showData(dataString) {
   var _data = JSON.parse(dataString);
   var string = "Name: " + _data.name + 
      "<br>Color: " + _data.color + 
      "<br>Size: " + _data.size;
   document.getElementById("thing").innerHTML = string;
}

function showNoKeyError() {
   document.getElementById("thing").innerHTML = "There is no item with that name."
}

function saveNumber() {
   storeData("number", document.getElementById("number").value);
}

function loadNumber() {
   document.getElementById("loadedNumber").innerHTML = localStorage.getItem("number");
}

function saveArray() {
   var animals = [];
   for (var i = 1; i <= 5; i++) {
      var string = "array" + i;
      var checkbox = document.getElementById(string);
      if (checkbox.checked) {
         animals.push(checkbox.value);
      }
   }
   localStorage.setItem("animals", animals);
}

function loadArray() {
   document.getElementById("loadedArray").innerHTML = localStorage.getItem("animals");
}



// Band Camp Registration:

class Student {
   name;
   instrument;
   grade;
}

class RegistrationInfo {
   instructorName;
   studentInfo;
}

var numStudents;

function displayStudentInputBoxes() {
   numStudents = document.getElementById("numStudents").value;
   var node = document.createElement("div");
   node.innerHTML = "Instructor Name:<input type=text id=instructorName>";
   document.getElementById("registrationInfo").appendChild(node);
   for (var i = 0; i < numStudents; i++) {
      node = document.createElement("div");
      node.innerHTML = "Name:<input type=text id=studentName" + i +
                       "><br>Instrument:<input type=text id=studentInstrument" + i + 
                       "><br>Grade:<input type=number id=studentGrade" + i + ">";
      document.getElementById("registrationInfo").appendChild(node); 
   }
   document.getElementById("registrationInfo").innerHTML += "<button onclick=registerStudents()>Register Students</button>";
}

function registerStudents() {
   var instructorName = document.getElementById("instructorName").value;
   var studentInfo = [];
   for (var i = 0; i < numStudents; i++) {
      var student = new Student();
      student.name = document.getElementById("studentName" + i).value;
      student.instrument = document.getElementById("studentInstrument" + i).value;
      student.grade = document.getElementById("studentGrade" + i).value;
      studentInfo.push(student);
   }
   var registrationInfo = new RegistrationInfo();
   registrationInfo.instructorName = instructorName;
   registrationInfo.studentInfo = studentInfo;
   localStorage.setItem(instructorName, JSON.stringify(registrationInfo));
}

function loadRegistration() {
   var key = document.getElementById("loadInstructorName").value;
   if (localStorage.getItem(key) != null) {
      showRegistration(localStorage.getItem(key));
   } else {
      showNoInstructorError();
   }
}

function showRegistration(registrationInfo) {
   var info = JSON.parse(registrationInfo);
   var displayString = "Instructor name: " + info.instructorName + 
                       "<table><tr><th>Student Name</th><th>Instrument</th><th>Grade</th></tr>";
   for (var i = 0; i < info.studentInfo.length; i++) {
      displayString += "<tr><td>" + info.studentInfo[i].name + "</td>" +
                       "<td>" + info.studentInfo[i].instrument + "</td>" +
                       "<td>" + info.studentInfo[i].grade + "</td></tr>"
   }
   displayString += "</table>";
   document.getElementById("info").innerHTML = displayString;
}

function showNoInstructorError() {
   document.getElementById("info").innerHTML = "Registration info not found";
}
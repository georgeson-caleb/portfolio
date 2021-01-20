
/*****************
 * Student class
 * Used to group student data together
 *****************/
class Student {
   firstName;
   lastName;
   ageGroup;
   description;
   days;
   time;
}

var Monday = false;
var Tuesday = false;
var Wednesday = false;
var Thursday = false;
var Friday = false;

/*********************
 * Select day
 * Determines what happens when a 
 * day gets clicked
 *********************/
function selectDay(elem) {
   var day = elem.innerHTML;
   if (day == "Monday") {
      if (Monday == true) {
         Monday = false;
         deselect(elem);
      } else {
         Monday = true;
         select(elem);
      }
   } else if (day == "Tuesday") {
      if (Tuesday == true) {
         Tuesday = false;
         deselect(elem)
      } else {
         Tuesday = true;
         select(elem)
      }         
   } else if (day == "Wednesday") {
      if (Wednesday == true) {
         Wednesday = false;
         deselect(elem)
      } else {
         Wednesday = true;
         select(elem)
      }         
   } else if (day == "Thursday") {
      if (Thursday == true) {
         Thursday = false;
         deselect(elem)
      } else {
         Thursday = true;
         select(elem)
      }      
   } else if (day == "Friday") {
      if (Friday == true) {
         Friday = false;
         deselect(elem)
      } else {
         Friday = true;
         select(elem)
      }      
   }
}

var time = '';
/*************************
 * Select time
 * Determines what happens when a 
 * time gets clicked
 */
function selectTime(elem) {
   var times = document.getElementById("timeSelection").childNodes;
   
   for (var i = 0; i < times.length; i++) {
      if (times[i].tagName == "DIV") {
         deselect(times[i]);
      }
   }
   select(elem);
   time = elem.innerHTML;
}

/*******************
 * Play
 * Plays the passed note
 *******************/
function play(note) {
   document.getElementById(note).play();
}

/*********************
 * Disable
 * Makes the element disappear
 *********************/
function disable(elem) {
   elem.style.display = "none";
}

/**********************
 * Enable
 * Makes the element appear
 **********************/
function enable(elem) {
   elem.style.display = "block";
}

/***********************
 * Register
 * Assigns each of the variables 
 * from the input boxes to the student
 ***********************/
function register() {
   var student = new Student();
   student.firstName = document.getElementById("firstName").value;
   student.lastName = document.getElementById("lastName").value;
   student.ageGroup = document.getElementById("ageGroup").value;
   student.description = document.getElementById("description").value;
   student.days = getDays();
   student.time = time;
   saveStudentInfo(student);
}

/***********************
 * Get Days
 * Checks which days have been 
 * selected.
 ***********************/
function getDays() {
   var days = [];
   if (Monday) {
      days.push("Monday");
   }
   if (Tuesday) {
      days.push("Tuesday");
   }
   if (Wednesday) {
      days.push("Wednesday");
   }
   if (Thursday) {
      days.push("Thursday");
   }
   if (Friday) {
      days.push("Friday");
   }

   return days;
}

/***************************
 * saveStudentInfo
 * Sends the student's info to the 
 * server to be processed.
 ***************************/
function saveStudentInfo(student) {
   var xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
         updateResponse(JSON.parse(this.responseText));
         showResponse();
      }
   }
   xhttp.open("POST", "saveStudentInfo.php", true);
   xhttp.send(JSON.stringify(student));
}

/**************************
 * Start loading transition
 * First transition:
 * A div slides up and becomes 
 * less transparent
 **************************/
function startLoadingTransition() {
   var obj = document.getElementById("loadingScreen");
   obj.style.opacity = "100%";
   obj.style.transform = "translate(50%, 200px)";
}

/**************************
 * showPage
 * When the first transition ends,
 * this function is called to make
 * the rest of the page appear
 **************************/
function showPage() {
   document.getElementById("loadingScreen").style.display = "none";
   document.getElementById("piano").style.display = "flex";
   document.getElementById("registration").style.display = "block";
   document.getElementById("header").style.display = "block";
}

/***************************
 * Slide1 Left
 * Triggers the first animation:
 * Slide1 disappears to the left 
 * while Slide2 appears from the 
 * right
 ***************************/
function slide1Left() {
   document.getElementById("slide1").classList = "slideLeftDisappear";
   document.getElementById("slide2").style.display = "block";
   document.getElementById("slide2").classList += " slideLeftAppear";
}

/***************************
 * wiggleDiv
 * Makes the passed element wiggle
 ***************************/
function wiggleDiv(elem) {
   elem.classList += " wiggle";
}

/****************************
 * undoWiggle
 * Allows the element to wiggle again
 ****************************/
function undoWiggle(elem) {
   elem.classList.remove("wiggle");
}

/*****************************
 * select
 * Triggers another transition:
 * The element changes size and color
 *****************************/
function select(elem) {
   elem.style.backgroundColor = "#d64e4e";
   elem.style.borderColor = "#fa5757";
   elem.style.width = "70%";
   elem.style.height = "40px";
}

/*****************************
 * deselect
 * The element returns to its 
 * original style
 *****************************/
function deselect(elem) {
   elem.style.backgroundColor = "#fa5757";
   elem.style.borderColor = "#d64e4e";
   elem.style.width = "50%";
   elem.style.height = "30px";
}

/******************************
 * updateResponse
 * Fills in the response after the user
 * submits their information
 ******************************/
function updateResponse(response) {
   document.getElementById("firstNameResponse").innerHTML = response.firstName;
   document.getElementById("timeResponse").innerHTML = response.time;
   var dayString = "";
   if (response.days.length > 1) {
      for (var i = 0; i < response.days.length; i++) {
         dayString += (i < (response.days.length - 1)) ? response.days[i] + ", " : "and " + response.days[i];
      }
   } else {
      dayString = response.days[0];
   }
   document.getElementById("dayResponse").innerHTML = dayString;
}

/*******************************
 * showResponse
 * Triggers another animation:
 * Slide2 disappears to the left
 * while slide3 appears from the right
 *******************************/
function showResponse() {
   document.getElementById("slide2").classList += " slideLeftDisappear";
   document.getElementById("slide2").addEventListener("animationend", function() {
      document.getElementById("slide2").style.display = "none";
   });
   document.getElementById("slide3").style.display = "block";
   document.getElementById("slide3").classList.add("slideLeftAppear");
}
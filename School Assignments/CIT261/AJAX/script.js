function performAjaxRequest(key) {   
   var xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var weather = JSON.parse(this.responseText);
        console.log(this.responseText);
        displayWeather(weather);
      }
    };
    xhttp.open("GET", getQueryString() + key, true);
    xhttp.send();
}

// The API key can't be posted publicly, so it is stored
// on the server
function getKey() {
   var xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        performAjaxRequest(this.responseText);
      }
    };
    xhttp.open("GET", "apiKey.php", true);
    xhttp.send();
} 

function displayWeather(weather) {
   var string = "City: " + weather.name + "<br>Temp: " + weather.main.temp;
   document.getElementById("weather").innerHTML = string;
}

function getQueryString() {
   var city = document.getElementById("city").value;
   var queryString = "https://api.openweathermap.org/data/2.5/weather?q=" + city + "&units=imperial&apiKey="
   return queryString;
}
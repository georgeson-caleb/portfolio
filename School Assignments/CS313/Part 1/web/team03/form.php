<!doctype html>
<html lang="en">

<?php

$name = $_POST["name"];
$email = $_POST["email"];
$major = $_POST["major"];
$comments = $_POST["comments"];

$continents = $_POST["continent"];


//continent dictionary
$continentDictionary = [
    "na" => "North America",
    "sa" => "South America",
    "eur" => "Europe",
    "as" => "Asia",
    "af" => "Africa",
    "aus" => "Australia",
    "ant" => "Antarctica"
];

?>



  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>Week 3 | Teach</title>
  </head>
  <main>
    <body>
      <?php 
        include '../header.php';
      ?>
      
    <div class="jumbotron">
          <h1 class="display-2">Week 3 - Teach: Team Activity</h1>
    </div>

    <div class="container">

        <h1>Name: <?php echo $name; ?></h1>
        <p>Email: <?php echo "<a href='mailto:'" . $email . ">" . $email . "</a>"; ?></p>
        <p>Major: <?php echo $major; ?></p>
        <p>Comments: <?php echo $comments; ?></p>

        <p>Continents Visited:<p>
        <br>
        <ul>
        <?php   

            // Loop to store and display values of individual checked checkbox.
            foreach($continents as $key => $value){
               echo "<li>" . $continentDictionary[$value] . "</li>";
            }


        ?>
        </ul>
    
    </div>

    
    
    </main>
  </body>
</html>
<?php
   require("dbConnect.php");
   
   $db = get_db();
   
   session_start();

   function getCatName($cat_id) {
      global $db;
      $query = "SELECT cat_name, fav_food, fav_pastime, age  FROM cats WHERE id=:id LIMIT 1;";
      $stmt = $db->prepare($query);
      $stmt->bindValue(":id", $cat_id, PDO::PARAM_INT);
      $stmt->execute();

      return $stmt->fetch(PDO::FETCH_ASSOC)["cat_name"];
   }
?>

<!DOCTYPE html>
<html>
<head>
   <title> Catscratch - Share your kitties!</title>
   <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
   <script src="script.js"></script>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   <link rel="stylesheet" href="style.css">
</head>
<body>
   <header id="top">
      <h1>Catscratch</h1>
      <div onclick="window.location = 'home.php'">Home</div>
   </header>
   <?if ($_SESSION["dq4r1"] == "") {
      // Not logged in
      echo "Oops! You're not logged in. Click <a href='index.php'>here</a> to log in.";
   } else {
      $cat_id = $_GET["cat_id"];
      echo "cat id: " . $cat_id;
      $cat = getCat($cat_id);
      $stmt = $db->prepare("SELECT image_name FROM pictures WHERE cat_id=:id");
      $stmt->bindValue(":id", $cat_id, PDO::PARAM_INT);
      $stmt->execute();
      ?> <div id="pictures" class="d-flex"> <?
      if ($stmt->rowCount > 0) {
         while ($picture = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $image_name = $picture["image_name"];
            echo ("<img src=$image_name class='img-fluid'>");
         } 
      } else {
         echo ("<img src='img/pixel_cat_large.png' class='img-fluid'>");
      }
      ?></div><?
      $cat_name = $cat["cat_name"];
      $fav_food = $cat["fav_food"];
      $fav_pastime = $cat["fav_pastime"];
      $age = $cat["age"];
      echo "<p> Name: $cat_name<\p><p>Age: $age</p><p>Favorite food: $fav_food</p><p>Favorite pastime: $fav_pastime</p>";

   ?>

   
   <?}?>
</body>
</html>
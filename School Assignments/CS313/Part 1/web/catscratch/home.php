<?php
   require("dbConnect.php");
   $db = get_db();
   
   session_start();   

   // Get the username
   $query = "SELECT username FROM users WHERE id=:id LIMIT 1;";

   $stmt = $db->prepare($query);
   $stmt->bindValue(":id", $_SESSION["dq4r1"], PDO::PARAM_INT);
   $stmt->execute();

   $username = $stmt->fetchAll(PDO::FETCH_ASSOC)[0]["username"];

   function getCatName($cat_id) {
      global $db;
      $query = "SELECT cat_name FROM cats WHERE id=:id;";
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
      <a href="home.php"><h1>Catscratch</h1></a>
   </header>
<?
   if ($_SESSION["dq4r1"] == "") {
      // Not logged in
      ?>
         <div class="mt-2 mx-auto p-2 border rounded">Oops! You're not logged in. Click <a href='index.php'>here</a> to log in.</div>
      <?
   } else {
      ?>
      
      <div id="info-box">
      
      <?

      /*********************************************************************************************
         
      ** Leaving this out for now **

      // Show the sidebar
      ?>

         <div class="ml-3 ml-sm-0 ml-xs-0 position-fixed border rounded col-lg-2 col-xl-2">
            <h3><? echo $username; ?></h3>
         </div>

      <?

      ***************************************************************************************************/
   ?>
   
   <h3 class="text-center">Your Cats</h3>
   <div id="cat-box" class="d-flex flex-wrap w-75 mx-auto mb-2 p-2 border rounded">

   <?$pictures = array();

// Get the ids of any cats associated with the user id
$query = "SELECT id, cat_name FROM cats WHERE owner_id=:id;";

$stmt = $db->prepare($query);
$stmt->bindValue(":id", $_SESSION["dq4r1"], PDO::PARAM_INT);
$stmt->execute();

$cats = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the pictures associated with each of the cats
$query = "SELECT image_name, cat_id FROM pictures WHERE cat_id=:id;";
$stmt = $db->prepare($query);

foreach ($cats as $cat) {
   $stmt->bindValue(":id", $cat["id"], PDO::PARAM_INT);
   $stmt->execute();
   $pics = $stmt->fetchAll(PDO::FETCH_ASSOC);
   if ($stmt->rowCount() > 0) {
      array_push($pictures, $pics[0]);
   } else {
      $standIn = [
         "image_name" => "img/pixel_cat_large.png",
         "cat_id" => $cat["id"]
      ];
      array_push($pictures, $standIn);
   }
}

if (count($cats) == 0) {
   echo "No cats yet. Add some to see them here!";
}

foreach ($pictures as $picture) {
   $cat_id = $picture["cat_id"];
   $image = $picture["image_name"];
   $cat_name = getCatName($cat_id);

     echo "<div class='cat-card border rounded w-25 mx-2 mb-3'>
         <a href='cat-info.php?cat_id=$cat_id'>
         <h3 class='text-center'>$cat_name</h3>
         <img src='$image' class='img-fluid w-100'>
         </a></div>";

}?>

         <button class='border rounded w-25 mx-2 mb-3' onclick="window.location = 'add-cat.php'">
            Click to add a kitty!
         </button>
      </div> <!--cat-box-->
   </div> <!--info-box-->
   <?}?>
</body>
</html>
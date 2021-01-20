<?php
   if (!isset($_SESSION)){
      session_start();
   }
   $array = array();
   $_SESSION["cart"] = $array;
   $_SESSION["totalPrice"];
?>

<!DOCTYPE html>
<html>
   <head>
      <title>Misc. Stuff For Sale</title>
      <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
      <script src="script.js"></script>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <link rel="stylesheet" href="style.css">
      <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
   <body>
      <header class="jumbotron focus"> 
         <h1 class="mx-auto">
            Miscellaneous Stuff For Sale
</h1>
</header>
         <div id="information" class="d-flex flex-wrap mx-auto my-3 p-3 w-75 border rounded">
            <?php

               $images = array("Bananas", "Bike", "Bottles", "Laptop", "Dog");
               $prices = array(
                  "Bananas" => "1.98",
                  "Bike" => "245",
                  "Bottles" => "3.50",
                  "Laptop" => "499",
                  "Dog" => "299"
               );

               echo("<script>console.log(" . json_encode($_SESSION["cart"]) . ");</script>");

               foreach ($images as $image) {
                  $disabled = "";
                  for ($i = 0; $i < count($_SESSION["cart"]); $i++) {
                     if ($_SESSION["cart"][$i]->name == $image) {
                        $disabled = "disabled";
                     } 
                  }
                  $price = $prices[$image];
                  echo "<div id='$image' class='col-sm-12 col-md-6 col-lg-3 m-1 p-2 border rounded'><img src='$image.png' class='img-fluid'><p>$image </br> $$price</p><button id=\"$image" . "Button\" class='btn btn-block btn-primary' onclick='addToCart(\"$image\", $price)' $disabled>Add to cart</button></div>";
               }
            ?>
         <button class="btn btn-block btn-success my-3" onclick="goToCart()">Go to Cart</button>
</div>
<footer class="jumbotron focus"></footer>
   </body>
</html>
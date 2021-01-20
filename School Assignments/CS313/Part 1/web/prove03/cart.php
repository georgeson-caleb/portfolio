<?php
   session_start();
   $totalPrice = 0;

   foreach($_SESSION["cart"] as $item) {
      $imgName = $item->name . ".png";
      $price = $item->price;

      $totalPrice += floatval($price);

      echo("<div id='$item->name' class='col-sm-12 col-md-6 col-lg-3 m-1 p-2 border rounded'><img src=$imgName class='img-fluid'><p></p><button class='btn btn-danger btn-block' onclick='removeFromCart(\"$item->name\")'>Remove from cart</button></div>");
   }
 
   echo("<div class='w-100'>Total price: $<span id='totalPrice'>$totalPrice</span></div>");

   echo("<div class='d-flex container-fluid'><button class='btn float-left btn-primary' onclick='goShopping()'>Continue shopping</button><button class='btn float-right btn-success' onclick='checkout()'>Checkout</button></div>");

?>
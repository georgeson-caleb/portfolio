<?php

   session_start();

   $address = json_decode(strip_tags($_POST["address"])); 

   // Confirmation message
   $confirmationMessage = "<h2 class='w-100'>Thank you for your order!</h2>";
   // Address
   $confirmationMessage .= "<div id='address' class='w-100 border rounded'>Your order will be shipped to $address->add1 $address->add2 $address->city, $address->state, $address->zip.</div>";
   // Items purchased
   $confirmationMessage .= "<div id='itemsPurchased' class='w-100 border rounded'>These items will be shipped to you:<div class='d-flex'>";

   foreach($_SESSION["cart"] as $item) {
      $confirmationMessage .= "<div id='$item->name' class='col-sm-12 col-md-6 col-lg-3 m-1 p-2 border rounded'><img src='$item->name.png' class='img-fluid'><p>$item->name</p></div>";
   }

   $confirmationMessage .= "</div></div>";

   echo $confirmationMessage;
?>
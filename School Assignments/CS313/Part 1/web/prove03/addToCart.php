<?php 

   session_start();

   $item_json = $_POST["item"];
   $item = json_decode($item_json);
   if ($_SESSION["cart"] == null) {
      $_SESSION["cart"] = array($item);
   } else {
      array_push($_SESSION["cart"], $item);
   }

   $_SESSION["totalPrice"] += floatval($item->price);


   echo($_SESSION["totalPrice"]); 

?>
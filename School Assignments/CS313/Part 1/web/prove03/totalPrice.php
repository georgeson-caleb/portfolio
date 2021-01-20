<?php 

   session_start();

   if (count($_SESSION["cart"]) == 0) {
      $_SESSION["totalPrice"] = 0;  
   }

   echo($_SESSION["totalPrice"]);
?>
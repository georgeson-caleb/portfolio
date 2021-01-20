<?php 
   $password = "what is up";

   echo password_verify($password, password_hash($password, PASSWORD_BCRYPT));
?>
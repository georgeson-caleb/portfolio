<?php 
   require("dbConnect.php");
   require("getUserId.php");

   session_start();

   $db = get_db();

   $username = strip_tags($_POST["username"]);
   $email = strip_tags($_POST["email"]);
   $password = strip_tags($_POST["password"]);

   $uservalid = false;
   $emailvalid = false;

   // Check if the username is taken
   $query = "SELECT username FROM USERS WHERE username=:username;";
   $stmt = $db->prepare($query);
   $stmt->bindValue(':username', $username, PDO::PARAM_STR);
   $stmt->execute();
   $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

   if (count($rows) == 0) {
      $uservalid = true;
   }


   // Check if the email has been used before
   $query = "SELECT username FROM USERS WHERE email=:email;";
   $stmt = $db->prepare($query);
   $stmt->bindValue(':email', $email, PDO::PARAM_STR);
   $stmt->execute();
   $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

   if (count($rows) == 0) {
      $emailvalid = true;
   }


   // All clear - Finish signup
   if ($uservalid & $emailvalid) {
      $tater = password_hash($password, PASSWORD_BCRYPT);

      $query = "INSERT INTO users (username, email, pass) VALUES (:username, :email, :tater);";

      $stmt = $db->prepare($query);
      $stmt->bindValue(':username', $username, PDO::PARAM_STR);
      $stmt->bindValue(':email', $email, PDO::PARAM_STR);
      $stmt->bindValue(':tater', $tater, PDO::PARAM_STR);   
      $stmt->execute();
   } 

   echo "{\"uservalid\":\"$uservalid\", \"emailvalid\":\"$emailvalid\"}";
?> 
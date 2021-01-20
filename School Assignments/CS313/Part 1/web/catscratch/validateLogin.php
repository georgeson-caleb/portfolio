<?php 
   require("dbConnect.php");

   session_start(); 

   $db = get_db();

   $username = strip_tags($_POST["username"]);
   $password = strip_tags($_POST["password"]);
   $query = "SELECT pass, id FROM users WHERE username=:username LIMIT 1";
   $stmt = $db->prepare($query);
   $stmt->bindValue(":username", $username, PDO::PARAM_STR);
   $stmt->execute();

   $userInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);

   if (count($userInfo) == 0) {
      # Invalid username
      echo false;
   } else {
      # check the password
      if (password_verify($password, $userInfo[0]["pass"])) {
        $_SESSION["dq4r1"] = $userInfo[0]["id"];
         echo true;
      } else {
         # Invalid password
         echo false;
      }
   }
   
?>
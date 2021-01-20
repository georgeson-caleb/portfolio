<?php 
   function getUserId($username, $db) {

      $stmt = $db->prepare("SELECT id FROM users WHERE username=:username");
      $stmt->bindValues(':username', $username, PDO::PARAM_STR);
      $stmt->execute();

      $id = $stmt->fetch(PDO::FETCH_ASSOC);

      return $id["id"];
   }
?>
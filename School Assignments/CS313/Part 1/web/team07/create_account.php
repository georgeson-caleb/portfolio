<?php

session_start();

require('dbConnect.php'); 
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);

/*
if(checkExistingUsername($username) > 0) {
    header("location: sign_up.php");
    die();
}
*/

$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$hashed_pass = password_hash($password, PASSWORD_DEFAULT);

//check if passwords match
/*
$passwordVerify = filter_input(INPUT_POST, 'passwordVerify', FILTER_SANITIZE_STRING);
if($password != $passwordVerify) {
    $warning = "<p style='color:red'>The passwords do not match</p>";
    header("location: sign_up.php");
}*/

addUser($username, $hashed_pass);
header("location: sign_in.php");
die();

var_dump($num);
if($num > 0 ) {
    // $_SESSION['userId'] = getUserId($username);
    // $_SESSION['username'] = $username;
    
    die();
}
else {
    //header("location: sign_up.php");
    //die();
}

//check existing username and returns 1 if username is used
function checkExistingUsername($username){
    $db = get_db();
    $query = "SELECT username FROM users_team WHERE username = (:username)";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);  
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

//returns 1 if successful
function addUser($username, $password) {
    $db = get_db();
    $query = 'INSERT INTO users_team (username, password) VALUES (:username, :password)';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);
    $stmt->execute();
    //$rowsChanged = $stmt->rowCount();
    $rowsChanged = pg_affected_rows($stmt);
    $stmt->closeCursor();
}

function getUserId($username) {
    $db = get_db();
    $query = "SELECT user_id FROM users_team WHERE username = (:username)";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $stmt->closeCursor();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $userId = $row['user_id'];
    }
    return $userId;
}

?>


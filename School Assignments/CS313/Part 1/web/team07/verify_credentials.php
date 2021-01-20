<?php
session_start();
require("dbConnect.php");
$db = get_db();

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

$stmt = $db->prepare("SELECT user_id, password FROM users_team WHERE username=:username LIMIT 1");
$stmt->bindValue(":username", $username, PDO::PARAM_STR);
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);
echo(json_encode($row));
$id = $row["user_id"];
$password_hash = $row["password"];

if(password_verify($password, $password_hash)) {
    $_SESSION['loggedin'] = TRUE;
    $_SESSION['user_id'] = $id;
    $_SESSION['username'] = $username;
    header('Location: welcome.php');
    die();
}
else {
    echo("Invalid credentials.");
}

?>


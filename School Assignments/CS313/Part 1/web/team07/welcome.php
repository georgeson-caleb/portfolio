<!DOCTYPE html>
<html lang="en-US">
<head>
<title>Welcome!</title>
<head>
<body>
    <header><h1>Welcome!</h1></header>
    <?php 

        session_start();

        if(isset($_SESSION['username'])){
            echo "<h1>Welcome" . $_SESSION['username'] . "</h1>";
        }
    ?>
    <div id="buttons">
    <button onclick="window.location.href='sign_up.php'">Sign up!</button>
    <button onclick="window.location.href='sign_in.php'">Sign in!</button>
    </div>
</body>
</html>
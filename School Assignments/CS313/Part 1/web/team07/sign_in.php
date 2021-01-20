<!DOCTYPE html>
<html lang="en-US">
<head>
<title>Welcome!</title>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
<script src="sign_in_verify.js"></script>
<head>
<body>
<header><h1>Sign in</h1></header>

<a href="sign_up.php">Sign Up</a>
<br><br>

<div id="login">
   <div style="display:none; color:red;" id="error"></div>
   <input type="text" id="username" name="username" placeholder="Username">
   <input type="password" id="password" name="password" placeholder="Password">
   <button type="button" onclick="submitInfo()">Sign in!</button>
</div>

</body>
</html>
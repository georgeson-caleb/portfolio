<?php
   session_start();
?>
<!DOCTYPE HTML>
<html lang="en-US">
   <head>
      <title>Catscratch - Share Your Kitties</title>
      <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="script.js"></script>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <link rel="stylesheet" href="style.css">
      <meta name="viewport" content="width=device-width, initial-scale=1">
   </head>
   <body>
      <header class="jumbotron" id="top">
         <h1>Catscratch</h1>
      </header>
      <div class="d-flex flex-wrap border rounded mx-auto my-4">
         <div id="filler" class="border rounded col-lg-6 col-md-6 col-sm-12 mx-0 my-4">
            <div id="carousel" class="carousel slide" data-ride="carousel">
               <ul class="carousel-indicators">
                 <li data-target="#carousel" data-slide-to="0" class="active"></li>
                 <li data-target="#carousel" data-slide-to="1"></li>
                 <li data-target="#carousel" data-slide-to="2"></li>
               </ul>            
               <div class="carousel-inner">
                 <div class="carousel-item active">
                   <img src="img/cat4.jpg" class="img-fluid" alt="kitty">
                 </div>
                 <div class="carousel-item">
                   <img src="img/cat2.jpg" class="img-fluid" alt="kitty">
                 </div>
                 <div class="carousel-item">
                   <img src="img/cat3.jpg" class="img-fluid" alt="kitty">
                 </div>
               </div>
               <a class="carousel-control-prev" href="#carousel" data-slide="prev">
                 <span class="carousel-control-prev-icon"></span>
               </a>
               <a class="carousel-control-next" href="#carousel" data-slide="next">
                 <span class="carousel-control-next-icon"></span>
               </a>
             </div>
         </div>
         <div id="login" class="border rounded col-lg-3 col-md-3 col-sm-12 mx-0 my-4 p-3"> 
            <form>
               <span id="loginError" class="error"></span>
               <input type="text" class="mx-auto my-1 border rounded p-2" id="username" placeholder="Username"><br>
               <input type="password" class="mx-auto my-1 border rounded p-2" id="password" placeholder="Password"><br>
               <button type="button" class="btn btn-primary mx-auto my-1 border rounded" onclick="login()">Login</button>
            </form>
         </div>
         <div id="signup" class="border rounded col-lg-3 col-md-3 col-sm-12 mx-0 my-4 p-3">
            <form>
               <input type="text" class="mx-auto my-1 border rounded p-2" id="usernameSignup" placeholder="Username"><br>
               <span id="usernameSignupError" class="error">* Username can't have spaces.</span><br>
               <input type="text" class="mx-auto my-1 border rounded p-2" id="email" placeholder="Email"><br>
               <span id="emailError" class="error">* Please enter a valid email.</span><br>
               <input type="password" class="mx-auto my-1 border rounded p-2" id="password1" placeholder="Password"><br>
               <span id="passwordError" class="error">Passwords must match</span><br>
               <input type="password" class="mx-auto my-1 border rounded p-2" id="password2" placeholder="Verify Password"><br>
               <button type="button" class="btn btn-success mx-auto my-1 border rounded" onclick="signup()">Sign Up!</button>
            </form>
         </div>
      </div>
      <footer class="jumbotron float-bottom" id="bottom">
         &copy Catscratch 2020
      </footer>
   </body>
</html>
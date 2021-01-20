<!DOCTYPE html>
<html>
   <head>
      <title>
         My Assignments
      </title>
      <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
      <script src="script.js"></script>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <link rel="stylesheet" href="style.css">
      <meta name="viewport" content="width=device-width, initial-scale=1">
   </head>
   <body>
      <header id="title-header" class="jumbotron"><h1>My Assignments</h1></header>
      
      <div>
      <ul>
      <?php 
      
      $dir = '../';
      $files = array_diff(scandir($dir), array('..', '.', 'index.php'));

      foreach ($files as $f) {
         $line = '<li><a href="../' . $f . '/">' . $f . '</a></li>';
         echo $line;
      }



      ?>
      </ul>
      </div>
      
   </body>
</html>
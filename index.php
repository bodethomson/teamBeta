<?php 
  session_start(); 
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['email']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Dashboard</title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
  </head>
  <body>
    <div class="container">
      <div class="jumbotron">
      <?php  if (isset($_SESSION['email'])) : ?>
        <h1 class="display-3">Welcome <?php echo $_SESSION['email']; ?></h1>
      <?php endif ?>

      <?php if (isset($_SESSION['success'])) : ?>
        <p class="lead">
          <?php 
          echo $_SESSION['success']; 
          ?>
        </p>
      <?php endif ?>
      <hr class="my-2" />
        <p class="lead"><a href="index.php?logout='1'" style="color: red;">logout</a></p>
      </div>
    </div>
  </body>
</html>

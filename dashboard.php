<?php
    include 'config.php';
    session_start();
    $row = $_SESSION['data'];
?>

<!DOCTYPE html>
<html>
    <head>
        <script src="https://apis.google.com/js/api:client.js"></script>
    <script>
      var googleUser = {};
      var startApp = function() {
        gapi.load('auth2', function(){
          // Retrieve the singleton for the GoogleAuth library and set up the client.
          auth2 = gapi.auth2.init({
            client_id: '784139540114-fkhbj4ljkun0u8cba64139mgksuedevu.apps.googleusercontent.com',
            cookiepolicy: 'single_host_origin',
            // Request scopes in addition to 'profile' and 'email'
            //scope: 'additional_scope'
          });
        });
      };
      </script>
        <meta charset="utf-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <link rel="stylesheet" href="css/dashboard_style.css" type="text/css">
        
        <link 
          rel="stylesheet" 
          href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" 
          crossorigin="anonymous"
        />

        <link 
          href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC|Boogaloo|Caveat+Brush|Major+Mono+Display|Pacifico" 
          rel="stylesheet"
        >
        <title>Dashboard</title>
    </head>

    <body>
        <div id="bg-image">
            <div class="text-center" id="dominant_text">
                <h1 style="font-family: 'Pacifico', cursive;">Hello, <?php echo $row[0]['user_name'];?></h1>
                <hr class="my-4" style="border-color: white;">
                <p id="name" class="lead" style="font-size: 30px;">Welcome to teamBeta</p>
                <a href='#' onclick="signOut();">Sign out</a>
            </div>
        </div>

        <script>
            startApp();
        </script>
        <script>
            
            function signOut() {
            var auth2 = gapi.auth2.getAuthInstance();
            auth2.signOut().then(function () {
                <?php
                  session_destroy();  
                ?>
                document.location = 'index.php'; 
            });
        }
        </script>

        <script 
          src="https://code.jquery.com/jquery-3.2.1.slim.min.js" 
          integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" 
          crossorigin="anonymous"
        ></script>
        
        <script 
          src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" 
          integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" 
          crossorigin="anonymous"
        ></script>
        
        <script 
          src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" 
          integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" 
          crossorigin="anonymous"
        ></script>
    </body>
</html>


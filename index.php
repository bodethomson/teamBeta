<?php
    include 'config.php';
    session_start();
    setcookie("user","aaa");
    setcookie("email","baa");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>TeamBeta</title>
    <link rel="stylesheet" href="css/main.css" />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.1.1/css/all.css"
      integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ"
      crossorigin="anonymous"
    />
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
          attachSignin(document.getElementById('signIn'));
        });
      };

      function attachSignin(element) {
        console.log(element.id);
        auth2.attachClickHandler(element, {},
            function(googleUser) {
              var name = googleUser.getBasicProfile().getName();
              var email = googleUser.getBasicProfile().getEmail();
              document.cookie = 'user' + '=' + name + ';';
              document.cookie = 'email' + '=' + email + ';';
              
              <?php
                $name = $_COOKIE['user'];
                $email = $_COOKIE['email'];

                $first_query = "SELECT * FROM users WHERE user_name = '$name' AND user_email = '$email'";
                $perform_query = $conn->prepare($first_query);
                $perform_query->execute();

                $row = $perform_query->fetchAll();
                $_SESSION['data'] = $row;

                if (!$row){
                  $some_query = "INSERT INTO users(user_name, user_email) VALUES ('$name', '$email')";
                  $exec_query = $conn->prepare($some_query);
                  $exec_query->execute();

                  $first_query = "SELECT * FROM users WHERE user_name = '$name' AND user_email = '$email'";
                  $select_query = $conn->prepare($first_query);
                  $select_query->execute();
                  
                  $row1 = $select_query->fetchAll();
                  $_SESSION['data'] = $row1;
                ?>
                  document.location = 'dashboard.php'; 
                <?php
                }

                else {
                ?>
                    document.location = 'dashboard.php';
                 
                <?php
                }
                ?>
              
            }, function(error) {
              alert(JSON.stringify(error, undefined, 2));
              }
        );
      }
    </script>
  </head>
  <body>
    <div id="root">
      <section class="d-flex flex-column m-auto p-5 section">
        <h1>Welcome Back <strong>Beta</strong></h1>
        <div class="contact">
          <img
            src="https://res.cloudinary.com/bodethomson/image/upload/v1568780205/contact_euphb2.png"
            id="contact-image"
            alt="contact"
          />
        </div>
        
        <div class="form-group" style="margin-bottom: -30px;">
            <button class="form-control btn g-btn" type="submit" id="signIn">
            <img
                src="https://res.cloudinary.com/bodethomson/image/upload/v1568780187/google_p8rauw.png"
                alt="google"
            />
            <span> Continue with Google</span>
            </button>
        </div>
        
        <form action="validate.php" method="POST">
          
          <div id="email">
            <p>OR SIGN IN WITH EMAIL</p>
          </div>
          <div class="form-group input-group">
            <span class="input-group-prepend">
              <i class="fas fa-envelope input-group-text"></i>
            </span>
            <input
              name="form_email"
              type="text"
              class="form-control"
              placeholder="Email address"
            />
          </div>
          <div class="form-group input-group">
            <span class="input-group-prepend">
              <i class="fas fa-lock input-group-text"></i>
            </span>
            <input name="form_password" type="password" class="form-control" placeholder="Password"/>
          </div>
          <button name="submit" type="submit" class="form-control btn login-btn">
            Login
          </button>
          <?php
            if (isset($_SESSION['error'])) {
                echo '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">'.$_SESSION['error'].'</div>';
            }
          ?>
          <div class="form-group form-check">
            <div id="checkbox">
              <input type="checkbox" class="form-check-input" />
              <label class="form-check-label" for="checkbox">Remember Me</label>
            </div>
            <a href="forgotpassword.html">Forgot Password?</a>
          </div>
        </form>
      </section>
      <section id="right">
        <div></div>
        <div class="sign-up">
          <h5>YOU'RE NOT A BETA?</h5>
          <button
            class="btn form-control sign-up-btn"
            data-toggle="modal"
            data-target="#exampleModalCenter"
          >
            Sign Up
          </button>
        </div>
        <div id="illustration"></div>
      </section>
    </div>

    <!-- Sign Up Modal -->
    <div
      class="modal fade bg-secondary"
      id="exampleModalCenter"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content p-3">
          <div class="modal-header">
            <h3 class="modal-title" id="exampleModalCenterTitle">
              Sign Up
            </h3>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true" style="color: #000; font-size: 1em"
                >&times;</span
              >
            </button>
          </div>
          <div class="modal-body">
            <span>Enter your credentials</span>
            <form action="signup.php" method="POST">
               <div class="form-group input-group">
                <span class="input-group-prepend">
                  <i class="fas fa-user input-group-text"></i>
                </span>
                <input
                  name="form_name"
                  type="text"
                  class="form-control"
                  placeholder="Your Full Name"
                  minlength="4"
                  required
                />
              </div>
              <div class="form-group input-group">
                <span class="input-group-prepend">
                  <i class="fas fa-envelope input-group-text"></i>
                </span>
                <input
                  name="form_email"
                  type="email"
                  class="form-control"
                  placeholder="Email address"
                  required
                />
              </div>
              <div class="form-group input-group">
                <span class="input-group-prepend">
                  <i class="fas fa-lock input-group-text"></i>
                </span>
                <input
                  name="form_password"
                  type="password"
                  class="form-control"
                  placeholder="Password"
                  required
                />
              </div>
              <div class="form-group input-group">
                <span class="input-group-prepend">
                  <i class="fas fa-lock input-group-text"></i>
                </span>
                <input
                  name="form_confirm"
                  type="password"
                  class="form-control"
                  placeholder="Confirm Password"
                  required
                />
              </div>
              <div class="modal-footer">
                <button name="submit" type="submit" class="btn btn-success">
                  Sign Up
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script src="script/script.js"></script>
    <script>
      startApp();
    </script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
      crossorigin="anonymous"
    ></script>
  </body>
</html>


<?php
    #session_destroy();
?>
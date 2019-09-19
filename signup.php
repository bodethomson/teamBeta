<?php
    include 'config.php';
    
if (isset($_POST['submit'])) {
        $name = $_POST['form_name'];
        $email = $_POST['form_email'];
        $password = $_POST['form_password'];
        $confirm = $_POST['form_confirm'];

        session_start();

        $first_query = "SELECT * FROM users WHERE user_email = '$email'";
        $perform_query = $conn->prepare($first_query);
        $perform_query->execute();

        $row = $perform_query->fetch(PDO::FETCH_BOTH);

        if(!$row) {

            if ($password != $confirm) {
                $_SESSION['notconfirmed'] = "Passwords didn't match";
                header("Location: incorrect_password.php");
            }

            else {
                $query = "INSERT INTO users(user_name, user_email, user_password) VALUES ('$name', '$email','$password')";
                $query = $conn->prepare($query);
                $query->execute();
    
                $_SESSION['confirmed'] = 'Success';
                header("Location: success.php");
            }
        } 

        else {
            echo "<div class='alert alert-warning' role='alert' style='margin-top: 20px;'>You've signed up previously</div>";
            echo  '<div class="alert alert-info" role="alert" style="margin-top: 20px;">Redirect back to home page in 5 seconds...</div>';
            header("Refresh:5;url=index.php");
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
            crossorigin="anonymous"
        />
    </head>
    <body>
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
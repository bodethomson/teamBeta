<?php
    include 'config.php';
    
    if(isset($_POST['submit'])){
        $email = $_POST['form_email'];
        $password = $_POST['form_password'];
        session_start();

        $first_query = "SELECT * FROM users WHERE user_email = '$email' AND user_password = '$password'";
        $perform_query = $conn->prepare($first_query);
        $perform_query->execute();

        $row = $perform_query->fetch(PDO::FETCH_BOTH);
        $_SESSION['data'] = $row;
        
        if (!$row){
            $_SESSION['error'] = 'Invalid login details';
            header("Location: index.php");
        }
        else {
            header("Location: dashboard.php");
        }
    }
?>
<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "beta_records";


try {
    $conn = new PDO("mysql:host=$host;dbname=beta_records", $user, $password);
    // set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

    #'expires=Thu, 18 Dec 2013 12:00:00 UTC'
?>
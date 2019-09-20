<?php
$host = "localhost";
$user = "id10939570_teambeta";
$password = "naruto";
$dbname = "id10939570_teambeta";


try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    // set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

    #'expires=Thu, 18 Dec 2013 12:00:00 UTC'
?>
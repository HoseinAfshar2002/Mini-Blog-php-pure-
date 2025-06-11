<?php
$serverName = "localhost";
$userName = "root";
$password = "";
try {
    $connection = new PDO("mysql:host=$serverName;dbname=Weblog", $userName, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "موفق";
} catch (PDOException $e) {
    echo "دیتا بیس متصل نیست" . $e->getMessage();
}
 
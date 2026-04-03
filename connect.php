<?php
$serverName = "localhost";
$userName = "root"; 
$userPassword = ""; 
$dbname = "cafe_db"; 

try {
    
    $conn = new PDO("mysql:host=$serverName;dbname=$dbname;charset=utf8", $userName, $userPassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed : " . $e->getMessage();
}
?>
<?php

$host = 'localhost';  
$dbname = 'signup';  
$username = 'root'; 
$password = '';  

try {
    
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
    
    $pdo = new PDO($dsn, $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected successfully to the database!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

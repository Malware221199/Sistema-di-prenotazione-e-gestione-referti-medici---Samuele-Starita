<?php

$host = "prova";
$db   = "prova";     
$user = "prova";    
$pass = "prova";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8",
        $user,
        $pass,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    die("Errore connessione DB: " . $e->getMessage());
}
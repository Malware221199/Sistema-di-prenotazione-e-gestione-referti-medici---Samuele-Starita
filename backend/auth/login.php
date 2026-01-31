<?php

session_start();
require_once "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email    = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";

    if (!$email || !$password) {
        die("Dati mancanti");
    }

    $stmt = $pdo->prepare("SELECT * FROM utenti WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user) {
        die("Credenziali non valide");
    }

    if (!password_verify($password, $user["password_hash"])) {
        die("Credenziali non valide");
    }

    $_SESSION["user_id"] = $user["id"];
    $_SESSION["ruolo"]   = $user["ruolo"];

    header("Location: /{$user['ruolo']}/dashboard.php");
    exit;
}

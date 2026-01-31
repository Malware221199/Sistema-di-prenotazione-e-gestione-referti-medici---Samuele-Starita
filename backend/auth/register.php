<?php

require_once __DIR__ . '/../config/database.php';

// Registrazione
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome           = $_POST["nome"] ?? "";
    $cognome        = $_POST["cognome"] ?? "";
    $data_nascita   = $_POST["data_nascita"] ?? "";
    $codice_fiscale = $_POST["codice_fiscale"] ?? "";
    $email          = $_POST["email"] ?? "";
    $password       = $_POST["password"] ?? "";

    if (
        !$nome ||
        !$cognome ||
        !$data_nascita ||
        !$codice_fiscale ||
        !$email ||
        !$password
    ) {
        die("Dati mancanti");
    }

    // Controllo email già esistente
    $stmt = $pdo->prepare("SELECT id FROM utenti WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        die("Email già registrata");
    }

    // Controllo codice fiscale già esistente
    $stmt = $pdo->prepare("SELECT id FROM pazienti WHERE codice_fiscale = ?");
    $stmt->execute([$codice_fiscale]);

    if ($stmt->rowCount() > 0) {
        die("Codice fiscale già registrato");
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("
        INSERT INTO utenti (email, password_hash, ruolo)
        VALUES (?, ?, 'paziente')
    ");
    $stmt->execute([$email, $password_hash]);

    // Recupero id nuovo utente
    $utente_id = $pdo->lastInsertId();

    $stmt = $pdo->prepare("
        INSERT INTO pazienti (
            utente_id,
            nome,
            cognome,
            data_nascita,
            codice_fiscale
        ) VALUES (?, ?, ?, ?, ?)
    ");
    $stmt->execute([
        $utente_id,
        $nome,
        $cognome,
        $data_nascita,
        $codice_fiscale
    ]);

    header("Location: /login.php");
    exit;
}

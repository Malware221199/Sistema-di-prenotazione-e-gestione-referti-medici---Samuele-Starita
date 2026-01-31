<?php

require_once __DIR__ . '/../session.php';
require_once __DIR__ . '/../config/database.php';

$user_id = $_SESSION["user_id"];
$ruolo   = $_SESSION["ruolo"];

// Solo medico
if ($ruolo !== "medico") {
    die("Accesso negato");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $prenotazione_id = $_POST["prenotazione_id"] ?? null;
    $file = $_FILES["referto"] ?? null;

    if (!$prenotazione_id || !$file) {
        die("Dati mancanti");
    }

    $stmt = $pdo->prepare("SELECT id FROM medici WHERE utente_id = ?");
    $stmt->execute([$user_id]);
    $medico = $stmt->fetch();

    if (!$medico) {
        die("Medico non trovato");
    }

    $stmt = $pdo->prepare("
        SELECT id 
        FROM prenotazioni 
        WHERE id = ? AND medico_id = ?
    ");
    $stmt->execute([$prenotazione_id, $medico["id"]]);

    if ($stmt->rowCount() === 0) {
        die("Prenotazione non valida");
    }

    $nome_file = time() . "_" . basename($file["name"]);
    $upload_dir = __DIR__ . '/../../uploads/referti/';
;

    if (!is_dir($upload_dir)) {
        die("Cartella uploads inesistente");
    }

    $path = $upload_dir . $nome_file;

    if (!move_uploaded_file($file["tmp_name"], $path)) {
        die("Errore nel salvataggio del file");
    }

    // Inserimento referto
    $stmt = $pdo->prepare("
        INSERT INTO referti (prenotazione_id, file_pdf)
        VALUES (?, ?)
    ");
    $stmt->execute([$prenotazione_id, $nome_file]);

    $stmt = $pdo->prepare("
        UPDATE prenotazioni
        SET stato = 'effettuata'
        WHERE id = ?
    ");
    $stmt->execute([$prenotazione_id]);

    header("Location: /medico/dashboard.php");
    exit;
}

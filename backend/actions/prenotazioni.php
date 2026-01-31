<?php

require_once __DIR__ . '/../session.php';
require_once __DIR__ . '/../config/database.php';


$user_id = $_SESSION["user_id"];
$ruolo   = $_SESSION["ruolo"];

if ($ruolo === "paziente" && $_SERVER["REQUEST_METHOD"] === "POST") {

    $medico_id   = $_POST["medico_id"] ?? null;
    $data_visita = $_POST["data_visita"] ?? null;

    if (!$medico_id || !$data_visita) {
        die("Dati mancanti");
    }

    // Recupero id paziente
    $stmt = $pdo->prepare("SELECT id FROM pazienti WHERE utente_id = ?");
    $stmt->execute([$user_id]);
    $paziente = $stmt->fetch();

    if (!$paziente) {
        die("Paziente non trovato");
    }

    $stmt = $pdo->prepare("
        INSERT INTO prenotazioni (paziente_id, medico_id, data_visita, stato)
        VALUES (?, ?, ?, 'prenotata')
    ");

    $stmt->execute([
        $paziente["id"],
        $medico_id,
        $data_visita
    ]);

    header("Location: /paziente/dashboard.php");
    exit;

}

if ($ruolo === "paziente") {

    $stmt = $pdo->prepare("SELECT id FROM pazienti WHERE utente_id = ?");
    $stmt->execute([$user_id]);
    $paziente = $stmt->fetch();

    $stmt = $pdo->prepare("
        SELECT 
            p.id,
            p.data_visita,
            p.stato,
            m.nome AS medico_nome,
            m.specializzazione
        FROM prenotazioni p
        JOIN medici m ON p.medico_id = m.id
        WHERE p.paziente_id = ?
        ORDER BY p.data_visita DESC
    ");

    $stmt->execute([$paziente["id"]]);

} elseif ($ruolo === "medico") {

    $stmt = $pdo->prepare("SELECT id FROM medici WHERE utente_id = ?");
    $stmt->execute([$user_id]);
    $medico = $stmt->fetch();

    $stmt = $pdo->prepare("
        SELECT 
            p.id,
            p.data_visita,
            p.stato,
            u.email AS paziente_email
        FROM prenotazioni p
        JOIN pazienti pa ON p.paziente_id = pa.id
        JOIN utenti u ON pa.utente_id = u.id
        WHERE p.medico_id = ?
        ORDER BY p.data_visita DESC
    ");

    $stmt->execute([$medico["id"]]);

} else {
    die("Ruolo non valido");
}

$prenotazioni = $stmt->fetchAll(PDO::FETCH_ASSOC);

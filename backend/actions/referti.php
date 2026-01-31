<?php

require_once __DIR__ . '/../session.php';
require_once __DIR__ . '/../config/database.php';

$user_id = $_SESSION["user_id"];
$ruolo   = $_SESSION["ruolo"];

if ($ruolo === "paziente") {

    $stmt = $pdo->prepare("
        SELECT id 
        FROM pazienti 
        WHERE utente_id = ?
    ");
    $stmt->execute([$user_id]);
    $paziente = $stmt->fetch();

    if (!$paziente) {
        die("Paziente non trovato");
    }

    $stmt = $pdo->prepare("
        SELECT
            p.data_visita,
            p.stato,
            m.nome AS medico_nome,
            r.file_pdf
        FROM prenotazioni p
        JOIN medici m ON p.medico_id = m.id
        LEFT JOIN referti r ON r.prenotazione_id = p.id
        WHERE p.paziente_id = ?
        ORDER BY p.data_visita DESC
    ");

    $stmt->execute([$paziente["id"]]);
}

elseif ($ruolo === "medico") {

    $stmt = $pdo->prepare("
        SELECT id 
        FROM medici 
        WHERE utente_id = ?
    ");
    $stmt->execute([$user_id]);
    $medico = $stmt->fetch();

    if (!$medico) {
        die("Medico non trovato");
    }

    $stmt = $pdo->prepare("
        SELECT
            p.data_visita,
            p.stato,
            u.email AS paziente_email,
            r.file_pdf
        FROM prenotazioni p
        JOIN pazienti pa ON p.paziente_id = pa.id
        JOIN utenti u ON pa.utente_id = u.id
        LEFT JOIN referti r ON r.prenotazione_id = p.id
        WHERE p.medico_id = ?
        ORDER BY p.data_visita DESC
    ");

    $stmt->execute([$medico["id"]]);
}

else {
    die("Ruolo non valido");
}

$referti = $stmt->fetchAll(PDO::FETCH_ASSOC);

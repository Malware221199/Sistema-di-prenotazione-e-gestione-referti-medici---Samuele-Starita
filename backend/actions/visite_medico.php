<?php

require_once __DIR__ . '/../session.php';
require_once __DIR__ . '/../config/database.php';


$user_id = $_SESSION["user_id"];
$ruolo   = $_SESSION["ruolo"];

if ($ruolo !== "medico") {
    die("Accesso negato");
}

$stmt = $pdo->prepare("SELECT id FROM medici WHERE utente_id = ?");
$stmt->execute([$user_id]);
$medico = $stmt->fetch();

if (!$medico) {
    die("Medico non trovato");
}

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
    ORDER BY p.data_visita ASC
");

$stmt->execute([$medico["id"]]);

$visite = $stmt->fetchAll(PDO::FETCH_ASSOC);

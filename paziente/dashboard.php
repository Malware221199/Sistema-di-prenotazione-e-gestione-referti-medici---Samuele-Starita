<?php
require_once __DIR__ . '/../backend/session.php';

if ($_SESSION['ruolo'] !== 'paziente') {
    header("Location: /login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Paziente</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <span class="navbar-brand">Area Paziente</span>
        <a href="/backend/auth/logout.php" class="btn btn-outline-light btn-sm">Logout</a>
    </div>
</nav>

<div class="container mt-5">

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h4 class="card-title">Benvenuto nella tua area riservata</h4>
            <p class="text-muted mb-0">
                Da qui puoi gestire le prenotazioni e consultare gli esiti delle visite.
            </p>
        </div>
    </div>

    <div class="row g-4">

        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Prenota una visita</h5>
                    <p class="card-text">
                        Prenota una nuova visita medica scegliendo il medico e la disponibilità.
                    </p>
                    <a href="prenota.php" class="btn btn-primary mt-auto">
                        Vai alla prenotazione
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Esiti e referti</h5>
                    <p class="card-text">
                        Consulta l’elenco delle visite effettuate e scarica i referti disponibili.
                    </p>
                    <a href="referti.php" class="btn btn-outline-primary mt-auto">
                        Visualizza referti
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>

</body>
</html>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Gestione Prenotazioni e Referti Medici</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">Sistema Sanitario</a>
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Accedi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Registrati</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/backend/auth/logout.php">Logout</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>


<section class="py-5 text-center bg-white">
    <div class="container">
        <h1 class="display-5 fw-bold">Sistema di Prenotazione e Gestione Referti Medici</h1>
        <p class="lead mt-3">
            Questa webapp e' stata sviluppata come Project Work universitario, consente la gestione delle visite e dei relativi referti di una struttura sanitaria privata.
        </p>
    </div>
</section>

<section class="container my-5">
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Area Paziente</h5>
                    <ul class="list-unstyled">
                        <li>Consente di prenotare visite o visualizzare e scaricare referti di visite gia sostenute.</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Area Medico</h5>
                    <ul class="list-unstyled">
                        <li>Consente di visualizzare visite da sostenere e caricare referti di visite gia sostenute</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="text-center my-5">
    <a href="login.php" class="btn btn-outline-primary btn-lg me-3">Accedi</a>
    <a href="register.php" class="btn btn-outline-primary btn-lg">Registrati come Paziente</a>
</section>

<footer class="bg-white py-4 mt-5 border-top">
    <div class="container text-center text-muted">
        <p class="mb-1">
            Project Work – Informatica per le Aziende Digitali
        </p>
        <p class="mb-0">
            Studente: <strong>Samuele Starita</strong>
        </p>
    </div>
</footer>

</body>
</html>

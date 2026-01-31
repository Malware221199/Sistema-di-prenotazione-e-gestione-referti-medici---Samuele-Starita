<?php

require_once __DIR__ . '/../backend/session.php';


if ($_SESSION['ruolo'] !== 'medico') {
    header("Location: /login.php");
    exit;
}


if (!isset($_GET['id'])) {
    die("ID prenotazione mancante");
}

$prenotazioneId = (int) $_GET['id'];
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Carica referto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-success">
    <div class="container">
        <a href="dashboard.php" class="navbar-brand">Area Medico</a>
        <a href="/backend/auth/logout.php" class="btn btn-outline-light btn-sm">Logout</a>
    </div>
</nav>

<div class="container mt-5">

    <div class="card shadow-sm">
        <div class="card-body">
            <h4>Carica referto PDF</h4>

            <form action="/backend/actions/upload_referto.php"
                  method="POST"
                  enctype="multipart/form-data">

                <input type="hidden" name="prenotazione_id"
                       value="<?= htmlspecialchars($prenotazioneId) ?>">

                <div class="mb-3">
                    <label class="form-label">Referto (PDF)</label>
                    <input type="file"
                           name="referto"
                           class="form-control"
                           accept="application/pdf"
                           required>
                </div>

                <button type="submit" class="btn btn-primary">
                    Carica referto
                </button>
            </form>
        </div>
    </div>

</div>

</body>
</html>

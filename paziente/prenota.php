<?php

require_once __DIR__ . '/../backend/session.php';

if ($_SESSION['ruolo'] !== 'paziente') {
    header("Location: /login.php");
    exit;
}

require_once __DIR__ . '/../backend/actions/medici.php';
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Prenota una visita</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <a href="dashboard.php" class="navbar-brand">Area Paziente</a>
        <a href="/backend/auth/logout.php" class="btn btn-outline-light btn-sm">Logout</a>
    </div>
</nav>

<div class="container mt-5">

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h4 class="card-title">Prenota una visita</h4>
            <p class="text-muted mb-0">
                Seleziona il medico e la data per prenotare una visita.
            </p>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="/backend/actions/prenotazioni.php" method="POST">

                <div class="mb-3">
                    <label class="form-label">Medico</label>
                    <select name="medico_id" class="form-select" required>
                        <option value="">Seleziona un medico</option>
                        <?php foreach ($medici as $m): ?>
                            <option value="<?= $m['id'] ?>">
                                <?= htmlspecialchars($m['nome']) ?> – <?= htmlspecialchars($m['specializzazione']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Data visita</label>
                    <input type="date" name="data_visita" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">
                    Prenota visita
                </button>
            </form>

        </div>
    </div>

</div>

</body>
</html>

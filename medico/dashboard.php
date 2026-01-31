<?php

require_once __DIR__ . '/../backend/session.php';

if ($_SESSION['ruolo'] !== 'medico') {
    header("Location: /login.php");
    exit;
}

require_once __DIR__ . '/../backend/actions/visite_medico.php';
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Medico</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-success">
    <div class="container">
        <span class="navbar-brand">Area Medico</span>
        <a href="/backend/auth/logout.php" class="btn btn-outline-light btn-sm">Logout</a>
    </div>
</nav>

<div class="container mt-5">

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h4>Visite assegnate</h4>
            <p class="text-muted mb-0">Elenco visite.</p>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Data</th>
                        <th>Paziente</th>
                        <th>Stato</th>
                        <th>Referto</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($visite)): ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted">
                            Nessuna visita assegnata
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($visite as $v): ?>
                        <tr>
                            <td><?= htmlspecialchars($v["data_visita"]) ?></td>
                            <td><?= htmlspecialchars($v["paziente_email"]) ?></td>
                            <td><?= htmlspecialchars($v["stato"]) ?></td>
                            <td>
                                <a href="upload_referto.php?id=<?= $v["id"] ?>"
                                   class="btn btn-sm btn-primary">
                                    Carica referto
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>

        </div>
    </div>

</div>

</body>
</html>

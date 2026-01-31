<?php

require_once __DIR__ . '/../backend/session.php';

if ($_SESSION['ruolo'] !== 'paziente') {
    header("Location: /login.php");
    exit;
}

require_once __DIR__ . '/../backend/actions/referti.php';
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Referti ed esiti</title>
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
            <h4>Esiti e referti delle visite</h4>
            <p class="text-muted mb-0">
                In questa sezione puoi consultare lo stato delle tue visite e scaricare i referti disponibili.
            </p>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Data visita</th>
                        <th>Medico</th>
                        <th>Stato</th>
                        <th>Referto</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($referti)): ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted">
                            Nessuna visita trovata
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($referti as $r): ?>
                        <tr>
                            <td><?= htmlspecialchars($r['data_visita']) ?></td>
                            <td><?= htmlspecialchars($r['medico_nome'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($r['stato'] ?? '-') ?></td>
                            <td>
                                <?php if (!empty($r['file_pdf'])): ?>
                                    <a href="/uploads/referti/<?= htmlspecialchars($r['file_pdf']) ?>"
                                       target="_blank">
                                        Scarica
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted">Non disponibile</span>
                                <?php endif; ?>
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

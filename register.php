<?php

session_start();

if (isset($_SESSION['ruolo'])) {
    header("Location: /paziente/dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Registrazione Paziente</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="text-center mb-4">Registrazione Paziente</h3>

                    <form action="/backend/auth/register.php" method="POST">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nome</label>
                                <input type="text" name="nome" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Cognome</label>
                                <input type="text" name="cognome" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Data di nascita</label>
                            <input type="date" name="data_nascita" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Codice fiscale</label>
                            <input type="text"
                                   name="codice_fiscale"
                                   class="form-control"
                                   maxlength="16"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Registrati
                        </button>
                    </form>

                    <div class="text-center mt-3">
                        <a href="login.php">Hai già un account? Accedi</a>
                    </div>

                    <div class="text-center mt-2">
                        <a href="index.php">Torna alla home</a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>

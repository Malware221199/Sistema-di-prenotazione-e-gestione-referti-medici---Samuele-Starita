<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect automatico se già loggato
if (isset($_SESSION['ruolo'])) {
    if ($_SESSION['ruolo'] === 'paziente') {
        header('Location: paziente/dashboard.php');
        exit;
    } elseif ($_SESSION['ruolo'] === 'medico') {
        header('Location: medico/dashboard.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="text-center mb-4">Accesso al sistema</h3>

                    <form action="/backend/auth/login.php" method="POST">

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Accedi
                        </button>
                    </form>

                    <div class="text-center mt-3">
                        <a href="register.php">Non hai un account? Registrati</a>
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

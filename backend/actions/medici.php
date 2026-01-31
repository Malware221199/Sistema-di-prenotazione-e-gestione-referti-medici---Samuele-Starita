<?php
require_once __DIR__ . '/../config/database.php';

// Lista medici
$stmt = $pdo->query("
    SELECT id, nome, specializzazione
    FROM medici
    ORDER BY nome
");

$medici = $stmt->fetchAll(PDO::FETCH_ASSOC);

<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

require_once '../config/database.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Identifiant invalide.");
}

$id = (int)$_GET['id'];

$stmt = $pdo->prepare("
    SELECT topic.title, topic.content, topic.creation_date, users.firstname, users.lastname
    FROM topic
    JOIN users ON topic.author = users.id
    WHERE topic.id = ?
");
$stmt->execute([$id]);
$topic = $stmt->fetch();

if (!$topic) {
    die("Sujet introuvable.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détail du sujet</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="top-bar">
        <a href="logout.php" class="logout-link">Se déconnecter</a>
    </div>

    <div class="content-box">
        <h1><?= htmlspecialchars($topic['title']) ?></h1>
        <p><em>Posté le <?= date('d/m/Y', strtotime($topic['creation_date'])) ?> par <?= htmlspecialchars($topic['firstname']) ?> <?= htmlspecialchars($topic['lastname']) ?></em></p>
        <p><?= nl2br(htmlspecialchars($topic['content'])) ?></p>

        <p><a href="listing.php">⬅ Retour au listing</a></p>
    </div>
</body>
</html>

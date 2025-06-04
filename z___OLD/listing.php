<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

require_once 'config/database.php';

$stmt = $pdo->query("
    SELECT topic.id, topic.title, topic.creation_date, users.firstname, users.lastname
    FROM topic
    JOIN users ON topic.author = users.id
    ORDER BY topic.creation_date DESC
");

$topics = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des sujets – Bukowski</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="top-bar">
        <span>Connecté en tant que <?= htmlspecialchars($_SESSION['user']['firstname']) ?></span>
        <a href="logout.php" class="logout-link">Se déconnecter</a>
    </div>

    <div class="content-box">
        <h1>📜 Liste des sujets</h1>

        <?php if (count($topics) > 0): ?>
            <ul class="topic-list">
                <?php foreach ($topics as $topic): ?>
                    <li>
                        <strong><?= htmlspecialchars($topic['title']) ?></strong><br>
                        <small>Publié le <?= date('d/m/Y', strtotime($topic['creation_date'])) ?> par <?= htmlspecialchars($topic['firstname']) ?> <?= htmlspecialchars($topic['lastname']) ?></small><br>
                        <a href="detail.php?id=<?= $topic['id'] ?>">Voir plus</a>
                    </li>
                    <hr>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Aucun sujet disponible.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
session_start();
require_once('config/database.php');

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}

$title = trim($_POST['title'] ?? '');
$content = $_POST['content'] ?? ''; // le contenu peut être vide

if ($title) {
    $stmt = $pdo->prepare("INSERT INTO topic (title, content, author) VALUES (?, ?, ?)");
    $stmt->execute([
        $title,
        $content,
        $_SESSION['user']['id']
    ]);
    header('Location: listing.php');
    exit();
} else {
    echo "⚠️ Le titre est obligatoire. Le contenu peut être vide si tu veux, mais faut un minimum de respect pour Bukowski.";
}

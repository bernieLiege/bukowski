<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

require_once 'config/database.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $content = $_POST['content'] ?? '';

    if ($title && $content) {
        $stmt = $pdo->prepare("INSERT INTO topic (title, content, author) VALUES (?, ?, ?)");
        $stmt->execute([$title, $content, $_SESSION['user']['id']]);
        header("Location: listing.php");
        exit();
    } else {
        $error = "Tous les champs sont requis.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouveau sujet</title>
    <link rel="stylesheet" href="/bukowski/assets/style.css">
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: 'textarea',
        height: 300,
        menubar: false,
        plugins: 'link lists code',
        toolbar: 'undo redo | bold italic underline | bullist numlist | link | code',
        content_style: "body { font-family: Courier, monospace; font-size: 14px; }"
      });
    </script>
</head>
<body>
    <div class="top-bar">
        <a href="logout.php" class="logout-link">Se déconnecter</a>
    </div>
    <div class="content-box">
        <h1>🖊️ Nouveau sujet</h1>
        <?php if ($error): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <form method="post">
            <input type="text" name="title" placeholder="Titre du sujet" required style="width:100%;padding:10px;margin-bottom:10px;">
            <textarea name="content" required></textarea>
            <br>
            <button type="submit">Publier</button>
        </form>
        <p><a href="listing.php">⬅ Retour au listing</a></p>
    </div>
</body>
</html>
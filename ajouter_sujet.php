<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouveau sujet</title>
    <link rel="stylesheet" href="/bukowski/assets/style.css">
</head>
<body>
    <div class="top-bar">
        <a href="logout.php" class="logout-link">Se déconnecter</a>
    </div>

    <div class="content-box">
        <h1>🖊️ Nouveau sujet</h1>

        <form method="post" action="traiter_ajout_sujet.php">
            <input type="text" name="title" placeholder="Titre du sujet" required style="width:100%;padding:10px;margin-bottom:10px;">
            <textarea name="content" rows="10" style="width:100%;padding:10px;" placeholder="Contenu (facultatif)"></textarea>
            <br><br>
            <button type="submit">Publier</button>
        </form>

        <p><a href="listing.php">⬅ Retour au listing</a></p>
    </div>
</body>
</html>

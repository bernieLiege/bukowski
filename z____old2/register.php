<?php
require_once 'config/database.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $firstname = trim($_POST['firstname'] ?? '');
    $lastname = trim($_POST['lastname'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email && $firstname && $lastname && $password) {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $error = "Cet email est déjà utilisé.";
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (email, firstname, lastname, password) VALUES (?, ?, ?, ?)");
            $stmt->execute([$email, $firstname, $lastname, $hashed]);
            $success = "Compte créé avec succès. Vous pouvez maintenant vous connecter.";
        }
    } else {
        $error = "Tous les champs sont obligatoires.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription – Bukowski Forum</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="login-box">
        <h1 class="main-title">Inscription</h1>
        <?php if ($success): ?>
            <div style="color: #00ff99;"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="post" action="">
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="firstname" placeholder="Prénom" required>
            <input type="text" name="lastname" placeholder="Nom" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">S'inscrire</button>
        </form>
        <p><a href="index.php">⬅ Retour à la connexion</a></p>
    </div>
</body>
</html>

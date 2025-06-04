<?php
session_start();
$error = '';


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'config/database.php';

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'firstname' => $user['firstname'],
            'lastname' => $user['lastname']
        ];
        header('Location: listing.php');
        exit();
    } else {
        $error = "Identifiants invalides.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bukowski Forum – Connexion</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="login-box">
        <h1 class="main-title">Bukowski Forum</h1>

        <form method="post" action="">
            <input type="email" name="email" placeholder="Adresse email" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">Connexion</button>
        </form>

        <?php if ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <p style="margin-top: 1rem;">
            <a href="register.php" class="register-link">👤➕ Créer un compte</a>
        </p>
    </div>
</body>
</html>

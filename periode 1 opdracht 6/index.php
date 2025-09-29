<?php
require_once 'User.php';

if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [
        "test@example.com" => new User("testuser", "12345", "test@example.com", "admin"),
    ];
}

$message = "";

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);

    if (isset($_SESSION['users'][$email])) {
        $message = "Er bestaat al een account met dit e-mailadres.";
    } else {
        $_SESSION['users'][$email] = new User($username, $password, $email);
        $message = "Account aangemaakt! Je kunt nu inloggen.";
    }
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (isset($_SESSION['users'][$email])) {
        $user = $_SESSION['users'][$email];
        if ($user->ValidateLogin($email, $password)) {
            $user->LoginUser();
            $message = "Je bent succesvol ingelogd!";
        } else {
            $message = "Ongeldig e-mailadres of wachtwoord.";
        }
    } else {
        $message = "Geen account gevonden met dit e-mailadres.";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Login Pagina</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f8f8;
            text-align: center;
            margin-top: 50px;
        }
        input { margin: 5px; padding: 8px; width: 200px; }
        button { padding: 8px 15px; cursor: pointer; margin-top: 10px; }
    </style>
</head>
<body>
    <h1>Login Pagina</h1>

    <?php if (isset($message) && $message != "") echo "<p>$message</p>"; ?>

    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']): ?>
        <p>Welkom, <strong><?= $_SESSION['username'] ?></strong> (<?= $_SESSION['email'] ?>)!</p>
        <form method="post">
            <button type="submit" name="logout">Uitloggen</button>
        </form>

    <?php elseif (isset($_GET['action']) && $_GET['action'] === 'register'): ?>
        <form method="post">
            <h2>Account aanmaken</h2>
            <input type="text" name="username" placeholder="Gebruikersnaam" required><br>
            <input type="email" name="email" placeholder="E-mailadres" required><br>
            <input type="password" name="password" placeholder="Wachtwoord" required><br>
            <button type="submit" name="register">Account maken</button>
        </form>
        <form method="get">
            <button type="submit" class="link-btn">Terug naar login</button>
        </form>

    <?php else: ?>
        <form method="post">
            <h2>Inloggen</h2>
            <input type="email" name="email" placeholder="E-mailadres" required><br>
            <input type="password" name="password" placeholder="Wachtwoord" required><br>
            <button type="submit" name="login">Inloggen</button>
        </form>

        <form method="get">
            <button type="submit" name="action" value="register" class="link-btn">Account aanmaken</button>
        </form>
    <?php endif; ?>
</body>
</html>
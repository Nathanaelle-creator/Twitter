<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter</title>
    <link href="/public/css/stylelogin.css" rel="stylesheet" />
</head>
<body>
<?php require_once "../../controllers/UserController.php";
            $controller = new RegisterController();
            
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $controller->login($_POST);
        }
?>
    <section id="right">
    <h2>Connexion</h2>
    <form action="loginView.php" method="post" autocomplete="off">
        <label for="email">Email:</label>
        <input type="email"  class="input_box" name="email" id="email"><br>
        <label for="password">Password:</label>
        <input type="password" class="input_box" name="password" id="password"><br>
        <button type="submit" class="login-btn" name="submit">SE CONNECTER</button>
        <button type="button" class="login-btn" onclick="window.location.href='registerView.php'">S'INSCRIRE</button>
    </form>
    </section>   
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/register.css">
    <title>Inscription</title>
</head>
<body>
    <?php require_once "../../controllers/UserController.php";
    $controller = new RegisterController();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $controller->regist($_POST);
    }
    ?>
    <section>
        <h2>Créer votre compte</h2>
        <div class="img-back">
            <form action="registerView.php" method="post" autocomplete="off">
                <label for="firstname">Firstname:</label>
                <input type="text" name="firstname" id="firstname" required value=""><br>
                <label for="lastname">Lastname:</label>
                <input type="text" name="lastname" id="lastname" required value=""><br>
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required value=""><br>
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" required value=""><br>
                <label for="password">Mot de passe:</label>
                <input type="password" name="password" id="password" required value=""><br>
                <label for="confirmpassword"> Confirmer mot de passe:</label>
                <input type="password" name="confirmpassword" id="confirmpassword"><br>
                <label for="naissance">Date de naissance:</label>
                <input type="date" name="birthdate" id="naissance" value="2007-01-01" max="2007-01-01"><br>
                <label for="number">Number:</label>
                <input type="tel" name="phone" id="number" required value=""><br>
                <label for="country">Country:</label>
                <input type="text" name="country" id="country"><br>
                <label for="genre">Genre:</label>
                <input type="text" name="genre" id="genre"><br>
                <button type="submit" class="login-btn" name="submit">S'INSCRIRE</button>
                <button type="button" class="login-btn" onclick="window.location.href='loginView.php'">LOGIN</button>
                </form>
        </div> 
    </section> 
</body>
</html>
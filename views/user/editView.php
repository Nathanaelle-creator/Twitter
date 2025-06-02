<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Profile</title>
    <link rel="stylesheet" href="/public/css/styleeditprofil.css">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>
<body>
<?php 
    require "../../controllers/UserController.php";
    require_once '../../controllers/TweetController.php';
    $controller = new RegisterController();
    $controller1 = new TweetController();
    $recupid = $controller1->getuser();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $controller->modification($_POST);
    }
?>
<div id="skeleton" class="layout">
        <div class="layout__left-sidebar skeleton-box"></div>
        <div class="layout__main skeleton-box"></div>
        <div class="layout__right-container skeleton-box"></div>
    </div>
<div class="cop">
    <div id="content" class="layout hidden">
        <div class="layout__left-sidebar">
            <h2 style="margin-right:20px"></h2>
            <img src="../../asset/twitter-logo.png" alt="Logo-twitter" id="toggle-button">
            <h2 style="margin-left:20px;"></h2>
            <div class="sidebar-menu">
                <nav>
                    <ul>
                    <li><a href="../../views/user/home.php" class="text-primary">HOME</a></li>
                        <li><a href="../../views/message/createView.php">MESSAGES</a></li>
                        <li><a href="../../views/user/profilView.php">PROFILE</a></li>
                        <li><a href="../../views/user/more.php">MORE</a></li>
                    </ul>
                </nav>
                <button type="button" class="tweet" onclick="openModal('tweet')">TWEET</button>
                <?php
                //  username de l'utilisateur connecté
                if (!empty($recupid)) {
                    echo "<p><strong>@{$recupid['username']}</strong></p>";
                } else {
                    echo "<p>Aucun utilisateur trouvé.</p>";
                }
                ?>
            </div>
        </div>

        <div class="container">
            <h1>Edit Profile</h1>
            <form action="editView.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo isset($user['id']) ? $user['id'] : ''; ?>">
                <div class="form-group">
                    <fieldset>
                        <legend class="fieldset-title">Identité</legend>
                        <div class="fieldset-content">
                            <label for="firstname">First Name:</label>
                            <input type="text" id="firstname" name="modif_firstname">
                            <br>
                            <label for="lastname">Last Name:</label>
                            <input type="text" id="lastname" name="modif_lastname">
                            <br>
                            <label for="username">Username:</label>
                            <input type="text" id="username" name="modif_username">
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend class="fieldset-title">Coordonner</legend>
                        <div class="fieldset-content">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="modif_email">
                            <br>
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="modif_password">
                            <br>
                            <label for="phone">Phone:</label>
                            <input type="text" id="phone" name="modif_phone">
                            <br>
                            <label for="biography">Biography:</label>
                            <textarea id="biography" name="modif_biography"></textarea>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend class="fieldset-title">Adresse</legend>
                        <div class="fieldset-content">
                            <label for="city">City:</label>
                            <input type="text" id="city" name="modif_city">
                            <br>
                            <label for="country">Country:</label>
                            <input type="text" id="country" name="modif_country">
                        </div>
                    </fieldset>
                    <label for="genre">Genre:</label>
                    <input type="text" id="genre" name="modif_genre">
                    <br>
                    <label for="picture">Photo:</label>
                    <input type="file" id="picture" name="modif_picture">
                    <br>
                    <label for="header">Header:</label>
                    <input type="file" id="header" name="modif_header">
                    <br>
                    <button type="submit">SAVE CHANGES</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var fieldsets = document.querySelectorAll('fieldset');
        fieldsets.forEach(function(fieldset) {
            fieldset.addEventListener('click', function() {
                this.classList.toggle('active');
            });
            var inputs = fieldset.querySelectorAll('input, textarea');
            inputs.forEach(function(input) {
                input.addEventListener('click', function(event) {
                    event.stopPropagation();
                });
            });
        });
    });
</script>
<script>
       let toggleSwitch = document.getElementById('toggle-button');
toggleSwitch.addEventListener('click', (e) => {
    let src = toggleSwitch.getAttribute('src');
    if (src == '../../asset/TaupeProfil.png') {
        toggleSwitch.src = '../../asset/twitter-logo.png"';
        document.documentElement.setAttribute('data-theme', 'light'); 
    } else {
        document.documentElement.setAttribute('data-theme', 'dark');
        toggleSwitch.src = '../../asset/TaupeProfil.png';
    }
});
</script>
<script src="/public/css/js/home.js"></script>
</body>
</html>

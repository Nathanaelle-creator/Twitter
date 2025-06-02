
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/stylemessage.css">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>Messagerie</title>
</head>
<body>
<?php
require "../../controllers/MessageController.php";
require_once '../../controllers/TweetController.php';
$controller = new MessageController();
$controller1 = new TweetController();
$recupid = $controller1->getuser();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller->envoyerMessage($_POST);
}

$messages = [];
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $messages = $controller->voirMessages(); // RÃ©cupÃ©rer les messages
    $destinataireId = $_GET['id']; // ID du destinataire
}
?>
<!-- Skeleton Loader -->

<div class="layout">
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
                <li>MORE</li>
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
        <h2>Messagerie</h2>
        <div class="conversation">
            <?php
            foreach ($messages as $message) {
                if ($message['id_receiver'] == $_SESSION['id']) {
                    echo "<p class='envoyeur'>" ."<small><strong>@{$message['username']}</small>"."<br>". htmlspecialchars($message['content']). "</p><small>{$message['date']}</small>";
                } elseif ($message['id_sender'] == $_SESSION['id']) {
                    echo "<p class='destinataire'>"."<small><strong>@{$message['username']}</small>"."<br>".htmlspecialchars($message['content']) . "</p><small>{$message['date']}</small>";
                }
            }
            ?>
            </div> <form method="post">
            <textarea name="message" ></textarea>
            <br/><br/>
            <input type="submit" name="envoyer" value="Envoyer">
        </form>
        </div>

        <div class="layout__right-container">
            <div class="layout__right-sidebar">
            <form method="GET" action="createView.php">
            <input type="text" name="search" placeholder="Entrez un nom, prénom, username ou #hashtag" required>
            <button type="submit">Rechercher</button>
            </form>
            <br>
            <h3>Mes Amies</h3>
            <br>
        <?php
        require_once '../../controllers/MessageController.php';
        $controller = new MessageController();
        $followers = $controller->follower();
        if ($followers) {
            foreach ($followers as $follower) {
                ?>
                <a href="<?php echo "createView.php?id=" . $follower['id']; ?>">
                    <?php echo '<p>' . htmlspecialchars($follower['username']) . '</p>'; ?>
                </a>
                <?php
            }
        }
        ?>
        </div>
        </div>
        <script>
       let toggleSwitch = document.getElementById('toggle-button');
toggleSwitch.addEventListener('click', (e) => {
    let src = toggleSwitch.getAttribute('src');
    if (src == '../../asset/TaupeProfil.png') {
        toggleSwitch.src = '../../asset/twitter-logo.png"';
        document.documentElement.setAttribute('data-theme', 'light');  // Assurez-vous que ce soit appliqué à `html`
    } else {
        document.documentElement.setAttribute('data-theme', 'dark');
        toggleSwitch.src = '../../asset/TaupeProfil.png';
    }
});

    </script>
    <script src="index.js"></script>
</div>
</body>
    
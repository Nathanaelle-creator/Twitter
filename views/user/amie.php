<?php
session_start();

$id = $_SESSION['id'];  // L'ID de l'utilisateur connecté
require_once '../../controllers/TweetController.php';

$controller = new TweetController();
$recupid = $controller->getuser();  
$followers = $controller->getFollowers();
$Actionfollowers = $controller->FollowAction();


$result = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $controller->create();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROJET X - Home</title>
    <link rel="stylesheet" href="../../public/css/amieretweet.css">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>
<body>
<div id="skeleton" class="layout">
        <div class="layout__left-sidebar skeleton-box"></div>
        <div class="layout__main skeleton-box"></div>
        <div class="layout__right-container skeleton-box"></div>
    </div>
    <div id="content" class="layout hidden">
        <!-- Barre latérale gauche -->
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

        <!-- Section principale -->
        <div class="layout__main">
            <div class="flux">
                <form method="GET" action="amie.php">
                    <input type="text" name="search" placeholder="Entrez un nom, prénom, username ou #hashtag" required>
                    <button type="submit">Rechercher</button>
                </form>

                <div>
                    <?php
                    if (!empty($followers)) {
                        foreach ($followers as $follower) {
                    ?>
                            <a href="<?php echo "views/message/createView.php?id=" . $follower['id']; ?>">
                                <p><?php echo htmlspecialchars($follower['username']); ?></p>
                            </a>
                            <!-- Bouton Suivre / Ne plus suivre -->
                            <form method="POST">
                                <input type="hidden" name="getfollowedid" value="<?php echo $follower['id']; ?>">
                                <button type="submit" name="follow_action">
                                    <?php echo in_array($follower['id'], array_column($followers, 'id')) ? "Ne plus suivre" : "Suivre"; ?>
                                </button>
                            </form>
                    <?php
                        }
                    }
                    ?>
                
                    <?php
                    
                    ?>
                </div>
            </div>
        </div>
    </div>
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
    <script src="public/css/js/index.js"></script>
</body>
</html>
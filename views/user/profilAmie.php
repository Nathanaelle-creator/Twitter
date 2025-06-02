<?php
session_start();

$id = $_SESSION['id'];

if (isset($_GET['id'])) {
    $followerId = $_GET['id']; //recup l'id dans url
}

require_once '../../controllers/TweetController.php';

$controller = new TweetController();

$recupid = $controller->getuser();
$followerDetails = $controller->getuser();
$followerDetails = $controller->getUserDetailsById($followerId);
$followerTweet = $controller->gettweet($followerId);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROJET X - Profile</title>
    <link rel="stylesheet" href="/public/css/profil.css">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>
<body>
    <div class="layout">
        <!-- Sidebar gauche -->
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
        

        <!-- Contenu principal -->
        <div class="layout__main">
            <div class="profile-header">
                <div class="profile-cover">
                    <!-- <img src="../../asset/profile-cover.jpg" alt="Profile Cover"> -->
                </div>
                <div class="profile-details">
                    <?php
                    if ($followerDetails) {
                        echo "<h2>@{$followerDetails['username']}</h2>";
                    }
                    ?>
                </div>
            </div>

            <div class="profile-navigation">
                <button >Retweet</button>
                <button >Followers</button>
                <button>Following</button>
            </div>

            <div class="info">
        <p>MES POSTS</p>
        <div  id="tweetContainer">
                <div class="tweet-wrapper">
                    <?php
                    if (!empty($followerTweet)) {
                        foreach ($followerTweet as $tweet) {
                            echo "<p>  @{$tweet['username']} {$tweet['content']}  <small>Publié le {$tweet['creation_date']}</small></p>";
                        }
                    } else {
                        echo "<p>Aucun tweet trouvé.</p>";
                    }
                    ?>
                </div>
                </div>
        </div>

        
</div>

<!-- Sidebar droite -->
<div class="layout__right-container">
            <div class="layout__right-sidebar">
                <form method="GET" action="profilView.php">
                    <input type="text" name="search" placeholder="Entrez un nom, prénom, username ou #hashtag" required>
                    <button type="submit">Rechercher</button>
                </form>

                <?php
                $resultsSearch = $controller->search();
                $hashtags = $controller->hastag();

                if (!empty($resultsSearch)): 
                ?>
                    <h3>Résultats de la recherche :</h3>
                    <h4>Utilisateurs :</h4>
                    <ul>
                        <?php foreach ($resultsSearch as $user): ?>
                            <li><?= htmlspecialchars($user['firstname']) . " " . htmlspecialchars($user['lastname']) . " (@" . htmlspecialchars($user['username']) . ")" ?></li>
                        <?php endforeach; ?>

                        <?php foreach ($hashtags as $hashtag): ?>
                            <li>#<?= htmlspecialchars($hashtag['name']) ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>Aucun résultat trouvé.</p>
                <?php endif; ?>

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
</body>
</html>

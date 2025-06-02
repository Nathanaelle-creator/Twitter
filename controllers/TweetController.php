<?php

require_once '../../model/Tweet.php';



class TweetController{
    private $model;
    private $message;
    private $user;
    private $tweetAmis;

    private $mytweet;

    private $hastag;

    private $search;


    private $follow;

    public function __construct() {
        $this->model = new TweetModel();
        $this->message = new TweetModel();
        $this->user = new TweetModel();
        $this->tweetAmis = new TweetModel();
        $this->mytweet = new TweetModel();
        $this->hastag=new TweetModel();
        $this->search=new TweetModel();
        $this->follow=new TweetModel();
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_user = $_SESSION["id"] ?? null; // Si l'ID n'est pas défini, il sera null
            $reply_to = isset($_POST['reply_to']) && !empty($_POST['reply_to']) ? $_POST['reply_to'] : null;
            $content = isset($_POST['content']) ? $_POST['content'] : '';
            $creation_date = date("Y-m-d H:i:s");
            $names = isset($_POST['namehashtag']) ? $_POST['namehashtag'] :  "";//s'il y un hastag la va la retourner si s'est faux elel va me retourner vide
            if (!$id_user || empty($content)) {
                return [
                    'success' => false,
                    'error' => 'L\'ID utilisateur et le contenu du tweet sont obligatoires.'
                ];
            }
            if (!empty($names)) {
                $hashtag = $this->model->createHashtag($names);
            }
    
            // Créer le tweet
            $tweetId = $this->model->CreateTweet($id_user, $reply_to, $content, $creation_date);
            
            if ($tweetId) {
                header("Location: home.php");
                exit;
            }
        }
    }
    
    
    public function afficheTweet(){
        $id_user = $_SESSION["id"];
       // var_dump($id_user);
        return $this->mytweet->afficherTweet($id_user);
    }

    public function TweetAmis(){
        $tweet1 = $_SESSION["id"];
        return $this->tweetAmis->Tweetfriend($tweet1);
    }
    
    public function UserTwitter(){
        $user = $_SESSION["id"];
        return $this->user->User($user);
    }


    public function getuser(){
        if (!empty($_SESSION['id'])) {
            $user = $_SESSION['id'];
            $result = $this->user->getid($user);
            return $result;
        }
        return null;  
    }
    
    
    public function tag() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_hastag'])) {
            echo "<pre>";
            print_r($_POST);
            echo "</pre>";
            $id = $_SESSION["id"] ?? null; // Sécurisé
            $name = !empty($_POST['name']) ? $_POST['name'] : null;
            if ($id !== null && $name !== null) {
                $success = $this->hastag->hastag($id, $name);
            }
        }
    }

    public function search() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $search = $_GET['search'] ?? null;
            $id = $_SESSION["id"] ?? null; // Sécurisé
        }
        
        if (!empty($search)) {
            return $this->search->search($search); 
        } else {
            return [];
        }
    }
    public function hastag(){
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $search = $_GET['search'] ?? null;
            $id = $_SESSION["id"] ?? null; // Sécurisé
        }
        
        if (!empty($search)) {
            return $this->hastag-> searchtag($search);
        } else {
            return [];
        }
    }

    public function FollowAction() {
        if (isset($_POST['follow_action'], $_POST['getfollowedid'])) {
            $getfollowedid = $_POST['getfollowedid'];
            $id_user_follow = $_SESSION['id'];

            // Vérifier si l'utilisateur suit déjà ou non l'autre utilisateur
            if ($this->follow->checkedFollow($id_user_follow, $getfollowedid) == 0) {
                $this->follow->addFollow($id_user_follow, $getfollowedid);
            } else {
                $this->follow->deleteFollow($id_user_follow, $getfollowedid);
            }
        }
    }

    // voir les followers de l'utilisateur connecté
    public function getFollowers() {
        $id_user_follow = $_SESSION['id'];
        return $this->follow->voirFollowers($id_user_follow);
    }
    
    public function getUserDetailsById($id) {
        $result = $this->user->getid($id);
        $result1 = $this->user->afficherTweet($id);
        if ($result && $result1) {
            return $result;
        } else {
            return false; 
        }
    }

    public function gettweet($id) {
        $result1 = $this->user->afficherTweet($id);
    if ($result1) {
        return $result1; 
    } else {
        return false;
    }
    }
    


} 
?>
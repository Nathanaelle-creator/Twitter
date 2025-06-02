<?php
require_once '../../model/Retweet.php';

class RetweetController {
    private $model;

    public function __construct() {
        $this->model = new RetweetModel();
    }

    public function createR() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['retweet'])) {
            //var_dump($_POST);  // Debugging: Verify the data being sent
            if (!isset($_SESSION['id'])) {
                return "Erreur : utilisateur non authentifié.";
            }
            $id_user = $_SESSION['id'];
            $id_tweet = $_POST['retweet'];
            $result = $this->model->createRetweet($id_user, $id_tweet);
            if ($result) {
                header("Location: home.php"); // Redirection après succès
                exit();
            } else {
                return "Erreur lors du retweet.";
            }
        }
    }
    public function afficheretweet(){
        $id_user = $_SESSION["id"];
       // var_dump($id_user);
        return $this->model->voirretweet($id_user);
    }

    

}
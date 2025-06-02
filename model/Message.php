<?php
require('../../config/config.php');

class MessageModel {
    private $donner;

    public function __construct() {
        // Initialiser la connexion à la base de données
        $res = new BaseDeDonne();
        $this->donner = $res->DBConnection();
    }

    public function addMessage($message, $destinataireId) {
        $req = "INSERT INTO message(content, id_sender, id_receiver) VALUES(?, ?, ?)";
        $stmt = $this->donner->prepare($req);
        $stmt->execute(array($message, $_SESSION['id'], $destinataireId));
    }

    public function voirMessages($destinataireId) {
        $req = "SELECT * FROM message
        INNER JOIN user ON message.id_sender=user.id
        WHERE (id_sender = ? AND id_receiver = ?) OR (id_sender = ? AND id_receiver = ?)";
        $stmt = $this->donner->prepare($req);
        $stmt->execute(array($_SESSION['id'], $destinataireId, $destinataireId, $_SESSION['id']));
        return $stmt->fetchAll(); 
    }

    public function follower($id){
        $requete = "SELECT user.username ,id
        FROM user
        INNER JOIN follow ON user.id = follow.id_user_followed
        WHERE follow.id_user_follow = :id_user_follow";
        $statement =  $this->donner->prepare($requete);
        $statement->execute([':id_user_follow' => $id]);
        return $statement->fetchAll();
    }

    public function getid($user){
        $requete = "SELECT * FROM user WHERE id = :id";
        $statement = $this->donner->prepare($requete);
        $statement->bindParam(':id', $user, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}
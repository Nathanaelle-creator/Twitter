<?php
class RetweetModel{
    private $donner;

    public function __construct() {
        $res = new BaseDeDonne();
        $this->donner = $res->DBConnection();
    }

    public function CreateRetweet($id_user, $retweet) {
        $req = "INSERT INTO `retweet` (id_user, id_tweet) VALUES (:id_user, :id_tweet)";
        $statement = $this->donner->prepare($req);
        $statement->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $statement->bindParam(':id_tweet', $retweet, PDO::PARAM_INT);

        // Exécute la requête
        if ($statement->execute()) {
            // Retourne l'ID du retweet inséré
            return $this->donner->lastInsertId();
        } else {
            // Retourne false en cas d'échec
            return false;
        }
    }
    public function voirretweet($id_user) {
        // Correction de la requête avec un paramètre lié :id_user
        $requete = "SELECT tweet.id,tweet.content,tweet.creation_date
                    FROM retweet 
                    INNER JOIN tweet ON retweet.id_tweet=tweet.id
                    WHERE retweet.id_user=:id_user
                    ORDER BY creation_date DESC";
        $statement = $this->donner->prepare($requete);
        $statement->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    
}

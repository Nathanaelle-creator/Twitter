<?php
require('../../config/config.php');

class TweetModel{
    private $donner;

    public function __construct() {
        //initialisation de connexion 
        $res = new BaseDeDonne();
        $this->donner=$res->DBConnection();
    }

public function CreateTweet($id_user,$reply_to, $content,$creation_date ){
    $req  = "INSERT INTO `tweet` (id_user, reply_to, content, creation_date) VALUES (:id_user, :reply_to, :content, :creation_date)";
    $statement = $this->donner->prepare($req);

    
    $statement->bindParam(':id_user', $id_user, PDO::PARAM_INT);
    $statement->bindParam(':content', $content, PDO::PARAM_STR);
    $statement->bindParam(':creation_date', $creation_date, PDO::PARAM_STR);


   

    if($reply_to === null){
        $statement->bindValue(':reply_to', null ,PDO::PARAM_NULL);
    }else{
        $statement->bindParam(':reply_to', $reply_to ,PDO::PARAM_INT);
    }
    $statement->execute();
   
    return $this->donner->lastInsertId();
 }

 public function getid($user){
    $requete = "SELECT * FROM user WHERE id = :id";
    $statement = $this->donner->prepare($requete);
    $statement->bindParam(':id', $user, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
}

 public function afficherTweet($id_user){
$requete = "SELECT tweet.creation_date,tweet.content,user.username 
FROM tweet
INNER JOIN user ON tweet.id_user = user.id
WHERE tweet.id_user = :id_user
ORDER BY creation_date DESC";
$statement = $this->donner->prepare($requete);
$statement->bindParam(':id_user', $id_user, PDO::PARAM_INT);
$statement->execute();
return $statement->fetchAll(PDO::FETCH_ASSOC);
}

public function Tweetfriend($id){
    $requete = "SELECT * FROM user 
    INNER JOIN TWEET ON user.id=tweet.id_user;
    ORDER BY creation_date ASC";
    $statement = $this->donner->prepare($requete);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

public function User($user){
    $requete = "SELECT * FROM user
    INNER JOIN follow ON user.id=follow.id_user_follow
    ORDER BY creation_date DESC";
    $statement = $this->donner->prepare($requete);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

public function CreateHashtag($name){
    $req  = "INSERT INTO `hashtag` (name) VALUES (:names)";
    $statement = $this->donner->prepare($req);
    $statement->bindParam(':names', $name, PDO::PARAM_STR);
    $statement->execute();
    return $this->donner->lastInsertId();
 }

 public function afficherHashtag($id){
    $requete = "SELECT * FROM hashtag";
    $statement = $this->donner->prepare($requete);
     $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}
 
public function hastag($id,$name){
    $req  = "INSERT INTO hastag (id,name) VALUES (:id, :name)";
    $statement = $this->donner->prepare($req);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->bindParam(':name', $name, PDO::PARAM_STR);
    $statement->execute();
    return $statement->execute();
}

public function search($search){
    $requete = "SELECT * FROM user WHERE username LIKE :search OR firstname LIKE :search OR lastname LIKE :search";
    $statement = $this->donner->prepare($requete);
    $statement->execute(['search' => "%$search%"]);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

public function searchtag($search){
    $requete = "SELECT * FROM hashtag WHERE name LIKE :search";
    $statement = $this->donner->prepare($requete);
    $statement->execute(['search' => "%$search%"]);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

public function addFollow($id_user_follow, $id_user_followed){
    $requete = 'INSERT INTO follow (id_user_follow, id_user_followed) VALUES (?, ?)';
    $statement = $this->donner->prepare($requete);
    $statement->execute([$id_user_follow, $id_user_followed]);
    return $statement->rowCount();
}


public function deleteFollow($id_user_follow, $id_user_followed) {
    $requete = 'DELETE FROM follow WHERE id_user_follow = ? AND id_user_followed = ?';
    $statement = $this->donner->prepare($requete);
    $statement->execute([$id_user_follow, $id_user_followed]);

    return $statement->rowCount(); 
}


public function checkedFollow($id_user_follow, $id_user_followed){
    $requete = 'SELECT * FROM follow WHERE id_user_follow = ? AND id_user_followed = ?';
    $statement = $this->donner->prepare($requete);
    $statement->execute([$id_user_follow, $id_user_followed]);
    return $statement->rowCount();

}

public function voirFollowers($id_user_follow) {
    $stmt = $this->donner->prepare('
        SELECT user.username, user.id 
        FROM user
        INNER JOIN follow ON user.id = follow.id_user_followed
        WHERE follow.id_user_follow = :id_user_follow
    ');
    $stmt->execute([':id_user_follow' => $id_user_follow]);
    return $stmt->fetchAll();
}

}
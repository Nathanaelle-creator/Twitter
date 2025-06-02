<?php
require('../../config/config.php');
require_once('../../private.php');

class RegisterModel{
    private $donner;

    public function __construct() {
        $res = new BaseDeDonne();
        $this->donner=$res->DBConnection();
    }
public function register($firstname,$lastname,$username,$email,$password,$birthdate,$phone,$country,$genre){
    $requete ="INSERT INTO `user`(`firstname`, `lastname`, `username`, `email`, `password`, `birthdate`, `phone`, `country`, `genre`)
  VALUES ( :firstname,:lastname,:username,:email,:password, :birthdate,:phone, :country, :genre)";

 //Préparer notre requête
        $statement=$this->donner->prepare($requete);
        $hasheMDP = hash('ripemd160', $password . mdp);
//Exécuter la requête et vérifier
        $statement->bindParam(':firstname', $firstname,PDO::PARAM_STR);
        $statement->bindParam(':lastname', $lastname,PDO::PARAM_STR);
        $statement->bindParam(':username', $username,PDO::PARAM_STR);
        $statement->bindParam(':email', $email,PDO::PARAM_STR);
        $statement->bindParam(':password', $hasheMDP,PDO::PARAM_STR);
        $statement->bindParam(':birthdate', $birthdate,PDO::PARAM_STR);
        $statement->bindParam(':phone', $phone,PDO::PARAM_STR);
        $statement->bindParam(':country', $country,PDO::PARAM_STR);
        $statement->bindParam(':genre', $genre,PDO::PARAM_STR);
        $statement->execute();
    return $statement->fetchAll();

}
//-------------------------------------------------------------------------------------------------------

//-----------------------------------------------------------------------------------------------------------
public function getid($user){
    $requete = "SELECT * FROM user WHERE id = :id";
    $statement = $this->donner->prepare($requete);
    $statement->bindParam(':id', $user, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
}
public function editfirstname( $user,$firstname){
    $requete = 'UPDATE user SET firstname=:modif_firstname  WHERE id= :id';
    $statement = $this->donner->prepare($requete);
    $statement->bindParam('modif_firstname', $firstname, PDO::PARAM_STR);
    $statement->bindParam(':id', $user, PDO::PARAM_STR);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
}
public function editlastname( $user,$lastname){
    $requete = 'UPDATE user SET lastname=:modif_lastname  WHERE id= :id';
    $statement = $this->donner->prepare($requete);
    $statement->bindParam('modif_lastname', $lastname, PDO::PARAM_STR);
    $statement->bindParam(':id', $user, PDO::PARAM_STR);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
}
public function editusername( $user,$username){
    $requete = 'UPDATE user SET username=:modif_username WHERE id= :id';
    $statement = $this->donner->prepare($requete);
    $statement->bindParam('modif_username', $username, PDO::PARAM_STR);
    $statement->bindParam(':id', $user, PDO::PARAM_STR);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
}

public function editemail( $user,$email){
    $requete = 'UPDATE user SET email =:modif_email:  WHERE id= :id';
    $statement = $this->donner->prepare($requete);
    $statement->bindParam(' email  ', $email, PDO::PARAM_STR);
    $statement->bindParam(':id', $user, PDO::PARAM_STR);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);

}
public function editpassword( $user,$password){
    $requete = 'UPDATE user SET password=:modif_password  WHERE id= :id';
    $statement = $this->donner->prepare($requete);
    $statement->bindParam('modif_password', $password, PDO::PARAM_STR);
    $statement->bindParam(':id', $user, PDO::PARAM_STR);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
}
public function editphone( $user,$phone){
    $requete = 'UPDATE user SET phone=:modif_phone  WHERE id= :id';
    $statement = $this->donner->prepare($requete);
    $statement->bindParam('modif_phone', $phone, PDO::PARAM_STR);
    $statement->bindParam(':id', $user, PDO::PARAM_STR);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
}
public function editbiography( $user,$bio){
    $requete = 'UPDATE user SET biography=:modif_biography  WHERE id= :id';
    $statement = $this->donner->prepare($requete);
    $statement->bindParam('modif_biography', $bio, PDO::PARAM_STR);
    $statement->bindParam(':id', $user, PDO::PARAM_STR);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
}
public function editcity( $user,$city){
    $requete = 'UPDATE user SET city=:modif_city  WHERE id= :id';
    $statement = $this->donner->prepare($requete);
    $statement->bindParam('modif_city', $city, PDO::PARAM_STR);
    $statement->bindParam(':id', $user, PDO::PARAM_STR);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
}

public function editcountry( $user,$country){
    $requete = 'UPDATE user SET country=:modif_country WHERE id= :id';
    $statement = $this->donner->prepare($requete);
    $statement->bindParam('country  ', $country, PDO::PARAM_STR);
    $statement->bindParam(':id', $user, PDO::PARAM_STR);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
}

public function editgenre( $user,$genre){
    $requete = 'UPDATE user SET genre=:modif_genre  WHERE id= :id';
    $statement = $this->donner->prepare($requete);
    $statement->bindParam('modif_genre', $genre, PDO::PARAM_STR);
    $statement->bindParam(':id', $user, PDO::PARAM_STR);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
}
public function editphoto($user,$photo){
    $requete = 'UPDATE user SET picture=:modif_picture  WHERE id= :id';
    $statement = $this->donner->prepare($requete);
    $statement->bindParam('modif_picture', $photo, PDO::PARAM_STR);
    $statement->bindParam(':id', $user, PDO::PARAM_STR);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
}
public function editheader($user,$header){
    $requete = 'UPDATE user SET header=:modif_header  WHERE id= :id';
    $statement = $this->donner->prepare($requete);
    $statement->bindParam('modif_header', $header, PDO::PARAM_STR);
    $statement->bindParam(':id', $user, PDO::PARAM_STR);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
}
//-------------------------------------------------------------------------------
public function  connexion ($email,$password) {
    //Faire la requete important les '' et nom de variable
    $requete1 = "SELECT * FROM user WHERE email = :email AND password = :password ";
    //Preparer notre requete
    $statement1=$this->donner->prepare($requete1);
    //Executer la requete et verifier
    $statement1->bindParam(':email', $email,PDO::PARAM_STR);
    $statement1->bindParam(':password', $password,PDO::PARAM_STR);
    $statement1->execute();
    return $statement1->fetch(PDO::FETCH_ASSOC);
    
}

//--------------------------------------------------------------------------------


public function info($user){
    $requete = "SELECT firstname, lastname ,username,biography,picture FROM user WHERE id = :id";
    $statement = $this->donner->prepare($requete);
    $statement->bindParam(':id', $user, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
}


}
//----------------------------------------------------------------------------------
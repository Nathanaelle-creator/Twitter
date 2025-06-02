<?php
session_start();
require("../../model/User.php");
class RegisterController{
    private $regist;
    private $modif;
    private $login;
    private $search;
    private $info;


    private $hastag;
    public function __construct() {
        $this->regist = new RegisterModel ();
        $this->modif=new RegisterModel ();
        $this->login=new RegisterModel ();
        $this->search=new RegisterModel ();
        $this->hastag=new RegisterModel ();
        $this->info=new RegisterModel ();
    }
    public function regist($post){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $firstname = $_POST["firstname"];
            $lastname= $_POST["lastname"];
            $username=$_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $birthdate=$_POST["birthdate"];
            $phone=$_POST["phone"];
            $country=$_POST["country"];
            $genre=$_POST["genre"];
        $editeur=$this->regist->register($firstname,$lastname,$username,$email,$password,$birthdate,$phone,$country,$genre);
        if($editeur){
            $_SESSION["login"] = true;
            $_SESSION["id"] = $editeur;
            header('Location:../../views/user/loginView.php');
        }
        else {
            //echo "Bienvenue, vous etes inscriprite !"; 
            
        }
    }
}

//---------------------------------------------------------------------------------
public function modification($post){

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $firstname = $_POST["modif_firstname"];
        $lastname= $_POST["modif_lastname"];
        $username=$_POST["modif_username"];
        $email = $_POST["modif_email"];
        $password = $_POST["modif_password"];
        $city = $_POST["modif_city"];
        $bio=$_POST["modif_biography"];
        $phone=$_POST["modif_phone"];
        $country=$_POST["modif_country"];
        $genre=$_POST["modif_genre"];
        $photo=$_POST["modif_picture"];
        $header=$_POST["modif_header"];

    if (!empty($_SESSION['id'])) {
        $user = $_SESSION['id'];
        $result=$this->modif->getid($user);
           // if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($result && $post["modif_firstname"]) {
                $firstname= $_POST["modif_firstname"];
                $result1 = $this->modif->editfirstname($user,$firstname);
                echo'Firstname modifier';
            } elseif ($result && $post["modif_lastname"]) {
                $lastname = $post["modif_lastname"];
            $result2 = $this->modif->editlastname( $user,$lastname);
                echo'lastname modifier';
            }elseif ($result && $post['modif_username']) {
                $username = $post["modif_username"];
            $result3 = $this->modif->editusername( $user,$username);
                echo'username modifier';
            }elseif ($result && $post['modif_email']) {
                $email = $post["modif_email"];
            $result3 = $this->modif->editemail($user,$email);
                echo'email modifier';
            }elseif ($result && $post['modif_password']) {
                $password = $post["modif_password"];
            $result3 = $this->modif->editpassword( $user,$password);
                echo'password modifier';
            }elseif ($result && $post['modif_phone']) {
                $phone = $post["modif_phone"];
            $result3 = $this->modif->editphone( $user,$phone);
                echo'phone modifier';
            }elseif ($result && $post['modif_biography']) {
                $bio = $post["modif_biography"];
            $result3 = $this->modif->editbiography( $user,$bio);
                echo'biography modifier';
            }elseif ($result && $post['modif_city']) {
                $city = $post["modif_city"];
            $result3 = $this->modif->editcity( $user,$city);
                echo'city modifier';
            }elseif ($result && $post['modif_country']) {
                $country = $post["modif_country"];
            $result3 = $this->modif->editcountry( $user,$country);
                echo'country modifier';
            }elseif ($result && $post['modif_genre']) {
                $genre = $post["modif_genre"];
            $result3 = $this->modif->editgenre( $user,$genre);
                echo'country modifier';
            }elseif($result && $post['modif_picture']) {
                $result3 = $this->modif->editphoto($user,$photo);
                echo'photo modifier';
            }elseif($result && $post['modif_header']){
                $result3 = $this->modif->editheader($user,$header);
                echo'header modifier';
            }
        }
    }
}
//----------------------------------------------------------------------------------

public function login($post) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];
    $connexion=$this->login->connexion($email,$password);
    if($connexion){
        $_SESSION["login"] = true;
            $_SESSION["id"] = $connexion["id"];
            //header("Location: ../../index.php");
            //header("Location: ../../views/user/home.php");
            //header("Location: ../../views/user/test.php");
            header("Location: ../../views/user/home.php");
            exit();
        }else {
        
            echo "Erreur de connexion, veuillez vérifier vos informations.";
        }
    }
}
//-------------------------------------------------------------------------

public function info($post){
    if(isset ($_POST["follower"])){
        $user = !empty($_POST["follower"]) ? trim(htmlspecialchars($_POST["follower"])) : '%';
        $this->search->info($user);
    }
}
}
?>
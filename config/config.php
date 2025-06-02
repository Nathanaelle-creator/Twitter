<?php
if (!class_exists('BaseDeDonne')) {
class BaseDeDonne{
    private $databases;
    function DBConnection(){
        try {
            $this->databases=new PDO('mysql:host=127.0.0.1; dbname=twitter;','nathanaelle', 'latouche09');
           $this->databases->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->databases;
        }
        catch(PDOException $e) {
            die('Erreur: ' . $e->getMessage());
        }

    } 

    function connecté(){
        echo " connecté";
    }

} 
}
?>


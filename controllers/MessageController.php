
<?php
session_start();
require_once '../../model/Message.php';

class MessageController {
    private $messageModel;

    public function __construct() {
        $this->messageModel = new MessageModel();
    }

    public function envoyerMessage($post) {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $destinataireId = $_GET['id']; // ID du destinataire
            if (isset($post['message'])) {
                $message = $post['message'];
                $this->messageModel->addMessage($message, $destinataireId);
            }
        }
    }

    public function voirMessages() {
        if (isset($_GET['id'])) {
            $destinataireId = $_GET['id'];
            return $this->messageModel->voirMessages($destinataireId); 
        }
        return [];
    }
    public function follower() {
        if (!empty($_SESSION['id'])) {
            $user = $_SESSION['id'];
            $result=$this->messageModel->getid($user);
            return $this->messageModel->follower($user); 
            
        }
        return [];
    }


  
}
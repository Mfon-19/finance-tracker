<?php
namespace App\Controller;
use \App\Model\User;

class ContactController{
    private $userModel;

    public function __construct($conn){
        $this->userModel = new User($conn);
    }

    public function index(){
        require_once __DIR__ . '/../../src/View/contact.php';
    }

    public function addContact($fullName, $email, $phoneNumber, $message){
        $result = $this->userModel->addContact($fullName, $email, $phoneNumber, $message);
        if($result){
            header('Location: /contact');
        }
    }
}
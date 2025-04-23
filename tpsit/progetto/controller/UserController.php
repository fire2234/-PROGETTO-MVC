<?php
require_once 'Model/UserModel.php';

class UserController {
    private $userModel;

    public function __construct()
    {
        global $pdo;
        $this->userModel = new UserModel($pdo);
    }

    public function register()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $cognome   = $_POST['cognome'] ?? '';
            $nome      = $_POST['nome'] ?? '';
            $email     = $_POST['email'] ?? '';
            $password  = $_POST['password'] ?? '';

            $this->userModel->register($cognome, $nome, $email, $password);
            echo "<script>alert('Registrazione avvenuta con successo'); window.location.href='index.php';</script>";
        }
        else
        {
            require 'View/register.php';
        }
    }


public function login()
{
    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $email    = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $userId = $this->userModel->checkUser($email, $password); 
        // Modifichiamo 'checkUser' in modo da restituire l’id utente o false

        if($userId)
        {
            $_SESSION['user_id'] = $userId; // Salva ID utente in sessione
            echo "<script>alert('Login effettuato con successo'); window.location.href='index.php';</script>";
        }
        else
        {
            echo "<script>alert('Credenziali non valide');</script>";
        }
    }
    require 'View/login.php';
}
    }

<?php

class UserModel {
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function register($cognome, $nome, $email, $password)
    {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt   = $this->pdo->prepare("INSERT INTO user (cognome, nome, email, password) VALUES (?, ?, ?, ?)");
        $stmt->execute([$cognome, $nome, $email, $hashed]);
    }
    

    public function checkUser($email, $password)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
    
        if($user && password_verify($password, $user['password'])) {
            // Ritorna l’ID dell’utente
            return $user['id'];
        }
        return false;
    }
}
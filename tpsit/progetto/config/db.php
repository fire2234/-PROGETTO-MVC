<?php
// Impostazioni connessione al database
$host     = 'localhost';
$db       = 'gite_scolastiche';
$user     = 'root';
$password = '';

try {
    // Creazione della connessione PDO
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $password);
} catch (PDOException $e) {
    exit('Connessione fallita: '.$e->getMessage());
}
<?php
require_once 'Model/MeteModel.php';
require_once 'Model/TourModel.php';

class MeteController {
    private $meteModel;
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->meteModel = new MeteModel($pdo);
    }

    public function index()
    {
        $mete = $this->meteModel->getAllMete();
        require 'View/mete_index.php';
    }

    public function create()
    {
        require 'View/mete_create.php';
    }

    public function store()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'] ?? '';
            $descrizione = $_POST['descrizione'] ?? '';
            $data_gita = $_POST['data_gita'] ?? '';
            $costo = $_POST['costo'] ?? '0';
            $num_partecipanti = $_POST['num_partecipanti'] ?? '0';
            
            $userId = $_SESSION['user_id'] ?? null; // Utente loggato
            $this->meteModel->createMeta($nome, $descrizione, $data_gita, $costo, $num_partecipanti, $userId);
        }
        header('Location: index.php?url=mete');
    }

    public function edit($id)
    {
        $meta = $this->meteModel->getMetaById($id);
        require 'View/mete_edit.php';
    }

    public function update()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $nome = $_POST['nome'] ?? '';
            $descrizione = $_POST['descrizione'] ?? '';
            $data_gita = $_POST['data_gita'] ?? '';
            $costo = $_POST['costo'] ?? '0';
            $num_partecipanti = $_POST['num_partecipanti'] ?? '0';
            $this->meteModel->updateMeta($id, $nome, $descrizione, $data_gita, $costo, $num_partecipanti);
        }
        header('Location: index.php?url=mete');
    }

    public function delete($id)
    {
        if (!$this->meteModel->isOwner($id, $_SESSION['user_id'])) {
            exit('Non hai i permessi per eliminare questa meta.');
        }
    
        $this->meteModel->deleteMeta($id);
        header('Location: index.php?url=mete');
    }

    public function join($id)
    {
        $userId = $_SESSION['user_id'] ?? null;
        if($this->meteModel->joinMeta($id, $userId)) {
            echo "<script>alert('Iscrizione effettuata!'); window.location.href='index.php?url=mete';</script>";
        } else {
            echo "<script>alert('Numero massimo di partecipanti raggiunto.'); window.location.href='index.php?url=mete';</script>";
        }
    }

    public function show($id)
    {
        $meta = $this->meteModel->getMetaById($id);
        $tourModel = new TourModel($this->pdo);
        $tours = $tourModel->getToursByMeta($id);

        $userId = $_SESSION['user_id'] ?? null;
        $totalPrice = $this->meteModel->getTotalPrice($id, $userId);

        require 'View/mete_show.php';
    }
}

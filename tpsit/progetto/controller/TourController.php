<?php
require_once 'Model/TourModel.php';
class TourController {
    private $tourModel;

    public function __construct()
    {
        global $pdo;
        $this->tourModel = new TourModel($pdo);
    }

    // Visualizza l'elenco dei tour per una data meta
    public function index($metaId)
    {
        $tours = $this->tourModel->getToursByMeta($metaId);
        require 'View/tour_index.php';
    }

    // Mostra il form per la creazione di un tour (per una meta)
    public function create($metaId)
    {
        require 'View/tour_create.php';
    }

    // Salva il nuovo tour nel database
    public function store($metaId)
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'] ?? '';
            $descrizione = $_POST['descrizione'] ?? '';
            $durata = $_POST['durata'] ?? '';
            $costo_aggiuntivo = $_POST['costo_aggiuntivo'] ?? '0';
            $this->tourModel->createTour($metaId, $nome, $descrizione, $durata, $costo_aggiuntivo);
        }
        header("Location: index.php?url=tour-index&meta_id=" . $metaId);
    }

    // Mostra il form per modificare un tour esistente
    public function edit($id)
    {
        $tour = $this->tourModel->getTourById($id);
        require 'View/tour_edit.php';
    }

    // Aggiorna il tour modificato
    public function update()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $metaId = $_POST['meta_id'] ?? null;
            $nome = $_POST['nome'] ?? '';
            $descrizione = $_POST['descrizione'] ?? '';
            $durata = $_POST['durata'] ?? '';
            $costo_aggiuntivo = $_POST['costo_aggiuntivo'] ?? '0';
            $this->tourModel->updateTour($id, $nome, $descrizione, $durata, $costo_aggiuntivo);
        }
        header("Location: index.php?url=tour-index&meta_id=" . $metaId);
    }

    // Elimina un tour
    public function delete($id, $metaId)
    {
        $this->tourModel->deleteTour($id);
        header("Location: index.php?url=tour-index&meta_id=" . $metaId);
    }

    public function join($id)
    {
        $userId = $_SESSION['user_id'] ?? null;
        $metaId = $_GET['meta_id'] ?? null;
        if($this->tourModel->joinTour($id, $userId)) {
            echo "<script>alert('Iscrizione effettuata al tour!'); window.location.href='index.php?url=tour-index&meta_id=".$metaId."';</script>";
        } else {
            echo "<script>alert('Sei già iscritto a questo tour.'); window.location.href='index.php?url=tour-index&meta_id=".$metaId."';</script>";
        }
}
}
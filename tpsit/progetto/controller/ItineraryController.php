<?php
class ItineraryController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Mostra il form per personalizzare l’itinerario
    public function customize() {
        // Recupera le mete e i tour disponibili
        // (es. istanziare i modelli MeteModel, TourModel, ecc.)
        require 'View/itinerary_customize.php';
    }

    // Salva l’itinerario personalizzato
    public function save() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Leggi i tour selezionati
            $selectedTours = $_POST['tours'] ?? [];
            // Salva l’itinerario nel database (crea una tabella "itineraries" se non esiste)
            // ...
            echo "<script>alert('Itinerario salvato!'); window.location.href='index.php';</script>";
        }
    }
}
?>
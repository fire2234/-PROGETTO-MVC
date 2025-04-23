<?php
class TourModel {
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Restituisce i tour per una determinata meta
    public function getToursByMeta($metaId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tours WHERE meta_id = ? ORDER BY nome ASC");
        $stmt->execute([$metaId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crea un nuovo tour associato a una meta
    public function createTour($metaId, $nome, $descrizione, $durata, $costo_aggiuntivo)
    {
        $sql = "INSERT INTO tours (meta_id, nome, descrizione, durata, costo_aggiuntivo)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$metaId, $nome, $descrizione, $durata, $costo_aggiuntivo]);
    }

    // Recupera un tour passando il suo id
    public function getTourById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tours WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Aggiorna i dati di un tour
    public function updateTour($id, $nome, $descrizione, $durata, $costo_aggiuntivo)
    {
        $sql = "UPDATE tours 
                SET nome = ?, descrizione = ?, durata = ?, costo_aggiuntivo = ? 
                WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nome, $descrizione, $durata, $costo_aggiuntivo, $id]);
    }

    // Elimina un tour
    public function deleteTour($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM tours WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Metodo per verificare se l'utente è già iscritto a un tour
    public function isUserJoined($tourId, $userId)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM tour_adesioni WHERE tour_id = ? AND user_id = ?");
        $stmt->execute([$tourId, $userId]);
        return $stmt->fetchColumn() > 0;
    }
    
    // Metodo per iscrivere un utente a un tour
    public function joinTour($tourId, $userId)
    {
        if ($this->isUserJoined($tourId, $userId)) {
            return false;
        }
        $stmt = $this->pdo->prepare("INSERT INTO tour_adesioni (tour_id, user_id) VALUES (?, ?)");
        return $stmt->execute([$tourId, $userId]);
    }
    
}
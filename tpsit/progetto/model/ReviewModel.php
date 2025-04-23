<?php
class ReviewModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Salva una recensione per una meta
    public function createReview($metaId, $userId, $rating, $comment) {
        $sql = "INSERT INTO reviews (meta_id, user_id, rating, comment, created_at) VALUES (?, ?, ?, ?, NOW())";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$metaId, $userId, $rating, $comment]);
    }

    // Recupera le recensioni per una meta
    public function getReviewsByMeta($metaId) {
        $sql = "SELECT r.*, u.nome, u.cognome 
                FROM reviews r 
                JOIN user u ON r.user_id = u.id 
                WHERE r.meta_id = ? 
                ORDER BY r.created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$metaId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
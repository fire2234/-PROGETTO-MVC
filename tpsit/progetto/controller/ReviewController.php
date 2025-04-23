<?php
require_once 'Model/ReviewModel.php';

class ReviewController {
    private $reviewModel;

    public function __construct($pdo) {
        $this->reviewModel = new ReviewModel($pdo);
    }

    // Visualizza le recensioni per una meta e il form per aggiungerne una
    public function index($metaId) {
        $reviews = $this->reviewModel->getReviewsByMeta($metaId);
        require 'View/review_index.php';
    }

    // Salva una nuova recensione
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $metaId = $_POST['meta_id'] ?? null;
            $userId = $_SESSION['user_id'] ?? null;
            $rating = $_POST['rating'] ?? null;
            $comment = $_POST['comment'] ?? '';

            if ($metaId && $userId && $rating) {
                $this->reviewModel->createReview($metaId, $userId, $rating, $comment);
            }
            header("Location: index.php?url=review-index&meta_id=" . $metaId);
        }
    }
}
?>
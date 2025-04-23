<?php
session_start();

require_once 'config/db.php';
require_once 'Controller/UserController.php';
require_once 'Controller/MeteController.php';
require_once 'Controller/TourController.php';
require_once 'Controller/ReviewController.php';
require_once 'Controller/ItineraryController.php';

function requireLogin() {
    if (empty($_SESSION['user_id'])) {
         echo "<script>alert('Devi effettuare il login per accedere.'); window.location.href='index.php?url=login';</script>";
         exit;
    }
}

$tourController     = new TourController($pdo);
$userController     = new UserController($pdo);
$meteController     = new MeteController($pdo);
$reviewController   = new ReviewController($pdo);
$itineraryController = new ItineraryController($pdo);

$url = $_GET['url'] ?? 'home';

switch($url) {
    // GESTIONE UTENTE
    case 'register':
        $userController->register();
        break;
    case 'login':
        $userController->login();
        break;
    
    // GESTIONE METE
    case 'mete':
        requireLogin();
        $meteController->index();
        break;
    case 'mete-create':
        requireLogin();
        $meteController->create();
        break;
    case 'mete-store':
        requireLogin();
        $meteController->store();
        break;
    case 'mete-edit':
        requireLogin();
        $meteController->edit($_GET['id'] ?? null);
        break;
    case 'mete-update':
        requireLogin();
        $meteController->update();
        break;
    case 'mete-delete':
        requireLogin();
        $meteController->delete($_GET['id'] ?? null);
        break;
    case 'mete-join':
        requireLogin();
        $meteController->join($_GET['id'] ?? null);
        break;
    case 'mete-show':
        requireLogin();
        $meteController->show($_GET['id'] ?? null);
        break;
        
    // GESTIONE TOUR
    case 'tour-index':
        requireLogin();
        $metaId = $_GET['meta_id'] ?? null;
        $tourController->index($metaId);
        break;
    case 'tour-create':
        requireLogin();
        $metaId = $_GET['meta_id'] ?? null;
        $tourController->create($metaId);
        break;
    case 'tour-store':
        requireLogin();
        $metaId = $_GET['meta_id'] ?? null;
        $tourController->store($metaId);
        break;
    case 'tour-edit':
        requireLogin();
        $tourController->edit($_GET['id'] ?? null);
        break;
    case 'tour-update':
        requireLogin();
        $tourController->update();
        break;
    case 'tour-delete':
        requireLogin();
        $metaId = $_GET['meta_id'] ?? null;
        $tourController->delete($_GET['id'] ?? null, $metaId);
        break;
    case 'tour-join':
        requireLogin();
        $tourController->join($_GET['id'] ?? null);
        break;
        
    // RECENSIONI METE
    case 'review-index':
        requireLogin();
        $metaId = $_GET['meta_id'] ?? null;
        $reviewController->index($metaId);
        break;
    case 'review-store':
        requireLogin();
        $reviewController->store();
        break;
    
    // PANNELLO DI AMMINISTRAZIONE
    case 'admin-dashboard':
        requireLogin();
        // Verifica eventuale ruolo admin
        $adminController->dashboard();
        break;
    
    // ITINERARIO PERSONALIZZATO
    case 'itinerary-customize':
        requireLogin();
        $itineraryController->customize();
        break;
    case 'itinerary-save':
        requireLogin();
        $itineraryController->save();
        break;
    
    // PAGINA DI DEFAULT (HOME)
    default:
        echo '<!DOCTYPE html>
        <html lang="it">
        <head>
          <meta charset="UTF-8">
          <title>Gestione Gite</title>
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        </head>
        <body class="bg-light">
        <div class="container mt-5">
            <h1 class="mb-4">Benvenuto nella Gestione Gite</h1>
            <div>
                <a class="btn btn-primary me-2" href="?url=register">Registrati</a>
                <a class="btn btn-success me-2" href="?url=login">Login</a>
                <a class="btn btn-secondary" href="?url=mete">Vedi Mete</a>
            </div>
        </div>
        
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>';
        break;
}
?>
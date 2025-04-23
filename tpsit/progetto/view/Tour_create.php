<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Crea Tour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>Crea Tour per la Meta</h2>
    <form method="post" action="index.php?url=tour-store&meta_id=<?php echo $_GET['meta_id']; ?>" class="card p-4">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome del Tour</label>
            <input type="text" name="nome" id="nome" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="descrizione" class="form-label">Descrizione</label>
            <textarea name="descrizione" id="descrizione" class="form-control" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="durata" class="form-label">Durata (in giorni)</label>
            <input type="number" name="durata" id="durata" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="costo_aggiuntivo" class="form-label">Costo aggiuntivo</label>
            <input type="number" step="0.01" name="costo_aggiuntivo" id="costo_aggiuntivo" class="form-control" value="0">
        </div>
        <button type="submit" class="btn btn-primary">Crea Tour</button>
        <a href="index.php?url=tour-index&meta_id=<?php echo $_GET['meta_id']; ?>" class="btn btn-secondary">Annulla</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
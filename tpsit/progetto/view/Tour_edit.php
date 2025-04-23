<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Modifica Tour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>Modifica Tour</h2>
    <?php if($tour): ?>
        <form method="post" action="index.php?url=tour-update" class="card p-4">
            <input type="hidden" name="id" value="<?php echo $tour['id']; ?>">
            <input type="hidden" name="meta_id" value="<?php echo $tour['meta_id']; ?>">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome del Tour</label>
                <input type="text" name="nome" id="nome" class="form-control" value="<?php echo htmlspecialchars($tour['nome']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="descrizione" class="form-label">Descrizione</label>
                <textarea name="descrizione" id="descrizione" class="form-control" rows="3"><?php echo htmlspecialchars($tour['descrizione']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="durata" class="form-label">Durata (giorni)</label>
                <input type="number" name="durata" id="durata" class="form-control" value="<?php echo htmlspecialchars($tour['durata']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="costo_aggiuntivo" class="form-label">Costo aggiuntivo</label>
                <input type="number" step="0.01" name="costo_aggiuntivo" id="costo_aggiuntivo" class="form-control" value="<?php echo htmlspecialchars($tour['costo_aggiuntivo']); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Aggiorna Tour</button>
            <a href="index.php?url=tour-index&meta_id=<?php echo $tour['meta_id']; ?>" class="btn btn-secondary">Annulla</a>
        </form>
    <?php else: ?>
        <div class="alert alert-danger">Tour non trovato.</div>
        <a href="index.php?url=tour-index&meta_id=<?php echo $_GET['meta_id']; ?>" class="btn btn-secondary">Torna ai Tour</a>
    <?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
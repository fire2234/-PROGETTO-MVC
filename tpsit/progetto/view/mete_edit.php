<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Modifica Meta</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-3">Modifica Meta</h2>
    <?php if($meta): ?>
        <form action="?url=mete-update" method="post" class="card p-4 shadow-sm">
            <input type="hidden" name="id" value="<?php echo $meta['id']; ?>">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome"
                       value="<?php echo htmlspecialchars($meta['nome']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="descrizione" class="form-label">Descrizione</label>
                <textarea class="form-control" id="descrizione" name="descrizione" rows="3"><?php 
                  echo htmlspecialchars($meta['descrizione']); 
                ?></textarea>
            </div>
            <div class="mb-3">
                <label for="data_gita" class="form-label">Data Gita</label>
                <input type="date" class="form-control" id="data_gita" name="data_gita"
                       value="<?php echo htmlspecialchars($meta['data_gita']); ?>">
            </div>
            <div class="mb-3">
                <label for="costo" class="form-label">Costo</label>
                <input type="number" step="0.01" class="form-control" id="costo" name="costo"
                       value="<?php echo htmlspecialchars($meta['costo']); ?>">
            </div>
            <div class="mb-3">
                <label for="num_partecipanti" class="form-label">Partecipanti Massimi</label>
                <input type="number" class="form-control" id="num_partecipanti" name="num_partecipanti"
                       value="<?php echo htmlspecialchars($meta['numero_partecipanti']); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Aggiorna</button>
            <a href="?url=mete" class="btn btn-secondary">Annulla</a>
        </form>
    <?php else: ?>
        <div class="alert alert-danger">Meta non trovata.</div>
        <a href="?url=mete" class="btn btn-secondary">Torna all'elenco</a>
    <?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
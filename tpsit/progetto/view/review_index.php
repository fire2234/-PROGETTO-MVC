<?php?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Recensioni Meta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <h2>Recensioni per la Meta</h2>
    
    <?php if (!empty($reviews)): ?>
      <?php foreach ($reviews as $r): ?>
        <div class="card mb-3 p-3">
          <h5><?php echo htmlspecialchars($r['nome'] . ' ' . $r['cognome']); ?> - Voto: <?php echo htmlspecialchars($r['rating']); ?></h5>
          <p><?php echo nl2br(htmlspecialchars($r['comment'])); ?></p>
          <small><?php echo htmlspecialchars($r['created_at']); ?></small>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>Nessuna recensione ancora.</p>
    <?php endif; ?>

    <h4>Aggiungi la tua recensione</h4>
    <form method="post" action="index.php?url=review-store" class="card p-4">
      <input type="hidden" name="meta_id" value="<?php echo $_GET['meta_id']; ?>">
      <div class="mb-3">
        <label for="rating" class="form-label">Voto (1-5)</label>
        <input type="number" name="rating" id="rating" class="form-control" min="1" max="5" required>
      </div>
      <div class="mb-3">
        <label for="comment" class="form-label">Commento</label>
        <textarea name="comment" id="comment" class="form-control" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Invia Recensione</button>
      <a href="?url=mete" class="btn btn-secondary">Torna all'elenco</a>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Dettagli Meta</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <?php if(isset($meta) && $meta): ?>
      <h2>Dettagli Meta</h2>
      <div class="card mb-3 p-3">
          <h3><?php echo htmlspecialchars($meta['nome']); ?></h3>
          <p><strong>Descrizione:</strong> <?php echo nl2br(htmlspecialchars($meta['descrizione'])); ?></p>
          <p><strong>Data Gita:</strong> <?php echo htmlspecialchars($meta['data_gita']); ?></p>
          <p><strong>Costo:</strong> € <?php echo htmlspecialchars($meta['costo']); ?></p>
          <p><strong>Max Partecipanti:</strong> <?php echo htmlspecialchars($meta['numero_partecipanti']); ?></p>
      </div>

      <!-- Bottoni di gestione tour -->
      <a href="index.php?url=tour-index&meta_id=<?php echo $meta['id']; ?>" class="btn btn-info mb-3">Visualizza Tour</a>
      <?php if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $meta['user_id']): ?>
          <a href="index.php?url=tour-create&meta_id=<?php echo $meta['id']; ?>" class="btn btn-primary mb-3 ms-2">Aggiungi Tour</a>
      <?php endif; ?>

      <!-- Tabella dei tour -->
      <h4>Tour Associati</h4>
      <?php if(!empty($tours)): ?>
          <table class="table table-bordered">
              <thead>
                  <tr>
                      <th>Nome Tour</th>
                      <th>Descrizione</th>
                      <th>Durata (giorni)</th>
                      <th>Costo aggiuntivo</th>
                  </tr>
              </thead>
              <tbody>
                  <?php foreach($tours as $tour): ?>
                      <tr>
                          <td><?php echo htmlspecialchars($tour['nome']); ?></td>
                          <td><?php echo htmlspecialchars($tour['descrizione']); ?></td>
                          <td><?php echo htmlspecialchars($tour['durata']); ?></td>
                          <td>€ <?php echo htmlspecialchars($tour['costo_aggiuntivo']); ?></td>
                      </tr>
                  <?php endforeach; ?>
              </tbody>
          </table>
      <?php else: ?>
          <p>Nessun tour associato a questa meta.</p>
      <?php endif; ?>

      <!-- Prezzo totale -->
      <?php 
        if(isset($_SESSION['user_id'])) {
      ?>
            <div class="alert alert-info mt-3">
                <strong>Prezzo Totale:</strong> € <?php echo number_format($totalPrice, 2, ',', '.'); ?>
            </div>
      <?php } ?>
      <?php if(isset($meta) && $meta): ?>
    <!-- existing details… -->
    <a href="index.php?url=review-index&meta_id=<?php echo $meta['id']; ?>"
       class="btn btn-secondary mb-3">
        Vedi Recensioni
    </a>
    <!-- existing tour table… -->
<?php endif; ?>

      <!-- Pulsanti di navigazione -->
      <a href="index.php?url=mete" class="btn btn-secondary">Torna all'elenco delle mete</a>
  <?php else: ?>
      <div class="alert alert-danger">Meta non trovata.</div>
      <a href="index.php?url=mete" class="btn btn-secondary">Torna all'elenco delle mete</a>
  <?php endif; ?>
  
  <a href="index.php" class="btn btn-secondary">Torna alla Home</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
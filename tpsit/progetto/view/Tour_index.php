<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Elenco Tour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <h2>Elenco dei Tour</h2>
    <?php if (!empty($tours)): ?>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome Tour</th>
            <th>Descrizione</th>
            <th>Prezzo</th>
            <th>Promozione</th>
            <th>Azioni</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($tours as $tour): ?>
          <tr>
            <td><?php echo htmlspecialchars($tour['id']); ?></td>
            <td><?php echo htmlspecialchars($tour['nome']); ?></td>
            <td><?php echo htmlspecialchars($tour['descrizione'] ?? ''); ?></td>
            <td>
              <?php 
              if(isset($tour['promotion']) && $tour['promotion']['discount'] > 0) {
                  $discountedPrice = $tour['costo_aggiuntivo'] - (($tour['promotion']['discount'] / 100) * $tour['costo_aggiuntivo']);
                  echo "<del>" . htmlspecialchars($tour['costo_aggiuntivo']) . "</del> " . number_format($discountedPrice, 2);
              } else {
                  echo htmlspecialchars($tour['costo_aggiuntivo']);
              }
              ?>
            </td>
            <td>
              <?php 
              if(isset($tour['promotion']) && $tour['promotion']['discount'] > 0) {
                  echo htmlspecialchars($tour['promotion']['discount'] . ' %');
              } else {
                  echo 'Nessuna';
              }
              ?>
            </td>
            <td>
              <a href="index.php?url=tour-edit&id=<?php echo $tour['id']; ?>" class="btn btn-primary btn-sm">Modifica</a>
              <a href="index.php?url=tour-delete&id=<?php echo $tour['id']; ?>" class="btn btn-danger btn-sm">Elimina</a>
              <a href="index.php?url=tour-join&id=<?php echo $tour['id']; ?>" class="btn btn-success btn-sm">Partecipa</a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p>Nessun tour disponibile.</p>
    <?php endif; ?>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
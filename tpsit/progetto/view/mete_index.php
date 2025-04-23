<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Elenco Mete</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-3">Elenco Mete</h2>
    <a href="?url=mete-create" class="btn btn-primary mb-3">Aggiungi Nuova Meta</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Descrizione</th>
                <th>Data</th>
                <th>Costo</th>
                <th>Sconti</th>
                <th>Max Partecipanti</th>
                <th>Azioni</th>
                <th>Recensioni</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($mete)): ?>
                <?php foreach ($mete as $m): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($m['nome']); ?></td>
                        <td><?php echo htmlspecialchars($m['descrizione']); ?></td>
                        <td><?php echo htmlspecialchars($m['data_gita']); ?></td>
                        <td><?php echo htmlspecialchars($m['costo']); ?></td>
                        <td>Nessuno</td>
                        <td><?php echo htmlspecialchars($m['numero_partecipanti']); ?></td>
                        <td>
                            <a href="?url=mete-show&id=<?php echo $m['id']; ?>" class="btn btn-info btn-sm">Dettagli</a>

                            <?php if ($m['user_id'] == $_SESSION['user_id']): ?>
                                <a href="?url=mete-edit&id=<?php echo $m['id']; ?>" class="btn btn-warning btn-sm">Modifica</a>
                                <a href="?url=mete-delete&id=<?php echo $m['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Sei sicuro di voler eliminare questa meta?')">Elimina</a>
                            <?php else: ?>
                                <?php if (!($m['is_user_joined'] ?? false)): ?>
                                    <a href="?url=mete-join&id=<?php echo $m['id']; ?>" class="btn btn-success btn-sm">Iscriviti</a>
                                <?php else: ?>
                                    <span class="text-muted">Già iscritto</span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="index.php?url=review-index&meta_id=<?php echo $m['id']; ?>" class="btn btn-info btn-sm">
                                Recensioni
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="8">Nessuna meta trovata.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <a href="index.php" class="btn btn-secondary">Torna alla Home</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
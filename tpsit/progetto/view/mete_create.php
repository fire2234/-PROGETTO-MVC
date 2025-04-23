<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Crea Meta</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-3">Aggiungi Meta</h2>
    <form action="?url=mete-store" method="post" class="card p-4 shadow-sm">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="mb-3">
            <label for="descrizione" class="form-label">Descrizione</label>
            <textarea class="form-control" id="descrizione" name="descrizione" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="data_gita" class="form-label">Data Gita</label>
            <input type="date" class="form-control" id="data_gita" name="data_gita">
        </div>
        <div class="mb-3">
            <label for="costo" class="form-label">Costo</label>
            <input type="number" step="0.01" class="form-control" id="costo" name="costo" value="0">
        </div>
        <div class="mb-3">
            <label for="num_partecipanti" class="form-label">Partecipanti Massimi</label>
            <input type="number" class="form-control" id="num_partecipanti" name="num_partecipanti" value="0">
        </div>
        <button type="submit" class="btn btn-primary">Salva</button>
        <a href="?url=mete" class="btn btn-secondary">Annulla</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Personalizza Itinerario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
     <h2>Personalizza il tuo Itinerario</h2>
     <form method="post" action="index.php?url=itinerary-save" class="card p-4">
       <!-- Mostra una lista di tour (es. checkboxes) da cui l'utente può scegliere -->
       <div class="mb-3">
         <label class="form-label">Seleziona i tour desiderati:</label>
         <?php
         // Esempio statico; potresti recuperare i tour dal TourModel
         $tours = [
           ['id' => 1, 'nome' => 'Tour 1'],
           ['id' => 2, 'nome' => 'Tour 2'],
           ['id' => 3, 'nome' => 'Tour 3']
         ];
         foreach ($tours as $tour):
         ?>
           <div class="form-check">
             <input class="form-check-input" type="checkbox" name="tours[]" value="<?php echo $tour['id']; ?>" id="tour<?php echo $tour['id']; ?>">
             <label class="form-check-label" for="tour<?php echo $tour['id']; ?>">
               <?php echo htmlspecialchars($tour['nome']); ?>
             </label>
           </div>
         <?php endforeach; ?>
       </div>
       <button type="submit" class="btn btn-primary">Salva Itinerario</button>
     </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
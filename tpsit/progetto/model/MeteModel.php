<?php
class MeteModel {
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllMete()
    {
        $stmt = $this->pdo->query("SELECT * FROM mete ORDER BY data_gita ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Unica createMeta con $userId
    public function createMeta($nome, $desc, $data, $costo, $maxPartecipanti, $userId)
    {
        $sql = "INSERT INTO mete (nome, descrizione, data_gita, costo, numero_partecipanti, user_id)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nome, $desc, $data, $costo, $maxPartecipanti, $userId]);
    }

    public function getMetaById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM mete WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateMeta($id, $nome, $desc, $data, $costo, $maxPartecipanti)
    {
        $sql = "UPDATE mete 
                SET nome=?, descrizione=?, data_gita=?, costo=?, numero_partecipanti=? 
                WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nome, $desc, $data, $costo, $maxPartecipanti, $id]);
    }

    public function deleteMeta($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM mete WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function isOwner($metaId, $userId)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM mete WHERE id = ? AND user_id = ?");
        $stmt->execute([$metaId, $userId]);
        return $stmt->fetchColumn() > 0;
    }

    public function countPartecipanti($metaId)
{
    $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM adesioni WHERE meta_id = ?");
    $stmt->execute([$metaId]);
    return $stmt->fetchColumn();
}

public function joinMeta($metaId, $userId)
{
    // Controlla se l'utente è già iscritto
    $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM adesioni WHERE meta_id = ? AND user_id = ?");
    $stmt->execute([$metaId, $userId]);
    if ($stmt->fetchColumn() > 0) {
        return false; // già iscritto
    }

    // Recupera i dati della meta per verificare il limite
    $meta = $this->getMetaById($metaId);
    $iscritti = $this->countPartecipanti($metaId);

    if($iscritti < $meta['numero_partecipanti']) {
        $stmt = $this->pdo->prepare("INSERT INTO adesioni (meta_id, user_id) VALUES (?, ?)");
        return $stmt->execute([$metaId, $userId]);
    }

    return false; // Numero massimo raggiunto oppure gia iscritto o altro errore
}

public function getToursByMetaId($metaId) {
    $stmt = $this->pdo->prepare("SELECT * FROM tours WHERE meta_id = :meta_id");
    $stmt->execute(['meta_id' => $metaId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getTotalPrice($metaId, $userId)
{
    // Recupera il costo base della meta
    $stmt = $this->pdo->prepare("SELECT costo FROM mete WHERE id = ?");
    $stmt->execute([$metaId]);
    $baseCost = (float)$stmt->fetchColumn();

    // Somma i costi aggiuntivi dei tour a cui l'utente è iscritto per quella meta
    $stmt2 = $this->pdo->prepare("
        SELECT SUM(t.costo_aggiuntivo) 
        FROM tours t 
        JOIN tour_adesioni ta ON t.id = ta.tour_id 
        WHERE ta.user_id = ? AND t.meta_id = ?
    ");
    $stmt2->execute([$userId, $metaId]);
    $tourCost = (float)$stmt2->fetchColumn();
    
    return $baseCost + $tourCost;
}

}